<?php
include('../../config/config.php');

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

$article_id = $_POST['article_id'] ?? null;
$article_author = $_POST['article_author'] ?? null;
$article_title = $_POST['article_title'] ?? null;
$article_summary = $_POST['article_summary'] ?? null;
$article_content = $_POST['article_content'] ?? null;
$article_link = $_POST['article_link'] ?? '';
$article_link = trim($article_link);
$article_link = str_replace(' ', '-', $article_link);

// lấy link ảnh 
// Lấy link ảnh từ input thay vì upload file
$article_image = $_POST['article_image'] ?? '';
$article_image = trim($article_image);


function isValidImageUrl($url) {
    if (empty($url)) return true; // Cho phép để trống
    
    // Kiểm tra định dạng URL cơ bản
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }
    
    // Kiểm tra extension ảnh
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    $urlParts = parse_url($url);
    $path = $urlParts['path'] ?? '';
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    
    return in_array($extension, $imageExtensions) || empty($extension); // Cho phép URL không có extension
}


$article_date = $_POST['article_date'] ?? date('Y-m-d');
$article_status = $_POST['article_status'] ?? null;
$article_tag = $_POST['article_tag'] ?? null;
$article_tag = trim($article_tag);
$article_tag = strtolower($article_tag);
$article_tag = preg_replace('/\s+/', ' ', $article_tag);
$article_tag = str_replace('#', '', $article_tag);

// Cho phép HTML cơ bản
$allowed_tags = '<p><br><b><i><u><strong><em><a><img><ul><ol><li>';
$article_summary = strip_tags($article_summary, $allowed_tags);
$article_content = strip_tags($article_content, $allowed_tags);

// Thư mục lưu trữ
$imageDir = "uploads/";
$videoDir = "uploads/videos/";

if (!file_exists($imageDir)) mkdir($imageDir, 0777, true);
if (!file_exists($videoDir)) mkdir($videoDir, 0777, true);

// Xử lý upload video (nếu có)
$videoName = '';
$video_link = '';
if (!empty($_FILES['video']['name'])) {
    $video = $_FILES['video'];
    $videoName = time() . '_' . basename($video['name']);
    $targetVideoPath = $videoDir . $videoName;
    $videoType = strtolower(pathinfo($targetVideoPath, PATHINFO_EXTENSION));
    $allowedVideoTypes = ['mp4', 'webm', 'ogg', 'mov', 'avi'];

    if (in_array($videoType, $allowedVideoTypes) && $video['size'] <= 500 * 1024 * 1024) {
        if (move_uploaded_file($video['tmp_name'], $targetVideoPath)) {
            $relativePath = "../admin/modules/blog/" . $targetVideoPath;
            $video_link = '<video width="720" height="620" controls>
                            <source src="' . $relativePath . '" type="video/' . $videoType . '">
                            Your browser does not support the video tag.
                          </video>';
        } else {
            die("Không thể upload video.");
        }
    } else {
        die("Định dạng hoặc kích thước video không hợp lệ.");
    }
}

// Thêm bài viết
if (isset($_POST['article_add']) || isset($_POST['api'])) {
    if (empty($article_link)) {
        $article_link = uniqid('article_');
    }

    // Kiểm tra trùng lặp bài viết
    $sql_check = "SELECT * FROM article WHERE article_link = ?";
    $stmt = $mysqli->prepare($sql_check);
    if (!$stmt) die("Lỗi SQL: " . $mysqli->error);
    $stmt->bind_param("s", $article_link);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if (isset($_POST['api'])) {
            header('Content-Type: application/json');
            echo json_encode([
                "success" => false,
                "message" => "Đường dẫn bài viết đã tồn tại!"
            ]);
            exit;
        } else {
            die("<script>alert('Lỗi: Đường dẫn bài viết đã tồn tại!'); window.history.back();</script>");
        }
    }

    // Upload ảnh

    if (!empty($article_image) && filter_var($article_image, FILTER_VALIDATE_URL)) {
        // Giữ nguyên link từ POST (Postman)
    } elseif (!empty($_FILES['article_image']['name'])) {
        // Trường hợp upload file ảnh
        $article_image_tmp = $_FILES['article_image']['tmp_name'];
        $uploadPath = $imageDir . basename($_FILES['article_image']['name']);
        move_uploaded_file($article_image_tmp, $uploadPath);

        // Tạo URL đầy đủ
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
            || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $baseUrl = $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $article_image = $baseUrl . '/' . $uploadPath;
    } else {
        // Nếu không gửi ảnh mới -> giữ ảnh cũ
        $sql_get_old_image = "SELECT article_image FROM article WHERE article_link=? LIMIT 1";
        $stmt = $mysqli->prepare($sql_get_old_image);
        $stmt->bind_param("s", $article_link);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $article_image = $row['article_image'];
        }
    }


    // Summary + video
    $full_summary = $article_summary . ($video_link ? $video_link : '');

    // Thêm vào DB
    $sql_add = "INSERT INTO article 
        (article_link, article_author, article_title, article_summary, article_content, article_image, article_date, article_tag, article_status, article_video) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql_add);
    if (!$stmt) die("Lỗi SQL: " . $mysqli->error);
    $stmt->bind_param("ssssssssss", $article_link, $article_author, $article_title, $full_summary, $article_content, $article_image, $article_date, $article_tag, $article_status, $videoName);

    if ($stmt->execute()) {
        if (isset($_POST['api'])) {
            header('Content-Type: application/json');
            echo json_encode([
                "success" => true,
                "message" => "Thêm bài viết thành công!",
                "article_id" => $stmt->insert_id,
                "article_link" => $article_link
            ]);
            exit;
        } else {
            header('Location: ../../index.php?action=article&query=article_list');
            exit;
        }
    } else {
        if (isset($_POST['api'])) {
            header('Content-Type: application/json');
            echo json_encode([
                "success" => false,
                "message" => "Lỗi khi thêm bài viết: " . $stmt->error
            ]);
            exit;
        } else {
            die("Lỗi khi thêm bài viết: " . $stmt->error);
        }
    }




// ===  API XOÁ BÀI VIẾT ===

} elseif (isset($_POST['api_delete'])) {
    header('Content-Type: application/json; charset=utf-8');

    // Kiểm tra có gửi article_id không
    if (empty($_POST['article_id'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Thiếu article_id"
        ]);
        exit;
    }

    $article_id = intval($_POST['article_id']);

    // Kiểm tra bài viết có tồn tại không
    $sql_check = "SELECT article_image FROM article WHERE article_id=? LIMIT 1";
    $stmt = $mysqli->prepare($sql_check);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Nếu có ảnh thì xoá file
        if (!empty($row['article_image'])) {
            $filePath = str_replace("http://" . $_SERVER['HTTP_HOST'] . "/", "", $row['article_image']);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Xoá bài viết trong DB
        $sql_delete = "DELETE FROM article WHERE article_id=?";
        $stmt = $mysqli->prepare($sql_delete);
        $stmt->bind_param("i", $article_id);
        $stmt->execute();

        echo json_encode([
            "status" => "success",
            "message" => "Xoá bài viết thành công"
        ], JSON_UNESCAPED_UNICODE);
        exit;

    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Bài viết không tồn tại"
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

}

// === TIM KIẾM BÀI VIẾT ===

if (isset($_GET['search'])) {
    header('Content-Type: application/json; charset=utf-8');

    $keyword = trim($_GET['search']);

    if (empty($keyword)) {
        echo json_encode([
            "status" => "error",
            "message" => "Thiếu từ khoá tìm kiếm"
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $sql = "SELECT article_id, article_title 
            FROM article 
            WHERE article_title LIKE ? 
            ORDER BY article_id DESC";

    $stmt = $mysqli->prepare($sql);
    $like = "%" . $keyword . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $articles = [];
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $articles
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}




?>
