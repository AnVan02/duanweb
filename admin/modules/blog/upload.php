<?php
// modules/blog/upload.php

// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Thư mục lưu trữ file
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
}

// Kiểm tra file upload
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $targetFile = $uploadDir . $fileName;

    // Di chuyển file vào thư mục uploads
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Trả về URL của file
        $fileUrl = '/uploads/' . $fileName; // Điều chỉnh URL theo cấu hình server
        echo json_encode(['link' => $fileUrl]);
    } else {
        echo json_encode(['error' => 'Không thể upload file']);
    }
} else {
    echo json_encode(['error' => 'Không tìm thấy file']);
}
?>