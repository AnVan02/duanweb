<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
function dbconnect() {
    $conn = new mysqli("localhost", "root", "", "student");
    if ($conn->connect_error) {
        die("Lỗi kết nối: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}
$conn = dbconnect();

// Thêm mới 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $student_id = $_POST['student_id'];
    $ten = $_POST['ten'];
    $khoa_id = $_POST['khoa_id'];
    $trangthai = $_POST['trangthai'];
    $chung_chi = $_POST['chung_chi'];

    $stmt = $conn->prepare("INSERT INTO capbang (student_id, Ten, khoa_id, trangthai, chung_chi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $student_id, $ten, $khoa_id, $trangthai, $chung_chi);
    $stmt->execute();
    $stmt->close();

    header("Location: capbang.php?message=Đã thêm thành công");
    exit;
}

// Xóa bản ghi
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $conn->query("DELETE FROM capbang WHERE student_id = " . intval($student_id));
    header("Location: capbang.php?message=Đã xóa thành công");
    exit;
}

// Sửa bản ghi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $student_id = $_POST['student_id'];
    $ten = $_POST['ten'];
    $khoa_id = $_POST['khoa_id'];
    $trangthai = $_POST['trangthai'];
    $chung_chi = $_POST['chung_chi'];

    $stmt = $conn->prepare("UPDATE capbang SET Ten=?, khoa_id=?, trangthai=?, chung_chi=? WHERE student_id=?");
    $stmt->bind_param("ssisi", $ten, $khoa_id, $trangthai, $chung_chi, $student_id);
    $stmt->execute();
    $stmt->close();

    header("Location: capbang.php?message=Đã cập nhật thành công");
    exit;
}

// Lấy dữ liệu để hiển thị
$edit_data = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['student_id'])) {
    $id = intval($_GET['student_id']);
    $result = $conn->query("SELECT * FROM capbang WHERE student_id = $id");
    $edit_data = $result->fetch_assoc();
}

$capbang_list = $conn->query("SELECT * FROM capbang ORDER BY student_id DESC")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Quản lý bảng kiểm tra - cap bang</title>
</head>
<body>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        form {
            background-color: #fff;
            max-width: 1000px;
            margin: 0 auto 40px;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #34495e;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 14px 20px;
            text-align: center;
            border-bottom: 1px solid #eaeaea;
        }

        th {
            max-width: 1000px;
            background-color: #3498db;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .actions a {
            display: inline-block;
            margin: 0 5px;
            color: #3498db;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .actions a:hover {
            color: #21618c;
        }

        @media (max-width: 600px) {
            form, table {
                width: 100%;
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>



    <h2><?= $edit_data ? "Cập nhật bản ghi" : "Thêm mới bản ghi" ?></h2>
    <?php if (isset($_GET['message'])): ?>
        <p style="color: green"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="action" value="<?= $edit_data ? 'edit' : 'add' ?>">
        <label>Student ID:</label>
        <input type="number" name="student_id" required value="<?= $edit_data['student_id'] ?? '' ?>" <?= $edit_data ? 'readonly' : '' ?>><br>
        <label>Tên:</label>
        <input type="text" name="ten" required value="<?= $edit_data['Ten'] ?? '' ?>"><br>
        <label>Khoa ID:</label>
        <input type="text" name="khoa_id" required value="<?= $edit_data['khoa_id'] ?? '' ?>"><br>
        <label>Trạng thái:</label>
        <input type="number" name="trangthai" required value="<?= $edit_data['trangthai'] ?? '' ?>"><br>
        <label>Chứng chỉ:</label>
        <input type="date" name="chung_chi" required value="<?= $edit_data['chung_chi'] ?? '' ?>"><br>
        <button type="submit"><?= $edit_data ? 'Cập nhật' : 'Thêm mới' ?></button>
    </form>

    <hr>
    <h2>Danh sách bản ghi</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Student ID</th>
            <th>Tên</th>
            <th>Khoa ID</th>
            <th>Trạng thái</th>
            <th>Chứng chỉ</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($capbang_list as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['student_id']) ?></td>
            <td><?= htmlspecialchars($row['Ten']) ?></td>
            <td><?= htmlspecialchars($row['khoa_id']) ?></td>
            <td><?= htmlspecialchars($row['trangthai']) ?></td>
            <td><?= htmlspecialchars($row['chung_chi']) ?></td>
            <td>
                <a href="capbang.php?action=edit&student_id=<?= $row['student_id'] ?>">Sửa</a> |
                <a href="capbang.php?action=delete&student_id=<?= $row['student_id'] ?>" onclick="return confirm('Xóa bản ghi này?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
