<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kết nối tới cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "123"; // Thay bằng tên database của bạn

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Kiểm tra các giá trị từ form
    if (isset($_POST['account_name'], $_POST['account_password'], $_POST['account_email'], $_POST['account_phone'], $_POST['account_type'], $_POST['account_status'])) {
        $account_name = $_POST['account_name'];
        $account_password = password_hash($_POST['account_password'], PASSWORD_BCRYPT);
        $account_email = $_POST['account_email'];
        $account_phone = $_POST['account_phone'];
        $account_type = $_POST['account_type'];
        $account_status = $_POST['account_status'];

        // Chuẩn bị câu lệnh SQL
        $sql = "INSERT INTO account (account_name, account_password, account_email, account_phone, account_type, account_status) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        // Chuẩn bị và ràng buộc dữ liệu
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $account_name, $account_password, $account_email, $account_phone, $account_type, $account_status);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            echo "Thêm user thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }

        // Đóng kết nối
        $stmt->close();
    } else {
        echo "Dữ liệu từ form chưa được gửi đầy đủ.";
    }

    $conn->close();
}

?>

<!-- form điền user -->
<form action="" method="POST">
    <label for="account_name">Tên tài khoản:</label>
    <input type="text" id="account_name" name="account_name" required><br>

    <label for="account_password">Mật khẩu:</label>
    <input type="password" id="account_password" name="account_password" required><br>

    <label for="account_email">Email:</label>
    <input type="email" id="account_email" name="account_email" required><br>

    <label for="account_phone">Số điện thoại:</label>
    <input type="text" id="account_phone" name="account_phone" required><br>

    <label for="account_type">Loại tài khoản:</label>
    <input type="number" id="account_type" name="account_type" required><br>
    
    <label for="account_status">Trạng thái tài khoản:</label>
    <input type="number" id="account_status" name="account_status" required><br>

    <input type="submit" value="Thêm User">
    
</form>


<style>
     /* Style form */
     form {
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    form label, form input {
        margin-bottom: 10px;
    }
</style>
