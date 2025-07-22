<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
function dbconnect() {
    $conn = new mysqli("localhost", "root", "", "student");
    if ($conn->connect_error) {
        die("Lỗi kết nối: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

// Hàm lấy danh sách khóa học
function getCourses($conn) {
    $query = "SELECT id, khoa_hoc FROM khoa_hoc ORDER BY khoa_hoc";
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Hàm lấy danh sách tên khóa học theo IDs
function getCourseNames($conn, $khoa_ids) {
    if (empty($khoa_ids)) return [];
    $khoa_ids = explode(',', $khoa_ids);
    $placeholders = str_repeat('?,', count($khoa_ids) - 1) . '?';
    $stmt = $conn->prepare("SELECT khoa_hoc FROM khoa_hoc WHERE id IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($khoa_ids)), ...$khoa_ids);
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return array_column($courses, 'khoa_hoc');
}

// Hàm đếm số bài đạt cho một khóa học
function DemSoBaiDatTheoKhoa($conn, $student_id, $khoa_id) {
    $sobaidat = 0;

    $test_query = $conn->prepare("SELECT id_test, so_cau_hien_thi, Pass FROM test WHERE id_khoa = ?");
    $test_query->bind_param("i", $khoa_id);
    $test_query->execute();
    $result = $test_query->get_result();

    while ($test = $result->fetch_assoc()) {
        $test_id = $test['id_test'];
        $so_cau = $test['so_cau_hien_thi'];
        $pass = $test['Pass'];

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

// Hàm đếm tổng số bài test cho một khóa học
function TongSoBaiTestTheoKhoa($conn, $khoa_id) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS tong FROM test WHERE id_khoa = ?");
    $stmt->bind_param("i", $khoa_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['tong'] ?? 0;
}

// Hàm cập nhật thành tích cho một học sinh
function updateThanhtich($conn, $student_id) {
    $stmt = $conn->prepare("SELECT Khoahoc FROM students WHERE Student_ID = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    
    $all_passed = true;
    $khoa_ids = explode(',', $student['Khoahoc']);
    
    foreach ($khoa_ids as $khoa_id) {
        $khoa_id = trim($khoa_id);
        if (empty($khoa_id)) continue;
        
        $sobaidat = DemSoBaiDatTheoKhoa($conn, $student_id, $khoa_id);
        $tongsobai = TongSoBaiTestTheoKhoa($conn, $khoa_id);
        
        if ($tongsobai == 0 || $sobaidat < $tongsobai) {
            $all_passed = false;
            break;
        }
    }
    
    $thanhtich = $all_passed ? 1 : 0;
    
    $stmt = $conn->prepare("UPDATE chungchi SET thanhtich = ? WHERE student_id = ?");
    $stmt->bind_param("is", $thanhtich, $student_id);
    $stmt->execute();
    $stmt->close();
}

$conn = dbconnect();


// Xử lý cập nhật chứng chỉ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_chungchi') {
    $student_id = $_POST['student_id'];
    $thanhtich = $_POST['thanhtich'];
    $chung_chi = $_POST['chung_chi'];
    
    
    $stmt = $conn->prepare("UPDATE chungchi SET thanhtich = ?, chungchi = ? WHERE student_id = ?");
    $stmt->bind_param("iss", $thanhtich, $chung_chi, $student_id);

    if ($stmt->execute()) {
        header("Location: index.php?action=chungchi.php?message=Cập nhật chứng chỉ thành công");
    } else {
        header("Location: index.php?action=chungchi.php?error=Lỗi khi cập nhật");
    }
    $stmt->close();
    exit;
}

// Xử lý xóa học sinh
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    
    $stmt = $conn->prepare("DELETE FROM chungchi WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $stmt->close();
    
    $stmt = $conn->prepare("DELETE FROM students WHERE Student_ID = ?");
    $stmt->bind_param("s", $student_id);
    
    if ($stmt->execute()) {
        header("Location: index.php?action=chungchi.php?message=Xóa học sinh thành công");
    } else {
        header("Location: index.php?action=chungchi.php?error=Lỗi khi xóa học sinh");
    }
    
    $stmt->close();
    exit;
}

// Lấy filter từ GET parameter
$filter_status = $_GET['filter'] ?? 'all';

// Phân trang
$items_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($current_page - 1) * $items_per_page;

// Lấy danh sách học sinh
$query = "SELECT s.Student_ID, s.Ten, s.Khoahoc, c.thanhtich, c.chungchi, c.ten_hs
          FROM students s 
          LEFT JOIN chungchi c ON s.Student_ID = c.student_id 
          ORDER BY s.Student_ID DESC";
$result = $conn->query($query);
$all_students = $result->fetch_all(MYSQLI_ASSOC);

// Lọc và tính toán thông tin học sinh
$filtered_students = [];
foreach ($all_students as $student) {
    $khoa_ids = explode(',', $student['Khoahoc']);
    $all_passed = true;
    $total_tests = 0;
    $passed_tests = 0;
    
    // Lấy danh sách tên khóa học
    $course_names = getCourseNames($conn, $student['Khoahoc']);
    
    foreach ($khoa_ids as $khoa_id) {
        $khoa_id = trim($khoa_id);
        if (empty($khoa_id)) continue;
        
        $sobaidat = DemSoBaiDatTheoKhoa($conn, $student['Student_ID'], $khoa_id);
        $tongsobai = TongSoBaiTestTheoKhoa($conn, $khoa_id);
        
        $total_tests += $tongsobai;
        $passed_tests += $sobaidat;
        
        if ($tongsobai > 0 && $sobaidat < $tongsobai) {
            $all_passed = false;
        }
    }
    
    // Thêm thông tin vào mảng student
    $student['sobaidat'] = $passed_tests;
    $student['tongsobai'] = $total_tests;
    $student['is_passed'] = $all_passed;
    $student['danh_sach_khoa_hoc'] = $course_names;
    
    // Áp dụng filter
    if ($filter_status == 'all' || 
        ($filter_status == 'passed' && $all_passed) || 
        ($filter_status == 'not_passed' && !$all_passed)) {
        $filtered_students[] = $student;
    }
}

// Tính toán phân trang
$total_filtered = count($filtered_students);
$total_pages = ceil($total_filtered / $items_per_page);

// Lấy danh sách cho trang hiện tại
$students = array_slice($filtered_students, $offset, $items_per_page);

// Lấy thông tin học sinh cần chỉnh sửa
$edit_student = null;
if (isset($_GET['edit'])) {
    $student_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT s.*, c.thanhtich, c.chungchi 
                          FROM students s 
                          LEFT JOIN chungchi c ON s.Student_ID = c.student_id 
                          WHERE s.Student_ID = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $edit_student = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Lấy danh sách khóa học
$courses = getCourses($conn);

// Tính toán thống kê
$total_students = count($all_students);
$passed_count = 0;
$not_passed_count = 0;

foreach ($all_students as $student) {
    $khoa_ids = explode(',', $student['Khoahoc']);
    $all_passed = true;
    
    foreach ($khoa_ids as $khoa_id) {
        $khoa_id = trim($khoa_id);
        if (empty($khoa_id)) continue;
        
        $sobaidat = DemSoBaiDatTheoKhoa($conn, $student['Student_ID'], $khoa_id);
        $tongsobai = TongSoBaiTestTheoKhoa($conn, $khoa_id);
        
        if ($tongsobai > 0 && $sobaidat < $tongsobai) {
            $all_passed = false;
            break;
        }
    }
    
    if ($all_passed) {
        $passed_count++;
    } else {
        $not_passed_count++;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Học Sinh và Chứng chỉ</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 2600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .filter-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .filter-buttons {
            display: inline-flex;
            gap: 10px;
            margin-top: 10px;
        }
        .filter-btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .filter-btn.active {
            background-color: #007bff;
            color: white;
        }
        .filter-btn:not(.active) {
            background-color: #e9ecef;
            color: #495057;
        }
        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #f2f2f2;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #245efcff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .status-passed {
            color: #28a745;
            font-weight: bold;
        }
        .status-not-passed {
            color: #dc3545;
            font-weight: bold;
        }
        .progress-info {
            font-size: 0.9em;
            color: #666;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .actions a {
            color: #2196F3;
            text-decoration: none;
            margin-right: 10px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .stat-item {
            text-align: center;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
        }
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            gap: 5px;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #007bff;
            background: white;
        }
        .pagination a:hover {
            background-color: #e9ecef;
            text-decoration: none;
        }
        .pagination .current {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .pagination .disabled {
            color: #6c757d;
            background-color: #fff;
            border-color: #dee2e6;
            cursor: not-allowed;
        }
        .page-info {
            text-align: center;
            margin: 10px 0;
            color: #666;
            font-size: 0.9em;
        }
        .course-lines div {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quản lý chứng chỉ sinh viên</h1>
        
        <?php if (isset($_GET['message'])): ?>
            <div class="message success"><?= htmlspecialchars($_GET['message']) ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="message error"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

     

        <!-- Form chỉnh sửa chứng chỉ -->
        <?php if (isset($_GET['edit'])): ?>
            <h2>Chỉnh sửa chứng chỉ</h2>
            <form method="POST" action="chungchi.php">
                <input type="hidden" name="action" value="update_chungchi">
                <input type="hidden" name="student_id" value="<?= htmlspecialchars($edit_student['Student_ID'] ?? '') ?>">
                
                <div class="form-group">
                    <label for="thanhtich">Thành tích:</label>
                    <select id="thanhtich" name="thanhtich" required>
                        <option value="1" <?= ($edit_student['thanhtich'] ?? 0) == 1 ? 'selected' : '' ?>>Đạt</option>
                        <option value="0" <?= ($edit_student['thanhtich'] ?? 0) == 0 ? 'selected' : '' ?>>Không đạt</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="chung_chi">Ngày cấp chứng chỉ:</label>
                    <input type="date" id="chung_chi" name="chung_chi" 
                           value="<?= htmlspecialchars($edit_student['chungchi'] ?? '') ?>">
                </div>
                
                <button type="submit">Cập nhật Chứng chỉ</button>
                <a href="index.php?action=chungchi.php" class="cancel-btn">Hủy bỏ</a>
            </form>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-buttons">
                <?php 
                $base_url = "?";
                if (isset($_GET['page'])) $base_url .= "page=" . $_GET['page'] . "&";
                ?>
                <a href="<?= $base_url ?>index.php?action=filter=all" class="filter-btn <?= $filter_status == 'all' ? 'active' : '' ?>">
                    Tất cả (<?= $total_students ?>)
                </a>
                <a href="<?= $base_url ?>index.php?action=filter=passed" class="filter-btn <?= $filter_status == 'passed' ? 'active' : '' ?>">
                    Đạt(<?= $passed_count ?>)
                </a>
                <a href="<?= $base_url ?>index.php?action=filter=not_passed" class="filter-btn <?= $filter_status == 'not_passed' ? 'active' : '' ?>">
                    Chưa đạt (<?= $not_passed_count ?>)
                </a>
            </div>
        </div>
       
        <h2>Danh sách Học sinh 
            <?php if ($filter_status != 'all'): ?>
                - <?= $filter_status == 'passed' ? 'Đã hoàn thành' : 'Chưa hoàn thành' ?>
            <?php endif; ?>
        </h2>
        
        <!-- Thông tin phân trang -->
        <?php if ($total_filtered > $items_per_page): ?>
        <div class="page-info">
            Hiển thị <?= $offset + 1 ?> - <?= min($offset + $items_per_page, $total_filtered) ?> 
            trong tổng số <?= $total_filtered ?> học sinh
            <?php if ($total_pages > 1): ?>
                (Trang <?= $current_page ?>/<?= $total_pages ?>)
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <table>
            <thead>
                <tr>
                    <th>Mã HS</th>
                    <th>Họ tên</th>
                    <th>Khóa học</th>
                    <th>Tiến độ Test</th>
                    <th>Trạng thái</th>
                    <th>Thành tích</th>
                    <th>Chứng chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
         <tbody>
            <?php foreach ($students as $student): 
                $courses = $student['danh_sach_khoa_hoc'];
                $khoa_ids = array_keys(array_flip(explode(',', $student['Khoahoc']))); // Lấy danh sách khoa_id duy nhất
                foreach ($courses as $index => $course): 
                    $khoa_id = $khoa_ids[$index];
                    $sobaidat = DemSoBaiDatTheoKhoa($conn, $student['Student_ID'], $khoa_id);
                    $tongsobai = TongSoBaiTestTheoKhoa($conn, $khoa_id);
                    $is_passed = ($tongsobai > 0 && $sobaidat >= $tongsobai);
                ?>
                <tr>
                    <td><?= htmlspecialchars($student['Student_ID']) ?></td>
                    <td><?= htmlspecialchars($student['Ten']) ?></td>
                    <td><?= htmlspecialchars($course) ?></td>
                    <td>
                        <strong><?= $sobaidat ?>/<?= $tongsobai ?></strong> bài
                        <div class="progress-info">
                            <?php if ($tongsobai > 0): ?>
                                (<?= round(($sobaidat / $tongsobai) * 100, 1) ?>%)
                            <?php else: ?>
                                (Chưa có bài test)
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <?php if ($is_passed): ?>
                            <span class="status-passed">✓ Hoàn thành</span>
                        <?php else: ?>
                            <span class="status-not-passed">✗ Chưa hoàn thành</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php 
                        // Đồng bộ cột Thành tích với trạng thái is_passed
                        if ($student['is_passed']): ?>
                            Đạt
                        <?php else: ?>
                            Chưa đạt
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($student['chungchi'] ?? 'Chưa có') ?></td>

                    <td class="actions">
                        <!-- <a href="?edit_student=<?= htmlspecialchars($student['Student_ID']) ?>">Sửa</a> -->
                        <a href="?edit=<?= htmlspecialchars($student['Student_ID']) ?>">Chứng chỉ</a>
                        <!-- <a href="?action=delete&student_id=<?= htmlspecialchars($student['Student_ID']) ?>" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa học sinh này?')">Xóa</a> -->
                    </td>
                </tr>
            <?php endforeach; endforeach; ?>
        </tbody>
        
        <!-- Phân trang -->
        <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php 
            $query_params = [];
            if ($filter_status != 'all') $query_params['filter'] = $filter_status;
            $base_query = !empty($query_params) ? '&' . http_build_query($query_params) : '';
            ?>
            
            <!-- Previous Button -->
            <?php if ($current_page > 1): ?>
                <a href="?page=<?= $current_page - 1 ?><?= $base_query ?>">‹ Trước</a>
            <?php else: ?>
                <span class="disabled">‹ Trước</span>
            <?php endif; ?>
            
            <!-- Page Numbers -->
            <?php 
            $start_page = max(1, $current_page - 2);
            $end_page = min($total_pages, $current_page + 2);
            
            if ($start_page > 1): ?>
                <a href="?page=1<?= $base_query ?>">1</a>
                <?php if ($start_page > 2): ?>
                    <span>...</span>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <?php if ($i == $current_page): ?>
                    <span class="current"><?= $i ?></span>
                <?php else: ?>
                    <a href="?page=<?= $i ?><?= $base_query ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if ($end_page < $total_pages): ?>
                <?php if ($end_page < $total_pages - 1): ?>
                    <span>...</span>
                <?php endif; ?>
                <a href="?page=<?= $total_pages ?><?= $base_query ?>"><?= $total_pages ?></a>
            <?php endif; ?>
            
            <!-- Next Button -->
            <?php if ($current_page < $total_pages): ?>
                <a href="?page=<?= $current_page + 1 ?><?= $base_query ?>">Tiếp ›</a>
            <?php else: ?>
                <span class="disabled">Tiếp ›</span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if (empty($students)): ?>
            <p style="text-align: center; color: #666; font-style: italic;">
                Không có học sinh nào phù hợp với bộ lọc hiện tại.
            </p>
        <?php endif; ?>
    </div>

    <?php 
    $conn->close(); 
    ?>
</body>
</html>