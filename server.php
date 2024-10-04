<?php
// Set the content type to JSON because our API will return data in JSON format
header('Content-Type: application/json');

// Allow cross-origin requests (CORS)
header('Access-Control-Allow-Origin: *');

// Handle preflight requests for POST methods (CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    exit(0);
}

// Check the HTTP request method (GET, POST, etc.)
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // Handle a POST request
        handlePost();
        break;

    default:
        // Handle other request methods if needed
        handleInvalidRequest();
        break;
}

// Function to handle POST request
function handlePost() {
    // Get the posted JSON data
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate that SoSerial is provided
    if (!isset($input['SoSerial'])) {
        $response = [
            'status' => 'error',
            'message' => 'Dữ liệu nhập vào không hợp lệ. Trường SoSerial là bắt buộc.'
        ];
        echo json_encode($response);
        return;
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "Vietson@123";
    $dbname = "123"; // Đảm bảo rằng cơ sở dữ liệu '123' tồn tại

    // Kết nối đến MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        $response = [
            'status' => 'error',
            'message' => 'Kết nối tới cơ sở dữ liệu thất bại: ' . $conn->connect_error
        ];
        echo json_encode($response);
        return;
    }

    // Chuẩn bị câu lệnh SQL để truy xuất dữ liệu dựa trên SoSerial
    $stmt = $conn->prepare("SELECT SoSerial, MaHang, TenHang, NgayXuat, ThoiHanBH FROM sanpham WHERE SoSerial = ?");
    
    if ($stmt === false) {
        $response = [
            'status' => 'error',
            'message' => 'Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error
        ];
        echo json_encode($response);
        return;
    }

    // Gán giá trị cho SoSerial
    $stmt->bind_param('s', $input['SoSerial']);

    // Thực thi câu lệnh
    $stmt->execute();

    // Lấy kết quả từ câu truy vấn
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu có dữ liệu, trả về thông tin
        $data = $result->fetch_assoc();
        $response = [
            'status' => 'success',
            'data' => $data
        ];
    } else {
        // Không tìm thấy dữ liệu
        $response = [
            'status' => 'error',
            'message' => 'Không tìm thấy dữ liệu với SoSerial này.'
        ];
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();

    // Gửi phản hồi
    echo json_encode($response);
}

// Function to handle invalid request methods
function handleInvalidRequest() {
    $response = [
        'status' => 'error',
        'message' => 'Phương thức yêu cầu không hợp lệ'
    ];

    // Send response as JSON
    echo json_encode($response);
}
