<?php
// session_start();
// Bật hiển thị lỗi để gỡ lỗi (xóa trong môi trường sản xuất)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/php_errors.log');

// // Kiểm tra đăng nhập admin
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header('Location: /admin/login.php');
//     exit;
// }

// Hàm kết nối cơ sở dữ liệu
function dbconnect() {
    $conn = new mysqli("localhost", "root", "", "student");
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        die("Lỗi kết nối CSDL: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

// Kết nối SQL
$conn = dbconnect();
$message = isset($_GET['message']) ? urldecode($_GET['message']) : "";

// Xử lý yêu cầu lấy khóa học của sinh viên
if (isset($_GET['action']) && $_GET['action'] == 'get_courses' && isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $stmt = $conn->prepare("SELECT Khoahoc FROM students WHERE Student_ID = ?");
    if (!$stmt) {
        error_log("Prepare failed for get_courses: " . $conn->error);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Lỗi truy vấn cơ sở dữ liệu']);
        exit;
    }

    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $khoa_hoc_ids = [];
    if ($row = $result->fetch_assoc()) {
        $khoa_hoc_ids = !empty($row['Khoahoc']) && $row['Khoahoc'] !== NULL ? explode(',', $row['Khoahoc']) : [];
        error_log("Fetched courses for student $student_id: " . print_r($khoa_hoc_ids, true));
    } else {
        error_log("No student found with Student_ID: $student_id");
    }
    $stmt->close();
    header('Content-Type: application/json');
    echo json_encode($khoa_hoc_ids);
    exit;
}

// Xử lý yêu cầu AJAX để lưu khóa học
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'save_courses') {
    $student_id = $_POST['student_id'] ?? '';
    $khoa_hoc_ids = isset($_POST['khoa_hoc']) ? array_map('trim', $_POST['khoa_hoc']) : [];

    if (empty($student_id)) {
        error_log("Invalid input: student_id is empty");
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Student_ID không hợp lệ']);
        exit;
    }

    error_log("Saving courses for student: $student_id");
    error_log("Selected courses: " . print_r($khoa_hoc_ids, true));

    $khoa_hoc_string = !empty($khoa_hoc_ids) ? implode(',', $khoa_hoc_ids) : '';

    $stmt_check = $conn->prepare("SELECT Student_ID FROM students WHERE Student_ID = ?");
    if (!$stmt_check) {
        error_log("Prepare failed for student check: " . $conn->error);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Lỗi truy vấn cơ sở dữ liệu']);
        exit;
    }

    $stmt_check->bind_param("s", $student_id);
    $stmt_check->execute();
    $check_result = $stmt_check->get_result();
    if ($check_result->num_rows === 0) {
        error_log("Student not found: $student_id");
        $response = ['status' => 'error', 'message' => 'Sinh viên không tồn tại: ' . htmlspecialchars($student_id)];
        $stmt_check->close();
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    $stmt_check->close();

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("UPDATE students SET Khoahoc = ? WHERE Student_ID = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed for update Khoahoc: " . $conn->error);
        }
        $stmt->bind_param("ss", $khoa_hoc_string, $student_id);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed for update Khoahoc: " . $stmt->error);
        }
        error_log("Updated Khoahoc for student $student_id: $khoa_hoc_string");
        $stmt->close();

        $stmt_delete = $conn->prepare("DELETE FROM kiem_tra WHERE Student_ID = ?");
        if (!$stmt_delete) {
            throw new Exception("Prepare failed for delete kiem_tra: " . $conn->error);
        }
        $stmt_delete->bind_param("s", $student_id);
        if (!$stmt_delete->execute()) {
            throw new Exception("Execute failed for delete kiem_tra: " . $stmt_delete->error);
        }
        error_log("Deleted old kiem_tra records for student: $student_id");
        $stmt_delete->close();

        if (!empty($khoa_hoc_ids)) {
            foreach ($khoa_hoc_ids as $khoa_id) {
                $stmt_check_khoa = $conn->prepare("SELECT id FROM khoa_hoc WHERE id = ?");
                if (!$stmt_check_khoa) {
                    throw new Exception("Prepare failed for check Khoa_ID: " . $conn->error);
                }
                $stmt_check_khoa->bind_param("s", $khoa_id);
                $stmt_check_khoa->execute();
                $check_khoa_result = $stmt_check_khoa->get_result();
                if ($check_khoa_result->num_rows === 0) {
                    error_log("Invalid Khoa_ID: $khoa_id for student: $student_id");
                    continue;
                }
                $stmt_check_khoa->close();

                $stmt_test = $conn->prepare("SELECT id_test, Pass, lan_thu FROM test WHERE id_khoa = ? LIMIT 1");
                if (!$stmt_test) {
                    throw new Exception("Prepare failed for select test: " . $conn->error);
                }
                $stmt_test->bind_param("s", $khoa_id);
                $stmt_test->execute();
                $test_result = $stmt_test->get_result();
                if ($test_result->num_rows === 0) {
                    error_log("No test found for Khoa_ID: $khoa_id for student: $student_id");
                    $stmt_test->close();
                    continue;
                }
                $test_row = $test_result->fetch_assoc();
                $test_id = $test_row['id_test'];
                $pass = $test_row['Pass'];
                $max_tral = $test_row['lan_thu'];
                $stmt_test->close();

                $stmt_insert = $conn->prepare("INSERT INTO kiem_tra (Student_ID, Khoa_ID, Test_ID, Best_Score, Max_Score, Pass, Trial, Max_trial) VALUES (?, ?, ?, '0', '0', ?, '0', ?)");
                if (!$stmt_insert) {
                    throw new Exception("Prepare failed for insert kiem_tra: " . $conn->error);
                }
                $stmt_insert->bind_param("ssisi", $student_id, $khoa_id, $test_id, $pass, $max_tral);
                if (!$stmt_insert->execute()) {
                    throw new Exception("Execute failed for insert kiem_tra: " . $stmt_insert->error);
                }
                error_log("Inserted kiem_tra record for student $student_id, course: $khoa_id, test_id: $test_id, pass: $pass, max_tral: $max_tral");
                $stmt_insert->close();
            }
        }

        $khoa_hoc_names = [];
        if (!empty($khoa_hoc_ids)) {
            $placeholders = implode(',', array_fill(0, count($khoa_hoc_ids), '?'));
            $stmt_khoa_hoc = $conn->prepare("SELECT khoa_hoc FROM khoa_hoc WHERE id IN ($placeholders)");
            if (!$stmt_khoa_hoc) {
                throw new Exception("Prepare failed for select khoa_hoc: " . $conn->error);
            }
            $stmt_khoa_hoc->bind_param(str_repeat('s', count($khoa_hoc_ids)), ...$khoa_hoc_ids);
            if (!$stmt_khoa_hoc->execute()) {
                throw new Exception("Execute failed for select khoa_hoc: " . $stmt_khoa_hoc->error);
            }
            $khoa_hoc_result = $stmt_khoa_hoc->get_result();
            while ($khoa_hoc_row = $khoa_hoc_result->fetch_assoc()) {
                $khoa_hoc_names[] = htmlspecialchars($khoa_hoc_row['khoa_hoc']);
            }
            $stmt_khoa_hoc->close();
        }

        $conn->commit();
        $response = [
            'status' => 'success',
            'message' => 'Lưu khóa học thành công!',
            'khoa_hoc_names' => $khoa_hoc_names,
            'student_id' => $student_id
        ];
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Error saving courses for student $student_id: " . $e->getMessage());
        $response = ['status' => 'error', 'message' => 'Lỗi khi lưu khóa học: ' . $e->getMessage()];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Xử lý các hành động khác
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $student_id = $_POST['student_id'];
        $stmt = $conn->prepare("DELETE FROM students WHERE Student_ID = ?");
        if (!$stmt) {
            error_log("Prepare failed for delete student: " . $conn->error);
            $message = "Lỗi khi xóa: " . $conn->error;
        } else {
            $stmt->bind_param("s", $student_id);
            if ($stmt->execute()) {
                $message = "Xóa sinh viên thành công!";
            } else {
                $message = "Lỗi khi xóa: " . $stmt->error;
                error_log("Error deleting student $student_id: " . $stmt->error);
            }
            $stmt->close();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'update') {
        $student_id = $_POST['student_id'];
        $imei = (int)$_POST['imei'];
        $mb_id = (int)$_POST['mb_id'];
        $os_id = (int)$_POST['os_id'];
        $password = $_POST['password'];
        $ten = $_POST['ten'];
        $email = $_POST['email'];
        $khoa_hoc_ids = isset($_POST['khoa_hoc']) ? array_map('trim', $_POST['khoa_hoc']) : [];

        $khoa_hoc_string = !empty($khoa_hoc_ids) ? implode(',', $khoa_hoc_ids) : '';
        error_log("Courses for update student $student_id: " . $khoa_hoc_string);

        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("UPDATE students SET IMEI = ?, MB_ID = ?, OS_ID = ?, Password = ?, Ten = ?, Email = ?, Khoahoc = ? WHERE Student_ID = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed for update student: " . $conn->error);
            }
            $stmt->bind_param("iiisssss", $imei, $mb_id, $os_id, $password, $ten, $email, $khoa_hoc_string, $student_id);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed for update student: " . $stmt->error);
            }
            $stmt->close();

            $stmt_delete = $conn->prepare("DELETE FROM kiem_tra WHERE Student_ID = ?");
            if (!$stmt_delete) {
                throw new Exception("Prepare failed for delete kiem_tra: " . $conn->error);
            }
            $stmt_delete->bind_param("s", $student_id);
            if (!$stmt_delete->execute()) {
                throw new Exception("Execute failed for delete kiem_tra: " . $stmt_delete->error);
            }
            $stmt_delete->close();

            if (!empty($khoa_hoc_ids)) {
                foreach ($khoa_hoc_ids as $khoa_id) {
                    $stmt_check_khoa = $conn->prepare("SELECT id FROM khoa_hoc WHERE id = ?");
                    if (!$stmt_check_khoa) {
                        throw new Exception("Prepare failed for check Khoa_ID: " . $conn->error);
                    }
                    $stmt_check_khoa->bind_param("s", $khoa_id);
                    $stmt_check_khoa->execute();
                    $check_khoa_result = $stmt_check_khoa->get_result();
                    if ($check_khoa_result->num_rows === 0) {
                        error_log("Invalid Khoa_ID: $khoa_id for student: $student_id");
                        continue;
                    }
                    $stmt_check_khoa->close();

                    $stmt_test = $conn->prepare("SELECT id_test, Pass, lan_thu FROM test WHERE id_khoa = ? LIMIT 1");
                    if (!$stmt_test) {
                        throw new Exception("Prepare failed for select test: " . $conn->error);
                    }
                    $stmt_test->bind_param("s", $khoa_id);
                    $stmt_test->execute();
                    $test_result = $stmt_test->get_result();
                    if ($test_result->num_rows === 0) {
                        error_log("No test found for Khoa_ID: $khoa_id for student: $student_id");
                        $stmt_test->close();
                        continue;
                    }
                    $test_row = $test_result->fetch_assoc();
                    $test_id = $test_row['id_test'];
                    $pass = $test_row['Pass'];
                    $max_tral = $test_row['lan_thu'];
                    $stmt_test->close();

                    $stmt_insert = $conn->prepare("INSERT INTO kiem_tra (Student_ID, Khoa_ID, Test_ID, Best_Score, Max_Score, Pass, Trial, Max_trial) VALUES (?, ?, ?, '0', '0', ?, '0', ?)");
                    if (!$stmt_insert) {
                        throw new Exception("Prepare failed for insert kiem_tra: " . $conn->error);
                    }
                    $stmt_insert->bind_param("ssisi", $student_id, $khoa_id, $test_id, $pass, $max_tral);
                    if (!$stmt_insert->execute()) {
                        throw new Exception("Execute failed for insert kiem_tra: " . $stmt_insert->error);
                    }
                    $stmt_insert->close();
                }
            }

            $conn->commit();
            $message = "Cập nhật thành công!";
            error_log("Updated student $student_id successfully with courses: $khoa_hoc_string");
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Error updating student $student_id: " . $e->getMessage());
            $message = "Lỗi khi cập nhật: " . $e->getMessage();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'add') {
        $imei = (int)$_POST['imei'];
        $mb_id = (int)$_POST['mb_id'];
        $os_id = (int)$_POST['os_id'];
        $student_id = $_POST['student_id'];
        $password = $_POST['password'];
        $ten = $_POST['ten'];
        $email = $_POST['email'];
        $khoa_hoc_ids = isset($_POST['khoa_hoc']) ? array_map('trim', $_POST['khoa_hoc']) : [];

        $khoa_hoc_string = !empty($khoa_hoc_ids) ? implode(',', $khoa_hoc_ids) : '';
        error_log("Courses for new student $student_id: " . $khoa_hoc_string);

        $stmt = $conn->prepare("SELECT Student_ID FROM students WHERE Student_ID = ?");
        if (!$stmt) {
            error_log("Prepare failed for check Student_ID: " . $conn->error);
            $message = "Lỗi khi kiểm tra Student_ID: " . $conn->error;
        } else {
            $stmt->bind_param("s", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $message = "Lỗi: Student_ID đã tồn tại!";
                error_log("Student_ID $student_id already exists");
            } else {
                $conn->begin_transaction();
                try {
                    $stmt = $conn->prepare("INSERT INTO students (IMEI, MB_ID, OS_ID, Student_ID, Password, Ten, Email, Khoahoc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    if (!$stmt) {
                        throw new Exception("Prepare failed for insert student: " . $conn->error);
                    }
                    $stmt->bind_param("iiisssss", $imei, $mb_id, $os_id, $student_id, $password, $ten, $email, $khoa_hoc_string);
                    if (!$stmt->execute()) {
                        throw new Exception("Execute failed for insert student: " . $stmt->error);
                    }
                    $stmt->close();

                    if (!empty($khoa_hoc_ids)) {
                        foreach ($khoa_hoc_ids as $khoa_id) {
                            $stmt_check_khoa = $conn->prepare("SELECT id FROM khoa_hoc WHERE id = ?");
                            if (!$stmt_check_khoa) {
                                throw new Exception("Prepare failed for check Khoa_ID: " . $conn->error);
                            }
                            $stmt_check_khoa->bind_param("s", $khoa_id);
                            $stmt_check_khoa->execute();
                            $check_khoa_result = $stmt_check_khoa->get_result();
                            if ($check_khoa_result->num_rows === 0) {
                                error_log("Invalid Khoa_ID: $khoa_id for student: $student_id");
                                continue;
                            }
                            $stmt_check_khoa->close();

                            $stmt_test = $conn->prepare("SELECT id_test, Pass, lan_thu FROM test WHERE id_khoa = ? LIMIT 1");
                            if (!$stmt_test) {
                                throw new Exception("Prepare failed for select test: " . $conn->error);
                            }
                            $stmt_test->bind_param("s", $khoa_id);
                            $stmt_test->execute();
                            $test_result = $stmt_test->get_result();
                            if ($test_result->num_rows === 0) {
                                error_log("No test found for Khoa_ID: $khoa_id for student: $student_id");
                                $stmt_test->close();
                                continue;
                            }
                            $test_row = $test_result->fetch_assoc();
                            $test_id = $test_row['id_test'];
                            $pass = $test_row['Pass'];
                            $max_tral = $test_row['lan_thu'];
                            $stmt_test->close();

                            $stmt_insert = $conn->prepare("INSERT INTO kiem_tra (Student_ID, Khoa_ID, Test_ID, Best_Score, Max_Score, Pass, Trial, Max_trial) VALUES (?, ?, ?, '0', '0', ?, '0', ?)");
                            if (!$stmt_insert) {
                                throw new Exception("Prepare failed for insert kiem_tra: " . $conn->error);
                            }
                            $stmt_insert->bind_param("ssisi", $student_id, $khoa_id, $test_id, $pass, $max_tral);
                            if (!$stmt_insert->execute()) {
                                throw new Exception("Execute failed for insert kiem_tra: " . $stmt_insert->error);
                            }
                            $stmt_insert->close();
                        }
                    }

                    $conn->commit();
                    $message = "Thêm sinh viên thành công!";
                    error_log("Added student $student_id successfully with courses: $khoa_hoc_string");
                } catch (Exception $e) {
                    $conn->rollback();
                    error_log("Error adding student $student_id: " . $e->getMessage());
                    $message = "Lỗi khi thêm: " . $e->getMessage();
                }
            }
            $stmt->close();
        }
    }
}

// Kiểm tra chế độ chỉnh sửa
$mode = isset($_GET['mode']) ? $_GET['mode'] : '';
$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : '';
$student_data = [];
if ($mode == 'edit' && $student_id) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE Student_ID = ?");
    if (!$stmt) {
        error_log("Prepare failed for select student: " . $conn->error);
        $message = "Lỗi truy vấn cơ sở dữ liệu";
    } else {
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $student_data = $result->fetch_assoc();
            error_log("Student data for $student_id: " . print_r($student_data, true));
        } else {
            $message = "Không tìm thấy sinh viên với Student_ID: " . htmlspecialchars($student_id);
            error_log("Student not found: $student_id");
        }
        $stmt->close();
    }
}
?>

<!-- KHÔNG có <html>, <head>, <body>, <main>, <section>, <style> -->

<!-- Form thêm/sửa sinh viên -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="action" value="<?php echo $mode == 'edit' ? 'update' : 'add'; ?>">
    <?php if ($mode == 'edit'): ?>
        <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
    <?php endif; ?>
    <div class="form-container">
        <div class="form-left">
            <label>IMEI</label>
            <input type="number" name="imei" value="<?php echo htmlspecialchars($student_data['IMEI'] ?? ''); ?>" required>
            <label>MB_ID</label>
            <input type="number" name="mb_id" value="<?php echo htmlspecialchars($student_data['MB_ID'] ?? ''); ?>">
            <label>OS_ID</label>
            <input type="number" name="os_id" value="<?php echo htmlspecialchars($student_data['OS_ID'] ?? ''); ?>">
            <label>Student_ID</label>
            <input type="text" name="student_id" value="<?php echo htmlspecialchars($student_data['Student_ID'] ?? ''); ?>" readonly>
        </div>
        <div class="form-right">
            <label>Mật khẩu</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($student_data['Password'] ?? ''); ?>" required>
            <label>Tên</label>
            <input type="text" name="ten" value="<?php echo htmlspecialchars($student_data['Ten'] ?? ''); ?>" required>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($student_data['Email'] ?? ''); ?>" required>
            <label>Khóa học</label>
            <div class="dropdown-checkbox">
                <button type="button" class="dropdown-btn" id="dropdownBtn_<?php echo $student_id; ?>" onclick="toggleDropdown('<?php echo $student_id; ?>')">Chọn khóa học ▼</button>
                <div class="dropdown-content" id="dropdownContent_<?php echo $student_id; ?>">
                    <?php
                    $stmt_khoa = $conn->prepare("SELECT id, khoa_hoc FROM khoa_hoc ORDER BY khoa_hoc");
                    if ($stmt_khoa) {
                        $stmt_khoa->execute();
                        $khoa_result = $stmt_khoa->get_result();
                        while ($khoa_row = $khoa_result->fetch_assoc()) {
                            $checked = '';
                            // Chỉ dùng $selected_courses nếu là form sửa
                            if (isset($selected_courses) && in_array((string)$khoa_row['id'], $selected_courses, true)) {
                                $checked = 'checked';
                            }
                            echo "<label>";
                            echo "<input type='checkbox' name='khoa_hoc[]' value='" . htmlspecialchars($khoa_row['id']) . "' $checked onchange=\"updateDropdownBtn('" . $student_id . "')\"> ";
                            echo htmlspecialchars($khoa_row['khoa_hoc']);
                            echo "</label>";
                        }
                        $stmt_khoa->close();
                    } else {
                        error_log("Prepare failed for select khoa_hoc: " . $conn->error);
                        echo "<span>Lỗi tải danh sách khóa học</span>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" value="<?php echo $mode == 'edit' ? 'Cập Nhật' : 'Thêm Sinh Viên'; ?>">
</form>

<!-- Bảng danh sách sinh viên -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>IMEI</th>
                <th>MB_ID</th>
                <th>OS_ID</th>
                <th>Student_ID</th>
                <th>Password</th>
                <th>Tên sinh viên</th>
                <th>Email</th>
                <th>Khóa học</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            $stmt = $conn->prepare("SELECT * FROM students");
            if (!$stmt) {
                error_log("Prepare failed for select students: " . $conn->error);
                echo "<tr><td colspan='9' class='error'>Lỗi truy vấn cơ sở dữ liệu</td></tr>";
            } else {
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-student-id='" . htmlspecialchars($row['Student_ID']) . "'>";
                        echo "<td>" . htmlspecialchars($row['IMEI'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($row['MB_ID'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($row['OS_ID'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($row['Student_ID'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($row['Password'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($row['Ten'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email'] ?? '') . "</td>";

                        $khoa_hoc_ids = !empty($row['Khoahoc']) && $row['Khoahoc'] !== NULL ? explode(',', $row['Khoahoc']) : [];
                        $khoa_hoc_names = [];
                        if (!empty($khoa_hoc_ids)) {
                            $placeholders = implode(',', array_fill(0, count($khoa_hoc_ids), '?'));
                            $stmt_khoa_hoc = $conn->prepare("SELECT khoa_hoc FROM khoa_hoc WHERE id IN ($placeholders)");
                            if ($stmt_khoa_hoc) {
                                $stmt_khoa_hoc->bind_param(str_repeat('s', count($khoa_hoc_ids)), ...$khoa_hoc_ids);
                                $stmt_khoa_hoc->execute();
                                $khoa_hoc_result = $stmt_khoa_hoc->get_result();
                                while ($khoa_hoc_row = $khoa_hoc_result->fetch_assoc()) {
                                    $khoa_hoc_names[] = htmlspecialchars($khoa_hoc_row['khoa_hoc']);
                                }
                                $stmt_khoa_hoc->close();
                            } else {
                                error_log("Prepare failed for select khoa_hoc: " . $conn->error);
                            }
                        }

                        echo "<td class='course-cell'>";
                        if (!empty($khoa_hoc_names)) {
                            echo "<ul>";
                            foreach ($khoa_hoc_names as $name) {
                                echo "<li>" . htmlspecialchars($name) . "</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo 'Chưa có khóa học';
                        }
                        echo "</td>";

                        echo "<td class='actions'>";
                        echo "<form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                        echo "<input type='hidden' name='action' value='delete'>";
                        echo "<input type='hidden' name='student_id' value='" . htmlspecialchars($row['Student_ID']) . "'>";
                        echo "<button type='submit' class='action-btn btn-danger' onclick='return confirm(\"Bạn có chắc muốn xóa?\");'>Xóa</button>";
                        echo "</form>";
                        echo "<form method='GET' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                        echo "<input type='hidden' name='mode' value='edit'>";
                        echo "<input type='hidden' name='student_id' value='" . htmlspecialchars($row['Student_ID']) . "'>";
                        echo "<button type='submit' class='action-btn btn-primary'>Sửa</button>";
                        echo "</form>";
                        echo "<button onclick=\"openModal('" . htmlspecialchars($row['Student_ID']) . "')\">Xem Khóa Học</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align:center;'>Chưa có dữ liệu sinh viên.</td></tr>";
                }
                $stmt->close();
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal hiển thị và lưu khóa học -->
<div id="courseModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>
        <h2 id="modalTitle">Khóa Học Của Sinh Viên</h2>
        <form id="courseForm" onsubmit="saveCourses(event)">
            <input type="hidden" name="action" value="save_courses">
            <input type="hidden" name="student_id" id="modalStudentId">
            <div class="course-list">
                <?php
                $stmt = $conn->prepare("SELECT * FROM khoa_hoc ORDER BY khoa_hoc");
                if (!$stmt) {
                    error_log("Prepare failed for select khoa_hoc: " . $conn->error);
                    echo "<p class='error'>Lỗi tải danh sách khóa học</p>";
                } else {
                    $stmt->execute();
                    $khoaHocResult = $stmt->get_result();
                    if ($khoaHocResult->num_rows > 0) {
                        while ($khoaHocRow = $khoaHocResult->fetch_assoc()) {
                            echo "<label class='course-item'>";
                            echo "<input type='checkbox' name='khoa_hoc[]' value='" . htmlspecialchars($khoaHocRow['id']) . "' onchange='updateSelectedCourses()'>";
                            echo "<span class='course-name'>" . htmlspecialchars($khoaHocRow['khoa_hoc']) . "</span>";
                            echo "</label>";
                        }
                    } else {
                        echo "<p>Không có khóa học nào.</p>";
                    }
                    $stmt->close();
                }
                ?>
            </div>
            <div id="selected-courses">
                <p><strong>Khóa học đã chọn:</strong> <span id="selectedCoursesText">Chưa chọn khóa học nào.</span></p>
            </div>
            <input type="submit" value="Lưu" style="background-color: #28a745; margin-top: 10px;">
        </form>
    </div>
</div>

<?php
$conn->close();
?>

<script>
    function openModal(studentId) {
        console.log('Opening modal for student:', studentId);
        document.getElementById('modalTitle').innerText = `Khóa Học Của Sinh Viên: ${studentId}`;
        document.getElementById('modalStudentId').value = studentId;
        document.getElementById('courseModal').style.display = 'block';

        fetch(`<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?action=get_courses&student_id=${studentId}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        })
            .then(response => {
                console.log('Fetch response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Fetched courses:', data);
                const checkboxes = document.querySelectorAll('input[name="khoa_hoc[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = data.includes(checkbox.value);
                });
                updateSelectedCourses();
            })
            .catch(error => {
                console.error('Error fetching courses:', error);
                alert('Lỗi khi tải danh sách khóa học: ' + error.message);
            });
    }

    function closeModal() {
        document.getElementById('courseModal').style.display = 'none';
        const checkboxes = document.querySelectorAll('input[name="khoa_hoc[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = false);
        updateSelectedCourses();
    }

    function updateSelectedCourses() {
        const selectedCourses = [];
        const checkboxes = document.querySelectorAll('input[name="khoa_hoc[]"]:checked');
        checkboxes.forEach(checkbox => {
            const label = checkbox.parentElement.querySelector('.course-name').textContent.trim();
            selectedCourses.push(label);
        });
        const selectedCoursesText = selectedCourses.length > 0 ? selectedCourses.join(', ') : 'Chưa chọn khóa học nào.';
        document.getElementById('selectedCoursesText').innerText = selectedCoursesText;
    }

    function saveCourses(event) {
        event.preventDefault();
        const form = document.getElementById('courseForm');
        const formData = new FormData(form);
        const studentId = document.getElementById('modalStudentId').value;

        console.log('Saving courses for student:', studentId);
        fetch('<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.status === 'success') {
                    const row = document.querySelector(`#studentTable tr[data-student-id="${data.student_id}"]`);
                    if (row) {
                        const courseCell = row.querySelector('.course-cell');
                        if (data.khoa_hoc_names && data.khoa_hoc_names.length > 0) {
                            courseCell.innerHTML = '<ul>' + data.khoa_hoc_names.map(name => `<li>${htmlspecialchars(name)}</li>`).join('') + '</ul>';
                        } else {
                            courseCell.innerHTML = 'Chưa có khóa học';
                        }
                    } else {
                        console.error('Row not found for student:', data.student_id);
                    }
                    alert(data.message);
                    closeModal();
                } else {
                    console.error('Save failed:', data.message);
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error saving courses:', error);
                alert('Đã xảy ra lỗi khi lưu khóa học: ' + error.message);
            });
    }

    function htmlspecialchars(str) {
        const div = document.createElement('div');
        div.innerText = str;
        return div.innerHTML;
    }

    function toggleDropdown(id) {
        var content = document.getElementById("dropdownContent_" + id);
        content.style.display = (content.style.display === "block") ? "none" : "block";
    }

    // Đóng dropdown nếu click ra ngoài
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-btn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }

    // Cập nhật tên các khóa học đã chọn lên nút
    function updateDropdownBtn(id) {
        var dropdown = document.getElementById('dropdownContent_' + id);
        var checkboxes = dropdown.querySelectorAll('input[type="checkbox"]:checked');
        var btn = document.getElementById('dropdownBtn_' + id);
        var selected = [];
        checkboxes.forEach(function(cb) {
            selected.push(cb.parentElement.textContent.trim());
        });
        if (selected.length > 0) {
            btn.innerHTML = selected.join(', ') + ' ▼';
        } else {
            btn.innerHTML = 'Chọn khóa học ▼';
        }
    }

    // Tự động cập nhật khi load lại trang (đặc biệt khi sửa sinh viên)
    window.onload = function() {
        // Nếu có nhiều form, cập nhật tất cả dropdown
        var allDropdowns = document.querySelectorAll('.dropdown-btn');
        allDropdowns.forEach(function(btn) {
            var id = btn.id.replace('dropdownBtn_', '');
            updateDropdownBtn(id);
        });
    };
</script>
