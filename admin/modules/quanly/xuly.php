<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database"; // Thay bằng tên database của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý xóa người dùng
if (isset($_GET['delete'])) {
    $account_id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM account WHERE account_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $account_id);
    
    if ($delete_stmt->execute()) {
        echo "Xóa người dùng thành công!";
    } else {
        echo "Lỗi khi xóa người dùng: " . $delete_stmt->error;
    }
    
    $delete_stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']); // Chuyển hướng về trang hiện tại
    exit();
}

// Xử lý cập nhật thông tin người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['account_id'], $_POST['account_name'], $_POST['account_email'], $_POST['account_phone'], $_POST['account_type'], $_POST['account_status'])) {
        $account_id = intval($_POST['account_id']);
        $account_name = $_POST['account_name'];
        $account_email = $_POST['account_email'];
        $account_phone = $_POST['account_phone'];
        $account_type = $_POST['account_type'];
        $account_status = $_POST['account_status'];

        // Chuẩn bị câu lệnh SQL để cập nhật
        $update_sql = "UPDATE account SET account_name=?, account_email=?, account_phone=?, account_type=?, account_status=? WHERE account_id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssiiii", $account_name, $account_email, $account_phone, $account_type, $account_status, $account_id);
        
        // Thực thi câu lệnh
        if ($update_stmt->execute()) {
            echo "Cập nhật người dùng thành công!";
        } else {
            echo "Cập nhật thất bại: " . $update_stmt->error;
        }

        $update_stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']); // Chuyển hướng về danh sách người dùng
        exit();
    }
}

// Lấy thông tin người dùng để hiển thị
$user = null;
if (isset($_GET['id'])) {
    $account_id = intval($_GET['id']);
    $sql = "SELECT * FROM account WHERE account_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

// Truy vấn để lấy thông tin tất cả người dùng
$sql = "SELECT account_id, account_name, account_email, account_phone, account_type, account_status FROM account";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<h2>Danh Sách User</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Tên Tài Khoản</th>
        <th>Email</th>
        <th>Số Điện Thoại</th>
        <th>Loại Tài Khoản</th>
        <th>Trạng Thái</th>
        <th>Thao Tác</th>
    </tr>

    <?php
    // Kiểm tra xem có dữ liệu hay không
    if ($result->num_rows > 0) {
        // Hiển thị dữ liệu của từng hàng
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["account_id"] . "</td>";
            echo "<td>" . $row["account_name"] . "</td>";
            echo "<td>" . $row["account_email"] . "</td>";
            echo "<td>" . $row["account_phone"] . "</td>";
            echo "<td>" . $row["account_type"] . "</td>";
            echo "<td>" . $row["account_status"] . "</td>";
            echo "<td>";
            echo "<a href='?id=" . $row["account_id"] . "'>Chỉnh Sửa</a> | ";
            echo "<a href='?delete=" . $row["account_id"] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?');\">Xóa</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Không có dữ liệu người dùng.</td></tr>";
    }
    ?>
</table>

<!-- Form Chỉnh Sửa Người Dùng -->
<?php if ($user): ?>
    <h2>Chỉnh Sửa Người Dùng</h2>
    <form action="xuly.php" method="POST">
        <input type="hidden" name="account_id" value="<?php echo $user['account_id']; ?>">
        
        <label for="account_name">Tên tài khoản:</label>
        <input type="text" id="account_name" name="account_name" value="<?php echo $user['account_name']; ?>" required><br>

        <label for="account_email">Email:</label>
        <input type="email" id="account_email" name="account_email" value="<?php echo $user['account_email']; ?>" required><br>

        <label for="account_phone">Số điện thoại:</label>
        <input type="text" id="account_phone" name="account_phone" value="<?php echo $user['account_phone']; ?>" required><br>

        <label for="account_type">Loại tài khoản:</label>
        <input type="number" id="account_type" name="account_type" value="<?php echo $user['account_type']; ?>" required><br>

        <label for="account_status">Trạng thái tài khoản:</label>
        <input type="number" id="account_status" name="account_status" value="<?php echo $user['account_status']; ?>" required><br>

        <input type="submit" value="Cập nhật">
    </form>
<?php endif; ?>

</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
