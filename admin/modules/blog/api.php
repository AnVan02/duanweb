<?php
$mysqli = new mysqli("localhost", "username", "password", "dbname");

if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Query: chọn id mới nhất cho mỗi title
$sql = "
    SELECT a.id, a.title
    FROM articles a
    JOIN (
        SELECT title, MAX(id) AS max_id
        FROM articles
        GROUP BY title
    ) b ON a.title = b.title AND a.id = b.max_id
";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Title: " . $row["title"] . "<br>";
    }
} else {
    echo "Không có dữ liệu.";
}

$mysqli->close();
?>
