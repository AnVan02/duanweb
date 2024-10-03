<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải lên PDF</title>
</head>
<body>
    <h1>Tải lên tệp PDF</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="pdf_files[]" accept="application/pdf" multiple required>
        <input type="submit" value="Tải lên">
    </form>
</body>
</html>

<?php
// Cấu hình thông tin kết nối cơ sở dữ liệu
$host = 'localhost'; // Địa chỉ máy chủ
$db   = 'study'; // Tên cơ sở dữ liệu
$user = 'root'; // Tên người dùng
$pass = ''; // Mật khẩu

// Tạo kết nối
$conn = new mysqli($host, $user, $pass, $db);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem tệp có được tải lên không
if (isset($_FILES['pdf_files'])) {
    $files = $_FILES['pdf_files'];
    $fileCount = count($files['name']);

    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $files['name'][$i];
        $fileTmpName = $files['tmp_name'][$i];
        $fileSize = $files['size'][$i];
        $fileError = $files['error'][$i];

        // Kiểm tra lỗi tệp
        if ($fileError === UPLOAD_ERR_OK) {
            // Kiểm tra định dạng tệp
            $fileType = mime_content_type($fileTmpName);
            if ($fileType === 'application/pdf') {
                // Đường dẫn lưu tệp
                $filePath = 'uploads/' . basename($fileName);

                // Di chuyển tệp đến thư mục mong muốn
                if (move_uploaded_file($fileTmpName, $filePath)) {
                    // Thêm thông tin vào cơ sở dữ liệu
                    $title = $conn->real_escape_string($fileName);
                    $description = $conn->real_escape_string("Tệp PDF đã được tải lên.");
                    
                    $sql = "INSERT INTO pdf_documents (title, description, file_path) VALUES ('$title', '$description', '$filePath')";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "Tải lên thành công: " . $fileName . "<br>";
                    } else {
                        echo "Lỗi: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Không thể di chuyển tệp: " . $fileName . "<br>";
                }
            } else {
                echo "Tệp không phải là PDF: " . $fileName . "<br>";
            }
        } else {
            echo "Lỗi tải lên tệp: " . $fileName . "<br>";
        }
    }
} else {
    echo "Không có tệp nào được tải lên.";
}

// Đóng kết nối
$conn->close();
?>
