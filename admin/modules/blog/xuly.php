<?php
include('../../config/config.php');

// Bật hiển thị lỗi để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tăng giới hạn upload và thời gian xử lý
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_execution_time', 300);

// Kiểm tra kết nối CSDL
if (!$mysqli) {
    die("Lỗi kết nối MySQL: " . mysqli_connect_error());
}

// Nhận dữ liệu từ form
$article_author = $_POST['article_author'] ?? null;
$article_title = $_POST['article_title'] ?? null;
$article_summary = $_POST['article_summary'] ?? null;
$article_content = $_POST['article_content'] ?? null;
$article_link = trim(str_replace(' ', '-', $_POST['article_link'] ?? ''));
$article_image = $_FILES['article_image']['name'] ?? null;
$article_image_tmp = $_FILES['article_image']['tmp_name'] ?? null;
$article_image = $article_image ? time() . '_' . basename($article_image) : null;
$article_date = $_POST['article_date'] ?? date('Y-m-d');
$article_status = $_POST['article_status'] ?? null;
$article_tag = strtolower(trim($_POST['article_tag'] ?? ''));

// Thư mục lưu trữ hình ảnh và video
$imageDir = "uploads/images/";
$videoDir = "uploads/videos/";

// Tạo thư mục nếu chưa tồn tại
if (!file_exists($imageDir)) {
    mkdir($imageDir, 0777, true);
}
if (!file_exists($videoDir)) {
    mkdir($videoDir, 0777, true);
}

// Xử lý upload video
$video_link = '';
$videoName = ''; // Khởi tạo để tránh lỗi nếu không có video
if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {
    $video = $_FILES['video'];
    $videoName = time() . '_' . basename($video['name']);
    $targetVideoPath = $videoDir . $videoName;
    $videoType = strtolower(pathinfo($targetVideoPath, PATHINFO_EXTENSION));

    // Các loại tệp video cho phép
    $allowedVideoTypes = ['mp4', 'webm', 'ogg'];

    // Kiểm tra loại tệp video
    if (in_array($videoType, $allowedVideoTypes)) {
        // Kiểm tra kích thước tệp (50MB)
        if ($video['size'] <= 50 * 1024 * 1024) {
            // Di chuyển tệp video đến thư mục đích
            if (move_uploaded_file($video['tmp_name'], $targetVideoPath)) {
                // Kiểm tra tệp đã được di chuyển thành công
                if (file_exists($targetVideoPath)) {
                    // Tạo đường dẫn tương đối để hiển thị video
                    $videoPath = '/' . $videoDir . $videoName;
                    $video_link = '<video controls style="max-width: 100%;"><source src="' . $videoPath . '" type="video/' . $videoType . '">Your browser does not support the video tag.</video>';
                } else {
                    die(json_encode(['error' => 'Tệp video không tồn tại sau khi di chuyển: ' . $targetVideoPath]));
                }
            } else {
                die(json_encode(['error' => 'Không thể di chuyển tệp video.']));
            }
        } else {
            die(json_encode(['error' => 'Kích thước video vượt quá giới hạn cho phép (50MB).']));
        }
    } else {
        die(json_encode(['error' => 'Loại video không được phép. Chỉ hỗ trợ: mp4, webm, ogg.']));
    }
}

// Xử lý thêm bài viết
if (isset($_POST['article_add'])) {
    // Tạo article_link nếu không có
    if (empty($article_link)) {
        $article_link = uniqid('article_');
    }

    // Kiểm tra trùng lặp đường dẫn bài viết
    $sql_check = "SELECT * FROM article WHERE article_link = ?";
    $stmt = $mysqli->prepare($sql_check);
    if (!$stmt) {
        die("Lỗi SQL: " . $mysqli->error);
    }
    $stmt->bind_param("s", $article_link);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("<script>alert('Lỗi: Đường dẫn bài viết đã tồn tại!'); window.history.back();</script>");
    }

    // Upload hình ảnh nếu có
    if ($article_image && $article_image_tmp) {
        $targetImagePath = $imageDir . $article_image;
        if (!move_uploaded_file($article_image_tmp, $targetImagePath)) {
            die(json_encode(['error' => 'Không thể di chuyển tệp hình ảnh.']));
        }
    }

    // Kết hợp nội dung bài viết và video link
    $full_content = $article_content . $video_link;

    // Thêm bài viết vào cơ sở dữ liệu
    $sql_add = "INSERT INTO article (article_link, article_author, article_title, article_summary, article_content, article_image, article_date, article_tag, article_status, article_video) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql_add);
    if (!$stmt) {
        die("Lỗi SQL: " . $mysqli->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssss", $article_link, $article_author, $article_title, $article_summary, $full_content, $article_image, $article_date, $article_tag, $article_status, $videoName);
    
    // Thực thi câu lệnh
    if ($stmt->execute()) {
        // Chuyển hướng đến danh sách bài viết sau khi thêm thành công
        header('Location: ../../index.php?action=article&query=article_list');
        exit;
    } else {
        die("Lỗi khi thêm bài viết: " . $stmt->error);
    }
} else {
    die("Yêu cầu không hợp lệ.");
}
?>