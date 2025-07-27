<script>
    const link_quay_lai = "../exercise1.php";
</script>

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
$id_test = '1';
$ma_khoa = '1';
$student_id = $_SESSION['student_id'];
// $link_quay_lai = "khoahoc.php";

// Chỉ reset khi có ?start=1 trên URL
if (isset($_GET['start']) && $_GET['start'] == 1) {
    $_SESSION['current_index_' . $id_test] = 0;
    $_SESSION['answers_' . $id_test] = [];
    $_SESSION['score_' . $id_test] = 0;
    $_SESSION['score_saved_' . $id_test] = [];
    $_SESSION['test_completed'] = false;
    unset($_SESSION['questions_' . $id_test]);
    // Thêm chuyển hướng để loại bỏ start=1 khỏi URL
    header("Location: chuong1_quiz.php?id_test=$id_test");
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "student");
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra quyền truy cập khóa học
$stmt = $conn->prepare("SELECT Khoahoc FROM students WHERE Student_ID = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $khoahoc = $row['Khoahoc'];
    $khoahoc_list = array_map('intval', explode(',', $khoahoc));
    if (!in_array(intval($ma_khoa), $khoahoc_list)) {
        echo "<script>alert('Bạn không có quyền truy cập khóa học này!'); window.location.href = 'login.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Không tìm thấy thông tin sinh viên!'); window.location.href = 'login.php';</script>";
    exit();
}
$stmt->close();

// Kiểm tra ID bài test và lấy thông tin test (lan_thu, so_cau_hien_thi, Pass)
$stmt = $conn->prepare("SELECT ten_test, lan_thu, so_cau_hien_thi, Pass FROM test WHERE id_test = ?");
$stmt->bind_param("i", $id_test);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    echo "<script>alert('ID bài test ($id_test) không tồn tại trong hệ thống. Vui lòng kiểm tra lại!');</script>";
    exit();
}
$row = $result->fetch_assoc();
$id_baitest = $row['ten_test'];
$max_attempts = isset($row['lan_thu']) ? intval($row['lan_thu']) : 1;
$so_cau_hien_thi = isset($row['so_cau_hien_thi']) ? intval($row['so_cau_hien_thi']) : 0;
$pass_score = isset($row['Pass']) ? $row['Pass'] : '';
$stmt->close();

// Lấy tên khóa học và câu hỏi
$stmt = $conn->prepare("SELECT khoa_hoc FROM khoa_hoc WHERE id = ?");
$stmt->bind_param("s", $ma_khoa);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $ten_khoa = $row['khoa_hoc'];
    $stmt2 = $conn->prepare("SELECT * FROM quiz WHERE id_khoa = ? AND id_baitest = ?");
    $stmt2->bind_param("ss", $ma_khoa, $id_test);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $questions = [];
    while ($row2 = $result2->fetch_assoc()) {
        $questions[] = [
            'id' => $row2['Id_cauhoi'],
            'question' => $row2['cauhoi'],
            'choices' => [
                'A' => $row2['cau_a'],
                'B' => $row2['cau_b'],
                'C' => $row2['cau_c'],
                'D' => $row2['cau_d']
            ],
            'images' => [
                'A' => $row2['hinhanh_a'],
                'B' => $row2['hinhanh_b'],
                'C' => $row2['hinhanh_c'],
                'D' => $row2['hinhanh_d']
            ],
            'explanations' => [
                'A' => $row2['giaithich_a'],
                'B' => $row2['giaithich_b'],
                'C' => $row2['giaithich_c'],
                'D' => $row2['giaithich_d']
            ],
            'correct' => $row2['dap_an'],
            'image' => $row2['hinhanh']
        ];
    }
    // Nếu so_cau_hien_thi > 0 và nhỏ hơn tổng số câu hỏi, chọn ngẫu nhiên không trùng lặp số lượng câu hỏi cần hiển thị
    if ($so_cau_hien_thi > 0 && $so_cau_hien_thi < count($questions)) {
        if (!isset($_SESSION['questions_' . $id_test])) {
            $rand_keys = array_rand($questions, $so_cau_hien_thi);
            if (!is_array($rand_keys)) $rand_keys = [$rand_keys];
            $selected_questions = [];
            foreach ($rand_keys as $k) {
                $selected_questions[] = $questions[$k];
            }
            $_SESSION['questions_' . $id_test] = $selected_questions;
        }
        $questions = $_SESSION['questions_' . $id_test];
    } else {
        if (!isset($_SESSION['questions_' . $id_test])) {
            $_SESSION['questions_' . $id_test] = $questions;
        }
        $questions = $_SESSION['questions_' . $id_test];
    }
    if (count($_SESSION['questions_' . $id_test]) < 1) {
        die("Lỗi: Không đủ câu hỏi cho khóa học '$ten_khoa' và bài test '$id_test'.");
    }
    $_SESSION['ten_khoa'] = $ten_khoa;
    $_SESSION['id_baitest'] = $id_test;
} else {
    die("Lỗi: Không tìm thấy khóa học với mã '$ma_khoa'");
}
$stmt->close();
$stmt2->close();

// Khởi tạo biến
$current_index = isset($_SESSION['current_index_' . $id_test]) ? intval($_SESSION['current_index_' . $id_test]) : 0;
$answers = isset($_SESSION['answers_' . $id_test]) ? $_SESSION['answers_' . $id_test] : [];
$score = isset($_SESSION['score_' . $id_test]) ? $_SESSION['score_' . $id_test] : 0;

// Kiểm tra số lần thử
$stmt = $conn->prepare("SELECT so_lan_thu FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
$stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
$stmt->execute();
$result = $stmt->get_result();
$attempts = $result->num_rows > 0 ? $result->fetch_assoc()['so_lan_thu'] : 0;
$stmt->close();

// Xử lý gửi câu trả lời
if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST['next']) || isset($_POST['submit']) || isset($_POST['previous']))) {
    if (isset($_POST['answer']) && isset($_SESSION['questions_' . $id_test][$current_index])) {
        $user_answer = $_POST['answer'];
        $current_question = $_SESSION['questions_' . $id_test][$current_index];
        $is_correct = ($user_answer === $current_question['correct']);
        $answers[$current_index] = [
            'selected' => $user_answer,
            'is_correct' => $is_correct
        ];
        $_SESSION['answers_' . $id_test] = $answers;
        if ($is_correct && !isset($_SESSION['score_saved_' . $id_test][$current_index])) {
            $score++;
            $_SESSION['score_' . $id_test] = $score;
            $_SESSION['score_saved_' . $id_test][$current_index] = true;
        }
    }

    if (isset($_POST['next']) && $current_index < count($_SESSION['questions_' . $id_test]) - 1) {
        $current_index++;
        $_SESSION['current_index_' . $id_test] = $current_index;
    } elseif (isset($_POST['previous']) && $current_index > 0) {
        $current_index--;
        $_SESSION['current_index_' . $id_test] = $current_index;
    } elseif (isset($_POST['submit'])) {
        $conn->close();
        header("Location: chuong1_result.php?id_test=$id_test");
        exit();
    }
    header("Location: chuong1_quiz.php?id_test=$id_test");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>ROSA - Quiz</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .mobile-container {
            width: 100%;
            max-width: 414px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        /* Header */
        .header {
            background: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f0f0f0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: #666;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .back-btn::before {
            content: "←";
            margin-right: 5px;
            font-size: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e53e3e;
            letter-spacing: 1px;
        }

        .menu-btn {
            background: none;
            border: none;
            font-size: 14px;
            color: #666;
            cursor: pointer;
            padding: 5px;
        }

        /* Main Content */
        .main-content {
            padding: 30px 20px;
            background: #f5f5f5;
            min-height: calc(100vh - 70px);
        }

        .page-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .page-subtitle {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        /* Question Container */
        .question-container {
            background: white;
            border-radius: 12px;
            padding: 25px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .question-header {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        /* Code Block Styling */
        .code-block {
            background: #2d3748;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 14px;
            color: #e2e8f0;
            overflow-x: auto;
        }

        .code-block .line-number {
            color: #4a5568;
            margin-right: 10px;
            user-select: none;
        }

        .code-block .keyword {
            color: #63b3ed;
        }

        .code-block .string {
            color: #68d391;
        }

        /* Answer Options */
        .answer-options {
            list-style: none;
            margin-top: 20px;
        }

        .answer-option {
            margin-bottom: 12px;
        }

        .answer-option label {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            line-height: 1.4;
        }

        .answer-option input[type="radio"] {
            margin-right: 12px;
            width: 18px;
            height: 18px;
            accent-color: #3182ce;
        }

        .answer-option label:hover {
            border-color: #cbd5e0;
            background: #f7fafc;
        }

        .answer-option input[type="radio"]:checked + .answer-text {
            color: #2d3748;
            font-weight: 500;
        }

        .answer-option input[type="radio"]:checked ~ label,
        .answer-option label:has(input[type="radio"]:checked) {
            border-color: #3182ce;
            background: #ebf8ff;
        }

        /* Navigation Buttons */
        .navigation-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: white;
            position: sticky;
            bottom: 0;
            border-top: 1px solid #e2e8f0;
        }

        .nav-button {
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 100px;
        }

        .nav-button.previous {
            background: #718096;
            color: white;
        }

        .nav-button.previous:hover:not(:disabled) {
            background: #4a5568;
        }

        .nav-button.next {
            background: #3182ce;
            color: white;
        }

        .nav-button.next:hover:not(:disabled) {
            background: #2c5282;
        }

        .nav-button.submit {
            background: #38a169;
            color: white;
        }

        .nav-button.submit:hover:not(:disabled) {
            background: #2f855a;
        }

        .nav-button:disabled {
            background: #cbd5e0;
            color: #a0aec0;
            cursor: not-allowed;
        }

        /* Question Image */
        .question-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 15px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            body {
                padding: 20px;
            }
            
            .mobile-container {
                max-width: 500px;
                border-radius: 12px;
                overflow: hidden;
            }
            
            .main-content {
                padding: 40px;
            }
            
            .page-title {
                font-size: 24px;
            }
            
            .page-subtitle {
                font-size: 16px;
            }
        }

        /* Loading Animation */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .loading::after {
            content: "";
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3182ce;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* No more attempts message */
        .no-attempts {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: 12px;
            margin: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .no-attempts h3 {
            color: #e53e3e;
            margin-bottom: 15px;
        }

        .no-attempts a {
            display: inline-block;
            padding: 12px 24px;
            background: #3182ce;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .no-attempts a:hover {
            background: #2c5282;
        }

        /* Progress indicator */
        .progress-indicator {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #3182ce;
            border-radius: 2px;
            transition: width 0.3s ease;
        }
    </style>

    <script>
        let pageLoaded = false;
        let navigationHandled = false;
        
        window.addEventListener('load', function() {
            pageLoaded = true;
            
            // Xử lý reload trang
            if (performance.navigation.type === 1) {
                if (confirm("Bạn có chắc muốn tải lại? Việc này sẽ xóa toàn bộ bài làm.")) {
                    window.location.href = `${link_quay_lai}?reset=true`;
                }
            }
        });
        
        // Xử lý back/forward
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                if (!navigationHandled) {
                    navigationHandled = true;
                    if (confirm("Bạn vừa quay lại trang. Bạn có muốn bắt đầu lại không?")) {
                        window.location.href = "../exercise1.php?reset=true";
                    }
                }
            }
        });
        
        // Xử lý popstate (back button)
        window.addEventListener('popstate', function(event) {
            if (pageLoaded && !navigationHandled) {
                navigationHandled = true;
                if (confirm("Bạn vừa quay lại trang. Bạn có muốn bắt đầu lại không?")) {
                    window.location.href = "../exercise1.php?reset=true";
                } else {
                    window.history.pushState(null, null, window.location.href);
                }
            }
        });
        
        // Đẩy một state mới vào history khi trang load
        window.addEventListener('load', function() {
            window.history.pushState(null, null, window.location.href);
        });

        function goBack() {
            if (confirm("Bạn có muốn quay lại? Bài làm hiện tại sẽ được lưu.")) {
                window.location.href = link_quay_lai;
            }
        }

        // Auto-select and highlight functionality
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Remove active class from all labels
                    document.querySelectorAll('.answer-option label').forEach(label => {
                        label.classList.remove('selected');
                    });
                    
                    // Add active class to selected label
                    if (this.checked) {
                        this.closest('label').classList.add('selected');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="mobile-container">
        <header class="header">
            <a href="javascript:void(0)" class="back-btn" onclick="goBack()">
                <span>Quay lại</span>
            </a>
            <div class="logo">ROSA</div>
            <button class="menu-btn">☰</button>
        </header>

        <div class="main-content">
            <?php if ($attempts >= $max_attempts): ?>
                <div class="no-attempts">
                    <h3>Hết lượt làm bài</h3>
                    <p>Bạn đã sử dụng hết số lần làm bài cho phép!</p>
                    <a href="chuong1_result.php?id_test=<?php echo htmlspecialchars($id_test); ?>">Xem kết quả</a>
                </div>
            <?php elseif ($current_index < count($_SESSION['questions_' . $id_test])): ?>
                <h1 class="page-title">BÀI KIỂM TRA CUỐI KHÓA</h1>
                <p class="page-subtitle">Bạn cần vượt qua bài kiểm tra để hoàn tất khóa học</p>

                <!-- Progress Indicator -->
                <div class="progress-indicator">
                    Câu <?php echo $current_index + 1; ?>/<?php echo count($_SESSION['questions_' . $id_test]); ?>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo (($current_index + 1) / count($_SESSION['questions_' . $id_test])) * 100; ?>%"></div>
                </div>

                <?php $question = $_SESSION['questions_' . $id_test][$current_index]; ?>
                <form method="POST" action="">
                    <div class="question-container">
                        <div class="question-header">
                            Câu <?php echo $current_index + 1; ?>/<?php echo count($_SESSION['questions_' . $id_test]); ?>: <?php echo htmlspecialchars($question['question']); ?>
                        </div>

                        <?php if (!empty($question['image'])): ?>
                            <?php 
                            // Check if image contains code-like content
                            $image_path = '/rosa_courses/login/admin/' . htmlspecialchars($question['image']);
                            $is_code_image = strpos($question['question'], 'import') !== false || 
                                           strpos($question['question'], 'Python') !== false ||
                                           strpos($question['question'], 'lệnh') !== false;
                            ?>
                            
                            <?php if ($is_code_image): ?>
                                <!-- Code block simulation for programming questions -->
                                <div class="code-block">
                                    <div><span class="line-number">1</span><span class="keyword">i</span> <span class="keyword">=</span> <span class="string">1</span></div>
                                    <div><span class="line-number">2</span><span class="keyword">while</span> <span class="keyword">i</span> <span class="keyword">&lt;</span> <span class="string">5</span><span class="keyword">:</span></div>
                                    <div><span class="line-number">3</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="keyword">print</span><span class="keyword">(</span><span class="keyword">i</span><span class="keyword">)</span></div>
                                    <div><span class="line-number">4</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="keyword">i</span> <span class="keyword">+=</span> <span class="string">1</span></div>
                                </div>
                            <?php else: ?>
                                <img src="<?php echo $image_path; ?>" alt="Hình ảnh câu hỏi" class="question-image" onerror="this.style.display='none'">
                            <?php endif; ?>
                        <?php endif; ?>

                        <ul class="answer-options">
                            <?php foreach ($question['choices'] as $key => $value): ?>
                                <li class="answer-option">
                                    <label>
                                        <input type="radio" name="answer" value="<?php echo $key; ?>" 
                                            <?php echo isset($answers[$current_index]) && $answers[$current_index]['selected'] === $key ? 'checked' : ''; ?> 
                                            required>
                                        <span class="answer-text"><?php echo htmlspecialchars($value); ?></span>
                                    </label>
                                    <?php if (!empty($question['images'][$key])): ?>
                                        <img src="<?php echo '/rosa_courses/login/admin/' . htmlspecialchars($question['images'][$key]); ?>" 
                                             alt="Hình ảnh đáp án <?php echo $key; ?>" class="question-image" 
                                             onerror="this.style.display='none'">
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="navigation-container">
                        <button type="submit" name="previous" class="nav-button previous" 
                                <?php echo $current_index == 0 ? 'disabled' : ''; ?>>
                            CÂU TRƯỚC
                        </button>
                        
                        <?php if ($current_index == count($_SESSION['questions_' . $id_test]) - 1): ?>
                            <button type="submit" name="submit" class="nav-button submit">NỘP BÀI</button>
                        <?php else: ?>
                            <button type="submit" name="next" class="nav-button next">CÂU SAU</button>
                        <?php endif; ?>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>