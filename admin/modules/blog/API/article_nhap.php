<?php
// Kết nối DB
include('../../../config/config.php'); // sửa lại đường dẫn tới file kết nối DB của bạn

header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT article_link, article_author, article_title, article_summary, article_content, article_image 
        FROM article 
        WHERE article_status = 0
        ORDER BY article_date DESC";

$result = $mysqli->query($sql);

if (!$result) {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi SQL: " . $mysqli->error
    ]);
    exit;
}

$drafts = [];
while ($row = $result->fetch_assoc()) {
    $drafts[] = $row;
}

echo json_encode([
    "success" => true,
    "count" => count($drafts),
    "data" => $drafts
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$mysqli->close();
