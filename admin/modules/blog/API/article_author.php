<?php
include('../../../config/config.php');

// Bật hiển thị lỗi để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tăng giới hạn upload
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '100M');
ini_set('max_execution_time', 300);

// Kiểm tra kết nối CSDL
if (!$mysqli) {
    die("Lỗi kết nối MySQL: " . mysqli_connect_error());
}

// Nhận dữ liệu từ form / API
$data = $_GET['data'] ?? '';
$article_links = [];
if (!empty($data)) {
    $article_links = json_decode($data, true);
}

// Luôn gán mặc định là chuỗi rỗng để tránh warning Deprecated

$article_author  = $_POST['article_author']  ?? '';
$article_link    = $_POST['article_link']    ?? '';


// Giá trị mặc định nếu không có dữ liệu gửi lên
$article_image   = trim($_POST['article_image']   ?? '');
$article_tag     = strtolower(trim($_POST['article_tag'] ?? ''));
// $article_summary = strip_tags($_POST['article_summary'] ?? '', $allowed_tags);

// Xử lý article_link và article_content
$article_link    = trim(str_replace(' ', '-', $_POST['article_link'] ?? ''));
// $article_content = strip_tags($_POST['article_content'] ?? '', $allowed_tags);


$article_link  = trim(str_replace(' ', '-', $article_link));
// $article_image = trim($article_image);

// $article_tag = strtolower(trim($article_tag));
$article_tag = preg_replace('/\s+/', ' ', $article_tag);
$article_tag = str_replace('#', '', $article_tag);

// Cho phép HTML cơ bản
$allowed_tags = '<p><br><b><i><u><strong><em><a><img><ul><ol><li>';
// $article_summary = strip_tags($article_summary, $allowed_tags);
// $article_content = strip_tags($article_content, $allowed_tags);

// Nếu thiếu dữ liệu => báo lỗi
if (empty($article_link) || empty($article_author)) {
    die(json_encode([
        "success" => false,
        "message" => "Thiếu dữ liệu!"
    ], JSON_UNESCAPED_UNICODE));
}

// --- UPDATE tác giả ---
$sql = "UPDATE article SET article_author=? WHERE article_link=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $article_author, $article_link);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Cập nhật tác giả thành công!"
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi: " . $stmt->error
    ], JSON_UNESCAPED_UNICODE);
}
?>
