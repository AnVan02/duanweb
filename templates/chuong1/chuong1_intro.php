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
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy id_test từ URL
$id_test = '71';
$ma_khoa = '10';
$student_id = $_SESSION['student_id'];
$link_quay_lai = "../chapter1.php";
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

// Lấy số lượng câu hỏi cần hiển thị từ bảng `test`
$stmt = $conn->prepare("SELECT so_cau_hien_thi FROM test WHERE id_test = ? AND id_khoa = ?");
$stmt->bind_param("ss", $id_test, $ma_khoa);
$stmt->execute();
$stmt->bind_result($so_cau_hien_thi);
$stmt->fetch();
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
    <title>Kết quả bài kiểm tra cuối khoá  - <?php echo htmlspecialchars($id_khoa); ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #FFFFFF;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: #333;
        }
          .header {
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #FFFFFF;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            outline: 1px #AFAAAA solid;
            outline-offset: -0.50px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 2rem;
            font-weight: bold;
            color: #e53e3e;
            letter-spacing: 2px;
        }

        .logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Arial', sans-serif;
            font-weight: 900;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            /* background-color: #ffffff; */
            padding: 30px;
            border-radius: 15px;
            /* box-shadow: 0 8px 16px rgba(0,0,0,0.1); */
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px);}
            to { opacity: 1; transform: translateY(0);}
        }
        h1 {
            text-align: center; 
            color: black; 
            font-size: 40px; 
            font-weight: 600; 
            word-wrap: break-word
        }
        h3 {
            text-align: center; 
            color: #203D6F; 
            font-size: 20px; 
            font-weight: 300; 
            word-wrap: break-word
        }
        .result-table, .test-info-table {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto 28px auto;
            background: #f8fafc;
            border-radius: 20px;
            border: 3px #EAEAEA solid;
            font-size: 17px;
            text-align:center;
            background: white;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            transition: box-shadow 0.3s;
        }
        .result-table tr, .test-info-table tr {
            border-bottom: 1px solid #e0e6ed;
        }
        .result-table tr:last-child, .test-info-table tr:last-child {
            border-bottom: none;
        }
        .result-table td, .test-info-table td {
            padding: 14px 18px;
            /* text-align: left; */
        }
        .result-table td:first-child, .test-info-table td:first-child {
            /* color: #1565c0; */
            font-weight: 600;
            word-wrap: break-word;
            width: 20%;
            /* background: #f1f7fe; */
            /* border-right: 1px solid #e0e6ed; */
        }
        .result-table td:last-child, .test-info-table td:last-child {
            color: #222;
            font-weight: 500;
            background: #fff;
        }
        .result-table:hover, .test-info-table:hover {
            box-shadow: 0 6px 24px rgba(44, 62, 80, 0.13);
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
        .navigation-links {
            padding-left: 39px; 
            padding-right: 39px; 
            padding-top: 17px; 
            padding-bottom: 17px; 
            border-radius:45px; 
            justify-content: center; 
            align-items: center; 
            gap: 10px; 
            display: inline-flex
            display: flex; 
            flex-direction: column; 
            color: white;
            font-size: 26px; 
            font-weight: 400; 
            text-transform: uppercase; 
            word-wrap: break-word

        }
        a.nav-link, a.start-quiz {
            padding: 7px 10px;
            margin-right: 10px;
            text-decoration: none;
            text-align: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
            display: inline-block;
        }
        a.nav-link {
            background-color: #21a6ffff;
            color: white;
        }
        a.start-quiz {
            background-color: #3961A6;
            color: white;
            text-align:center;
        }
        a.start-quiz.disabled {
            background-color: #bdc3c7;
            pointer-events: none;
            cursor: not-allowed;
            color: #fff;
            opacity: 0.7;
            text-align:center;
        }
        .no-result {
            color: #e74c3c;
            font-weight: 600;
            margin-top: 20px;
            text-align: center;
        }
        @media (max-width: 700px) {
            .container {
                padding: 12px 2vw;
            }
            .result-table, .test-info-table {
                font-size: 15px;
                max-width: 100%;
            }
            a.nav-link, a.start-quiz {
                font-size: 16px;
                padding: 10px 16px;
            }
        }
        .question-block {
            /* background: #fff; */
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(44, 62, 80, 0.04);
            padding: 10px 12px 6px 12px;
            margin-bottom: 10px;
            /* border-left: 3px solid #007bff; */
            transition: box-shadow 0.2s;
        }
        .question-text {
            margin-bottom:20px;
            font-size:18px;
            font-weight:bold;
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
        }
        ul li.correct {
            /* background-color: #e6f4ea; */
            color: #00AD26;
            font-weight: 700;
            position: relative;
            padding-left: 25px;
            font-size: 18px;
            
        }
        ul li.correct::before {
            content: "✓";
            position: absolute;
            left: 7px;
            color: #28a745;
            font-weight: bold;
            font-size: 16px;
        }
        ul li.incorrect {
            /* background-color: #fdeaea; */
            color: #AD0000;
            font-weight: 600;
            position: relative;
            padding-left: 25px;
        }
        ul li.incorrect::before {
            content: "✗";
            position: absolute;
            left: 7px;
            color: #dc3545;
            font-weight: bold;
            font-size: 16px;
        }
        .explanation-block {
            margin-top: 2px;
            padding: 6px 10px;
            /* border-left: 3px solid; */
            background-color: #F8FDFF;
            border-radius: 3px;
            font-size: 17px;
            border-radius: 30px;
        }
        img {
            max-width: 100%;        /* Chiều rộng tối đa là 100% khung chứa */
            max-height: 500px;      /* Giới hạn chiều cao tối đa nếu cần */
            height: auto;           /* Giữ tỷ lệ gốc của ảnh */
            width: auto;            /* Không kéo giãn ảnh nhỏ */
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: block;
            margin: 0 auto;         /* Căn giữa ảnh */
        }
        hr {
            margin: 6px 0 0 0;
            border: none;
            border-top: 1px solid #f0f0f0;
        }
    </style>
    <script>
        window.addEventListener("pageshow", function (event) {
            if (event.persisted || window.performance.getEntriesByType("navigation")[0].type === "back_forward") {
                window.location.href = "../exercise1.php?reset=true";               
            }
        });
    </script>
    
</head>
<body>
    <div class="container">
    <header class="header">
        <div class="header-content">
            <a href="javascript:void(0)" class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
             <div class="logo">
                <img src="../../ROSA_AI_Ready.png" alt="Logo">
            </div>
            <button class="menu-btn" onclick="toggleSidebar()">
                <span>Mục lục</span>
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
       <h1>BÀI KIỂM TRA CUỐI KHOÁ</h1>
        <h3 >Bạn cần vượt qua bài kiểm tra để hoàn tất khóa học</h3>
        <?php if ($recent_result): ?>
           <table class="result-table" border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>Khóa học</th>
                    <th>Bài test</th>
                    <th>Điểm cao nhất</th>
                    <th>Số lần làm bài</th>
                    <th>Trạng thái</th>
                </tr>
                
                <tr>
                    <td><?php echo htmlspecialchars($id_khoa); ?></td>
                    <td><?php echo htmlspecialchars($ten_test); ?></td>
                    <td><?php echo $recent_result['kq_cao_nhat']; ?> / <?php echo count($_SESSION['questions_' . $id_test] ?? []); ?></td>
                    <td><?php echo $recent_result['so_lan_thu']; ?> / <?php echo $max_attempts; ?></td>
                    <td><?php echo $recent_result['kq_cao_nhat'] >= 4 ? 'Đạt' : 'Không đạt'; ?></td>
                </tr>
            </table>
            
            <div class="navigation-links">
                <a href="chuong1_quiz.php?id_test=<?php echo htmlspecialchars($id_test); ?>&start=1" class="start-quiz<?php echo ($recent_result && $recent_result['so_lan_thu'] >= $max_attempts) ? ' disabled' : ''; ?>">Làm lại</a>
            </div>
                <?php if (!empty($recent_result['test_gan_nhat'])): ?>
                <h4>Chi tiết lần làm bài gần nhất:</h4>
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
                        echo "<p class='question-text'>Câu " . ($index + 1). ": ". htmlspecialchars($q['question']). "</p>";
                        // Hiển thị hình ảnh câu hỏi nếu có
                        if (!empty($q['image'])) {
                            echo "<img src='/rosa_courses/login/admin/" . htmlspecialchars($q['image']) . "' alt='Hình ảnh câu hỏi' class='question-image' onerror='this.style.display=\"none\"'>";
                        }

                        echo "<ul>";
                        foreach ($q['choices'] as $key => $val) {
                            $li_class = '';
                            if ($user_ans !== null && $key === $user_ans) {
                                $li_class = $is_correct ? 'correct' : 'incorrect';
                            }
                            echo "<li class='$li_class'>";
                            echo "$key. " . htmlspecialchars($val);
                            // Hiển thị hình ảnh đáp án nếu có
                            echo "</li>";
                        }
                        echo "</ul>";

                        // Giải thích nếu chọn sai
                        $explanation = '';
                        if ($user_ans !== null && $user_ans !== '' && isset($q['explanations'][$user_ans])) {
                            $explanation = $q['explanations'][$user_ans];
                        }
                        if (!empty(trim((string)$explanation))) {
                            echo "<div class='explanation-block'" . ";'>";
                            echo "<div style='text-align: left;'>
                                    <div style='display: flex; align-items: center;'>
                                        <img src='../../GT.png' alt='Ảnh minh họa' style='max-height:40px; margin-right:10px;'>
                                        <span><strong style='color:#205AB1;'>Giải thích:</strong> " . htmlspecialchars($explanation) . "</span>
                                    </div>
                                </div>";

                            if (!empty($q['images'][$key])) {
                                echo "<br><img src='/rosa_courses/login/admin/" . htmlspecialchars($q['images'][$key]) . "' alt='Hình ảnh đáp án $key' class='answer-image' onerror='this.style.display=\"none\"'>";
                            }
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
                <tr><td>Khóa học:</td><td><?php echo htmlspecialchars($id_khoa); ?></td></tr>
                <tr><td>Bài test: </td><td> <?php echo htmlspecialchars($ten_test); ?></td></tr>
                <tr><td>Số câu hỏi:</td><td><?php echo count($_SESSION['questions_' . $id_test] ?? []); ?></td></tr>
                <tr><td>Số lần làm tối đa:</td><td><?php echo $max_attempts; ?></td></tr>
                <tr><td>Yêu cầu đậu:</td><td><?php echo htmlspecialchars($required_pass_percent); ?>%</td></tr>
            </table>
            <div class="navigation-links">
                <a href="chuong1_quiz.php?id_test=<?php echo htmlspecialchars($id_test); ?>&start=1" class="start-quiz">Làm lại</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ob_end_flush(); ?>