<?php
include('../../../config/config.php');

// Bật hiển thị lỗi để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kiểm tra kết nối CSDL
if (!$mysqli) {
    die("Lỗi kết nối MySQL: " . mysqli_connect_error());
}

// Nhận dữ liệu từ form / API
$old_link = $_POST['old_link'] ?? '';   // link cũ
$new_link = $_POST['new_link'] ?? '';   // link mới

// Xử lý dữ liệu
$old_link = trim(str_replace(' ', '-', $old_link));
$new_link = trim(str_replace(' ', '-', $new_link));

// Nếu thiếu dữ liệu => báo lỗi
if (empty($old_link) || empty($new_link)) {
    die(json_encode([
        "success" => false,
        "message" => "Thiếu dữ liệu!"
    ], JSON_UNESCAPED_UNICODE));
}

// Kiểm tra tồn tại link cũ
$sql_check = "SELECT article_link FROM article WHERE article_link=? LIMIT 1";
$stmt = $mysqli->prepare($sql_check);
$stmt->bind_param("s", $old_link);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die(json_encode([
        "success" => false,
        "message" => "Bài viết với link cũ không tồn tại!"
    ], JSON_UNESCAPED_UNICODE));
}

// Kiểm tra xem link mới đã tồn tại chưa
$sql_check_new = "SELECT article_link FROM article WHERE article_link=? LIMIT 1";
$stmt = $mysqli->prepare($sql_check_new);
$stmt->bind_param("s", $new_link);
$stmt->execute();
$result_new = $stmt->get_result();

if ($result_new->num_rows > 0) {
    die(json_encode([
        "success" => false,
        "message" => "Link mới đã tồn tại, vui lòng chọn link khác!"
    ], JSON_UNESCAPED_UNICODE));
}

// Cập nhật article_link
$sql = "UPDATE article SET article_link=? WHERE article_link=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $new_link, $old_link);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Cập nhật link thành công!",
        "old_link" => $old_link,
        "new_link" => $new_link
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi cập nhật: " . $stmt->error
    ], JSON_UNESCAPED_UNICODE);
}
?>
