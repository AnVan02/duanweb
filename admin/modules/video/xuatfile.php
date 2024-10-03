<?php
ob_start(); // Bắt đầu bộ đệm đầu ra

require_once 'vendor/autoload.php'; // Nếu sử dụng Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Kết nối database (thay thế thông tin kết nối của bạn)
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "123"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra nếu có yêu cầu xuất file
if (isset($_POST['btnExport'])) {
    // Truy vấn dữ liệu
    $sql = "SELECT SoSerial, MaHang, TenHang, NgayXuat, ThoiHanBH FROM sanpham";
    $result = $conn->query($sql);

    // Tạo đối tượng Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Đặt tên cho các cột
    $sheet->setCellValue('A1', 'SoSerial');
    $sheet->setCellValue('B1', 'MaHang');
    $sheet->setCellValue('C1', 'TenHang');
    $sheet->setCellValue('D1', 'NgayXuat');
    $sheet->setCellValue('E1', 'ThoiHanBH');

    // Điền dữ liệu vào các hàng
    $row = 2;
    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['SoSerial']);
            $sheet->setCellValue('B' . $row, $data['MaHang']);
            $sheet->setCellValue('C' . $row, $data['TenHang']);
            $sheet->setCellValue('D' . $row, $data['NgayXuat']);
            $sheet->setCellValue('E' . $row, $data['ThoiHanBH']);
            $row++;
        }
    } else {
        // Nếu không có dữ liệu, hiển thị thông báo
        echo "Không có dữ liệu để xuất!";
        exit;
    }

    // Thiết lập headers cho file tải xuống
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="file.xlsx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    // Ghi file vào output
    ob_clean(); // Xóa output buffer
    flush(); // Xóa output buffer
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output'); // Ghi trực tiếp ra output

    $conn->close();
    exit; // Kết thúc script
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xuất Dữ Liệu Bảo Hành</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        button {
            background-color: #4CAF50; /* Màu nền của nút */
            color: white; /* Màu chữ */
            border: none; /* Không có viền */
            padding: 10px 20px; /* Khoảng cách bên trong */
            text-align: center; /* Căn giữa nội dung */
            text-decoration: none; /* Không gạch chân */
            display: inline-block; /* Hiển thị kiểu khối */
            font-size: 16px; /* Kích thước chữ */
            margin: 4px 2px; /* Khoảng cách bên ngoài */
            cursor: pointer; /* Con trỏ chuột thành hình tay */
            border-radius: 5px; /* Bo tròn các góc */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
        }
        button:hover {
            background-color: #45a049; /* Màu nền khi di chuột */
        }
    </style>
</head>
<body>
    <h1>Xuất Dữ Liệu Bảo Hành Ra Excel</h1>
    <form method="POST">
        <button type="submit" name="btnExport">Xuất File</button>
    </form>
</body>
</html>
