<?php
// db.php - Kết nối đến cơ sở dữ liệu ROSA
$EMAIL_VERIFY_CONFIG = [
    'max_attempts' => 5,
    'timeout_minutes' => 1
];

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "student";

try {
    $db = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    // Bật chế độ thông báo lỗi dạng Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Hiển thị lỗi kết nối
    die("Kết nối thất bại: " . $e->getMessage());
}
?>