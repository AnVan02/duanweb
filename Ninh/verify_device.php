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

// Lấy thời điểm code_sent_at từ CSDL
$stmt = $db->prepare("SELECT code_sent_at FROM users WHERE id = ?");
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
                $updateCode = $db->prepare("UPDATE users SET email_code = ?, code_sent_at = NOW(), verify_fail_count = 0 WHERE id = ?");
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
    <title>XÁC MINH TÀI KHOẢN</title>
    <link rel="shortcut icon" href="image/icon_rosa.jpg" />
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            font-family: Arial, sans-serif;
            margin: 0; padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 10px;
            color: #333;
        }
        .code-input {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        .code-input input {
            width: 45px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            border-radius: 10px;
            border: 1px solid #ccc;
            outline: none;
            transition: border 0.2s;
        }
        .code-input input:focus {
            border: 2px solid #0077b6;
        }
        button {
            padding: 10px 20px;
            border: none;
            margin: 5px;
            font-size: 16px;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
        }
        button[type="submit"] {
            background: orange;
            color: white;
        }
        #resend_btn {
            background: #ccc;
        }
        #resend_btn:disabled {
            background: #bbb;
            cursor: not-allowed;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
        #countdown {
            font-size: 13px;
            margin-top: 10px;
            color: #0077b6;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="image/icon_rosa.jpg" width="80" alt="Verify Icon">
    <h2>ROSA AI READY</h2>
    <p>Vui lòng nhập mã gồm 6 chữ số đã được gửi đến email của bạn</p>

    <form method="POST" id="verifyForm">
        <input type="hidden" name="step" value="verify">
        <div class="code-input">
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
        </div>
        <input type="hidden" name="code" id="full_code">

        <div>
            <button type="submit" class="verify-btn" value="resend_code" id="resend_btn">Gửi lại mã</button>
            <button type="submit" name="action" value="submit_code">Xác nhận</button>
        </div>
    </form>

    <p id="countdown"></p>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <?php if (!empty($message)) echo "<div class='success'>$message</div>"; ?>
</div>

<script>
    const inputs = document.querySelectorAll('.code-input input');
    const hiddenCodeInput = document.getElementById('full_code');
    const resendBtn = document.getElementById('resend_btn');
    const countdown = document.getElementById('countdown');
    let timeLeft = <?= $time_left ?>;

    // Tự chuyển sang ô tiếp theo
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/, '');
            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    // Gộp mã khi submit
    document.getElementById('verifyForm').addEventListener('submit', function(e) {
        const action = document.activeElement.value;
        const code = Array.from(inputs).map(i => i.value).join('');

        if (action === 'submit_code') {
            if (code.length !== 6) {
                e.preventDefault();
                alert("Vui lòng nhập đủ 6 chữ số.");
                return;
            }
            hiddenCodeInput.value = code;
        }
    });

    // Đếm ngược
    function updateCountdown() {
        if (timeLeft <= 0) {
            countdown.textContent = "Bạn có thể gửi lại mã.";
            resendBtn.disabled = false;
            return;
        }

        let min = Math.floor(timeLeft / 60);
        let sec = timeLeft % 60;
        countdown.textContent = `Chờ ${min} phút ${sec < 10 ? '0' : ''}${sec} giây để gửi lại mã`;
        resendBtn.disabled = true;
        timeLeft--;
        setTimeout(updateCountdown, 1000);
    }

    updateCountdown();
</script>

</body>
</html>
