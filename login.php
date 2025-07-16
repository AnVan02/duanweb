<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}




$success_message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password_input = $_POST['password'];

    $sql = "SELECT * FROM students WHERE Student_ID = :student_id AND Password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['student_id' => $student_id, 'password' => $password_input]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['student_id'] = $user['Student_ID'];
        $_SESSION['student_name'] = $user['Ten'];
        $_SESSION['khoahoc'] = $user['Khoahoc'];

        // ✅ Chuyển hướng đến danh sách bài kiểm tra
        header("Location: kiemtra.php");
        exit();
    } else {
        $error = "Mã sinh viên hoặc mật khẩu không đúng!";
    }
}

// Hàm chuyển đổi tên khóa học thành tên file
function getCourseFileName($course_name) {
    $course_files = [
        'Python cơ bản' => 'Python_cb.php',
        'Python nâng cao' => 'Python_nc.php',
        'YOLO' => 'Yolo.php',
        'Toán' => 'Toan.php',
        'Văn' => 'Van.php',
        'Tiếng anh' => 'Tienganh.php',
        'Hoá học' => 'Hoahoc.php',
        'recent_result' => 'recent_result.php'
    ];
    
    return $course_files[$course_name];
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-popup {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 40px 32px 24px 32px;
            width: 400px;
            max-width: 95vw;
            text-align: center;
            position: relative;
            animation: fadeIn 0.5s;
        }
        /* Thêm CSS cho ảnh logo */
        .login-logo {
            width: 180px;
            height: 180px;
            object-fit: contain;
            border-radius: 16px;
            margin-bottom: 18px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.08);
            background: #fff;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .login-popup h2 {
            font-size: 26px;
            margin-bottom: 8px;
            color: #222;
            font-weight: bold;
        }
        .login-popup .desc {
            color: #e74c3c;
            font-size: 15px;
            margin-bottom: 24px;
        }
        .login-btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background: #f5f6fa;
            border: none;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 16px;
            margin-bottom: 14px;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s;
            font-weight: 500;
        }
        .login-btn:hover {
            background: #e9ecef;
        }
        .login-btn .icon {
            font-size: 22px;
            margin-right: 12px;
            width: 28px;
            text-align: center;
        }
        .login-btn.email {
            background: #f5f6fa;
            color: #222;
        }
        .login-btn.google .icon { color: #ea4335; }
        .login-btn.facebook .icon { color: #1877f3; }
        .login-btn.github .icon { color: #333; }
        .login-btn.google { background: #fff; border: 1px solid #eee;}
        .login-btn.facebook { background: #fff; border: 1px solid #eee;}
        .login-btn.github { background: #fff; border: 1px solid #eee;}
        .or-divider {
            margin: 18px 0;
            display: flex;
            align-items: center;
            color: #aaa;
            font-size: 14px;
        }
        .or-divider::before, .or-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
            margin: 0 8px;
        }
        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }
        input[type="text"], 
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
            margin-bottom: 2px;
        }
        input[type="submit"] {
            background-color: #f05123;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            margin-top: 8px;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #d84315;
        }
        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
            padding: 10px;
            background-color: #f8d7da;
            border-radius: 5px;
        }
        .login-footer {
            margin-top: 18px;
            font-size: 15px;
            color: #444;
        }
        .login-footer a {
            color: #f05123;
            text-decoration: none;
            margin: 0 4px;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
        .login-terms {
            margin-top: 10px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="login-popup">
        <img src="https://rosacomputer.vn/rosa_courses/login/admin/logo%20ROSA%20AI%20Ready.png" alt="ROSA_AI_READY" class="login-logo">
        <h2>HỆ THỐNG ĐĂNG NHẬP </h2>
        <div class="desc"></div>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="student_id">Mã sinh viên:</label>
                <input type="text" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Đăng nhập">
        </form>
    </div>
</body>
</html>

