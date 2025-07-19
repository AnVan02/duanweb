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
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy id_test từ URL
$id_test = isset($_GET['id_test']) ? $_GET['id_test'] : '8';
$ma_khoa = '19';
$student_id = $_SESSION['student_id'];
$link_quay_lai = "khoahoc.php";
$link_tiep_tuc = "add_khoahoc.php";
$pass_score = 4;

// Khởi tạo biến kiểm tra hoàn thành bài test
if (!isset($_SESSION['test_completed'])) {
    $_SESSION['test_completed'] = false;
}

// Lấy thông tin khóa học và bài test
$stmt = $conn->prepare("SELECT k.khoa_hoc, t.ten_test 
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
} else {
    $ten_khoa = '';
    $ten_test = '';
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
        header("Location: chuong4_quiz.php?id_test=$id_test&start=1");
        exit();
    }
}

// Lấy danh sách câu hỏi từ session (đã random)
$questions = $_SESSION['questions_' . $id_test] ?? [];

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả Quiz - <?php echo htmlspecialchars($ten_khoa); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            margin: 0;
            padding: 20px;
            font-size: 17px;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .question-block {
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f1f1f1;
        }
        li.correct {
            background-color: #d4edda;
            color: #155724;
            font-weight: bold;
        }
        li.incorrect {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
        }
        img {
            max-width: 300px;
            border-radius: 6px;
            margin: 10px 0;
            border: 1px solid #eee;
            display: block;
        }
        .explanation-block {
            margin-top: 10px;
            padding: 15px;
            border-left: 6px solid;
            background-color: #fff3cd;
            border-radius: 6px;
            font-size: 17px;
        }
        .no-answers {
            color: #e74c3c;
            text-align: center;
            font-weight: bold;
        }
        .navigation-actions {
            display: flex;
            align-items: center;
        }
        button, a.nav-link {
            padding: 10px 13px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
            text-decoration: none;
        }
        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        button:hover:not(:disabled), a.nav-link:hover {
            background-color: #0056b3;
        }
        a.nav-link {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kết quả bài kiểm tra</h1>
        <p><strong>Khóa học:</strong> <?php echo htmlspecialchars($ten_khoa); ?></p>
        <p><strong>Bài test:</strong> <?php echo htmlspecialchars($ten_test); ?></p>
        <p><strong>Tổng điểm:</strong> <?php echo $score; ?> / <?php echo count($questions); ?></p>
        <p><strong>Điểm cao nhất:</strong> <?php echo $highest_score; ?> / <?php echo count($questions); ?></p>
        <p><strong>Số lần làm bài:</strong> <?php echo $attempts; ?> / <?php echo $max_attempts; ?></p>
        <p><strong>Trạng thái:</strong> <?php echo $score >= $pass_score ? 'Đạt' : 'Không đạt'; ?></p>
        <hr>
        <?php if (empty($answers) || empty($questions)): ?>
            <p class="no-answers">Bạn chưa trả lời câu hỏi nào! <a class="nav-link" href="chuong4_quiz.php?id_test=<?php echo htmlspecialchars($id_test); ?>&start=1">Quay lại làm bài</a></p>
        <?php else: ?>
            <?php foreach ($questions as $index => $question): ?>
                <div class="question-block">
                    <p class="question-text">Câu <?php echo $index + 1; ?>: <?php echo htmlspecialchars($question['question']); ?></p>
                    <?php if (!empty($question['image'])): ?>
                        <img src="<?php echo '/rosa_courses/login/admin/' . htmlspecialchars($question['image']); ?>" alt="Hình ảnh câu hỏi">
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
                                $icon = '✔️';
                            }
                            // Nếu người dùng chọn sai, chỉ tô đỏ đáp án họ chọn
                            if (!$selected_is_correct && $is_selected) {
                                $li_class = 'incorrect';
                                $icon = '❌';
                            }
                            ?>
                            <li class="<?php echo $li_class; ?>">
                                <?php echo $icon; ?> <?php echo $key; ?>. <?php echo htmlspecialchars($value); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                    // Xác định lại biến $is_correct cho giải thích
                    $is_correct = isset($answers[$index]) && ($answers[$index]['selected'] === $question['correct']);

                    // Giải thích nếu chọn sai
                    if (isset($answers[$index]['selected']) && !empty(trim($question['explanations'][$answers[$index]['selected']] ?? ''))) {
                        echo "<div class='explanation-block' style='border-color: " . ($is_correct ? "#28a745" : "#dc3545") . ";'>";
                        echo "<p><strong>Giải thích: </strong>" . htmlspecialchars($question['explanations'][$answers[$index]['selected']] ?? '') . "</p>";
                        echo "</div>";
                    }
                    ?>
                    <hr>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="navigation-actions">
            <form method="POST" action="">
                <button type="submit" name="reset" value="1" <?php echo $attempts >= $max_attempts ? 'disabled' : ''; ?>>
                    🔁 Làm lại (<?php echo $attempts; ?> / <?php echo $max_attempts; ?>)
                </button>
            </form>
            <a href="<?php echo htmlspecialchars($link_tiep_tuc); ?>" class="nav-link" style="margin-left: 72%;">→ Tiếp tục</a>
            <a href="<?php echo htmlspecialchars($link_quay_lai); ?>" class="nav-link">← Quay lại</a>
        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>