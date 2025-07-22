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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xác thực Email</title>
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .container img {
            width: 80px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 25px;
            margin-bottom: 10px;
        }

        p {
            font-size: 17px;
            color: #666;
            margin-bottom: 20px;
        }

        .code-inputs input {
            width: 40px;
            height: 50px;
            font-size: 20px;
            text-align: center;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .code-inputs input:focus {
            border: 2px solid orange;
            outline: none;
        }

        .verify-btn {
            background: orange;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }

        .link {
            font-size: 13px;
            margin-top: 15px;
        }

        .link a {
            color: black;
            text-decoration: underline;
            font-weight: bold;
        }

        .resend {
            font-size: 13px;
            margin-top: 10px;
        }

        .resend a {
            color: #333;
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 10px;
        }

        .success {
            color: green;
            font-size: 13px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="../RS_icon.jpg" alt="Verify Icon">
    <h2>ROSA AI READY</h2>
    <p>Vui lòng nhập mã gồm 6 chữ số đã được gửi đến email của bạn</p>

    <form id="verifyForm" method="POST">
        <div class="code-inputs">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <input type="text" name="digit<?php echo $i; ?>" maxlength="1" required>
            <?php endfor; ?>
        </div>
        
        <div class="resend">
            <button type="submit" class="verify-btn" value="submit_code">Xác nhận</button> 
            <button type="submit" name="action" value="resend_code" id="resend_btn">Gửi lại mã</button>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $code = "";
            for ($i = 1; $i <= 6; $i++) {
                $digit = $_POST["digit$i"] ?? '';
                $code .= $digit;
            }

            if (strlen($code) < 6 || !ctype_digit($code)) {
                echo "<div class='error'>Vui lòng nhập đủ 6 chữ số từ 0 đến 9.</div>";
            } else {
            
            }
        }
        ?>
    </form>
</div>

<script>
    const inputs = document.querySelectorAll('.code-inputs input');

    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            let value = e.target.value;

            if (value !== "" && !/^\d$/.test(value)) {
                e.target.value = "";
                alert("Chỉ được nhập số (0–9)");
                return;
            }

            if (value !== "" && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    document.getElementById("verifyForm").addEventListener("submit", function(e) {
        let valid = true;
        inputs.forEach(input => {
            if (!/^\d$/.test(input.value)) valid = false;
        });

        if (!valid) {
            e.preventDefault();
            alert("Vui lòng nhập đúng 6 chữ số (0-9).");
        }
    });

    // đêm ngược
    let timeLeft = <?= $time_left ?>;
        const countdownEl = document.getElementById("countdown");
        const resendBtn = document.getElementById("resend_btn");

        function updateCountdown() {
            if (timeLeft <= 0) {
                countdownEl.textContent = "Bạn có thể gửi lại mã.";
                resendBtn.disabled = false;
                return;
            }

            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;

            countdownEl.textContent = `Vui lòng chờ: ${minutes} phút ${seconds < 10 ? '0' : ''}${seconds} giây để gửi lại mã`;
            resendBtn.disabled = true;
            timeLeft--;

            setTimeout(updateCountdown, 1000);
        }
        updateCountdown();
</script>

</body>
</html>
