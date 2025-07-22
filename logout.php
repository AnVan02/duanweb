<?php
session_start();
session_unset(); // Xoá tất cả các biến session
session_destroy(); // Huỷ session

// Quay về trang đăng nhập hoặc trang chính
header("Location: login.php"); // hoặc index.php tùy bạn
exit;
?>
