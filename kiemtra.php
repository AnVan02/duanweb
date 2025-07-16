<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
    $conn = new mysqli("localhost", "root", "", "student");
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$student_id = $_SESSION['student_id'] ?? null;
if (!$student_id) {
    echo "<script>alert('Vui lòng đăng nhập!'); window.location.href='login.php';</script>";
    exit();
}

// Lấy danh sách các khóa học mà học viên đã đăng ký
$stmt = $conn->prepare("SELECT Khoahoc FROM students WHERE Student_ID = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    echo "<script>alert('Không tìm thấy học viên');</script>";
    exit();
}

$course_ids = array_map('intval', explode(',', $row['Khoahoc']));

// Chuẩn bị lấy thông tin cho từng khóa học
$course_summary = [];

foreach ($course_ids as $khoa_id) {
    // Lấy tên và mô tả khóa học
    $stmt = $conn->prepare("SELECT khoa_hoc, mo_ta FROM khoa_hoc WHERE id = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $info = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $ten_khoa = $info['khoa_hoc'] ?? 'N/A';
    $mo_ta = $info['mo_ta'] ?? '';

    // Đếm tổng số bài test
    $stmt = $conn->prepare("SELECT COUNT(*) AS tong_test FROM test WHERE id_khoa = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $total_test = $stmt->get_result()->fetch_assoc()['tong_test'] ?? 0;
    $stmt->close();

    // Đếm số bài test đã làm
    $stmt = $conn->prepare("SELECT COUNT(DISTINCT test_id) AS da_lam FROM ket_qua WHERE student_id = ? AND khoa_id = ?");
    $stmt->bind_param("si", $student_id, $khoa_id);
    $stmt->execute();
    $done_test = $stmt->get_result()->fetch_assoc()['da_lam'] ?? 0;
    $stmt->close();

    $hoan_thanh = ($total_test > 0 && $done_test >= $total_test);

    $course_summary[] = [
        'ten_khoa' => $ten_khoa,
        'mo_ta' => $mo_ta,
        'da_lam' => $done_test,
        'tong' => $total_test,
        'trang_thai' => $hoan_thanh ? 'Hoàn thành' : 'Chưa hoàn thành',
        'class' => $hoan_thanh ? 'status-completed' : 'status-incomplete',
        'id_khoa' => $khoa_id
    ];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tổng kết bài kiểm tra</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f3f6fb;
            padding: 0;
            margin: 0;
        }
        .header {
            text-align: center;
            margin: 40px 0 32px 0;
        }
        .header h1 {
            color: #222;
            font-size: 2.3rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }
        .header p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        table {
            width: 90%;
            margin: 0 auto 40px auto;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            box-shadow: 0 4px 24px 0 rgba(44,62,80,0.08);
            border-radius: 14px;
            overflow: hidden;
        }
        th, td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #eaeaea;
            text-align: left;
        }
        th {
            background: #3498db;
            color: #fff;
            text-transform: uppercase;
            font-size: 1.05rem;
            font-weight: 600;
            border-bottom: 3px solid #217dbb;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tbody tr:hover {
            background: #f0f8ff;
            transition: background 0.18s;
        }
        .status-completed {
            background-color: #2ecc71;
            color: #fff;
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(46,204,113,0.08);
        }
        .status-incomplete {
            background-color: #e74c3c;
            color: #fff;
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(231,76,60,0.08);
        }
        .btn {
            background-color: #2980b9;
            color: #fff;
            padding: 10px 22px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(52,152,219,0.08);
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            border: none;
            outline: none;
            display: inline-block;
        }
        .btn:hover, .btn:focus {
            background-color: #1c6396;
            box-shadow: 0 4px 16px rgba(52,152,219,0.15);
            transform: translateY(-2px) scale(1.03);
        }
        @media (max-width: 900px) {
            table {
                width: 100%;
            }
            th, td {
                padding: 0.7rem 0.5rem;
            }
        }
        @media (max-width: 600px) {
            .header h1 {
                font-size: 1.3rem;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th {
                border-radius: 0;
            }
            tr {
                margin-bottom: 1.2rem;
            }
            td {
                border: none;
                position: relative;
                padding-left: 50%;
                min-height: 38px;
            }
            td:before {
                position: absolute;
                left: 0;
                top: 0;
                width: 48%;
                padding-left: 10px;
                white-space: nowrap;
                font-weight: bold;
                color: #888;
                content: attr(data-label);
            }
        }
    </style>
</head>
<body>

   <div class="header">
        <h1>Tổng kết bài kiểm tra</h1>
        <p>Xem kết quả và tiến độ học tập của bạn</p>
    </div>
<table>
    <thead>
        <tr>
            <th>Khóa học</th>
            <th>Bài kiểm tra</th>
            <th>Trạng thái</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
        <tbody>
            <?php foreach ($course_summary as $course): ?>
                <tr>
                    <td><?= htmlspecialchars($course['ten_khoa']) ?></td>
                    <td><?= $course['da_lam'] . ' / ' . $course['tong'] ?></td>
                    <td><span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span></td>
                    <td><?= strip_tags($course['mo_ta'], '<h1><h2><ul><li><strong><p><br>') ?></td>
                    <td><a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</table>

</body>
</html>
