<?php
session_start();
require 'db.php';
require_once __DIR__ . '/send_verification_email.php';
require_once __DIR__ . '/verify_email_code.php';

if (!isset($_SESSION['pending_device'])) {
    header("Location: index.html");
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
                $_SESSION['user_id'] = $info['user_id'];

                header("Location: dashboard.php");
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
    <title>Xác minh thiết bị</title>
</head>
<body>
    <h3>Thiết bị mới. Vui lòng nhập mã xác minh được gửi đến email:</h3>

    <form method="POST">
        <input type="hidden" name="step" value="verify">
        <input type="text" name="code" placeholder="Mã xác nhận">
        <button type="submit" name="action" value="submit_code">Xác nhận</button>
        <button type="submit" name="action" value="resend_code" id="resend_btn">Gửi lại mã</button>
    </form>

    <p id="countdown" style="font-weight:bold; color:blue;"></p>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <script>
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
