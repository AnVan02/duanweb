<?php
// Kết nối DB
include('../../../config/config.php'); // sửa lại theo đường dẫn thực tế

header('Content-Type: application/json; charset=utf-8');

// Lấy 100 bài viết gần nhất (sắp xếp theo ngày mới nhất)
$sql = "SELECT article_link, article_title, article_content 
        FROM article 
        ORDER BY article_date DESC 
        LIMIT 100";

$result = $mysqli->query($sql);

if (!$result) {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi SQL: " . $mysqli->error
    ]);
    exit;
}

$articles = [];
$baseUrl = "https://rosacomputer.vn/tintuc_test/tintuc/";

while ($row = $result->fetch_assoc()) {
    $articles[] = [
        "article_url"     => $baseUrl . $row['article_link'],
        "article_title"   => $row['article_title'],
        "article_content" => $row['article_content']
    ];
}

echo json_encode([
    "success" => true,
    "count"   => count($articles),
    "data"    => $articles
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$mysqli->close();
