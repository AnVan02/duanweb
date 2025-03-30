<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Media</title>
    <style>
        /* Định dạng bảng */
        table, th, td {
            border: 1px solid black;
        }

        /* Định dạng cho tiêu đề */
        h2 {
            color: #333;
            text-align: center;
        }

        input[type="file"] {
            margin: 10px 0 20px 0;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Định dạng cho nút tải lên */
        button[type="submit"], button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Định dạng nút xóa */
        button[type="delete"] {
            background-color: red;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button[type="delete"]:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h2>Upload Image or Video</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="media">Choose an image or video:</label>
        <input type="file" name="media" id="media" accept="image/*,video/*" required>
        <button type="submit" name="submit[upload]">Upload</button>
    </form>

    <h2>Danh sách banner</h2>
    <table style="width:100%">
        <tr>
            <th>Image</th>
            <th>Media Path</th>
            <th>Upload Date</th>
            <th>Delete banner</th>
        </tr>
        <?php
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', '123');
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Hiển thị danh sách banner
        $result = $conn->query("SELECT id, media_path, upload_date FROM banners");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><img src='{$row['media_path']}' alt='Banner Image' style='width:100px; height:auto;'></td>
                    <td>{$row['media_path']}</td>
                    <td>{$row['upload_date']}</td>
                    <td>
                        <form action='' method='POST'>
                            <input type='hidden' name='banner_id' value='{$row['id']}'>
                            <button type='submit' name='submit[delete]' onclick=\"return confirm('Bạn có chắc chắn xoá banner này không ?');\">Xóa</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>

    </table>

    <?php
    // Xử lý upload media
    if (isset($_POST['submit']['upload'])) {
        $message = '';
        if (isset($_FILES['media']) && $_FILES['media']['error'] == 0) {
            $target_dir = "assets/images/banner/";
            $file_name = basename($_FILES['media']['name']);
            $target_file = $target_dir . $file_name;
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'webm', 'ogg', 'webp'];
            if (in_array($file_type, $allowed_types)) {
                if (move_uploaded_file($_FILES['media']['tmp_name'], $target_file)) {
                    $stmt = $conn->prepare("INSERT INTO banners (media_path, upload_date) VALUES (?, NOW())");
                    $stmt->bind_param("s", $target_file);
                    if ($stmt->execute()) {
                        $message = "Ảnh/video được tải lên thành công.";
                    } else {
                        $message = "Lỗi khi lưu tệp vào cơ sở dữ liệu.";
                    }
                    $stmt->close();
                } else {
                    $message = "Có lỗi xảy ra khi tải tệp lên.";
                }
            } else {
                $message = "Chỉ cho phép các định dạng ảnh và video.";
            }
        } else {
            $message = "Vui lòng chọn một tệp để tải lên.";
        }
        echo "<p>$message</p>";
    }

    // Xử lý xóa banner
    if (isset($_POST['submit']['delete'])) {
        $banner_id = $_POST['banner_id'];
        $message = '';

        // Lấy thông tin tệp từ cơ sở dữ liệu để xóa tệp thực tế
        $stmt = $conn->prepare("SELECT media_path FROM banners WHERE id = ?");
        $stmt->bind_param("i", $banner_id);
        $stmt->execute();
        $stmt->bind_result($media_path);
        $stmt->fetch();
        $stmt->close();

        // Xóa banner từ cơ sở dữ liệu
        $stmt = $conn->prepare("DELETE FROM banners WHERE id = ?");
        $stmt->bind_param("i", $banner_id);
        if ($stmt->execute()) {
            // Xóa tệp từ thư mục
            if (file_exists($media_path)) {
                unlink($media_path); // Xóa tệp thực tế
            }
            $message = "Banner đã được xóa thành công.";
        } else {
            $message = "Lỗi khi xóa banner từ cơ sở dữ liệu.";
        }
        $stmt->close();
        echo "<p>$message</p>";
    }
    $conn->close();
    ?>
</body>
</html>
