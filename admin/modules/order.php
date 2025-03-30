<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background-color: #fff;  
            justify-content: center;
            align-items: center;
            color: #000;
        }

        nav{
            background-color: #e9e9e9;
            display: flex;
            height: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .logo{
            color: #f83e3e;
            padding-top: 5px;
            padding-left: 20px;
            font-size: 1.5rem;
        }

        .logo:hover{
            transform: scale(1.1);
        }

        .link {
            margin-left: auto;
            padding-right: 50px;
            padding-top: 20px;
        }

        .link a{
            text-decoration: none;
            color: #333;
            font-size: 1.2rem;
        }

        .link a:hover{
            color: #80b6f5;
        }

        .information{
            justify-content: center;
            align-items: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        caption {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #745252;
        }

        caption:hover{
            color: #000;
        }

        th,td {
            padding:12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f1f1f1;
            color: #555;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        th:hover {
            background-color: #e0e0e0;
        }

        th, td {
            word-wrap: break-word;
            max-width: 200px;
        }

        /* Modal Style */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 900px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .order-details {
            white-space: pre-wrap; 
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>ROSA</h1>
        </div>
        <div class="link">
            <strong><a href="index.php">Trang chủ</a></strong>
        </div>
    </nav>

    <div class="information">
        <table>
            <caption>THÔNG TIN ĐƠN HÀNG</caption>
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Sản phẩm đặt mua</th>
                    <th>Họ và tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Hình thức nhận hàng</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Ghi chú khách hàng</th>
                    <th>Ngày lập hóa đơn</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "database";


                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['order_id']) && isset($_POST['new_status'])) {
                        $order_id = $_POST['order_id'];
                        $new_status = $_POST['new_status'];

                        $update_sql = "UPDATE `order` SET `status` = '$new_status' WHERE `formatted_order_id` = '$order_id'";
                        $conn->query($update_sql);
                    }

                    if (isset($_POST['delete_order_id'])) {
                        $delete_order_id = $_POST['delete_order_id'];

                        $delete_sql = "DELETE FROM `order` WHERE `formatted_order_id` = '$delete_order_id'";
                        if ($conn->query($delete_sql) === TRUE) {
                            echo "<script>alert('Xóa thành công!');</script>";
                        } else {
                            echo "<script>alert('Lỗi khi xóa: " . $conn->error . "');</script>";
                        }
                    }
                }

                $sql = "SELECT * FROM `order`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["formatted_order_id"] . "</td>
                                <td><button onclick='openModal(\"" . addslashes($row["order"]) . "\")'>Xem chi tiết</button></td>
                                <td>" . $row["customer_name"] . "</td>
                                <td>" . $row["customer_phone"] . "</td>
                                <td>" . $row["customer_email"] . "</td>
                                <td>" . $row["shipping_method"] . "</td>
                                <td>" . $row["delivery_address"] . "</td>
                                <td>" . $row["customer_note"] . "</td>
                                <td>" . $row["order_date"] . "</td>
                                <td>
                                    <form action='' method='POST'>
                                        <input type='hidden' name='order_id' value='" . $row["formatted_order_id"] . "' />
                                        <select name='new_status'>
                                            <option value='Đang xử lý' " . ($row["status"] == "Đang xử lý" ? "selected" : "") . ">Đang xử lý</option>
                                            <option value='Đang ráp máy' " . ($row["status"] == "Đang ráp máy" ? "selected" : "") . ">Đang ráp máy</option>
                                            <option value='Hoàn tất đóng gói' " . ($row["status"] == "Hoàn tất đóng gói" ? "selected" : "") . ">Hoàn tất đóng gói</option>
                                            <option value='Đã giao hàng' " . ($row["status"] == "Đã giao hàng" ? "selected" : "") . ">Đã giao hàng</option>
                                        </select>
                                        <button type='submit'>Cập nhật</button>
                                    </form>
                                </td>
                                <td>
                                    <form action='' method='POST'>
                                        <input type='hidden' name='delete_order_id' value='" . $row["formatted_order_id"] . "' />
                                        <button type='submit' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Xóa</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Không có dữ liệu</td></tr>";
                }
                $conn->close();
            ?>
        </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Chi tiết hóa đơn</h2>
            <div id="orderDetails" class="order-details"></div>
        </div>
    </div>


    <script>
        function openModal(orderDetails) {
            document.getElementById("orderDetails").innerHTML = orderDetails;  // Sử dụng innerHTML để hiển thị HTML
            document.getElementById("orderModal").style.display = "block";
        }


        function closeModal() {
            document.getElementById("orderModal").style.display = "none";
        }
    </script>
</body>
</html>
