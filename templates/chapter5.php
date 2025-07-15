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
        <h3>PANDAS</h3>
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
                <p> Pandas là một thư viện mã nguồn mở mạnh mẽ trong Python, được sử dụng rộng rãi cho việc thao tác và
                    phân tích dữ liệu. Thư viện này cung cấp các cấu trúc dữ liệu trực quan, dễ sử dụng và các công cụ
                    mạnh mẽ để xử lý dữ liệu có cấu trúc, đặc biệt là DataFrame.Với khả năng xử lý dữ liệu hiệu quả,
                    pandas giúp đơn giản hóa việc làm việc với các tập dữ liệu phức tạp, cho phép người dùng dễ dàng
                    truy vấn, biến đổi và phân tích dữ liệu từ nhiều nguồn khác nhau.Pandas có 3 kiểu cấu trúc dữ liệu:
                </p>
                <h3>Series</h3>
                <p>Là cấu trúc dữ liệu một chiều, tương tự như mảng hoặc danh sách trong Python. Mỗi phần tử trong
                    Series có một chỉ mục (index) tương ứng, giúp truy cập dữ liệu dễ dàng..</p>
                <h3>DataFrame</h3>
                <p>Đây là cấu trúc dữ liệu hai chiều, tương tự như bảng dữ liệu với các hàng và cột (giống bảng trong
                    Excel hoặc cơ sở dữ liệu). DataFrame là loại cấu trúc dữ liệu phổ biến nhất trong pandas, cho phép
                    bạn lưu trữ, thao tác và phân tích dữ liệu có cấu trúc một cách linh hoạt.</p>
                <h3>Panel</h3>
                <p>Đây là cấu trúc dữ liệu ba chiều, ít được sử dụng hơn so với Series và DataFrame. Panel phù hợp để
                    làm việc với dữ liệu nhiều chiều, nhưng hiện tại, nó đã bị loại bỏ kể từ phiên bản Pandas 1.0. Người
                    dùng có thể sử dụng các cấu trúc dữ liệu khác như MultiIndex DataFrame hoặc xarray để làm việc với
                    dữ liệu ba chiều hoặc nhiều hơn.</p>
                <div class="section">
                    <section>
                        <h3><a href="chapter5.php">Chương 5: PANDAS</a></h3>
                        <a href="chapter5_1.php">Series.</a>
                        <a href="chapter5_2.php">Dataframe.</a>
                        <a href="exercise5.php">Bài tập chương 5</a>
                    </section>
                </div>
                <div class="display">
                    <a href="exercise4.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Bài tập chương 4.</div>
                        </div>
                    </a>

                    <a href="chapter5_1.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Series trong python.</div>
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