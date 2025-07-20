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

// Xử lý thêm học sinh mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_student') {
    $student_id = $_POST['student_id'];
    $ten = $_POST['ten'];
    $khoa_id = $_POST['khoa_id'];

    // Kiểm tra trùng Student_ID
    $check = $conn->prepare("SELECT Student_ID FROM students WHERE Student_ID = ?");
    $check->bind_param("s", $student_id);
    $check->execute();
    
    if ($check->get_result()->num_rows > 0) {
        header("Location: chungchi.php?error=Student_ID đã tồn tại");
        exit;
    }

    // Thêm vào students
    $stmt = $conn->prepare("INSERT INTO students (Student_ID, Ten, Khoahoc) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_id, $ten, $khoa_id);
    
    if ($stmt->execute()) {
        // Thêm vào chungchi
        $stmt2 = $conn->prepare("INSERT INTO chungchi (student_id, ten_hs, khoa_id, thanhtich, chungchi) VALUES (?, ?, ?, 0, NULL)");
        $stmt2->bind_param("sss", $student_id, $ten, $khoa_id);
        $stmt2->execute();
        $stmt2->close();
        
        header("Location: chungchi.php?message=Thêm học sinh thành công");
    } else {
        header("Location: chungchi.php?error=Lỗi khi thêm học sinh");
    }
    
    $stmt->close();
    exit;
}

// Xử lý cập nhật chứng chỉ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_chungchi') {
    $student_id = $_POST['student_id'];
    $thanhtich = $_POST['thanhtich'];
    $chung_chi = $_POST['chung_chi'];
    
    $stmt = $conn->prepare("UPDATE chungchi SET thanhtich = ?, chungchi = ? WHERE student_id = ?");
    $stmt->bind_param("iss", $thanhtich, $chung_chi, $student_id);
    
    if ($stmt->execute()) {
        header("Location: chungchi.php?message=Cập nhật chứng chỉ thành công");
    } else {
        header("Location: chungchi.php?error=Lỗi khi cập nhật");
    }
    
    $stmt->close();
    exit;
}

// Xử lý xóa học sinh
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    
    // Xóa từ bảng chungchi trước
    $stmt = $conn->prepare("DELETE FROM chungchi WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $stmt->close();
    
    // Xóa từ bảng students
    $stmt = $conn->prepare("DELETE FROM students WHERE Student_ID = ?");
    $stmt->bind_param("s", $student_id);
    
    if ($stmt->execute()) {
        header("Location: chungchi.php?message=Xóa học sinh thành công");
    } else {
        header("Location: chungchi.php?error=Lỗi khi xóa học sinh");
    }
    
    $stmt->close();
    exit;
}

// Lấy danh sách học sinh và chứng chỉ
$query = "SELECT s.Student_ID, s.Ten, s.Khoahoc, 
          c.thanhtich, c.chungchi, c.ten_hs 
          FROM students s 
          LEFT JOIN chungchi c ON s.Student_ID = c.student_id 
          ORDER BY s.Student_ID DESC";
$result = $conn->query($query);
$students = $result->fetch_all(MYSQLI_ASSOC);

// Lấy thông tin học sinh cần chỉnh sửa
$edit_student = null;
if (isset($_GET['edit'])) {
    $student_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT s.*, c.thanhtich, c.chungchi 
                          FROM students s 
                          LEFT JOIN chungchi c ON s.Student_ID = c.student_id 
                          WHERE s.Student_ID = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $edit_student = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Học sinh và Chứng chỉ</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .actions a {
            color: #2196F3;
            text-decoration: none;
            margin-right: 10px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quản lý Học sinh và Chứng chỉ</h1>
        
        <?php if (isset($_GET['message'])): ?>
            <div class="message success"><?= htmlspecialchars($_GET['message']) ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="message error"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <h2><?= $edit_student ? 'Cập nhật' : 'Thêm mới' ?> Học sinh</h2>
        <form method="POST" action="chungchi.php">
            <input type="hidden" name="action" value="<?= $edit_student ? 'update_student' : 'add_student' ?>">
            
            <div class="form-group">
                <label for="student_id">Mã học sinh:</label>
                <input type="text" id="student_id" name="student_id" required 
                       value="<?= htmlspecialchars($edit_student['Student_ID'] ?? '') ?>"
                       <?= $edit_student ? 'readonly' : '' ?>>
            </div>
            
            <div class="form-group">
                <label for="ten">Họ và tên:</label>
                <input type="text" id="ten" name="ten" required 
                       value="<?= htmlspecialchars($edit_student['Ten'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="khoa_id">Khóa học:</label>
                <input type="text" id="khoa_id" name="khoa_id" required 
                       value="<?= htmlspecialchars($edit_student['Khoahoc'] ?? '') ?>">
            </div>
            
            <button type="submit"><?= $edit_student ? 'Cập nhật' : 'Thêm mới' ?></button>
            
            <?php if ($edit_student): ?>
                <a href="chungchi.php" style="margin-left: 10px;">Hủy bỏ</a>
            <?php endif; ?>
        </form>

        <h2>Cập nhật Chứng chỉ</h2>
        <?php if (isset($_GET['edit'])): ?>
        <form method="POST" action="chungchi.php">
            <input type="hidden" name="action" value="update_chungchi">
            <input type="hidden" name="student_id" value="<?= htmlspecialchars($edit_student['Student_ID'] ?? '') ?>">
            
            <div class="form-group">
                <label for="thanhtich">Thành tích:</label>
                <select id="thanhtich" name="thanhtich" required>
                    <option value="1" <?= ($edit_student['thanhtich'] ?? 0) == 1 ? 'selected' : '' ?>>Đạt</option>
                    <option value="0" <?= ($edit_student['thanhtich'] ?? 0) == 0 ? 'selected' : '' ?>>Không đạt</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="chung_chi">Ngày cấp chứng chỉ:</label>
                <input type="date" id="chung_chi" name="chung_chi" 
                       value="<?= htmlspecialchars($edit_student['chungchi'] ?? '') ?>">
            </div>
            
            <button type="submit">Cập nhật Chứng chỉ</button>
        </form>
        <?php else: ?>
            <p>Vui lòng chọn học sinh cần cập nhật từ danh sách bên dưới</p>
        <?php endif; ?>

        <h2>Danh sách Học sinh</h2>
        <table>
            <thead>
                <tr>
                    <th>Mã HS</th>
                    <th>Họ tên</th>
                    <th>Khóa học</th>
                    <th>Thành tích</th>
                    <th>Chứng chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['Student_ID']) ?></td>
                    <td><?= htmlspecialchars($student['Ten']) ?></td>
                    <td><?= htmlspecialchars($student['Khoahoc']) ?></td>
                    <td><?= ($student['thanhtich'] ?? 0) == 1 ? 'Đạt' : 'Không đạt' ?></td>
                    <td><?= htmlspecialchars($student['chungchi'] ?? 'Chưa có') ?></td>
                    <td class="actions">
                        <a href="chungchi.php?edit=<?= htmlspecialchars($student['Student_ID']) ?>">Sửa</a>
                        <a href="chungchi.php?action=delete&student_id=<?= htmlspecialchars($student['Student_ID']) ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa học sinh này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>