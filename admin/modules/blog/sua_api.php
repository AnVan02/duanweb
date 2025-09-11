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


// === Cập nhật bài viết ===


// Kiểm tra kết nối
if (!$mysqli) {
    die(json_encode([
        "success" => false,
        "message" => "Lỗi kết nối MySQL: " . mysqli_connect_error()
    ]));
}

// Nhận dữ liệu

$article_link = $_POST['article_link'] ?? null;
$field = $_POST['field'] ?? null;   
$value = $_POST['value'] ?? null;   

if (empty($article_link) || empty($field) || $value === null) {
    die(json_encode([
        "success" => false,
        "message" => "Thiếu dữ liệu!"
    ]));
}

// Danh sách các field hợp lệ
$allowed_fields = [
    "article_author",
    "article_title",
    "article_summary",
    "article_content",
    "article_image",
    "article_date",
    "article_tag",
    "article_status"
];

if (!in_array($field, $allowed_fields)) {
    die(json_encode([
        "success" => false,
        "message" => "Trường không hợp lệ!"
    ]));
}

// Validate theo từng field
switch ($field) {
    case "article_author":
        $value = trim($value);
        if (strlen($value) < 2) {
            die(json_encode(["success" => false, "message" => "Tên tác giả quá ngắn!"]));
        }
        break;

    case "article_title":
        $value = trim($value);
        if (strlen($value) < 3) {
            die(json_encode(["success" => false, "message" => "Tiêu đề quá ngắn!"]));
        }
        break;

    case "article_summary":
    case "article_content":
        $allowed_tags = '<p><br><b><i><u><strong><em><a><img><ul><ol><li>';
        $value = strip_tags($value, $allowed_tags);
        break;

    case "article_image":
        $value = trim($value);
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_URL)) {
            die(json_encode(["success" => false, "message" => "Link ảnh không hợp lệ!"]));
        }
        break;

    case "article_date":
        $d = DateTime::createFromFormat('Y-m-d', $value);
        if (!$d || $d->format('Y-m-d') !== $value) {
            die(json_encode(["success" => false, "message" => "Ngày không hợp lệ, định dạng Y-m-d!"]));
        }
        break;

    case "article_tag":
        $value = strtolower(trim($value));
        $value = preg_replace('/\s+/', ' ', $value);
        $value = str_replace('#', '', $value);
        break;

    case "article_status":
        if (!in_array($value, ['0','1'])) {
            die(json_encode(["success" => false, "message" => "Trạng thái chỉ nhận 0 hoặc 1!"]));
        }
        break;
}

// Chuẩn bị câu lệnh SQL
$sql = "UPDATE article SET $field=? WHERE article_link=?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die(json_encode([
        "success" => false,
        "message" => "Lỗi SQL: " . $mysqli->error
    ]));
}

$stmt->bind_param("ss", $value, $article_link);

// Thực thi
if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Cập nhật $field thành công!"
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi khi cập nhật: " . $stmt->error
    ], JSON_UNESCAPED_UNICODE);
}

//==== xử lý ảnh ====

if (!empty($article_image) && filter_var($article_image, FILTER_VALIDATE_URL)) {
    // Nếu gửi link http qua Postman => dùng luôn link đó
    // Không cần làm gì thêm
} elseif (!empty($_FILES['article_image']['name'])) {
    // Nếu upload file ảnh
    $article_image_tmp = $_FILES['article_image']['tmp_name'];
    $uploadPath = $imageDir . basename($_FILES['article_image']['name']);
    move_uploaded_file($article_image_tmp, $uploadPath);

    // Tạo URL đầy đủ
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
        || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $baseUrl = $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $article_image = $baseUrl . '/' . $uploadPath;
} else {
    // Nếu không gửi gì -> giữ ảnh cũ
    $sql_get_old_image = "SELECT article_image FROM article WHERE article_link=? LIMIT 1";
    $stmt = $mysqli->prepare($sql_get_old_image);
    $stmt->bind_param("s", $article_link);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $article_image = $row['article_image'];
    }
}

?>

