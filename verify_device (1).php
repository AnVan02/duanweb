<?php
session_start();
require 'db.php';
require_once __DIR__ . '/send_verification_email.php';
require_once __DIR__ . '/verify_email_code.php';

if (!isset($_SESSION['pending_device'])) {
    header("Location: login.php");
    exit;
}

$step = $_POST['step'] ?? '';
$action = $_POST['action'] ?? '';
$error = '';
$message = '';

$info = $_SESSION['pending_device'];
$user_id = $info['user_id'];
$timeout_seconds = $info['timeout_email'] * 60;

$stmt = $db->prepare("SELECT code_sent_at FROM students WHERE id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetch();

$time_left = 0;
if ($row && $row['code_sent_at']) {
    $code_sent_at = strtotime($row['code_sent_at']);
    $current_time = time();
    $time_left = max(0, ($code_sent_at + $timeout_seconds) - $current_time);
}

if ($step === 'verify') {
    if ($action === 'submit_code') {
        $code = $_POST['code'] ?? '';

        if ($code) {
            $resultVerify = verifyEmailCode($db, $info['user_id'], $code, $EMAIL_VERIFY_CONFIG);

            if ($resultVerify['status'] === 'error') {
                if ($resultVerify['code'] === 1) {
                    $wait = $resultVerify['timeout_remaining'] ?? '?';
                    $error = "Bạn đã nhập sai quá số lần cho phép. Vui lòng thử lại sau $wait phút.";
                } elseif ($resultVerify['code'] === 2) {
                    $left = $resultVerify['remaining_attempts'] ?? '?';
                    $error = "Mã xác minh không đúng. Bạn còn $left lần thử.";
                }
            } else {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $ip = $_SERVER['REMOTE_ADDR'];

                $stmt = $db->prepare("INSERT INTO user_devices1 (user_id, fingerprint, user_agent, ip_address, login_count, last_login)
                                      VALUES (?, ?, ?, ?, 1, NOW())");
                $stmt->execute([
                    $info['user_id'],
                    $info['fingerprint'],
                    $user_agent,
                    $ip
                ]);

                unset($_SESSION['pending_device']);
                $_SESSION['student_id'] = $info['user_id'];

                header("Location: overview.php");
                exit;
            }
        } else {
            $error = "Vui lòng nhập mã xác minh.";
        }
    } elseif ($action === 'resend_code') {
        if ($time_left > 0) {
            $error = "Bạn phải chờ thêm trước khi gửi lại mã.";
        } else {
            $email = $info['email'];
            $full_name = $info['full_name'];
            $code = rand(100000, 999999);

            $result = send_verification_code($email, $full_name, $code, 'Xác minh tài khoản ROSA', 'Mã xác minh tài khoản');

            if ($result === true) {
                $updateCode = $db->prepare("UPDATE students SET email_code = ?, code_sent_at = NOW(), verify_fail_count = 0 WHERE id = ?");
                $updateCode->execute([$code, $user_id]);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                $error = "Gửi mã thất bại. Vui lòng thử lại.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác minh thiết bị</title>
    <style>
        body {
            background: linear-gradient(135deg,#99CCFF,#99CCFF);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 350px;
            margin: 140px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }
        .digit-box {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 20px 0;
        }
        input.digit {
            width: 40px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        input[type="hidden"] {
            display: none;
        }
        button {
            background: #00CCFF;
            color: white;
            border: none;
            padding: 12px 25px;
            margin: 10px 5px;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        .success {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }
        #countdown {
            font-weight: bold;
            color: #0077b6;
        }
    </style>
</head>
<body>
<div class="header">
    
<div class="container">
    <img src="image/icon_rosa.jpg" width="60" alt="Verify Icon">
    <h3>ROSA AI READY </h3>
    <p>Vui lòng nhập mã gồm 6 chữ số đã được gửi đến email của bạn</p>

    <form method="POST" id="verifyForm">
        <input type="hidden" name="step" value="verify">
        <input type="hidden" name="code" id="code_combined">
        <div class="digit-box">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <input type="text" maxlength="1" class="digit" inputmode="numeric" pattern="[0-9]*" required>
            <?php endfor; ?>
        </div>
        <div>
            <button type="submit" name="action" value="submit_code" id="submitBtn">Xác nhận</button>
            <button type="submit" name="action" value="resend_code" id="resend_btn">Gửi lại mã</button>
        </div>
    </form>
    <p id="countdown"></p>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <?php if (!empty($message)) echo "<div class='success'>$message</div>"; ?>
</div>
<script>
    const digits = document.querySelectorAll('.digit');
    const codeInput = document.getElementById('code_combined');
    const form = document.getElementById('verifyForm');
    const resendBtn = document.getElementById('resend_btn');
    const countdownEl = document.getElementById('countdown');

    // Auto move and restrict to digits
    digits.forEach((input, index) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '');
            if (input.value && index < digits.length - 1) {
                digits[index + 1].focus();
            }
            updateHiddenInput();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                digits[index - 1].focus();
            }
        });
    });

    function updateHiddenInput() {
        let code = '';
        digits.forEach(d => code += d.value);
        codeInput.value = code;
    }

    // Submit with Enter
    form.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('submitBtn').click();
        }
    });

    // Countdown resend
    let timeLeft = <?= $time_left ?>;
    function updateCountdown() {
        if (timeLeft <= 0) {
            countdownEl.textContent = "Bạn có thể gửi lại mã.";
            resendBtn.disabled = false;
        } else {
            let m = Math.floor(timeLeft / 60);
            let s = timeLeft % 60;
            countdownEl.textContent = `Vui lòng chờ: ${m} phút ${s < 10 ? '0' : ''}${s} giây để gửi lại mã`;
            resendBtn.disabled = true;
            timeLeft--;
            setTimeout(updateCountdown, 1000);
        }
    }
    updateCountdown();
</script>

</body>
</html>
