<?php
require 'db.php';

function DemSoBaiDat($conn, $student_id, $khoa_id) {
    $sobaidat = 0;
    $chiTietBaiTest = []; 

    // Debug: Kiểm tra connection và parameters
    if (!$conn || $conn->connect_error) {
        return ['tong_so_bai_dat' => 0, 'chi_tiet_bai_test' => []];
    }

    // 1. Lấy tất cả bài test thuộc khóa với debug
    $test_query = $conn->prepare("SELECT id_test, ten_test, so_cau_hien_thi, Pass FROM test WHERE id_khoa = ? ORDER BY ten_test");
    if (!$test_query) {
        error_log("Prepare failed: " . $conn->error);
        return ['tong_so_bai_dat' => 0, 'chi_tiet_bai_test' => []];
    }
    
    $test_query->bind_param("i", $khoa_id);
    $test_query->execute();
    $result = $test_query->get_result();
    
    if (!$result) {
        error_log("Execute failed: " . $conn->error);
        $test_query->close();
        return ['tong_so_bai_dat' => 0, 'chi_tiet_bai_test' => []];
    }
    
    $tests = $result->fetch_all(MYSQLI_ASSOC);
    $test_query->close();

    // Debug: Log số lượng test tìm được
    error_log("Found " . count($tests) . " tests for khoa_id: $khoa_id");

    foreach ($tests as $test) {
        $test_id = $test['id_test'];
        $ten_test = $test['ten_test'];
        $so_cau = $test['so_cau_hien_thi'];
        $pass = $test['Pass'];
        $trang_thai = 0; 

        // Lấy số chương từ tên test - match với format "Bài kiểm tra chương X"
        $so_chuong = 0;
        
        // Pattern chính: "Bài kiểm tra chương 1", "Bài kiểm tra chương 2"
        if (preg_match('/bài\s*kiểm\s*tra\s*chương\s*(\d+)/i', $ten_test, $matches)) {
            $so_chuong = (int)$matches[1];
        }
        // Pattern phụ: "CHƯƠNG 1", "Chương 1" 
        elseif (preg_match('/chương\s*(\d+)/i', $ten_test, $matches)) {
            $so_chuong = (int)$matches[1];
        }
        // Pattern cho các test đặc biệt như "PHP"
        elseif (preg_match('/(\d+)/', $ten_test, $matches)) {
            $so_chuong = (int)$matches[1];
        }
        // Nếu không có số, tạo số chương dựa trên thứ tự
        else {
            static $chapter_counters = [];
            if (!isset($chapter_counters[$khoa_id])) {
                $chapter_counters[$khoa_id] = 1;
            }
            $so_chuong = $chapter_counters[$khoa_id]++;
        }

        // 2. Lấy điểm cao nhất của sinh viên ở test_id này
        $kq_query = $conn->prepare("SELECT kq_cao_nhat FROM ket_qua WHERE student_id = ? AND test_id = ?");
        if ($kq_query) {
            $kq_query->bind_param("si", $student_id, $test_id);
            $kq_query->execute();
            $kq_result = $kq_query->get_result();
            $kq = $kq_result ? $kq_result->fetch_assoc() : null;
            $kq_query->close();
        } else {
            $kq = null;
        }

        $diem = 0;
        $percent = 0;
        $da_lam = false;

        if ($kq) {
            $diem = $kq['kq_cao_nhat'];
            $da_lam = true;

            if ($so_cau > 0) {
                $percent = round(($diem / $so_cau) * 100);
                if ($percent >= $pass) {
                    $sobaidat++;
                    $trang_thai = 1; 
                }
            }
        }
        
        $chiTietBaiTest[$so_chuong] = [
            'ten_test' => $ten_test,
            'trang_thai' => $trang_thai,
            'so_chuong' => $so_chuong,
            'percent' => $percent,
            'da_lam' => $da_lam,
            'diem' => $diem,
            'tong_cau' => $so_cau,
            'diem_pass' => $pass
        ];
    }
    
    // Sắp xếp mảng chi tiết theo số chương tăng dần
    ksort($chiTietBaiTest);
    
    return [
        'tong_so_bai_dat' => $sobaidat,
        'chi_tiet_bai_test' => $chiTietBaiTest
    ];
}

function TongSoBaiTest($conn, $khoa_id) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS tong FROM test WHERE id_khoa = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['tong'] ?? 0;
}

// Function mới để lấy chi tiết tất cả chương của một khóa
function LayTatCaChuongTheoKhoa($conn, $student_id, $khoa_id) {
    $ketQua = DemSoBaiDat($conn, $student_id, $khoa_id);
    return $ketQua['chi_tiet_bai_test'];
}

// Function để hiển thị thông tin test (có thể dùng để debug)
function HienThiThongTinTest($conn, $student_id, $khoa_id) {
    $ketQua = DemSoBaiDat($conn, $student_id, $khoa_id);
    $tong = TongSoBaiTest($conn, $khoa_id);
    
    echo "Sinh viên đạt {$ketQua['tong_so_bai_dat']} / $tong bài test<br><br>";
    
    foreach ($ketQua['chi_tiet_bai_test'] as $bai_test) {
        $status = $bai_test['trang_thai'] ? 'ĐẠT' : 'CHƯA ĐẠT';
        $da_lam_status = $bai_test['da_lam'] ? "Đã làm ({$bai_test['percent']}%)" : "Chưa làm";
        echo "Chương {$bai_test['so_chuong']}: {$bai_test['ten_test']} - $status - $da_lam_status<br>";
    }
}

// Ví dụ sử dụng (có thể comment lại khi không cần)
/*
$ketQua = DemSoBaiDat($conn, 1, 19);
$tong = TongSoBaiTest($conn, 19);

echo "Sinh viên đạt {$ketQua['tong_so_bai_dat']} / $tong bài test<br><br>";

foreach ($ketQua['chi_tiet_bai_test'] as $bai_test) {
    $status = $bai_test['trang_thai'] ? 'ĐẠT' : 'CHƯA ĐẠT';
    $da_lam_status = $bai_test['da_lam'] ? "({$bai_test['percent']}%)" : "Chưa làm";
    echo "Chương {$bai_test['so_chuong']}: {$bai_test['ten_test']} - $status $da_lam_status<br>";
}
*/
?>