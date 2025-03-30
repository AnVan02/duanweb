<?php
use PhpOffice\PhpSpreadsheet\IOFactory;

// Kết nối database
function dbconnect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "database";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}

// Nếu có file được upload
if (isset($_POST['submit'])) {
    require_once '../../vendor/autoload.php'; // Đường dẫn tới vendor/autoload.php

    $file = $_FILES['excel_file']['tmp_name'];
    $fileType = IOFactory::identify($file);
    $reader = IOFactory::createReader($fileType);
    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    $conn = dbconnect();

    // Chuẩn bị câu lệnh SQL
    $sql = "INSERT INTO baohanh (SOSERI_SP, SOSERI_PC, LOAI, TENSP, NGAYXUAT, THOIHANBH) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bỏ qua dòng tiêu đề (dòng đầu tiên)
    $isFirstRow = true;
    foreach ($rows as $row) {
        if ($isFirstRow) {
            $isFirstRow = false;
            continue; // Bỏ qua dòng tiêu đề
        }

        // Gán giá trị từ file Excel
        $soseri_sp = $row[0];  // Cột 1: SOSERI_SP
        $soseri_pc = $row[1];  // Cột 2: SOSERI_PC
        $loai = $row[2];       // Cột 3: LOAI
        $tensp = $row[3];      // Cột 4: TENSP
        $ngayxuat = $row[4];   // Cột 5: NGAYXUAT
        $thoihanbh = $row[5];  // Cột 6: THOIHANBH

        // Kiểm tra và chuyển định dạng ngày nếu cần
        if (!empty($ngayxuat)) {
            $ngayxuat = date('Y-m-d', strtotime($ngayxuat)); // Chuyển sang định dạng MySQL
        }

        // Bind và thực thi
        $stmt->bind_param("sssssi", $soseri_sp, $soseri_pc, $loai, $tensp, $ngayxuat, $thoihanbh);
        if ($stmt->execute()) {
            $success = "Dữ liệu đã được nhập thành công!";
        } else {
            $error = "Lỗi khi nhập dữ liệu: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="main-content fl-right">
    <div class="section" id="upload-excel-wp">
        <div class="section-head clearfix">
            <h3 class="section-title" style="color:dodgerblue;">Tải lên file Excel để nhập dữ liệu bảo hành</h3>
        </div>
        <div class="section-detail">
            <div class="border border-zinc-300 p-4 rounded mb-4">
                <form method="POST" enctype="multipart/form-data">
                    <label for="excel_file">Chọn file Excel:</label>
                    <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" required class="border border-zinc-300 p-2 rounded w-full" style="width: 80%;">
                    <button type="submit" name="submit" class="bg-blue-500 text-white p-2 rounded" style="background-color:#FF3333; border: none; margin-top: 10px; width: 15%;">
                        Tải lên
                    </button>
                </form>

                <?php
                if (isset($success)) {
                    echo '<p style="color: green; margin-top: 10px;">' . $success . '</p>';
                }
                if (isset($error)) {
                    echo '<p style="color: red; margin-top: 10px;">' . $error . '</p>';
                }
                ?>
            </div>
            <div>
                <p><strong>Ghi chú:</strong> File Excel cần có các cột theo thứ tự: SOSERI_SP, SOSERI_PC, LOAI, TENSP, NGAYXUAT, THOIHANBH.</p>
                <p>Ví dụ định dạng ngày: "2023-12-25" hoặc "25-12-2023".</p>
            </div>
        </div>
    </div>
</div>

<style>
    .main-content {
        padding: 20px;
    }

    .section-title {
        font-size: 24px;
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }

    .border {
        border: 1px solid #e0e0e0;
        padding: 15px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    label {
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
    }

    input[type="file"] {
        font-size: 15px;
    }

    button {
        cursor: pointer;
    }

    button:hover {
        background-color: #e60000;
    }
</style>

<?php
?>