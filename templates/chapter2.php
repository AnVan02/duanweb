<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="shortcut icon" href="../RS_icon.jpg" />
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
     <header class="header">
        <div class="header-content">
            <a href="<?php echo htmlspecialchars($link_quay_lai); ?>" class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
             <div class="logo">
                <img src="../ROSA_AI_Ready.png" alt="ROSA" class="logo-img">
            </div>
            <button class="menu-btn" onclick="toggleSidebar()">
                <span>Mục lục</span>
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
    <div class="title-section">
        <h1 class="main-title">CẤU TRÚC ĐIỀU KIỆN, VÒNG LẬP VÀ HÀM TRONG PYTHON</h1>
    </div>
    <div class="container">
        <div class="chapter" id="chapter">
            <h3><a href="chapter1.php">Chương 1:Giới thiệu chung về Python</a></h3>
            <a href="chapter1_1.php">Tổng quan về ngôn ngữ lập trình python.</a>
            <a href="chapter1_2.php">Chương trình đầu tiên làm quen với python.</a>
            <a href="chapter1_3.php">Biến và các kiểu dữ liệu cơ bản trong python.</a>
            <a href="chapter1_4.php">Toán tử trong python.</a>
            <a href="exercise1.php">Bài tập chương 1</a>
            <h3><a href="chapter2.php">Chương 2: Cấu trúc điều kiên, vòng lập và hàm trong python</a></h3>
            <a href="chapter2_1.php">Cấu trúc điều kiện.</a>
            <a href="chapter2_2.php">Vòng lập trong python.</a>
            <a href="chapter2_3.php">try và except trong python.</a>
            <a href="chapter2_4.php">Hàm trong python.</a>
            <a href="exercise2.php">Bài tập chương 2</a>
            <h3><a href="chapter3.php">Chương 3: Cấu trúc dữ liệu trong python</a></h3>
            <a href="chapter3_1.php">List trong python.</a>
            <a href="chapter3_2.php">Tuples trong python.</a>
            <a href="chapter3_3.php">Dictionary trong python.</a>
            <a href="chapter3_4.php">Set trong python.</a>
            <a href="exercise3.php">Bài tập chương 3</a>
            <h3><a href="chapter4.php">Chương 4: Module và Package</a></h3>
            <a href="chapter4_1.php">Module.</a>
            <a href="chapter4_2.php">Package.</a>
            <a href="exercise4.php">Bài tập chương 4</a>
            <h3><a href="chapter5.php">Chương 5: PANDAS</a></h3>
            <a href="chapter5_1.php">Series.</a>
            <a href="chapter5_2.php">Dataframe.</a>
            <a href="exercise5.php">Bài tập chương 5</a>
            <h3><a href="chapter6.php">Chương 6: MATPLOTLIB</a></h3>
            <a href="chapter6_1.php">Pyplot cơ bản.</a>
            <a href="chapter6_2.php">Lưu biểu đồ.</a>
            <a href="exercise6.php">Bài tập chương 6</a>
        </div>

        <div class="content">
            <div class="main">
                <h3>Điều Kiện, Vòng Lặp và Hàm trong Python</h3>
                <p>Trong lập trình, việc kiểm soát luồng chương trình là một khía cạnh quan trọng để xây dựng các ứng
                    dụng linh hoạt và mạnh mẽ. Python, với cú pháp đơn giản và dễ hiểu, cung cấp nhiều công cụ mạnh mẽ
                    giúp lập trình viên điều khiển được hành vi của chương trình. Chương này sẽ giới thiệu về ba khái
                    niệm cơ bản mà mọi lập trình viên Python cần nắm vững: cấu trúc điều kiện, vòng lặp, và hàm. Ngoài
                    ra, chương này cũng sẽ giúp bạn hiểu sâu hơn về xử lý ngoại lệ với các câu lệnh try và except.</p>
                <h3>Cấu trúc điều kiện trong Python</h3>
                <p>Cấu trúc điều kiện cho phép chương trình thực hiện các thao tác khác nhau dựa trên các điều kiện được
                    cung cấp. Python sử dụng các từ khóa như if, elif, và else để thực hiện các kiểm tra điều kiện và
                    thay đổi luồng chương trình dựa trên kết quả của các phép kiểm tra đó.</p>
                <h3>Vòng lặp trong Python</h3>
                <p>Vòng lặp là công cụ mạnh mẽ trong lập trình, cho phép thực hiện các thao tác lặp đi lặp lại nhiều
                    lần. Python cung cấp hai loại vòng lặp chính là for và while. Các vòng lặp này giúp lập trình viên
                    thực hiện các tác vụ nhiều lần mà không cần viết lại mã lệnh.</p>
                <h3>Try và Except trong Python</h3>
                <p>Trong quá trình lập trình, các lỗi hoặc ngoại lệ có thể xảy ra khi thực thi chương trình. Python cung
                    cấp cơ chế xử lý lỗi bằng các câu lệnh try và except, cho phép lập trình viên xử lý ngoại lệ một
                    cách có kiểm soát, thay vì để chương trình bị dừng lại đột ngột.</p>
                <h3>Hàm trong Python</h3>
                <p>Hàm giúp tổ chức mã lệnh thành các phần nhỏ gọn và có thể tái sử dụng. Python cho phép lập trình viên
                    định nghĩa hàm với từ khóa def, và sử dụng các hàm để thực hiện các nhiệm vụ cụ thể mà không cần lặp
                    lại cùng một đoạn mã nhiều lần. Hàm cũng có thể nhận tham số và trả về giá trị.</p>
                <div class="section">
                    <section>
                        <h3><a href="chapter2.php">Chương 2: Cấu trúc điều kiên, vòng lập và hàm trong python</a></h3>
                        <a href="chapter2_1.php">Cấu trúc điều kiện.</a>
                        <a href="chapter2_2.php">Vòng lập trong python.</a>
                        <a href="chapter2_3.php">try và except trong python.</a>
                        <a href="chapter2_4.php">Hàm trong python.</a>
                        <a href="exercise2.php">Bài tập chương 2</a>
                    </section>
                </div>
                <div class="display">
                    <a href="exercise1.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Bài tập chương 1</div>
                        </div>
                    </a>

                    <a href="chapter2_1.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Cấu trúc điều kiện.</div>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="space">

        </div>
    </div>
    <script src="static/javascript/main.js"></script>
</body>

</html>