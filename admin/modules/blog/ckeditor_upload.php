<?php
// modules/blog/ckeditor_upload.php - Dành riêng cho CKEditor
include('../../config/config.php');

// Bật hiển thị lỗi để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Thư mục lưu trữ ảnh
$imageDir = "uploads/images/";

if (!file_exists($imageDir)) {
    mkdir($imageDir, 0777, true);
}

// Kiểm tra xem có file được upload không
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload'];
    $fileName = time() . '_' . basename($file['name']);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    // Các định dạng ảnh được phép
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    $targetPath = $imageDir . $fileName;
    
    // Kiểm tra định dạng và kích thước file
    if (in_array($fileType, $allowedTypes) && $file['size'] <= 10 * 1024 * 1024) { // Giới hạn 10MB
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Trả về response theo định dạng CKEditor yêu cầu
            $response = [
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $imageDir . $fileName
            ];
        } else {
            $response = [
                'uploaded' => 0,
                'error' => [
                    'message' => 'Không thể upload file'
                ]
            ];
        }
    } else {
        $response = [
            'uploaded' => 0,
            'error' => [
                'message' => 'Định dạng hoặc kích thước file không hợp lệ'
            ]
        ];
    }
} else {
    $response = [
        'uploaded' => 0,
        'error' => [
            'message' => 'Không có file được upload'
        ]
    ];
}

// Trả về JSON response
header('Content-Type: application/json');
echo json_encode($response);
?> 