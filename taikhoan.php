<?php
session_start();
require 'db.php';
require_once __DIR__ . '/send_verification_email.php';
require_once __DIR__ . '/verify_email_code.php';

$student_id = $_POST['student_id'] ?? '';
$password = $_POST['password'] ?? '';
$fingerprint = $_POST['fingerprint'] ?? '';

if (!$student_id || !$password || !$fingerprint) {
    echo "<script>alert('Thiếu thông tin!'); window.history.back();</script>";
    exit;
}

// 1. Kiem tra nguoi dung
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$student_id]);
$user = $stmt->fetch();

if (!$user || ($password !== $user['password_hash'])) {
    echo "<script>alert('Email hoặc mật khẩu sai!'); window.history.back();</script>";
    exit;
}

$user_id = $user['id'];
echo $user['admin'];
if ((int)$user['admin'] === 1) {
    $_SESSION['student_id'] = $user_id;
    header("Location: overview.php");
    exit;
}

$user_id = $user['id'];
$full_name = $user['full_name'];
$email = $user['email'];

// 2. Kiem tra fingerprint co ton tai chua
$stmt = $db->prepare("SELECT * FROM user_devices1 WHERE user_id = ? AND fingerprint = ?");
$stmt->execute([$user_id, $fingerprint]);
$device = $stmt->fetch();

if (!$device) {
    // 3. Diem so luong thiet bi dang co
    $stmt = $db->prepare("SELECT * FROM user_devices1 WHERE user_id = ? AND active = 1");
    $stmt->execute([$user_id]);
    $devices = $stmt->fetchAll();

    if (count($devices) >= 3) {
        // 4. Xoa thiet bi it dung nhat..
        $stmt = $db->prepare("SELECT id from user_devices1 WHERE user_id = ? AND active = 1 ORDER BY login_count ASC, last_login ASC LIMIT 1");
        $stmt->execute([$user_id]);
        $oldest = $stmt->fetch();
        if ($oldest) {
            $db->prepare("DELETE FROM users_devices WHERE id = ?")->execute([$oldest['id']]);
        }
    }

    // 5. Chua xac minh thiet bi -> yeu cau nhap ma code
    $code = rand(100000, 999999);

    $result = send_verification_code($email, $full_name, $code, 'Xác minh tài khoản ROSA', 'Mã xác minh tài khoản');

    if ($result === true) {
        $updateCode = $db->prepare("UPDATE users
            SET email_code = ?, code_sent_at = NOW()
            WHERE id = ?");
        $updateCode->execute([$code, $user_id]);
        
        $_SESSION['pending_device'] = [
            'user_id' => $user_id,
            'fingerprint' => $fingerprint,
            'email' => $email,
            'full_name' => $full_name,
            'timeout_email' => $EMAIL_VERIFY_CONFIG['timeout_minutes']
        ];
        header("Location: verify_device.php");
        exit;
    } else {
        echo"<script> alert ('Khong the gui ma xac minh!!!!!!'); window.history.back();<script>";
        exit;
    }

}

// 6. Cap nhat login_count va last_login
else {
    $db->prepare("UPDATE user_devices1 SET login_count = login_count + 1, last_login = NOW() WHERE id = ?")
       ->execute([$device['id']]);
    
    $_SESSION['student_id'] = $user_id;
    header("Location: overview.php");
}
?>