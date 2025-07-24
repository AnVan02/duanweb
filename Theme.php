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

// Sử dụng function từ list.php
foreach ($course_ids as $khoa_id) {
    $stmt = $conn->prepare("SELECT khoa_hoc, mo_ta FROM khoa_hoc WHERE id = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $info = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $ten_khoa = $info['khoa_hoc'] ?? 'N/A';
    $mo_ta = $info['mo_ta'] ?? '';

    // Lấy chi tiết bài test theo chương từ list.php
    $result_data = DemSoBaiDat($conn, $student_id, $khoa_id);
    $chi_tiet_chuong = $result_data['chi_tiet_bai_test'];
    
    // Đếm số bài đạt và tổng số bài từ kết quả function DemSoBaiDat
    $bai_dat = $result_data['tong_so_bai_dat'];
    $total_test = TongSoBaiTest($conn, $khoa_id);
    
    $percent_tong = ($total_test > 0) ? round(($bai_dat / $total_test) * 100) : 0;
    $hoan_thanh = ($total_test > 0 && $bai_dat >= $total_test);
    
    $course_summary[] = [
        'ten_khoa' => $ten_khoa,
        'mo_ta' => $mo_ta,
        'bai_dat' => $bai_dat,
        'tong' => $total_test,
        'phan_tram' => $percent_tong,
        'hoan_thanh' => $hoan_thanh,
        'trang_thai' => $hoan_thanh ? 'Hoàn thành' : 'Chưa hoàn thành',
        'class' => $hoan_thanh ? 'status-completed' : 'status-incomplete',
        'id_khoa' => $khoa_id,
        'chi_tiet_chuong' => $chi_tiet_chuong
    ];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu khoá học</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI',sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .header-top {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo_container img {
            height: 40px;
            width: auto;
        }

        .logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .logout:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            padding: 20px;
            max-width: 100%;
        }

        .banner-container {
            position: relative;
            width: 100%;
            margin-bottom: 30px;
            border-radius: 24px;
            overflow: hidden;
        }

        .banner-text {
            position: relative;
            z-index: 2;
            color: white;
        }

        .banner-text h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .banner-text p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

        .course-card {
            background: white;
            border-radius: 16px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        }

        .course-header {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .course-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .course-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            flex: 1;
        }

        .completion-badge {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .check-icon {
            width: 24px;
            height: 24px;
            background: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        .progress-badge {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 600;
        }

        .course-description {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
        }

        .course-content {
            padding: 0 20px 20px;
        }

        .chapter-list {
            margin-bottom: 20px;
        }

        .chapter-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .chapter-item:last-child {
            border-bottom: none;
        }

        .chapter-bullet {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .chapter-bullet.completed {
            background: #4CAF50;
        }

        .chapter-bullet.incomplete {
            background: #e0e0e0;
        }

        .chapter-text {
            flex: 1;
            font-size: 14px;
            color: #555;
        }

        .chapter-text.completed {
            color: #4CAF50;
            font-weight: 500;
        }

        .course-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .status-text {
            font-size: 14px;
            font-weight: 500;
        }

        .status-completed {
            color: #4CAF50;
        }

        .status-incomplete {
            color: #f44336;
        }

        .start-btn {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .start-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .start-btn::after {
            content: '→';
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .banner-text h2 {
                font-size: 20px;
            }
            
            .course-title {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="header-top">
        <div class="logo_container">
            <img src="rosa.png" alt="Logo">
        </div>
        <form action="logout.php" method="post">
            <button type="submit" class="logout">Đăng xuất</button>
        </form>
    </div>

    <div class="container">
        <div class="banner-container">
            <img src="code.png" class="banner" alt="Banner">
            <div class="banner-text">
                <h2>GIỚI THIỆU KHOÁ HỌC</h2>
                <p>Khóa học Python toàn diện dành cho người mới, gồm nhiều giai đoạn từ cơ bản đến nâng cao.</p>
            </div>
        </div>
        <?php foreach ($course_summary as $course): ?>
        <div class="course-card">
            <div class="course-header">
                <div class="course-title-row">
                    <div class="course-title"><?= htmlspecialchars($course['ten_khoa']) ?></div>
                    <div class="completion-badge">
                        <?php if ($course['hoan_thanh']): ?>
                            <div class="check-icon">✓</div>
                        <?php else: ?>
                            <div class="progress-badge"><?= $course['phan_tram'] ?>%</div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="course-description">
                    <?= strip_tags($course['mo_ta']) ?>
                </div>
            </div>
            
            <div class="course-content">
                <div class="chapter-list">
                    <?php if (!empty($course['chi_tiet_chuong'])): ?>
                        <?php 
                        $chapters_available = array_keys($course['chi_tiet_chuong']);
                        sort($chapters_available);
                        foreach ($chapters_available as $chapter_num): 
                            $chuong = $course['chi_tiet_chuong'][$chapter_num];
                            $ten_hien_thi = htmlspecialchars($chuong['ten_test']);
                            $is_completed = $chuong['trang_thai'] == 1;
                        ?>
                            <div class="chapter-item">
                                <div class="chapter-bullet <?= $is_completed ? 'completed' : 'incomplete' ?>"></div>
                                <div class="chapter-text <?= $is_completed ? 'completed' : '' ?>">
                                    <?= $is_completed ? "<strong>$ten_hien_thi</strong>" : $ten_hien_thi ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="chapter-item">
                            <div class="chapter-bullet incomplete"></div>
                            <div class="chapter-text">Không có bài kiểm tra nào</div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="course-footer">
                    <span class="status-text <?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
                    <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="start-btn">Bắt đầu</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>