<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>CÂU TRÚC DỮ LIỆU TRONG PYTHON</h3>
    </nav>
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
                <h3>Giới thiệu chung</h3>
                <p>Python cung cấp một loạt các cấu trúc dữ liệu tích hợp, linh hoạt và mạnh mẽ, giúp dễ dàng lưu trữ,
                    truy xuất, và quản lý dữ liệu. Các cấu trúc như list, tuple, dictionary, và set đều có mục đích sử
                    dụng riêng, tùy thuộc vào yêu cầu của bài toán. Hiểu rõ về chúng là nền tảng để xây dựng các chương
                    trình hiệu quả..</h3>
                <h3>List</h3>
                <p>List là một cấu trúc dữ liệu dạng mảng trong Python, có thể thay đổi (mutable), nghĩa là có thể thêm,
                    xóa, hoặc thay đổi các phần tử sau khi khởi tạo. Các phần tử trong list có thể là bất kỳ kiểu dữ
                    liệu nào và list có thể chứa các phần tử trùng lặp.</p>
                <h3>Tuples</h3>
                <p>Tuple tương tự như list nhưng không thể thay đổi (immutable). Một khi đã khởi tạo, bạn không thể thay
                    đổi nội dung của tuple. Đây là cấu trúc dữ liệu hữu ích khi cần bảo vệ dữ liệu khỏi sự thay đổi.</p>
                <h3>Dictionary</h3>
                <p>Dictionary là một cấu trúc dữ liệu lưu trữ các cặp key-value. Mỗi key là duy nhất và liên kết với một
                    value. Dictionary cho phép tra cứu nhanh chóng dựa trên key và có tính linh hoạt cao.</p>
                <h3>Set</h3>
                <p>Set là một tập hợp các phần tử không có thứ tự và không trùng lặp. Nó tương tự như các tập hợp trong
                    toán học. Set hỗ trợ các phép toán như hợp (union), giao (intersection), và trừ (difference).</p>
                <div class="section">
                    <section>
                        <h3><a href="chapter3.php">Chương 3: Cấu trúc dữ liệu trong python</a></h3>
                        <a href="chapter3_1.php">List trong python.</a>
                        <a href="chapter3_2.php">Tuples trong python.</a>
                        <a href="chapter3_3.php">Dictionary trong python.</a>
                        <a href="chapter3_4.php">Set trong python.</a>
                        <a href="exercise3.php">Bài tập chương 3</a>
                    </section>
                </div>
                <div class="display">
                    <a href="exercise2.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Bài tập chương 2.</div>
                        </div>
                    </a>

                    <a href="chapter3_1.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">List trong python.</div>
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