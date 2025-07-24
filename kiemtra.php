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
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f3f6fb;
            margin: 0;
            padding: 0;
        }

        .header-top {
            max-width: 1265px;
            margin: auto;
            border-radius: 30px;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo_container img {
            max-width: 120px;
            height: auto;
        }

        .logout {
            background-color: #3D3D3D;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 20px 100px;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 30px;
            border: 1px solid #ccc;
            padding: 30px;
        }

        .banner-container {
            position: relative;
            width: 100%;
            margin-bottom: 30px;
            border-radius: 24px;
            overflow: hidden;
        }

        .banner {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 24px;
        }

        .banner-text {
            position: absolute;
            top: 30%;
            left: 5%;
            width: 40%;
            color: white;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
        }

        .banner-text h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        table {
            width: 100%;
        }

        th, td {
            padding: 12px 8px;
            border-bottom: 1px solid #969696;
            text-align: left;
            font-size: 14px;
        }

        td small {
            color: #777;
            display: block;
            margin-top: 8px;
            max-width: 360px;
            line-height: 1.4;
        }

        .btn {
            display: inline-block;
            background-color: #2d6cdf;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn:hover {
            background-color: #1558c0;
        }

      .status-completed {
            color: #00AD26;
            font-weight: 600;
            display: inline-block;
            margin-right: 45px;
            white-space: nowrap;
            text-decoration: none; /* Loại bỏ gạch chân */
        }

    .status-incomplete {
            color: #AD0000;
            font-weight: 600;
            display: inline-block;
            margin-right: 10px;
            white-space: nowrap;
            text-decoration: none; /* Loại bỏ gạch chân */
        }

        .checkmark {
            color: #00AD26;
            font-size: 20px;
            font-weight: bold;
        }
        .percent {
            display: inline-block;
            border: 1px solid #1558c0;
            color: #fff;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 13px;
            font-size: 14px;
            background-color: #1558c0;
            
        }


        .percent-individual {
            color: #FF6B35;
            font-size: 14px;
            font-weight: bold;
        }

        .chapter-list {
            max-width: 400px;
        }

        .chapter-list p {
            margin: 4px 0;
            color: #444;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chapter-list.completed p {
            color: #00AD26;
            font-weight: 500;
        }

        .chapter-status {
            margin-left: 10px;
            font-size: 12px;
        }

        .chapter-percent {
            color: #FF6B35;
            font-weight: bold;
        }

        .chapter-pass {
            color: #00AD26;
            font-weight: bold;
        }

        .chapter-not-done {
            color: #999;
        }
        .text-green {
            color: green;
        }

    /* Mobile CSS - Tối ưu theo hình ảnh */
    /* RESET CƠ BẢN */

    
    
@media (max-width: 768px) {
    .banner-container {
        border-radius: 16px;
    }
    .banner-text h2 {
        font-size: 1.25rem;
    }
    .banner-text p {
        font-size: 0.9rem;
    }
    .banner-text {
        top: 10%;
        left: 1%;
        width: 70%;
    }
    .container {
        /* width: 100%; */
        max-width: 1200px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 30px;
        border: 1px solid #ccc;
        padding: 30px;
    }
    
    body {
        font-family: "Segoe UI", sans-serif;
        font-size: 15px;
        background: #f7f7f7;
        color: #333;
        padding: 10px;
        line-height: 1.5;
    }
    .logout {
        background-color: #4D4D4D;
        color: white;
        border: none;
        margin-left:60px;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
    }
    .banner-container {
        width: 100%;
        border-radius: 24px;
        overflow: hidden; /* Bắt buộc để cắt phần ảnh vượt ra */
        margin-bottom: 24px;
    }

    .banner {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }


    /* TIÊU ĐỀ KHÓA HỌC */
    .course-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .header-top {
        max-width: 1290px;
        margin: auto;
        border-radius: 30px;
        padding: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* MÔ TẢ NGẮN */
    .course-description {
        font-size: 0.95rem;
        color: #666;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 15px;
    }

    
    /* BUTTON HÀNH ĐỘNG */
    .btn {
        display: inline-block;
        width: 89%;
        background: #007bff;
        color: white;
        padding: 10px 12px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        text-align: center;
        margin-top: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn:hover {
        background: #0056b3;
    }

    /* DANH SÁCH CHƯƠNG HỌC */
    .chapter-list {
        margin-top: 20px;
    }
    .chapter {
        background: white;
        border-radius: 10px;
        padding: 12px 15px;
        margin-bottom: 15px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }
    .chapter p {
        margin-bottom: 5px;
    }
    .chapter .status {
        color: green;
        font-weight: bold;
        font-size: 0.9rem;
    }
}


    /* BẢNG DẠNG RESPONSIVE (CHUYỂN BLOCK) */
    @media screen and (max-width: 480px) {
    
    table, thead, tbody, th, td, tr {
        display: block;
    }
    .banner-container {
        border-radius: 24px;
        overflow: hidden;
    }

    .banner {
        width: 156%;
        height: auto;
        display: block;
        object-fit: cover;
    }
    thead {
        display: none;
    }
    
    tr {
        margin-bottom: 15px;
        background: white;
        padding: 10px;
        border-radius: 8px;
        /* box-shadow: 0 1px 4px rgba(0,0,0,0.05); */
    }
    
    td {
        position: relative;
        /* padding-left: 50%; */
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 0.95rem;
        border-bottom: 1px solid #eee;
    }
    td:before {
        position: absolute;
        top: 20px;
        left: 5px;
        /* width: 45%; */
        font-weight: bold;
        color: #555;
    }
 }

    /* Ẩn/hiện đúng theo thiết bị */
    .mobile-only {
        display: none;
    }
    .desktop-only {
        display: table-cell;
    }

    /* Mobile responsive */
    @media screen and (max-width: 768px) {
        .mobile-only {
            display: table-cell;
        }
        .desktop-only {
            display: none;
        }

        .mobile-row-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* border-top: 1px solid #ddd; */
            text-decoration: none;
            gap: 132px;
        }
        .desktop-only {
            display: table-cell;
        }
        .mobile-row-bottom span {
            font-size: 14px;
         
        }
        .mobile-only {
            display: none;
        }
        .btn {
            padding: 6px 14px;
            background-color: #1E59C5;
            color: white;
            border-radius: 999px;
            text-decoration: none;
            font-size: 14px;
        }


        @media (max-width: 768px) {
            .desktop-only {
                display: none;
            }
            .mobile-only {
                display: table-cell;
            }
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
           <!-- Máy tính: Cột 1 (tích hoặc %) -->
            <td class="desktop-only" style="text-align: center;">
                <?php if ($course['hoan_thanh']): ?>
                    <img src="icon.png" alt="Hoàn thành" class="checkmark" style="width: 24px; height: 24px;">
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
                <div style="display: flex; align-items: center; gap: 6px;">
                    <strong><?= htmlspecialchars($course['ten_khoa']) ?></strong>
                    <?php if ($course['hoan_thanh']): ?>
                        <span style="display: inline-flex; width: 20px; height: 20px;">
                            <img src="icon.png" alt="✓" style="width: 100%; height: 100%;">
                        </span>
                    <?php else: ?>
                        <span class="percent" style="font-weight: bold;"><?= $course['phan_tram'] ?>%</span>
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
                                            ? "<strong style='color: #28a745;'>$ten_hien_thi</strong>"
                                            : $ten_hien_thi ?>
                                    </span>
                                </p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có bài kiểm tra nào</p>
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