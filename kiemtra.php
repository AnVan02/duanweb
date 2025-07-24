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
            font-family: 'Segoe UI', Arial, sans-serif;
           background: #f3f6fb;
            min-height: 100vh;
            color: #333;
            padding: 10px;
        }

        .header-top {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 15px 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo_container img {
            height: 40px;
            width: auto;
        }

        .logout {
            background: rgba(0, 106, 220, 0.92);
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
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
            backdrop-filter: blur(10px);
        }

        .banner-container {
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 16px;
            padding: 30px 20px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .banner-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.3;
        }

        .banner {
            display: none; /* Ẩn ảnh banner gốc */
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

        /* Hide table elements on mobile, show card layout */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            display: none; /* Hide table header on mobile */
        }

        tbody tr {
            display: block;
            background: white;
            border-radius: 16px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        }

        tbody td {
            display: block;
            padding: 0;
            border: none;
            border-bottom: none;
        }

        /* Course Header */
        .desktop-only:first-child,
        .desktop-only:nth-child(2),
        .mobile-only:first-child {
            padding: 20px;
            /* border-bottom: 1px solid #f0f0f0; */
        }

        /* Course title and completion badge */
        .mobile-only:first-child > div:first-child {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .mobile-only:first-child strong {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }

        .mobile-only:first-child small {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
            margin-top: 10px;
        }

        /* Completion badges */
        .percent {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 600;
            border: none;
        }

        .checkmark {
            width: 24px;
            height: 24px;
            background: #4CAF50;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        /* Chapter list styling */
        .chapter-list {
            padding: 0 20px;
            margin-bottom: 20px;
        }

        .chapter-list p {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f8f9fa;
            margin: 0;
        }

        .chapter-list p:last-child {
            border-bottom: none;
        }

        .chapter-list p::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e0e0e0;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .chapter-list p:has(strong)::before {
            background: #4CAF50;
        }

        .chapter-list p span {
            flex: 1;
            font-size: 14px;
            color: #555;
        }

        .chapter-list p strong {
            color: #4CAF50;
        }

        /* Footer with status and button */
        .mobile-only:last-child {
            padding: 15px 20px;
            border-top: 1px solid #f0f0f0;
        }

        .mobile-row-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .status-completed {
            color: #4CAF50;
            font-weight: 500;
            font-size: 14px;
        }

        .status-incomplete {
            color: #f44336;
            font-weight: 500;
            font-size: 14px;
        }

        .btn {
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

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .btn::after {
            content: '→';
            font-size: 16px;
        }

        /* Hide desktop-only elements on mobile */
        .desktop-only {
            display: none !important;
        }

        .mobile-only {
            display: block !important;
        }

        /* Desktop styles */
        @media (min-width: 769px) {
            body {
                padding: 30px;
            }

            .banner-container {
                position: relative;
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
                /* border-radius: 16px; */
                padding: 30px 20px;
                margin-bottom: 30px;
                overflow: hidden;
            }
            .header-top {
                max-width: 1200px;
                margin: 0 auto 30px auto;
                padding: 20px 30px;
            }

            .container {
                padding: 30px;
            }

            .banner-text h2 {
                font-size: 36px;
            }

            .banner-text p {
                font-size: 16px;
            }

            .logout {
                padding: 12px 30px;
                font-size: 16px;
            }

            /* Show desktop table layout */
            thead {
                display: table-header-group;
            }

            tbody tr {
                display: table-row;
                background: transparent;
                border-radius: 0;
                margin-bottom: 0;
                box-shadow: none;
                border-bottom: 1px solid #969696;
            }

            tbody tr:hover {
                transform: none;
                box-shadow: none;
                background-color: rgba(0,0,0,0.02);
            }

            tbody td {
                display: table-cell;
                padding: 12px 8px;
                border-bottom: 1px solid #969696;
                text-align: left;
                font-size: 14px;
            }

            .desktop-only {
                display: table-cell !important;
            }

            .mobile-only {
                display: none !important;
            }

            th, td {
                padding: 12px 8px;
                border-bottom: 1px solid #969696;
                text-align: left;
                font-size: 14px;
            }

            th {
                background-color: rgba(0,0,0,0.05);
                font-weight: 600;
            }

            td small {
                color: #777;
                display: block;
                margin-top: 8px;
                max-width: 360px;
                line-height: 1.4;
            }

            .chapter-list {
                max-width: 400px;
                padding: 0;
                margin: 0;
            }

            .chapter-list p {
                margin: 4px 0;
                color: #444;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 4px 0;
                border-bottom: none;
            }

            .chapter-list p::before {
                display: none;
            }

            .btn {
                padding: 10px 20px;
                border-radius: 6px;
            }

            .btn::after {
                display: none;
            }
        }

        /* Tablet adjustments */
        @media (max-width: 768px) and (min-width: 481px) {
            .container {
                padding: 25px;
            }

            .banner-text h2 {
                font-size: 28px;
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

    <table>
        <thead>
        <tr>
            <th></th>
            <th>Tên khoá học</th>
            <th>Chương</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($course_summary as $course): ?>
        <tr>
           <!-- Máy tính: Cột 1 (tích hoặc %) -->
            <td class="desktop-only" style="text-align: center;">
                <?php if ($course['hoan_thanh']): ?>
                    <span class="checkmark">✓</span>
                <?php else: ?>
                    <span class="percent"><?= $course['phan_tram'] ?>%</span>
                <?php endif; ?>
            </td>

            <!-- Máy tính: Cột 2 (tên khoá + mô tả) -->
            <td class="desktop-only">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div>
                        <strong><?= htmlspecialchars($course['ten_khoa']) ?></strong><br>
                        <small><?= strip_tags($course['mo_ta']) ?></small>
                    </div>
                </div>
            </td>

            <!-- Mobile: Gộp cột 1 & 2 -->
         <td colspan="2" class="mobile-only">
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <!-- Dòng 1: Tên khoá + icon hoàn thành hoặc % -->
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <strong><?= htmlspecialchars($course['ten_khoa']) ?></strong>
                    <?php if ($course['hoan_thanh']): ?>
                        <span class="checkmark">✓</span>
                    <?php else: ?>
                        <span class="percent"><?= $course['phan_tram'] ?>%</span>
                    <?php endif; ?>
                </div>

                <!-- Dòng 2: Mô tả -->
                <div>
                    <small><?= strip_tags($course['mo_ta']) ?></small>
                </div>
            </div>
        </td>

                <!-- Cột 3: Danh sách chương -->
                <td>
                    <div class="chapter-list">
                        <?php if (!empty($course['chi_tiet_chuong'])): ?>
                            <?php 
                            $chapters_available = array_keys($course['chi_tiet_chuong']);
                            sort($chapters_available);
                            foreach ($chapters_available as $chapter_num): 
                                $chuong = $course['chi_tiet_chuong'][$chapter_num];
                                $ten_hien_thi = htmlspecialchars($chuong['ten_test']);
                            ?>
                                <p>
                                    <span>
                                        <?= $chuong['trang_thai'] == 1
                                            ? "<strong>$ten_hien_thi</strong>"
                                            : $ten_hien_thi ?>
                                    </span>
                                </p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p><span>Không có bài kiểm tra nào</span></p>
                        <?php endif; ?>
                    </div>
                </td>

                <!-- Cột 4 & 5: Desktop view -->
                <td class="desktop-only">
                    <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
                </td>
                <td class="desktop-only">
                    <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
                </td>

                <!-- Cột gộp 4 & 5: Mobile view -->
               <td class="mobile-only" colspan="2">
                    <div class="mobile-row-bottom">
                        <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
                        <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>