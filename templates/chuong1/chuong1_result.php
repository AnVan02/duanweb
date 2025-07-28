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

// Kết nối cơ sở dữ liệu
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
$link_tiep_tuc = "../chapter2.php";
$link_lam_lai = "chuong1_intro.php";
$pass_score = 0;

// Khởi tạo biến kiểm tra hoàn thành bài test
if (!isset($_SESSION['test_completed'])) {
    $_SESSION['test_completed'] = false;
}

// Lấy thông tin khóa học và bài test, đồng thời lấy thông tin test (lan_thu, so_cau_hien_thi, Pass)
$stmt = $conn->prepare("SELECT k.khoa_hoc, t.ten_test, t.lan_thu, t.so_cau_hien_thi, t.Pass 
                       FROM khoa_hoc k 
                       JOIN test t ON k.id = t.id_khoa 
                       WHERE k.id = ? AND t.id_test = ?");
$stmt->bind_param("ss", $ma_khoa, $id_test);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ten_khoa = $row['khoa_hoc'];
    $ten_test = $row['ten_test'];
    $max_attempts = isset($row['lan_thu']) ? intval($row['lan_thu']) : 1;
    $so_cau_hien_thi = isset($row['so_cau_hien_thi']) ? intval($row['so_cau_hien_thi']) : 0;
    $pass_score = isset($row['Pass']) ? intval(($row['Pass'] / 100) * $so_cau_hien_thi) : 1000;
} else {
    $ten_khoa = '';
    $ten_test = '';
    $max_attempts = 1;
    $so_cau_hien_thi = 0;
    $pass_score = 1000;
    echo "<p class='no-answers'>Lỗi: Không tìm thấy khóa học hoặc bài test!</p>";
    $conn->close();
    exit();
}
$stmt->close();


// Lấy số lần thử tối đa
function getTestInfo($conn, $id_test, $ma_khoa) {
    $sql = "SELECT lan_thu FROM test WHERE id_test = ? AND id_khoa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id_test, $ma_khoa);
    $stmt->execute();
    $result = $stmt->get_result();
    $lan_thu = $result->num_rows > 0 ? $result->fetch_assoc()['lan_thu'] : 1;
    $stmt->close();
    return $lan_thu;
}
$max_attempts = getTestInfo($conn, $id_test, $ma_khoa);

// Lưu câu trả lời vào cơ sở dữ liệu
function saveAnswerToDatabase($conn, $student_id, $ma_khoa, $id_test, $answers, $score) {
    global $_SESSION;
    
    if (!$_SESSION['test_completed']) {
        $tt_bai_test = '';
        if (!empty($answers)) {
            $answer_pairs = [];
            foreach ($answers as $index => $answer) {
                if (isset($_SESSION['questions_' . $id_test][$index]['id'])) {
                    $question_id = $_SESSION['questions_' . $id_test][$index]['id'];
                    $answer_pairs[] = $question_id . ":" . $answer['selected'];
                }
            }
            $tt_bai_test = implode(";", $answer_pairs);
            if (strlen($tt_bai_test) > 1000) {
                $tt_bai_test = substr($tt_bai_test, 0, 997) . '...';
            }
        } else {
            $tt_bai_test = 'Không có câu trả lời';
        }

        $stmt = $conn->prepare("SELECT so_lan_thu, kq_cao_nhat, test_cao_nhat FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
        $stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $so_lan_thu = $row['so_lan_thu'] + 1;
            $highest_score = max($score, $row['kq_cao_nhat']);
            $test_cao_nhat = ($score >= $row['kq_cao_nhat']) ? $tt_bai_test : $row['test_cao_nhat'];
            $stmt = $conn->prepare("UPDATE ket_qua SET so_lan_thu = ?, kq_cao_nhat = ?, test_cao_nhat = ?, test_gan_nhat = ? WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
            $stmt->bind_param("iisssis", $so_lan_thu, $highest_score, $test_cao_nhat, $tt_bai_test, $student_id, $ma_khoa, $id_test);
            $stmt->execute();
        } else {
            $so_lan_thu = 1;
            $highest_score = $score;
            $test_cao_nhat = $tt_bai_test;
            $stmt = $conn->prepare("INSERT INTO ket_qua (student_id, khoa_id, test_id, so_lan_thu, kq_cao_nhat, test_cao_nhat, test_gan_nhat) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiiiss", $student_id, $ma_khoa, $id_test, $so_lan_thu, $highest_score, $test_cao_nhat, $tt_bai_test);
            $stmt->execute();
        }
        $stmt->close();
        
        $_SESSION['test_completed'] = true;
        return $highest_score;
    }
    
    $stmt = $conn->prepare("SELECT kq_cao_nhat FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
    $stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
    $stmt->execute();
    $result = $stmt->get_result();
    $highest_score = $result->num_rows > 0 ? $result->fetch_assoc()['kq_cao_nhat'] : 0;
    $stmt->close();
    return $highest_score;
}

// Lưu kết quả
$answers = $_SESSION['answers_' . $id_test] ?? [];
$score = $_SESSION['score_' . $id_test] ?? 0;
if (!empty($answers) && !$_SESSION['test_completed']) {
    $highest_score = saveAnswerToDatabase($conn, $student_id, $ma_khoa, $id_test, $answers, $score);
} else {
    $stmt = $conn->prepare("SELECT kq_cao_nhat FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
    $stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
    $stmt->execute();
    $result = $stmt->get_result();
    $highest_score = $result->num_rows > 0 ? $result->fetch_assoc()['kq_cao_nhat'] : 0;
    $stmt->close();
}

// Lấy số lần đã làm
$stmt = $conn->prepare("SELECT so_lan_thu FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
$stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
$stmt->execute();
$result = $stmt->get_result();
$attempts = ($result->num_rows > 0) ? (int)$result->fetch_assoc()['so_lan_thu'] : 0;
$stmt->close();

// Xử lý làm lại bài test
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reset'])) {
    if ($attempts < $max_attempts) {
        $_SESSION['score_' . $id_test] = 0;
        $_SESSION['answers_' . $id_test] = [];
        $_SESSION['current_index_' . $id_test] = 0;
        $_SESSION['score_saved_' . $id_test] = [];
        $_SESSION['test_completed'] = false;
        header("Location: $link_lam_lai?id_test=$id_test&start=1");
        exit();
    }
}


// Lấy danh sách câu hỏi từ session (đã random)
$questions = $_SESSION['questions_' . $id_test] ?? [];

// Tính toán phần trăm và số câu cần đúng để đạt 80%
$total_questions = count($questions);
$current_percentage = $total_questions > 0 ? round(($score / $total_questions) * 100, 1) : 0;
$highest_percentage = $total_questions > 0 ? round(($highest_score / $total_questions) * 100, 1) : 0;

// Tính số câu cần đúng để đạt 80%
$required_for_80_percent = $total_questions > 0 ? ceil($total_questions * 0.8) : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Kết quả Quiz - <?php echo htmlspecialchars($ten_khoa); ?></title>
     <style>
        /* CSS tổng thể cho trang */
        body {
            font-family: 'Montserrat'; /* Sử dụng font Montserrat */
            background: #F0F2F5; /* Nền màu xám nhạt */
            margin: 0;
            padding: 0;
            font-size: 17px;
            color: #333;
        }

        /* Header của trang */
        .header {
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Tạo bóng đổ nhẹ */
            position: sticky; /* Giữ header ở trên cùng khi cuộn */
            top: 0;
            z-index: 1000;
            background-color: #FFFFFF;
            display: flex;
            justify-content: center; /* Căn giữa nội dung header */
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1336px; /* Chiều rộng tối đa của nội dung */
            width: 100%;
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

        /* Container chính của trang */
        .container {
            max-width: 1100px;
            margin: 40px auto; /* Căn giữa và tạo khoảng cách trên dưới */
            /* background-color: #ffffff; */
            border-radius: 15px;
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); Bóng đổ cho container */
            /* padding: 30px; Khoảng đệm bên trong container */
        }

        /* Tiêu đề chính của trang kết quả */
        h1 {
            text-align: center;
            color: #2C3E50;
            font-size: 2.2em;
            margin-bottom: 10px;
            font-weight: 700;
        }

        /* Phụ đề bên dưới tiêu đề chính */
        h3.quiz-subtitle { /* Đổi từ p sang h3 và thêm class để phân biệt */
            text-align: center;
            color: #6C757D;
            font-size: 1.1em;
            margin-bottom: 40px;
            font-weight: 500;
        }

        /* Bảng thông tin kết quả */
        .score-info {
            width: 100%;
            border-collapse: collapse; /* Gộp các đường viền */
            margin: 0 auto 30px auto;
            border-radius: 15px; /* Bo góc cho bảng */
            overflow: hidden; /* Đảm bảo bo góc hoạt động */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); /* Bóng đổ nhẹ cho bảng */
        }

        .score-info th, .score-info td {
            padding: 15px 20px;
            text-align: center;
            border: 1px solid #e0e0e0; /* Viền nhẹ cho các ô */
        }

        .score-info th {
            background-color: #F8F9FA; /* Nền cho hàng tiêu đề */
            color: #495057;
            font-weight: 600;
            font-size: 1.05em;
        }

        .score-info td {
            background-color: #ffffff; /* Nền cho các ô dữ liệu */
            font-size: 1em;
        }

        .score-info tr:last-child td {
            border-bottom: none; /* Bỏ viền dưới cho hàng cuối */
        }

        /* Kiểu dáng cho trạng thái Đạt/Không đạt */
        .status-pass {
            color: #28a745; /* Màu xanh lá cho "Đạt" */
            font-weight: 700;
        }
        .status-fail {
            color: #dc3545; /* Màu đỏ cho "Không đạt" */
            font-weight: 700;
        }

        .reset-button-container {
            text-align: center;
            margin: 30px 0;
        }

        .reset-button {
            padding: 12px 30px;
            background-color: #5a7bc4;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
        }

        .reset-button:hover:not(:disabled) {
            background-color: #4a6bb0;
        }

        .reset-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
            opacity: 0.7;
        }

        /* Dòng kẻ ngang phân cách */
        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 30px 0;
        }

        /* Khối câu hỏi chi tiết */
        .question-block {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #f0f0f0; /* Đường kẻ phân cách từng câu hỏi */
        }

        .question-block:last-child {
            border-bottom: none; /* Bỏ đường kẻ cho câu hỏi cuối cùng */
        }

        .question-text {
            font-size: 1.1em;
            font-weight: 600;
            color: #2C3E50;
            margin-bottom: 15px;
        }

        .question-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 15px auto;
            display: block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
            /* padding: 12px 18px; */
            border-radius: 8px;
            /* background-color: #f7f7f7;
            border: 1px solid #e9e9e9; */
            display: flex; /* Để căn icon và chữ */
            align-items: flex-start;
            gap: 10px;
            transition: background-color 0.2s;
        }

        /* Kiểu dáng cho đáp án đúng */
        li.correct {
            /* background-color: #e6ffed; Nền xanh nhạt */
            border-color: #28a745; /* Viền xanh */
            color: #28a745; /* Chữ xanh */
            font-weight: 600;
        }

        /* Kiểu dáng cho đáp án sai do người dùng chọn */
        li.incorrect {
            /* background-color: #ffe6e6; Nền đỏ nhạt */
            border-color: #dc3545; /* Viền đỏ */
            color: #dc3545; /* Chữ đỏ */
            font-weight: 600;
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


        
        /* Kiểu dáng chung cho biểu tượng check/cross */
        .icon-status {
            font-size: 1.1em;
            line-height: 1.5; /* Căn chỉnh với text */
        }

        /* Khối giải thích - loại bỏ CSS cũ vì dùng inline style */

        /* Thông báo khi không có câu trả lời */
        .no-answers {
            text-align: center;
            padding: 50px;
            font-size: 1.2em;
            color: #e74c3c;
            border: 1px solid #f2dede;
            background-color: #fdf7f7;
            border-radius: 10px;
            margin-top: 50px;
        }
        .no-answers a.nav-link {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .no-answers a.nav-link:hover {
            background-color: #0056b3;
        }

        /* Navigation actions */
        .navigation-actions {
            text-align: center;
            margin-top: 30px;
            padding: 20px 0;
        }

        .navigation-actions .nav-link {
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .navigation-actions .nav-link:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {

        .container {
            max-width: 1100px;
            margin: 40px auto; /* Căn giữa và tạo khoảng cách trên dưới */
            /* background-color: #ffffff; */
            border-radius: 15px;
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); Bóng đổ cho container */
            /* padding: 30px; Khoảng đệm bên trong container */
        }
        .back-btn span {
            display: none;
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
        .mobile-visible {
            display: table; /* hoặc block nếu không phải table */
            width: 100%;
            display:none;
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
            <button2 class="menu-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button2>
        </div>
    </header>
    <div class="container">
        <h1>KẾT QUẢ BÀI KIỂM TRA CUỐI KHOÁ</h1>
        <h3 class="quiz-subtitle">Bạn phải vượt qua bài kiểm tra để hoàn tất bài học</h3>

        <div class="quiz-card">
            <p><?php echo htmlspecialchars($ten_khoa); ?></p>
            <p class="course-desc">Dành cho người mới nắm vững nền tảng với biến, vòng lặp, hàm và cấu trúc dữ liệu</p>

            <hr>
            <h4><?php echo htmlspecialchars($ten_test); ?></h4>
            <hr>
            <div class="test-info">
                <p>Số lần làm: <?php echo $max_attempts; ?></p>
                <p>Yêu cầu đạt: <?php echo $highest_score >= $pass_score ? 'Đạt' : 'Không đạt'; ?></p>
            </div>
        </div>

        <table  class="score-info mobile-visible" border="1"  cellpadding="5" cellspacing="0">
            <tr>
                <th>Tên khoá học</th>
                <th>Bài test</th>
                <th>Điểm cao nhất</th>
                <th>Số lần làm</th>
                <th>Kết quả</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($ten_khoa); ?></td>
                <td><?php echo htmlspecialchars($ten_test); ?></td>
                <td><?php echo $score; ?>/<?php echo $total_questions; ?></td>
                <td><?php echo $attempts; ?></td>
                <td class="<?php echo $highest_score >= $pass_score ? 'status-pass' : 'status-fail'; ?>">
                   <?php echo $highest_score >= $pass_score ? 'Đạt' : 'Không đạt'; ?>
                </td>
            </tr>
        </table>
        <div class="reset-button-container">
            <form method="POST" action="">
                <button type="submit" name="reset" value="1" class="reset-button" <?php echo $attempts >= $max_attempts ? 'disabled' : ''; ?>>
                    LÀM LẠI
                </button>
            </form>
        </div>
        <?php if (empty($answers) || empty($questions)): ?>
            <p class="no-answers">Bạn chưa trả lời câu hỏi nào! <a class="nav-link" href="chuong1_quiz.php?id_test=<?php echo htmlspecialchars($id_test); ?>&start=1">Quay lại làm bài</a></p>
        <?php else: ?>
            <?php foreach ($questions as $index => $question): ?>
                <div class="question-block">
                    <p class="question-text" style="font-weight: bold;">Câu <?php echo $index + 1; ?>/<?php echo $total_questions; ?>: <?php echo htmlspecialchars($question['question']); ?></p>
                    <?php if (!empty($question['image'])): ?>
                        <img src="<?php echo '/rosa_courses/login/admin/' . htmlspecialchars($question['image']); ?>" alt="Hình ảnh câu hỏi" class="question-image">
                    <?php endif; ?>
                    <ul>
                        <?php foreach ($question['choices'] as $key => $value): ?>
                            <?php
                            $is_selected = isset($answers[$index]) && $key === $answers[$index]['selected'];
                            $is_correct_answer = $key === $question['correct'];
                            $selected_is_correct = isset($answers[$index]) && $answers[$index]['selected'] === $question['correct'];

                            $li_class = '';
                            $icon = '';

                            // Nếu người dùng chọn đúng, tô xanh đáp án đúng
                            if ($selected_is_correct && $is_correct_answer) {
                                $li_class = 'correct';
                                $icon = '<img src="../../dung.png" alt="icon" style="width:16px; height:16px;">';

                            }
                            // Nếu người dùng chọn sai, chỉ tô đỏ đáp án họ chọn
                            if (!$selected_is_correct && $is_selected) {
                                $li_class = 'incorrect';
                                $icon = '<img src="../../sai.png" alt="icon" style="width:16px; height:16px;">';
                            }
                            ?>
                            <li class="<?php echo $li_class; ?>">
                                <span><?php echo $key; ?>. <?php echo htmlspecialchars($value); ?></span>
                                <span class="icon-status"><?php echo $icon; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                    // Xác định lại biến $is_correct cho giải thích
                    $is_correct = isset($answers[$index]) && ($answers[$index]['selected'] === $question['correct']);
                            
                    // Giải thích nếu chọn sai hoặc có giải thích
                    if (isset($answers[$index]['selected']) && !empty(trim($question['explanations'][$answers[$index]['selected']] ?? ''))) {
                        $explanation = $question['explanations'][$answers[$index]['selected']] ?? '';
                        echo "<div style='margin-top: 15px; padding: 12px; background-color: #e8f4fd; border: 1px solid #b3d9ff; border-radius: 30px; display: flex; align-items: flex-start; gap: 8px;'>";
                        echo "<img src='../../GT.png' alt='Icon giải thích' style='width: 20px; height: 20px; margin-top: 2px;'>";
                        echo "<div>";
                        echo "<span style='color: #1976d2; font-weight: 600;'>Giải thích:</span> ";
                        echo "<span style='color: #333;'>" . htmlspecialchars($explanation) . "</span>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <div class="navigation-actions">
            <a href="<?php echo htmlspecialchars($link_tiep_tuc); ?>" class="nav-link">→ Tiếp tục</a>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
<?php ob_end_flush(); ?>