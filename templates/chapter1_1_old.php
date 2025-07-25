<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu Python</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/chapter1_1.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Thêm các style mới */
        .header-title {
            text-align: center;
            font-size: 2.5rem;
            margin: 20px 0;
            color: #333;
        }
        
        .chapter-overview {
            background-color: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #4CAF50;
        }
        
        .chapter-list {
            columns: 2;
            -webkit-columns: 2;
            -moz-columns: 2;
        }
        
        .chapter-list h4 {
            margin-top: 0;
            color: #4CAF50;
        }
        
        .chapter-list ul {
            list-style-type: none;
            padding-left: 0;
        }
        
        .chapter-list li {
            margin-bottom: 8px;
        }
        
        .navigation-links {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            color: #4CAF50;
            text-decoration: none;
        }
        
        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Thêm tiêu đề ROSA -->
    <div class="header-title">ROSA</div>

    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>GIỚI THIỆU CHUNG VỀ PYTHON</h3>
    </nav>

    <div class="container">
        <div class="chapter" id="chapter">
            <!-- Giữ nguyên nội dung chapter như cũ -->
            <h3><a href="chapter1.php">Chương 1: Giới thiệu chung về Python</a></h3>
            <a href="chapter1_1.php">Tổng quan về ngôn ngữ lập trình python.</a>
            <a href="chapter1_2.php">Chương trình đầu tiên làm quen với python.</a>
            <a href="chapter1_3.php">Biến và các kiểu dữ liệu cơ bản trong python.</a>
            <a href="chapter1_4.php">Toán tử trong python.</a>
            <a href="exercise1.php">Bài tập chương 1</a>
            <!-- Các chương khác giữ nguyên -->
        </div>

        <div class="content">
            <div class="main">
                <!-- Thêm phần giới thiệu chung như trong hình -->
                <div class="chapter-overview">
                    <h3>Giới thiệu chung</h3>
                    <p>Trong chương này, chúng ta sẽ khám phá những khái niệm cơ bản và cần thiết để làm quen với ngôn ngữ lập trình Python. Python đã trở thành một trong những ngôn ngữ lập trình phổ biến nhất trong cộng đồng lập trình viên nhờ vào sự dễ học, cú pháp rõ ràng và khả năng linh hoạt trong việc ứng dụng vào nhiều lĩnh vực khác nhau như phát triển web, khoa học dữ liệu, trí tuệ nhân tạo và tự động hóa.</p>
                </div>

                <!-- Thêm phần tổng quan -->
                <div class="chapter-overview">
                    <h3>Tổng quan về ngôn ngữ lập trình python</h3>
                    <p>Chúng ta sẽ bắt đầu bằng việc giới thiệu tổng quan về Python, lịch sử phát triển và những ưu điểm nổi bật của nó. Python không chỉ được thiết kế để đơn giản và dễ hiểu, mà còn cung cấp một môi trường mạnh mẽ cho việc phát triển các ứng dụng phức tạp.</p>
                </div>

                <!-- Thêm phần chương trình đầu tiên -->
                <div class="chapter-overview">
                    <h3>Chương trình đầu tiên làm quen với Python</h3>
                    <p>Chúng ta sẽ thực hiện một bước đầu tiên đơn giản nhưng quan trọng: viết và chạy chương trình đầu tiên bằng Python. Qua đó, bạn sẽ hiểu rõ hơn về cách thức hoạt động của ngôn ngữ này và làm quen với công cụ lập trình. Biến và các kiểu dữ liệu cơ bản trong Python. Chúng ta sẽ tìm hiểu về biến và các kiểu dữ liệu cơ bản trong Python.</p>
                </div>

                <!-- Thêm danh sách chương -->
                <div class="chapter-list">
                    <h4>Chương 1: Giới thiệu chung.</h4>
                    <ul>
                        <li>Tổng quan về python</li>
                        <li>Làm quen với python</li>
                        <li>Biến và các kiểu dữ liệu cơ bản</li>
                        <li>Toán tử trong python</li>
                        <li>Bài tập chương 1</li>
                    </ul>
                    
                    <h4>Chương 2: Cấu trúc điều kiện, vòng lập và hàm trong python</h4>
                    <ul>
                        <li>Cấu trúc điều kiện</li>
                        <li>Vòng lập trong python</li>
                        <li>try và except trong python</li>
                        <li>Hàm trong python</li>
                        <li>Bài tập chương 2</li>
                    </ul>
                    
                    <h4>Chương 3: Cấu trúc dữ liệu</h4>
                    <ul>
                        <li>List trong python</li>
                        <li>Tuples trong python</li>
                        <li>Dictionary trong python</li>
                        <li>Set trong python</li>
                        <li>Bài tập chương 3</li>
                    </ul>
                    
                    <h4>Chương 4: Module và Package</h4>
                    <ul>
                        <li>Module</li>
                        <li>Package</li>
                        <li>Bài tập chương 4</li>
                    </ul>
                </div>

                <!-- Thêm nút điều hướng -->
                <div class="navigation-links">
                    <a href="#" class="nav-link">
                        <i class="fas fa-arrow-left"></i>
                        <span>Bài trước đó</span>
                    </a>
                    <a href="#" class="nav-link">
                        <span>Bài tiếp theo</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="space"></div>
    </div>

    <script src="static/javascript/main.js"></script>
    <script src="static/javascript/code.js"></script>
</body>

</html>