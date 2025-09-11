<?php
header("Content-Type: application/json; charset=utf-8");

// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Kết nối thất bại: " . $conn->connect_error], JSON_UNESCAPED_UNICODE);
    exit();
}
$conn->set_charset("utf8mb4");

// Lấy từ khóa
$keyword = isset($_REQUEST['q']) ? trim($_REQUEST['q']) : '';

if ($keyword !== "") {
    // escape ký tự đặc biệt để an toàn với regex
    $escaped = preg_quote($keyword, '/'); // tránh lỗi nếu người dùng nhập . * ? ...
    // MySQL word-boundary POSIX
    $regexp = '[[:<:]]' . $escaped . '[[:>:]]';

$sql = "SELECT article_id, article_link, article_title, article_author, article_date
        FROM article
        WHERE article_status = 1
        AND (article_link REGEXP ? OR article_title REGEXP ?)
        ORDER BY article_date DESC
        LIMIT 10
        ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $regexp, $regexp);
    $stmt->execute();
    $result = $stmt->get_result();

    $articles = [];
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }

    echo json_encode([
        "keyword" => $keyword,
        "count"   => count($articles),
        "results" => $articles
    ], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
} else {
    echo json_encode(["error" => "Vui lòng nhập từ khóa"], JSON_UNESCAPED_UNICODE);
}

$conn->close();

