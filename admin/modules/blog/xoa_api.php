// === API CẬP NHẬT TRẠNG THÁI BÀI VIẾT ===
if (isset($_POST['api_update_status'])) {
    header('Content-Type: application/json; charset=utf-8');

    if (empty($_POST['article_id']) || !isset($_POST['article_status'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Thiếu article_id hoặc article_status"
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $article_id = intval($_POST['article_id']);
    $article_status = intval($_POST['article_status']);

    if ($article_status === 1) {
        // Nếu chuyển sang 1 (hiển thị), cập nhật luôn ngày hiện tại
        $sql_update = "UPDATE article 
                       SET article_status = 1, article_date = NOW() 
                       WHERE article_id = ?";
    } else {
        // Nếu chuyển sang 0 (ẩn), chỉ cập nhật status
        $sql_update = "UPDATE article 
                       SET article_status = 0 
                       WHERE article_id = ?";
    }

    $stmt = $mysqli->prepare($sql_update);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Cập nhật trạng thái thành công"
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Lỗi khi cập nhật: " . $stmt->error
        ], JSON_UNESCAPED_UNICODE);
    }
    exit;
}
