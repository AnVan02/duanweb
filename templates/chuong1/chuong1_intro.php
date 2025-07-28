<?php
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "student");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy id_test từ URL
$id_test = '1';
$ma_khoa = '1';
$student_id = $_SESSION['student_id'];
$link_quay_lai = "exercise1.php";
$link_tiep_tuc = "dashboard.php";

// Kiểm tra quyền truy cập khóa học
$stmt = $conn->prepare("SELECT Khoahoc FROM students WHERE Student_ID = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $khoahoc = $row['Khoahoc'];
    $khoahoc_list = array_map('intval', explode(',', $khoahoc));
    if (!in_array(intval($ma_khoa), $khoahoc_list)) {
        echo "<script>
            alert('Bạn không có quyền truy cập khóa học này!');
            window.location.href = 'login.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('Không tìm thấy thông tin sinh viên!');
        window.location.href = 'login.php';
    </script>";
    exit();
}
$stmt->close();

// Kiểm tra ID bài test
$stmt = $conn->prepare("SELECT id_test FROM test WHERE id_test = ?");
$stmt->bind_param("i", $id_test);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    echo "<script>alert('ID bài test ($id_test) không tồn tại trong hệ thống. Vui lòng kiểm tra lại!');</script>";
    exit();
}
$row = $result->fetch_assoc();
$id_baitest = $row['id_test'];
$stmt->close();

// Lấy mô tả khoá học 
$stmt = $conn->prepare("SELECT mo_ta FROM khoa_hoc WHERE id= ?");
$stmt->bind_param("s", $mo_ta);
$stmt->execute();
$result = $stmt->get_result();
$mo_ta = $result->num_rows > 0 ? $result->fetch_assoc()['mo_ta'] : '';
$stmt->close();

// Lấy tên khóa học
$stmt = $conn->prepare("SELECT khoa_hoc FROM khoa_hoc WHERE id = ?");
$stmt->bind_param("s", $ma_khoa);
$stmt->execute();
$result = $stmt->get_result();
$id_khoa = $result->num_rows > 0 ? $result->fetch_assoc()['khoa_hoc'] : '';
$stmt->close();

// Lấy tên bài test
$stmt = $conn->prepare("SELECT ten_test FROM test WHERE id_test = ?");
$stmt->bind_param("s", $id_test);
$stmt->execute();
$result = $stmt->get_result();
$ten_test = $result->num_rows > 0 ? $result->fetch_assoc()['ten_test'] : '';
$stmt->close();

// Lấy thông tin bài test (số lần thử tối đa)
function getTestInfo($conn, $id_test, $id_khoa) {
    $sql = "SELECT lan_thu FROM test WHERE id_test = ? AND id_khoa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id_test, $id_khoa);
    $stmt->execute();
    $result = $stmt->get_result();
    $lan_thu = $result->num_rows > 0 ? $result->fetch_assoc()['lan_thu'] : 3;
    $stmt->close();
    return $lan_thu;
}
$max_attempts = getTestInfo($conn, $id_baitest, $id_khoa);

// Lấy kết quả gần nhất
$stmt = $conn->prepare("SELECT kq_cao_nhat, test_gan_nhat, so_lan_thu FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
$stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
$stmt->execute();
$result = $stmt->get_result();
$recent_result = $result->num_rows > 0 ? $result->fetch_assoc() : null;
$stmt->close();

// Lấy danh sách câu hỏi từ session nếu đã làm bài
$questions = $_SESSION['questions_' . $id_test] ?? [];

// Nếu chưa có session (chưa từng làm bài), mới lấy từ database để đếm số câu hỏi
if (empty($questions)) {
    $stmt = $conn->prepare("SELECT * FROM quiz WHERE id_khoa = ? AND id_baitest = ?");
    $stmt->bind_param("ss", $ma_khoa, $id_test);
    $stmt->execute();
    $result = $stmt->get_result();
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            'id' => $row['Id_cauhoi'],
            'question' => $row['cauhoi'],
            'choices' => [
                'A' => $row['cau_a'],
                'B' => $row['cau_b'],
                'C' => $row['cau_c'],
                'D' => $row['cau_d']
            ],
            'images' => [
                'A' => $row['hinhanh_a'],
                'B' => $row['hinhanh_b'],
                'C' => $row['hinhanh_c'],
                'D' => $row['hinhanh_d']
            ],
            'explanations' => [
                'A' => $row['giaithich_a'],
                'B' => $row['giaithich_b'],
                'C' => $row['giaithich_c'],
                'D' => $row['giaithich_d']
            ],
            'correct' => $row['dap_an'],
            'image' => $row['hinhanh']
        ];
    }
    $stmt->close();
}
$_SESSION['questions_' . $id_test] = $questions;

// Lấy thông tin bài test (không bao gồm required_pass_percent)
$stmt = $conn->prepare("SELECT id_test, ten_test, lan_thu FROM test WHERE id_test = ?");
$stmt->bind_param("i", $id_test);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('ID bài test ($id_test) không tồn tại trong hệ thống. Vui lòng kiểm tra lại!');</script>";
    exit();
}

$test_info = $result->fetch_assoc();
$id_baitest = $test_info['id_test'];
$ten_test = $test_info['ten_test'] ?? 'Bài test ' . $id_test;
$max_attempts = $test_info['lan_thu'] ?? 3;
$required_pass_percent = 80; // Giá trị mặc định
$stmt->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
    <title><?php echo $recent_result ? 'Kết quả gần nhất' : 'Bài kiểm tra cuối khóa'; ?> - <?php echo htmlspecialchars($id_khoa); ?></title>
    <style>
        body {
            font-family: Montserrat;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: #333;
        }
        
        .header {
            background:#FFFFFF;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #AFAAAA; /* Đường gạch ngang dưới */
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1336px;
            margin: 0 auto;
        }
        
       /* Kiểu dáng cho nút "Quay lại" trong header */
        .back-btn {
            background: none; /* Không có nền */
            border: none; /* Không có viền */
            cursor: pointer; /* Biến con trỏ thành bàn tay khi di chuột */
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            padding: 0;
            display: flex; /* Để căn chỉnh icon và chữ */
            align-items: center;
            gap: 0.5rem; /* Khoảng cách giữa icon và chữ */
            text-decoration: none; /* Bỏ gạch chân cho link 'Quay lại' */
            transition: color 0.2s ease; /* Hiệu ứng chuyển màu mượt mà */
        }

        .back-btn i {
            font-size: 1.2rem;
        }
        
          /* Logo ROSA */
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Màu gradient cho chữ ROSA */
            -webkit-background-clip: text; /* Cắt nền theo hình dạng chữ */
            -webkit-text-fill-color: transparent; /* Làm màu chữ trong suốt để thấy nền */
            background-clip: text;
            font-family: 'Arial', sans-serif; /* Font Arial cho chữ logo */
            font-weight: 900;
        }

        .spacer {
            width: 100px;
        }
        
        .title-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .main-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
         .subtitle {
            font-size: 16px;
            color: #6c757d;
            font-weight: 400;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 1px;
            /* background: white; */
            border-radius: 12px;
            /* box-shadow: 0 4px 20px rgba(0,0,0,0.08); */
        }
        
        .test-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
        }

        .test-info-table th,
        .test-info-table td {
            padding: 15px 20px;
            text-align: left;
            font-size: 15px;
            color: #333;
        }

        .test-info-table thead {
            background-color: #f9f9f9;
            font-weight: bold;
            border-bottom: 1px solid #e0e0e0;
        }

        .test-info-table tbody tr {
            border-top: 1px solid #f0f0f0;
        }

        .test-info-table tbody tr:last-child {
            border-bottom: none;
        }


        .test-info-table tbody tr:hover {
            background-color: #f9fbff;
        }
        .result-table thead th {
            background-color: #f2f6ff;
            color: #333;
            font-weight: 600;
            text-align: center;
            padding: 14px 16px;
            border-bottom: 1px solid #e0e0e0;
        }

        /* Styles cho bảng khi đã có kết quả */
     .result-table {
        width: 100%;
        max-width: 800px; /* hoặc 700px, 600px tùy ý */
        margin: 0 auto 30px; /* căn giữa bảng */
        border-spacing: 0;
        border: 1px solid #c9d9f0;
        border-radius: 20px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        font-size: 15px;
        padding: 8px 6px;
    }


    .result-table tr {
        border-bottom: 1px solid #f2f2f2;
    }

    .result-table tr:last-child {
        border-bottom: none;
    }

    .result-table td {
        padding: 14px 16px;
        text-align: center;
        color: #333;
    }


    .result-table td:last-child {
        background-color: #fff;
        font-weight: 500;
    }

        
        .result-table:hover {
            box-shadow: 0 6px 24px rgba(44, 62, 80, 0.13);
        }
        
        .navigation-links, .start-quiz-container {
            text-align: center;
            margin-top: 30px;
        }
        
        a.nav-link, a.start-quiz {
            padding: 12px 30px;
            margin-right: 10px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        a.nav-link {
            background: linear-gradient(135deg, #21a6ff, #1890ff);
            color: white;
        }
        
        a.start-quiz {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }
        
        a.start-quiz:hover:not(.disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.4);
            background: linear-gradient(135deg, #0056b3, #004085);
            color: white;
            text-decoration: none;
        }
        
        a.start-quiz.disabled {
            background-color: #bdc3c7;
            pointer-events: none;
            cursor: not-allowed;
            color: #fff;
            opacity: 0.7;
        }
        
        .detail-answer-block {
            background: #f9fbe7;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 14px;
            border-left: 5px solid #81c784;
            box-shadow: 0 1px 4px rgba(44, 62, 80, 0.04);
            text-align: left;
        }
        
        .detail-answer-block strong {
            color: #388e3c;
        }
        
        .detail-answer-block span[style*="font-weight:bold"] {
            background: #e3f2fd;
            border-radius: 4px;
            padding: 2px 6px;
        }
        
        .no-result {
            color: #e74c3c;
            font-weight: 600;
            margin-top: 20px;
            text-align: center;
        }

        .quiz-card {
            background: #fff;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin: 16px;
            display: none;
        }


        .course-title {
            font-size: 1.1em;
            font-weight: bold;
            margin: 0;
        }

        .course-desc {
            color: #666;
            font-size: 0.9em;
            margin: 4px 0 12px;
        }

        .test-title {
            font-weight: bold;
            font-size: 1em;
            margin: 8px 0;
        }

        .test-info p {
            font-size: 0.9em;
            margin: 4px 0;
        }

        
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
            
            .back-btn span {
                display: none;
            }
            
            .main-title {
                font-size: 24px;
            }
            
            .test-info-table thead th,
            .test-info-table tbody td {
                padding: 12px 8px;
                font-size: 14px;
            }
            
            .result-table {
                font-size: 15px;
                max-width: 100%;
            }
            
            a.nav-link, a.start-quiz {
                font-size: 14px;
                padding: 10px 20px;
            }
            .mobile-visible {
                display: table; /* hoặc block nếu không phải table */
                width: 100%;
                display:none;
            }

            .quiz-card {
                background: #fff;
                border-radius: 16px;
                padding: 16px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                font-family: sans-serif;
                margin: 16px;
                display: block;
                
            }

            .course-title {
                font-size: 1.1em;
                font-weight: bold;
                margin: 0;
            }

            .course-desc {
                color: #666;
                font-size: 0.9em;
                margin: 4px 0 12px;
            }

            .test-title {
                font-weight: bold;
                font-size: 1em;
                margin: 8px 0;
            }

            .test-info p {
                font-size: 0.9em;
                margin: 4px 0;
            }

        }
        
        /* .question-block {
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(44, 62, 80, 0.04);
            padding: 10px 12px 6px 12px;
            margin-bottom: 10px;
            border-left: 3px solid #007bff;
            transition: box-shadow 0.2s;
        }
         */
        .question-text {
            margin-bottom: 4px;
            font-size: 18px;
        }
        
        .question-image {
            max-width: 100%;
            height: auto;
            margin: 8px 0;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: block;
        }
        
        ul {
            margin: 0 0 2px 0;
            padding: 0;
            list-style: none;
        }
        
        ul li {
            margin-bottom: 2px;
            padding: 4px 7px;
            border-radius: 3px;
            font-size: 18px;
            line-height: 1.3;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        ul li.correct {
            color: #28a745;
            font-weight: 700;
            font-size: 18px;
        }
        
        ul li.incorrect {
            color: #c0392b;
            font-weight: 600;
        }
        
        /* Icon styles */
        .answer-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            margin-left: 8px;
            flex-shrink: 0;
        }
        
        .answer-icon.correct {
            background-color: #28a745;
            color: white;
        }
        
        .answer-icon.incorrect {
            background-color: #dc3545;
            color: white;
        }
        
        .explanation-block {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #f8fcff; /* Nền xanh rất nhạt */
            border: 1px solid #1976d2; /* Viền xanh dương */
            border-radius: 30px;
            font-size: 17px;
            display: flex;
            align-items: center;
            color: #333;
            line-height: 1.6;
        }

        img {
            max-width: 300px;
            border-radius: 6px;
            margin: 10px 0;
            /* border: 1px solid #eee; */
            display: block;
        }
        
        hr {
            margin: 6px 0 0 0;
            border: none;
            border-top: 1px solid #f0f0f0;
        }
              .logo img {
            height: 61px; /* trước là 36px, giờ to hơn */
            display: block;
            margin: 0 auto;
        }


        /* Căn logo chính giữa trên điện thoại */
        @media (max-width: 768px) {
            .logo {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }

            .back-btn {
                font-size: 14px;
                color: #333;
                text-decoration: none;
            }

            .menu-btn {
                background: none;
                border: none;
                font-size: 20px;
                color: #333;
            }

            .mobile-title {
                display: block;
                text-align: center;
                padding: 10px 0 0;
            }

            .mobile-title h2 {
                font-size: 18px;
                font-weight: bold;
                color: #000;
                margin: 5px 0;
            }

            .mobile-title p {
                font-size: 14px;
                color: #4a6fa1;
                margin: 0;
            }
        }

    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="<?php echo htmlspecialchars($link_quay_lai); ?>" class="back-btn" onclick="goBack()">
                <img src="../../iconQL.png" alt="Quay lại" style="width:16px; height:16px; vertical-align:middle; margin-right:5px;">
                <span>Quay lại</span>
            </a>
            <div class="logo">
                <img src="../../ROSA_AI_Ready.png" alt="Logo">
            </div>
            <!-- <button2 class="menu-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button2> -->
        </div>
    </header>
    
    <div class="container">
        <div class="title-section">
            <h1 class="main-title"><?php echo $recent_result ? 'KẾT QUẢ GẦN ĐÂY' : 'BÀI KIỂM TRA CUỐI KHÓA'; ?></h1>
            <p class="subtitle">Bạn cần vượt qua bài kiểm tra để hoàn tất khóa học</p>
        </div>


        <div class="quiz-card">
            <p><?php echo htmlspecialchars($id_khoa); ?></p>
            <p class="course-desc">Dành cho người mới nắm vững nền tảng với biến, vòng lặp, hàm và cấu trúc dữ liệu</p>

            <hr>
            <h4><?php echo htmlspecialchars($ten_test); ?></h4>
            <hr>
            <div class="test-info">
                <p>Số câu: <?php echo count($_SESSION['questions_' . $id_test] ?? []); ?></p>
                <p>Số lần làm: <?php echo $max_attempts; ?></p>
                <p>Yêu cầu đạt: <?php echo htmlspecialchars($required_pass_percent); ?>%</p>
            </div>
        </div>

        <?php if ($recent_result): ?>
            <table class="result-table mobile-visible">
                <tr>
                    <th>Tên khóa học</th>
                    <th>Bài test</th>
                    <th>Điểm cao nhất</th>
                    <th>Số lần làm</th>
                    <th>Trạng thái</th>
                </tr>

                <td><?php echo htmlspecialchars($id_khoa); ?></td>
                <td><?php echo htmlspecialchars($ten_test); ?></td>
                <td><?php echo $recent_result['kq_cao_nhat']; ?> / <?php echo count($_SESSION['questions_' . $id_test] ?? []); ?></td>
                <td><?php echo $recent_result['so_lan_thu']; ?> / <?php echo $max_attempts; ?></td>
                <td><?php echo $recent_result['kq_cao_nhat'] >= 4 ? 'Đạt' : 'Không đạt'; ?></td>
            </table>
            <div class="navigation-links">
                <a href="chuong1_quiz.php?id_test=<?php echo htmlspecialchars($id_test); ?>&start=1" class="start-quiz<?php echo ($recent_result && $recent_result['so_lan_thu'] >= $max_attempts) ? ' disabled' : ''; ?>">Bắt đầu làm bài</a>
            </div>
            <?php if (!empty($recent_result['test_gan_nhat'])): ?>
                <h3>Chi tiết lần làm bài gần nhất:</h3>
                <div style="text-align:left;">
                <?php
                // Parse đáp án
                $test_gan_nhat = $recent_result['test_gan_nhat'];
                $answers = [];
                $question_ids = [];
                if ($test_gan_nhat) {
                    $pairs = explode(';', $test_gan_nhat);
                    foreach ($pairs as $pair) {
                        if (strpos($pair, ':') !== false) {
                            list($qid, $ans) = explode(':', $pair);
                            $answers[$qid] = $ans;
                            $question_ids[] = $qid;
                        }
                    }
                }

                // Lấy nội dung câu hỏi từ DB theo đúng thứ tự $question_ids
                if (!empty($question_ids)) {
                    $placeholders = implode(',', array_fill(0, count($question_ids), '?'));
                    $types = str_repeat('s', count($question_ids));
                    $stmt = $conn->prepare("SELECT * FROM quiz WHERE Id_cauhoi IN ($placeholders)");
                    $stmt->bind_param($types, ...$question_ids);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $questions_map = [];
                    while ($row = $result->fetch_assoc()) {
                        $questions_map[$row['Id_cauhoi']] = [
                            'id' => $row['Id_cauhoi'],
                            'question' => $row['cauhoi'],
                            'choices' => [
                                'A' => $row['cau_a'],
                                'B' => $row['cau_b'],
                                'C' => $row['cau_c'],
                                'D' => $row['cau_d']
                            ],
                            'images' => [
                                'A' => $row['hinhanh_a'],
                                'B' => $row['hinhanh_b'],
                                'C' => $row['hinhanh_c'],
                                'D' => $row['hinhanh_d']
                            ],
                            'explanations' => [
                                'A' => $row['giaithich_a'],
                                'B' => $row['giaithich_b'],
                                'C' => $row['giaithich_c'],
                                'D' => $row['giaithich_d']
                            ],
                            'correct' => $row['dap_an'],
                            'image' => $row['hinhanh']
                        ];
                    }
                    $stmt->close();

                    $index = 0;
                    foreach ($question_ids as $qid) {
                        if (!isset($questions_map[$qid])) continue;
                        $q = $questions_map[$qid];
                        $user_ans = $answers[$qid] ?? null;
                        $is_correct = $user_ans === $q['correct'];
                        echo "<div class='question-block'>";
                        echo "<p class='question-text' style='font-weight: bold'>Câu " . ($index + 1) . ": " . htmlspecialchars($q['question']) . "</p>";
                        
                        // Hiển thị hình ảnh câu hỏi nếu có
                        if (!empty($q['image'])) {
                            echo "<img src='/rosa_courses/login/admin/" . htmlspecialchars($q['image']) . "' alt='Hình ảnh câu hỏi' class='question-image' onerror='this.style.display=\"none\"'>";
                        }

                        echo "<ul>";
                        foreach ($q['choices'] as $key => $val) {
                            $li_class = '';
                            $icon_html = '';
                            
                            // Xác định class và icon cho từng đáp án
                            if ($user_ans !== null && $key === $user_ans) {
                                if ($is_correct) {
                                    $li_class = 'correct';
                                    $icon_html = '<span class="answer-icon correct">✓</span>';
                                } else {
                                    $li_class = 'incorrect';
                                    $icon_html = '<span class="answer-icon incorrect">✗</span>';
                                }
                            } else if ($key === $q['correct']) {
                              
                            }
                            
                            echo "<li class='$li_class'>";
                            echo "<span>$key. " . htmlspecialchars($val) . "</span>";
                            echo $icon_html;
                            
                            // Hiển thị hình ảnh đáp án nếu có
                            if (!empty($q['images'][$key])) {
                                echo "<br><img src='../../login/admin/" . htmlspecialchars($q['images'][$key]) . "' alt='Hình ảnh đáp án $key' class='answer-image' onerror='this.style.display=\"none\"'>";
                            }
                            echo "</li>";
                        }
                        echo "</ul>";

                        // Giải thích nếu chọn sai
                        $explanation = '';
                        if ($user_ans !== null && $user_ans !== '' && isset($q['explanations'][$user_ans])) {
                            $explanation = $q['explanations'][$user_ans];
                        }
                        if (!empty(trim((string)$explanation))) {
                            echo "<div class='explanation-block'>";
                            echo "<img src='../../GT.png' alt='Icon giải thích' style='width: 20px; height: 20px; margin-top: 2px; margin-right: 10px;'>";
                            echo "<div>";
                            echo "<p><strong style='color: #1976d2; font-weight: 600;'>Giải thích: </strong>" . htmlspecialchars($explanation) . "</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "<hr>";
                        echo "</div>";
                        $index++;
                    }
                }
                
                ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <table class="test-info-table">
                <thead>
                    <tr>
                        <th>Tên khóa học</th>
                        <th>Bài test</th>
                        <th>Số câu</th>
                        <th>Số lần làm</th>
                        <th>Yêu cầu đạt</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($id_khoa); ?></td>
                        <td><?php echo htmlspecialchars($ten_test); ?></td>
                        <td><?php echo count($_SESSION['questions_' . $id_test] ?? []); ?></td>
                        <td><?php echo $max_attempts; ?></td>
                        <td><?php echo htmlspecialchars($required_pass_percent); ?>%</td>
                    </tr>
                </tbody>
            </table>
            <div class="start-quiz-container">
                <a href="chuong1_quiz.php?id_test=<?php echo htmlspecialchars($id_test); ?>&start=1" class="start-quiz">Bắt đầu làm bài</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ob_end_flush(); ?>