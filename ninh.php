<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "student");
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$student_id = 1;
$khoa_id = 10; 

$query = "SELECT kq_cao_nhat FROM ket_qua WHERE student_id = ? AND khoa_id = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die("Lỗi prepare: " . $conn->error);
}

$stmt->bind_param("ii", $student_id, $khoa_id); 
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Kết quả cao nhất: " . $row['kq_cao_nhat'];
    $query = "SELECT so_cau_hien_thi, Pass FROM test WHERE id_khoa = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $test_result = $stmt->get_result();
    if ($test_result->num_rows > 0) {
        $test_row = $test_result->fetch_assoc();
        echo "Số câu hỏi trong bài test: " . $test_row['so_cau_hien_thi'];
        $total_points = ($row['kq_cao_nhat'] / $test_row['so_cau_hien_thi']) * 100;
        echo "Điểm số: " . $total_points;
        if ($total_points >= $test_row['Pass']) {
            echo " - Đạt yêu cầu";
        } else {
            echo " - Không đạt yêu cầu";
        }
    } else {
        echo "Không tìm thấy thông tin bài test.";
    }
} else {
    echo "Không tìm thấy kết quả cho học viên này.";
}

$stmt->close();
$conn->close();

?>
