<?php
// modules/blog/upload.php
header('Content-Type: application/json');

// Đường dẫn lưu file
$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Kiểm tra file upload
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $file_name = time() . '_' . basename($file['name']);
    $file_path = $upload_dir . $file_name;

    // Di chuyển file vào thư mục uploads
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        // Trả về URL của file cho TinyMCE
        $response = [
            'location' => '/' . $file_path
        ];
    } else {
        $response = [
            'error' => 'Upload failed!'
        ];
    }
} else {
    $response = [
        'error' => 'No file uploaded!'
    ];
}

// Trả về JSON
echo json_encode($response);
exit;
?>