<?php
function SoBaiTestDat($conn, $student_id, $khoa_id) {
    $soBaiDat = 0;

    // Lấy tất cả các bài test thuộc khóa học
    $stmt = $conn->prepare("SELECT id, so_cau_hien_thi, Pass FROM test WHERE id_khoa = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $test_id = $row['id'];
        $so_cau_hien_thi = $row['so_cau_hien_thi'];
        $pass_score = $row['Pass'];

        // Lấy điểm cao nhất của sinh viên cho từng bài test
        $score_stmt = $conn->prepare("SELECT kq_cao_nhat FROM ket_qua WHERE student_id = ? AND khoa_id = ? AND test_id = ?");
        $score_stmt->bind_param("iii", $student_id, $khoa_id, $test_id);
        $score_stmt->execute();
        $score_result = $score_stmt->get_result();

        if ($score_result->num_rows > 0) {
            $score_row = $score_result->fetch_assoc();
            $kq_cao_nhat = $score_row['kq_cao_nhat'];

            if ($so_cau_hien_thi > 0) {
                $total_points = ($kq_cao_nhat / $so_cau_hien_thi) * 100;
                if ($total_points >= $pass_score) {
                    $soBaiDat += 1;
                }
            }
        }

        $score_stmt->close();
    }

    $stmt->close();

    return $soBaiDat;
}

?>