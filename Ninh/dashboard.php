<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Bảng điều khiển</title></head>
<body>
    <h2>Chào mừng bạn đến hệ thống!</h2>
    <a href="logout.php">Đăng xuất</a>
</body>
</html>
