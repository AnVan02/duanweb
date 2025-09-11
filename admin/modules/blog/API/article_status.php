<?php
include('../../../config/config.php');
header("Content-Type: application/json; charset=UTF-8");

// Kiểm tra kết nối
if (!$mysqli) {
    die(json_encode([
        "success" => false,
        "message" => "Lỗi kết nối MySQL: " . mysqli_connect_error()
    ], JSON_UNESCAPED_UNICODE));
}

$article_link   = $_POST['article_link']   ?? null;
$article_status = $_POST['article_status'] ?? null;

// Kiểm tra dữ liệu đầu vào
if (empty($article_link) || $article_status === null) {
    die(json_encode(["success"=>false, "message"=>"Thiếu dữ liệu!"], JSON_UNESCAPED_UNICODE));
}

if (!in_array($article_status, ['0','1'], true)) {
    die(json_encode(["success"=>false, "message"=>"Trạng thái chỉ nhận 0 hoặc 1!"], JSON_UNESCAPED_UNICODE));
}


// Kiểm tra bài viết có tồn tại không
$sql_check = "SELECT article_link FROM article WHERE article_link=? LIMIT 1";
$stmt = $mysqli->prepare($sql_check);
$stmt->bind_param("s", $article_link);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die(json_encode([
        "success" => false,
        "message" => "Bài viết không tồn tại!"
    ], JSON_UNESCAPED_UNICODE));
}

// Cập nhật trạng thái
$sql = "UPDATE article SET article_status=? WHERE article_link=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("is", $article_status, $article_link);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Cập nhật trạng thái thành công!"
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi: " . $stmt->error
    ], JSON_UNESCAPED_UNICODE);
}
?>
