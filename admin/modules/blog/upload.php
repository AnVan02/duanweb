<?php
// modules/blog/upload.php
include('../../../config/config.php');

// Bật hiển thị lỗi để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Thư mục lưu trữ
$imageDir = "uploads/images/";
$videoDir = "uploads/videos/";

if (!file_exists($imageDir)) mkdir($imageDir, 0777, true);
if (!file_exists($videoDir)) mkdir($videoDir, 0777, true);

$response = ['status' => 'error', 'message' => 'Không có file được upload'];

if (isset($_FILES['file']) && isset($_POST['type'])) {
    $file = $_FILES['file'];
    $type = $_POST['type'];
    $fileName = time() . '_' . basename($file['name']);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($type === 'image') {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $targetDir = $imageDir;
    } elseif ($type === 'video') {
        $allowedTypes = ['mp4', 'webm', 'ogg', 'mov', 'avi'];
        $targetDir = $videoDir;
    } else {
        $response['message'] = 'Loại file không hợp lệ';
        echo json_encode($response);
        exit;
    }

    $targetPath = $targetDir . $fileName;

    if (in_array($fileType, $allowedTypes) && $file['size'] <= 500 * 1024 * 1024) {
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $relativePath = ($type === 'image' ? 'uploads/images/' : 'uploads/videos/') . $fileName;
            $response = [
                'status' => 'success',
                'url' => $relativePath
            ];
        } else {
            $response['message'] = 'Không thể upload file';
        }
    } else {
        $response['message'] = 'Định dạng hoặc kích thước file không hợp lệ';
    }
}

echo json_encode($response);
?>