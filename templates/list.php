<?php
require 'db.php';

function DemSoBaiDat($db, $student_id, $khoa_id) {
    $sobaidat = 0;
    $chiTietBaiTest = []; 

    // 1. Lấy tất cả bài test thuộc khóa
    $test_query = $db->prepare("SELECT id_test, ten_test, so_cau_hien_thi, Pass FROM test WHERE id_khoa = ?");
    $test_query->execute([$khoa_id]);
    $tests = $test_query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tests as $test) {
        $test_id = $test['id_test'];
        $ten_test = $test['ten_test'];
        $so_cau = $test['so_cau_hien_thi'];
        $pass = $test['Pass'];
        $trang_thai = 0; 

        preg_match('/CHƯƠNG (\d+)/i', $ten_test, $matches);
        $so_chuong = isset($matches[1]) ? (int)$matches[1] : 0;

        // 2. Lấy điểm cao nhất của sinh viên ở test_id này
        $kq_query = $db->prepare("SELECT kq_cao_nhat FROM ket_qua WHERE student_id = ? AND test_id = ?");
        $kq_query->execute([$student_id, $test_id]);
        $kq = $kq_query->fetch(PDO::FETCH_ASSOC);

        if ($kq) {
            $diem = $kq['kq_cao_nhat'];

            if ($so_cau > 0) {
                $percent = ($diem / $so_cau) * 100;
                if ($percent >= $pass) {
                    $sobaidat++;
                    $trang_thai = 1; 
                }
            }
        }
        
        $chiTietBaiTest[$so_chuong] = [
            'ten_test' => $ten_test,
            'trang_thai' => $trang_thai,
            'so_chuong' => $so_chuong
        ];
    }
    
    // Sắp xếp mảng chi tiết theo số chương tăng dần
    ksort($chiTietBaiTest);
    
    return [
        'tong_so_bai_dat' => $sobaidat,
        'chi_tiet_bai_test' => $chiTietBaiTest
    ];
}

function TongSoBaiTest($db, $khoa_id) {
    $stmt = $db->prepare("SELECT COUNT(*) AS tong FROM test WHERE id_khoa = ?");
    $stmt->execute([$khoa_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['tong'] ?? 0;
}

$ketQua = DemSoBaiDat($db, 1, 19);
$tong = TongSoBaiTest($db, 19);

echo "Sinh viên đạt {$ketQua['tong_so_bai_dat']} / $tong bài test<br><br>";

foreach ($ketQua['chi_tiet_bai_test'] as $bai_test) {
    $status = $bai_test['trang_thai'] ? 'ĐẠT' : 'CHƯA ĐẠT';
    echo "{$bai_test['ten_test']}: $status<br>";
}
?>