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

$ma_khoa = '19';
$id_test = '7';
$student_id = $_SESSION['student_id'];


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
        $sql = "SELECT lan_thu FROM test WHERE id_test = ? AND id_khoa = (SELECT id FROM khoa_hoc WHERE khoa_hoc = ?)";
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

    // Lấy lịch sử các lần làm bài
    $stmt = $conn->prepare("SELECT so_lan_thu, kq_cao_nhat, test_cao_nhat, test_gan_nhat FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
    $stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
    $stmt->execute();
    $result = $stmt->get_result();
    $history = $result->fetch_assoc();
    $stmt->close();

    // Lấy kết quả gần nhất
    $stmt = $conn->prepare("SELECT kq_cao_nhat, test_gan_nhat, so_lan_thu FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
    $stmt->bind_param("sis", $student_id, $ma_khoa, $id_test);
    $stmt->execute();
    $result = $stmt->get_result();
    $recent_result = $result->num_rows > 0 ? $result->fetch_assoc() : null;
    $stmt->close();


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

    // Đóng kết nối database
    $conn->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link rel="stylesheet" href="static/css/table.css">
    <link rel="stylesheet" href="static/css/code_running.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>BÀI TẬP CHƯƠNG 3</h3>
    </nav>
    <div class="container">
        <div class="chapter" id="chapter">
            <h3><a href="chapter1.php">Chương 1:Giới thiệu chung về Python</a></h3>
            <a href="chapter1_1.php">Tổng quan về ngôn ngữ lập trình python.</a>
            <a href="chapter1_2.php">Chương trình đầu tiên làm quen với python.</a>
            <a href="chapter1_3.php">Biến và các kiểu dữ liệu cơ bản trong python.</a>
            <a href="chapter1_4.php">Toán tử trong python.</a>
            <a href="exercise1.php">Bài tập chương 1</a>
            <h3><a href="chapter2.php">Chương 2: Cấu trúc điều kiên, vòng lập và hàm trong python</a></h3>
            <a href="chapter2_1.php">Cấu trúc điều kiện.</a>
            <a href="chapter2_2.php">Vòng lập trong python.</a>
            <a href="chapter2_3.php">try và except trong python.</a>
            <a href="chapter2_4.php">Hàm trong python.</a>
            <a href="exercise2.php">Bài tập chương 2</a>
            <h3><a href="chapter3.php">Chương 3: Cấu trúc dữ liệu trong python</a></h3>
            <a href="chapter3_1.php">List trong python.</a>
            <a href="chapter3_2.php">Tuples trong python.</a>
            <a href="chapter3_3.php">Dictionary trong python.</a>
            <a href="chapter3_4.php">Set trong python.</a>
            <a href="exercise3.php">Bài tập chương 3</a>
            <h3><a href="chapter4.php">Chương 4: Module và package</a></h3>
            <a href="chapter4_1.php">Module.</a>
            <a href="chapter4_2.php">package.</a>
            <a href="exercise4.php">Bài tập chương 4</a>
            <h3><a href="chapter5.php">Chương 5: PANDAS</a></h3>
            <a href="chapter5_1.php">Series.</a>
            <a href="chapter5_2.php">Dataframe.</a>
            <a href="exercise5.php">Bài tập chương 5</a>
            <h3><a href="chapter6.php">Chương 6: MATPLOTLIB</a></h3>
            <a href="chapter6_1.php">Pyplot cơ bản.</a>
            <a href="chapter6_2.php">Lưu biểu đồ.</a>
            <a href="exercise6.php">Bài tập chương 6</a>
        </div>

        <div class="content">
            <div class="main">
                <h3>Phần bài tập</h3>
                <p>1. Viết một hàm nhập vào hai số nguyên và trả về tổng của chúng.</p>
                <p>2. Viết một hàm nhận một số là số nguyên và in ra số đó là chẵn hay số lẻ.</p>
                <p>3. Viết một hàm nhận một số nguyên dương và trả về giai thừa của nó.</p>
                <p>4. Viết chương trình tìm nghiệm của phương trình bậc 2. Tính và in kết quả ra màn hình.</p>
                <p>5. Viết chương trình python nhập vào 4 số và tìm ra số lơn nhấp trong 4 số đó.</p>
                <!-- code -->

                <div class="navigation-links" >
                    <a href="chuong3/chuong3_intro.php" class="start-quiz  <?php echo ($recent_result && $recent_result['so_lan_thu'] >= $max_attempts) ? ' disabled' : ''; ?>">Bắt đầu làm bài ➜</a>
                </div>
                <!-- code -->
                <div class="display">
                    <a href="chapter2_4.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Hàm trong python.</div>
                        </div>
                    </a>

                    <a href="chapter3.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Giới thiệu chương 3.</div>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        
    </div>
    <script src="static/javascript/main.js"></script>
    <script src="static/javascript/code.js"></script>
    <script src="static/javascript/code_running.js"></script>
</body>

</html>