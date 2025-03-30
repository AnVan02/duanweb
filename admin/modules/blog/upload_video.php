<?php
include('../../config/config.php');

// Bật hiển thị lỗi để debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Thư mục lưu video
$uploadDir = 'uploads/videos/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Kiểm tra file upload từ Froala
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = time() . '_' . basename($file['name']);
    $targetFile = $uploadDir . $fileName;

    // Kiểm tra định dạng video
    $allowedTypes = ['mp4', 'webm', 'ogg', 'mov'];
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedTypes)) {
        echo json_encode(['error' => 'Định dạng video không hợp lệ']);
        exit;
    }

    // Kiểm tra kích thước (50MB)
    if ($file['size'] > 50 * 1024 * 1024) {
        echo json_encode(['error' => 'Video vượt quá kích thước cho phép (50MB)']);
        exit;
    }

    // Di chuyển file
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $videoUrl = '/modules/blog/' . $targetFile; // Đường dẫn tuyệt đối từ gốc website
        echo json_encode(['link' => $videoUrl]);
    } else {
        echo json_encode(['error' => 'Upload video thất bại']);
    }
} else {
    echo json_encode(['error' => 'Không có file nào được upload']);
}
?>