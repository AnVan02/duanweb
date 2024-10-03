<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', 'Vietson@123', '123'); // Thay đổi nếu cần

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý thêm banner
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $media_path = '';

    // Kiểm tra và tạo thư mục nếu không tồn tại
    $media_dir = "uploads//";
    if (!is_dir($media_dir)) {
        mkdir($media_dir, 0755, true);
    }

    // Xử lý video upload
    if (isset($_FILES['banner_video']) && $_FILES['banner_video']['error'] == UPLOAD_ERR_OK) {
        $media_path = $media_dir . basename($_FILES["banner_video"]["name"]);
        move_uploaded_file($_FILES["banner_video"]["tmp_name"], $media_path);
    }
    
    // Xử lý ảnh upload
    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] == UPLOAD_ERR_OK) {
        $media_path = $media_dir . basename($_FILES["banner_image"]["name"]);
        move_uploaded_file($_FILES["banner_image"]["tmp_name"], $media_path);
    }

    // Chèn vào cơ sở dữ liệu nếu có file
    if ($media_path) {
        $sql = "INSERT INTO banners (media_path) VALUES ('$media_path')";
        if ($conn->query($sql) === TRUE) {
            echo "Banner đã được thêm thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}

// Xử lý xóa banner
if (isset($_POST['delete'])) {
    $id = $_POST['banner_id'];
    $sql = "DELETE FROM banners WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Banner đã được xóa thành công";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Hiển thị banner
$sql = "SELECT * FROM banners ORDER BY upload_date DESC";
$result = $conn->query($sql);
?>

<!-- Form để upload banner -->
<form method="POST" enctype="multipart/form-data">
    <label>Chọn video:</label>
    <input type="file" name="banner_video" accept="video/mp4">
    <label>Chọn ảnh:</label>
    <input type="file" name="banner_image" accept="image/*">
    <button type="submit" name="add">Thêm Banner mới</button>
</form>

<?php
if ($result->num_rows > 0) {
    echo '<div class="banner__box d-flex p-relative banner__large w-100">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="image__banner image__item p-absolute w-100 h-100">';
        if (strpos($row['media_path'], '.mp4') !== false) {
            echo '<video class="w-100 h-100 d-block object-fit-cover" autoplay muted loop>';
            echo '<source src="' . $row['media_path'] . '" type="video/mp4">';
            echo '</video>';
        } else {
            echo '<img src="' . $row['media_path'] . '" class="w-100 h-100 d-block object-fit-cover" alt="Banner Image">';
        }
        echo '<form method="POST">';
        echo '<input type="hidden" name="banner_id" value="' . $row['id'] . '">';
        echo '<button type="submit" name="delete">Xóa Banner</button>';
        echo '</form>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "Không có banner nào.";
}

$conn->close();
?>

<style>
.banner__box {
    position: relative;
    overflow: hidden;
}

.image__banner {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.image__banner img,
.image__banner video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
form {
    max-width: 600px; /* Chiều rộng tối đa của form */
    margin: 20px auto; /* Canh giữa form */
    padding: 20px; /* Khoảng cách bên trong */
    border: 1px solid #ccc; /* Đường viền */
    border-radius: 8px; /* Bo góc */
    background-color: #f9f9f9; /* Màu nền */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
}

label {
    display: block; /* Hiển thị label trên một dòng riêng */
    margin-bottom: 8px; /* Khoảng cách giữa label và input */
    font-weight: bold; /* Đậm chữ */
}

input[type="file"] {
    width: 100%; /* Chiều rộng 100% */
    padding: 10px; /* Khoảng cách bên trong */
    margin-bottom: 20px; /* Khoảng cách dưới cùng */
    border: 1px solid #ccc; /* Đường viền */
    border-radius: 4px; /* Bo góc */
    background-color: #fff; /* Màu nền */
    font-size: 16px; /* Kích thước chữ */
}

button {
    display: inline-block; /* Hiển thị button */
    padding: 10px 15px; /* Khoảng cách bên trong */
    border: none; /* Không có đường viền */
    border-radius: 4px; /* Bo góc */
    background-color: #28a745; /* Màu nền */
    color: white; /* Màu chữ */
    font-size: 16px; /* Kích thước chữ */
    cursor: pointer; /* Hiển thị con trỏ khi di chuột qua */
    transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
}

button:hover {
    background-color: #218838; /* Màu nền khi hover */
}

</style>
