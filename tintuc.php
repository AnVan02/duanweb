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
$link_quay_lai = "index.php";
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
    <title>Bài Kiểm Tra Cuối Khóa - ROSA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #FFFFFF;
            min-height: 100vh;
            color: #333;
        }
        
        .header {
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .back-btn {
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }
        
        .back-btn:hover {
            color: #333;
        }
        
        .back-btn::before {
            content: "←";
            margin-right: 8px;
            font-size: 18px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #e74c3c;
            letter-spacing: 2px;
        }
        
        .spacer {
            width: 80px;
        }
        
        .container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }
        
        .title-section {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .main-title {
            font-size: 32px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        
        .subtitle {
            font-size: 16px;
            color: #7f8c8d;
            font-weight: 400;
        }
        
        .quiz-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .quiz-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .quiz-table thead {
            background: #f8f9fa;
        }
        
        .quiz-table th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            font-size: 16px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .quiz-table td {
            padding: 25px 20px;
            border-bottom: 1px solid #f1f3f4;
            font-size: 16px;
            color: #495057;
        }
        
        .quiz-table tbody tr:hover {
            background: #f8f9fa;
            transition: background 0.3s;
        }
        
        .quiz-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .course-name {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .test-name {
            color: #34495e;
        }
        
        .questions-count, .attempts-count {
            font-weight: 500;
            color: #27ae60;
        }
        
        .pass-rate {
            font-weight: 600;
            color: #e74c3c;
        }
        
        .start-btn-container {
            text-align: center;
            margin-top: 40px;
        }
        
        .start-btn {
            background: #3961A6;
            color: white;
            padding: 15px 35px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .start-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .start-btn:active {
            transform: translateY(0);
        }
        
        .start-btn.disabled {
            background: #bdc3c7;
            pointer-events: none;
            cursor: not-allowed;
            opacity: 0.7;
            box-shadow: none;
        }
        
        /* Styles cho phần kết quả */
        /* .result-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
         */
        .result-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        
        .result-table td {
            padding: 15px;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .result-table td:first-child {
            font-weight: 600;
            color: #495057;
            width: 30%;
        }
        
        .result-table td:last-child {
            color: #2c3e50;
        }
        
        .detail-section {
            margin-top: 30px;
        }
        
        .detail-title {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        
        /* .question-block {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #007bff;
        } */
        
        .question-text {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .question-image {
            max-width: 100%;
            height: auto;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .choices-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .choices-list li {
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            background: white;
            border: 1px solid #e9ecef;
        }
        
        .choices-list li.correct {
            background: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            font-weight: 600;
        }
        
        .choices-list li.incorrect {
            background: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            font-weight: 600;
        }
        
        .explanation-block {
            margin-top: 15px;
            padding: 15px;
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
        }
        
        .explanation-block strong {
            color: #856404;
        }
        
        .explanation-block img {
            max-width: 250px;
            height: auto;
            margin: 10px 0;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: block;
        }
        
        .correct-answer-block {
            margin-top: 15px;
            padding: 15px;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }
        
        .correct-answer-block p {
            margin: 0;
            color: #155724;
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            body {
                background: #f5f7fa;
            }
            
            .container {
                padding: 0 20px;
                margin: 20px auto;
                max-width: 100%;
            }
            
            .main-title {
                font-size: 24px;
                margin-bottom: 10px;
            }
            
            .subtitle {
                font-size: 14px;
                margin-bottom: 30px;
            }
            
            .header {
                padding: 15px 20px;
                background: white;
            }
            
            .logo {
                font-size: 24px;
            }
            
            /* Mobile: Hide table and show card layout */
            .quiz-card {
                display: none;
            }
            
            .mobile-card {
                display: block;
                background: white;
                border-radius: 15px;
                padding: 25px 20px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                margin-bottom: 30px;
            }
            
            .course-info {
                margin-bottom: 20px;
            }
            
            .course-title {
                font-size: 18px;
                font-weight: 600;
                color: #2c3e50;
                margin-bottom: 8px;
            }
            
            .course-desc {
                font-size: 14px;
                color: #7f8c8d;
                line-height: 1.4;
                margin-bottom: 20px;
            }
            
            .test-title {
                font-size: 20px;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 20px;
            }
            
            .test-stats {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }
            
            .stat-item {
                text-align: center;
                flex: 1;
            }
            
            .stat-label {
                font-size: 12px;
                color: #7f8c8d;
                margin-bottom: 5px;
            }
            
            .stat-value {
                font-size: 16px;
                font-weight: 600;
                color: #2c3e50;
            }
            
            .start-btn {
                width: 100%;
                padding: 15px;
                font-size: 16px;
                margin-top: 20px;
            }
            
            .result-section {
                padding: 20px;
                margin-bottom: 20px;
            }
            
            .detail-title {
                font-size: 18px;
            }
            
            .question-block {
                padding: 15px;
                margin-bottom: 15px;
            }
            
            .question-text {
                font-size: 15px;
            }
            
            .choices-list li {
                padding: 8px 12px;
                font-size: 14px;
            }
        }
        
        /* Desktop: Hide mobile card */
        .mobile-card {
            display: none;
        }
    </style>
</head>
<body>
    <div class="header">
            <a href="<?php echo htmlspecialchars($link_quay_lai); ?>" class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>        
            <div class="logo">
            <img src="../../ROSA_AI_Ready.png" alt="Logo">
        </div>
        <div class="spacer"></div>
    </div>
    
    <div class="container">
        <div class="title-section">
            <h1 class="main-title">KÊT QUẢ KIỂM TRA GẦN ĐÂY</h1>
            <p class="subtitle">Bạn cần vượt qua bài kiểm tra để hoàn tất khóa học</p>
        </div>
        
        <div class="quiz-card">
            <table class="quiz-table">
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
                        <td class="course-name"><?php echo htmlspecialchars($id_khoa); ?></td>
                        <td class="test-name"><?php echo htmlspecialchars($ten_test); ?></td>
                        <td class="questions-count"><?php echo count($_SESSION['questions_' . $id_test] ?? []); ?></td>
                        <td class="attempts-count"><?php echo $max_attempts; ?></td>
                        <td class="pass-rate"><?php echo htmlspecialchars($required_pass_percent); ?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Mobile Card Layout -->
        <div class="mobile-card">
            <div class="course-info">
                <div class="course-title"><?php echo htmlspecialchars($id_khoa); ?></div>
                <div class="course-desc">Dành cho người mới năm viết thế giấy để làm ứng dụng và biến, ứng dụp, hàm và cấu trúc dữ liệu</div>
            </div>
            
            <div class="test-title"><?php echo htmlspecialchars($ten_test); ?></div>
            
            <div class="test-stats">
                <div class="stat-item">
                    <div class="stat-label">Số lần làm</div>
                    <div class="stat-value"><?php echo $max_attempts; ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Yêu cầu đạt</div>
                    <div class="stat-value"><?php echo htmlspecialchars($required_pass_percent); ?>%</div>
                </div>
            </div>
        </div>
        
        <?php if ($recent_result): ?>
        <div class="result-section">
            
            <?php if (!empty($recent_result['test_gan_nhat'])): ?>
            <h3 class="detail-title" style="margin-top: 30px;">Chi tiết lần làm bài gần nhất</h3>
            <div class="detail-section">
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
                    echo "<p class='question-text'>Câu " . ($index + 1) . ": " . htmlspecialchars($q['question']) . "</p>";

                    // Hiển thị hình ảnh câu hỏi nếu có
                    if (!empty($q['image'])) {
                        echo "<img src='/rosa_courses/login/admin/" . htmlspecialchars($q['image']) . "' alt='Hình ảnh câu hỏi' class='question-image' onerror='this.style.display=\"none\"'>";
                    }

                    echo "<ul class='choices-list'>";
                    foreach ($q['choices'] as $key => $val) {
                        $li_class = '';
                        if ($user_ans !== null && $key === $user_ans) {
                            $li_class = $is_correct ? 'correct' : 'incorrect';
                        }
                        // Hiển thị đáp án đúng nếu user chưa chọn hoặc chọn sai
                        if ($key === $q['correct'] && ($user_ans === null || $user_ans !== $q['correct'])) {
                            $li_class = 'correct';
                        }
                        echo "<li class='$li_class'>";
                        echo "$key. " . htmlspecialchars($val);
                        // Hiển thị hình ảnh đáp án nếu có
                        if (!empty($q['images'][$key])) {
                            echo "<br><img src='/rosa_courses/login/admin/" . htmlspecialchars($q['images'][$key]) . "' alt='Hình ảnh đáp án $key' class='answer-image' style='max-width: 200px; margin-top: 5px;' onerror='this.style.display=\"none\"'>";
                        }
                        echo "</li>";
                    }
                    echo "</ul>";


                    // Giải thích cho đáp án đúng (luôn hiển thị)
                    if (isset($q['explanations'][$q['correct']]) && !empty(trim((string)$q['explanations'][$q['correct']]))) {
                        $correct_explanation_style = ($user_ans === $q['correct']) ? 'background: #d4edda; border-color: #c3e6cb;' : 'background: #d1ecf1; border-color: #bee5eb;';
                        echo "<div class='explanation-block' style='$correct_explanation_style'>";
                        echo "<p><strong>Giải thích: </strong>" . htmlspecialchars($q['explanations'][$q['correct']]) . "</p>";
                        echo "</div>";
                    }

                    echo "</div>";
                    $index++;
                }
            } else {
                echo "<p style='text-align: center; color: #7f8c8d; font-style: italic;'>Không có dữ liệu chi tiết bài làm gần nhất</p>";
            }
            ?>
            </div>
            <?php else: ?>
            <p style='text-align: center; color: #7f8c8d; font-style: italic; margin-top: 20px;'>Chưa có dữ liệu chi tiết bài làm</p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <div class="start-btn-container">
            <a href="chuong1_quiz.php?id_test=<?php echo htmlspecialchars($id_test); ?>&start=1" class="start-btn<?php echo ($recent_result && $recent_result['so_lan_thu'] >= $max_attempts) ? ' disabled' : ''; ?>">Bắt đầu làm bài</a>
        </div>
        
        <?php if ($recent_result && !empty($recent_result['test_gan_nhat'])): ?>
        <!-- Code này đã được di chuyển vào phần trên -->
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ob_end_flush(); ?>