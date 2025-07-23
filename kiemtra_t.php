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
    
    // Debug: Kiểm tra dữ liệu (BẬT DEBUG)
    echo "<pre>Debug khóa $khoa_id (Student: $student_id):\n";
    echo "Số test tìm được: " . count($chi_tiet_chuong) . "\n";
    print_r($chi_tiet_chuong);
    echo "</pre>";
    
    // Debug query trực tiếp
    $debug_query = "SELECT id_test, ten_test FROM test WHERE id_khoa = $khoa_id";
    $debug_result = $conn->query($debug_query);
    echo "<pre>Tests trong database cho khóa $khoa_id:\n";
    while ($row = $debug_result->fetch_assoc()) {
        echo "ID: {$row['id_test']}, Tên: {$row['ten_test']}\n";
    }
    echo "</pre>";
    
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
            background-color: #4D4D4D;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
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
        }

        .status-incomplete {
            color: #AD0000;
            font-weight: 600;
        }

        .checkmark {
            color: #00AD26;
            font-size: 20px;
            font-weight: bold;
        }

        .percent {
            color: #0091FF;
            font-size: 16px;
            font-weight: bold;
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

        @media screen and (max-width: 480px) {
            body {
                font-size: 14px;
            }

            .logo_container img {
                max-width: 80px;
            }

            .logout {
                margin-top: 10px;
                padding: 6px 14px;
                font-size: 13px;
            }

            .banner-text {
                width: 90%;
                top: 10%;
                left: 5%;
            }

            .banner-text h2 {
                font-size: 20px;
            }

            .banner-text p {
                font-size: 13px;
            }

            .container {
                padding: 15px;
                border-radius: 20px;
            }

            table {
                font-size: 12px;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                padding: 8px 6px;
                font-size: 13px;
                min-width: 120px;
            }

            .btn {
                font-size: 12px;
                padding: 8px 14px;
                display: inline-block;
            }

            .chapter-list p {
                font-size: 12px;
                margin: 3px 0;
            }

            .checkmark {
                width: 18px;
                height: 18px;
            }
        }

        @media screen and (max-width: 768px) {
            .banner-text {
                top: 10%;
                width: 90%;
            }

            .banner-text h2 {
                font-size: 18px;
            }

            .banner-text p {
                font-size: 13px;
            }

            .table, table {
                width: 100%;
                display: block;
                overflow-x: auto;
            }

            th, td {
                padding: 10px 5px;
                font-size: 12px;
            }

            .chapter-list p {
                font-size: 11px;
            }

            .btn {
                padding: 6px 10px;
                font-size: 12px;
            }

            .logout {
                padding: 5px 10px;
                font-size: 12px;
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
            <th>Tên khoá học</th>
            <th>Chương</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($course_summary as $course): ?>
            <tr>
                <?php
                    // Hiển thị icon hoàn thành hoặc phần trăm tổng
                    $icon_html = $course['hoan_thanh']
                        ? '<img src="icon.png" alt="Hoàn thành" class="checkmark" style="width: 24px; height: 24px;">'
                        : '<span class="percent">' . $course['phan_tram'] . '%</span>';
                ?>
                <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <?= $icon_html ?>
                        <div>
                            <strong><?= htmlspecialchars($course['ten_khoa']) ?></strong>
                            <small><?= strip_tags($course['mo_ta']) ?></small>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="chapter-list">
                        <?php if (!empty($course['chi_tiet_chuong'])): ?>
                            <?php 
                            // Lấy danh sách chương thực tế có trong database
                            $chapters_available = array_keys($course['chi_tiet_chuong']);
                            sort($chapters_available); // Sắp xếp theo thứ tự tăng dần
                            ?>
                            
                            <?php foreach ($chapters_available as $chapter_num): ?>
                                <?php $chuong = $course['chi_tiet_chuong'][$chapter_num]; ?>
                                <p>
                                    <span>
                                        <?php 
                                        // Hiển thị tên test gốc từ database
                                        $ten_hien_thi = htmlspecialchars($chuong['ten_test']);
                                        ?>
                                        <?= $ten_hien_thi ?>
                                    </span>
                                    <span class="chapter-status">
                                        <?php if (!$chuong['da_lam']): ?>
                                            <span class="chapter-not-done">Chưa làm</span>
                                        <?php elseif ($chuong['trang_thai'] == 1): ?>
                                            <span class="chapter-pass">✓ <?= $chuong['percent'] ?>%</span>
                                        <?php else: ?>
                                            <span class="chapter-percent"><?= $chuong['percent'] ?>%</span>
                                        <?php endif; ?>
                                    </span>
                                </p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có bài kiểm tra nào</p>
                            <?php 
                            // Debug: Hiển thị thông tin debug nếu cần
                            // echo "<small>Debug: student_id=$student_id, khoa_id={$course['id_khoa']}</small>"; 
                            ?>
                        <?php endif; ?>
                    </div>
                </td>
                <td><span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span></td>
                <td><a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>