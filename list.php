<?php


function DemSoBaiDat($conn, $student_id, $khoa_id) {
    $sobaidat = 0;

    // 1. Lấy tất cả bài test thuộc khóa
    $test_query = $conn->prepare("SELECT id_test, so_cau_hien_thi, Pass FROM test WHERE id_khoa = ?");
    $test_query->bind_param("i", $khoa_id);
    $test_query->execute();
    $result = $test_query->get_result();

    while ($test = $result->fetch_assoc()) {
        $test_id = $test['id_test'];
        $so_cau = $test['so_cau_hien_thi'];
        $pass = $test['Pass'];

        // 2. Lấy điểm cao nhất của sinh viên ở bài test này
        $kq_query = $conn->prepare("SELECT kq_cao_nhat FROM ket_qua WHERE student_id = ? AND test_id = ?");
        $kq_query->bind_param("ii", $student_id, $test_id);
        $kq_query->execute();
        $kq_result = $kq_query->get_result();

        if ($kq_result->num_rows > 0) {
            $kq = $kq_result->fetch_assoc();
            $diem = $kq['kq_cao_nhat'];

            if ($so_cau > 0) {
                $percent = ($diem / $so_cau) * 100;
                if ($percent >= $pass) {
                    $sobaidat++;
                }
            }
        }
    }
    
    return $sobaidat;
}

function TongSoBaiTest($conn, $khoa_id) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS tong FROM test WHERE id_khoa = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['tong'] ?? 0;
}

// $conn = new mysqli("localhost", "root", "", "student");
// $conn->set_charset("utf8mb4");

// $sobaidat = DemSoBaiDat($conn, 1, 2);
// $tong = TongSoBaiTest($conn, 2);
// echo "Sinh viên 1 đạt $sobaidat / $tong bài test";

?>