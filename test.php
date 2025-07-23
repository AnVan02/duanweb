<?php
require 'list.php';
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
$course_summary = [];

foreach ($course_ids as $khoa_id) {
    $stmt = $conn->prepare("SELECT khoa_hoc, mo_ta FROM khoa_hoc WHERE id = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $info = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $ten_khoa = $info['khoa_hoc'] ?? 'N/A';
    $mo_ta = $info['mo_ta'] ?? '';

    $bai_dat = DemSoBaiDat($conn, $student_id, $khoa_id);
    $total_test = TongSoBaiTest($conn, $khoa_id);
    $percent = ($total_test > 0) ? round(($bai_dat / $total_test) * 100) : 0;
    $hoan_thanh = ($total_test > 0 && $bai_dat >= $total_test);

    $course_summary[] = [
        'ten_khoa' => $ten_khoa,
        'mo_ta' => $mo_ta,
        'bai_dat' => $bai_dat,
        'tong' => $total_test,
        'phan_tram' => $percent,
        'hoan_thanh' => $hoan_thanh,
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSA - Giới thiệu khoá học</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f3f6fb;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header-top {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo_container img {
            max-width: 120px;
            height: auto;
        }

        .logout {
            background-color: #4D4D4D;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .logout:hover {
            background-color: #333;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 30px;
            box-sizing: border-box;
        }

        .banner-container {
            position: relative;
            width: 100%;
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
            height: 300px;
        }

        .banner {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .banner-text {
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateY(-50%);
            width: 50%;
            color: white;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
        }

        .banner-text h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
            color: white;
        }

        .banner-text p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 20px 15px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: top;
        }

        .course-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .course-icon {
            flex-shrink: 0;
        }

        .course-details {
            flex-grow: 1;
        }

        .course-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .course-description {
            color: #7f8c8d;
            font-size: 14px;
            line-height: 1.5;
        }

        .chapter-list {
            margin: 0;
            padding: 0;
        }

        .chapter-list p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
            line-height: 1.4;
        }

        .chapter-list.completed p {
            color: #27ae60;
        }

        .status {
            font-weight: 600;
            font-size: 15px;
        }

        .status-completed {
            color: #27ae60;
        }

        .status-incomplete {
            color: #e74c3c;
        }

        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .checkmark {
            width: 24px;
            height: 24px;
        }

        .percent {
            font-weight: 600;
            color: #3498db;
            font-size: 16px;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .banner-text {
                width: 70%;
            }
            
            .banner-text h2 {
                font-size: 28px;
            }
            
            .banner-text p {
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            .header-top {
                padding: 15px;
            }
            
            .container {
                padding: 20px;
            }
            
            .banner-container {
                height: 250px;
            }
            
            .banner-text {
                width: 80%;
            }
            
            .banner-text h2 {
                font-size: 24px;
                margin-bottom: 10px;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
            
            td, th {
                padding: 15px 10px;
            }
            
            .course-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .logo_container img {
                max-width: 100px;
            }
            
            .logout {
                padding: 8px 15px;
                font-size: 13px;
            }
            
            .banner-container {
                height: 200px;
            }
            
            .banner-text {
                width: 90%;
                left: 5%;
            }
            
            .banner-text h2 {
                font-size: 20px;
            }
            
            .course-title {
                font-size: 16px;
            }
            
            .course-description, .chapter-list p {
                font-size: 13px;
            }
            
            .btn {
                padding: 8px 15px;
                font-size: 13px;
            }
        }
        <img class="logo-rosa-ai-ready-1" src="data:image/png;base64,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" />
<div class="group-1">
  <div class="rectangle-3"></div>
  <div class="ng-xut"><span class="ngxut_span">Đăng xuất</span></div>
</div>
<img class="rectangle-141" src="data:image/png;base64,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" />
<div class="gii-thiu-kho-hc"><span class="giithiukhohc_span">GIỚI THIỆU KHOÁ HỌC</span></div>
<div class="kha-hc-python-ton-din-dnh-cho-ngi-mi-gm-nhiu-giai-on-t-c-bn-n-nng-cao"><span class="khahcpythontondindnhchongimigmnhiugiaiontcbnnnngcao_span">Khóa học Python toàn diện dành cho người mới, <br/>gồm nhiều giai đoạn từ cơ bản đến nâng cao.</span></div>

<style>
.rectangle-3 {
  width: 78.31px;
  height: 23.17px;
  left: 0px;
  top: 0px;
  position: absolute;
  background: linear-gradient(90deg, #4D4D4D 0%, #3F3F3F 100%);
  border-radius: 20px;
}

.ngxut_span {
  color: white;
  font-size: 10px;
  font-family: Montserrat;
  font-weight: 400;
  word-wrap: break-word;
}

.ng-xut {
  width: 53.75px;
  height: 12.51px;
  left: 12.51px;
  top: 5.10px;
  position: absolute;
}

.giithiukhohc_span {
  color: white;
  font-size: 20px;
  font-family: Montserrat;
  font-weight: 600;
  text-transform: uppercase;
  word-wrap: break-word;
}

.gii-thiu-kho-hc {
  justify-content: center;
  display: flex;
  flex-direction: column;
}

.khahcpythontondindnhchongimigmnhiugiaiontcbnnnngcao_span {
  color: white;
  font-size: 14px;
  font-family: Montserrat;
  font-weight: 400;
  line-height: 16.80px;
  word-wrap: break-word;
}

.kha-hc-python-ton-din-dnh-cho-ngi-mi-gm-nhiu-giai-on-t-c-bn-n-nng-cao {
  width: 662px;
  justify-content: center;
  display: flex;
  flex-direction: column;
}

.group-1 {
  width: 78.31px;
  height: 23.17px;
  position: relative;
  border-radius: 20px;
}

.rectangle-141 {
  width: 571px;
  height: 226px;
  background: #777777;
  border-radius: 24px;
}

.logo-rosa-ai-ready-1 {
  width: 102px;
  height: 32px;
}
</style>
    </style>
</head>
<body>
    
<div class="header-top">
    <div class="logo_container">
        <img src="rosa.png" alt="ROSA Logo">
    </div>
    <form action="logout.php" method="post">
        <button type="submit" class="logout">Đăng xuất</button>
    </form>
</div>

<div class="container">
    <div class="banner-container">
        <img src="code.png" class="banner" alt="Khóa học lập trình">
        <div class="banner-text">
            <h2>GIỚI THIỆU KHOÁ HỌC</h2>
            <p>Khóa học Python toàn diện dành cho người mới, gồm nhiều giai đoạn từ cơ bản đến nâng cao.</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tên khoá học</th>
                <th>Chương</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($course_summary as $course): ?>
            <tr>
                <td>
                    <div class="course-info">
                        <div class="course-icon">
                            <?php if ($course['hoan_thanh']): ?>
                                <img src="icon.png" alt="Hoàn thành" class="checkmark">
                            <?php else: ?>
                                <span class="percent"><?= $course['phan_tram'] ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="course-details">
                            <div class="course-title"><?= htmlspecialchars($course['ten_khoa']) ?></div>
                            <div class="course-description"><?= strip_tags($course['mo_ta']) ?></div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="chapter-list <?= $course['hoan_thanh'] ? 'completed' : '' ?>">
                        <p>Chương 1: Giới thiệu chung về Python</p>
                        <p>Chương 2: Cấu trúc điều kiện, vòng lặp</p>
                        <p>Chương 3: Cấu trúc dữ liệu trong Python</p>
                        <p>Chương 4: Module & Package</p>
                        <p>Chương 5: Pandas</p>
                        <p>Chương 6: Matplotlib</p>
                    </div>
                </td>
                <td>
                    <span class="status <?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
                </td>
                <td>
                    <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>

