<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/index.css">
    <link rel="stylesheet" href="static/css/formula.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>MATPLOTLIB</h3>
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
                <p>Matplotlib là một thư viện vẽ đồ thị mạnh mẽ trong Python, được sử dụng rộng rãi để trực quan hóa dữ
                    liệu. Nó cho phép tạo nhiều loại biểu đồ như biểu đồ đường, biểu đồ cột, biểu đồ tán xạ, biểu đồ
                    tròn, v.v. Matplotlib đặc biệt hữu ích trong khoa học dữ liệu và học máy khi cần biểu diễn dữ liệu
                    một cách trực quan để phân tích và ra quyết định.</p>
                <h3>Một số tính năng chính của matplotlib</h3>
                <p>• Dễ sử dụng: Matplotlib có cú pháp đơn giản, dễ hiểu và dễ sử dụng, đặc biệt khi bạn chỉ cần vẽ các
                    biểu đồ cơ bản. Bạn có thể tạo biểu đồ chỉ với một vài dòng mã.</p>
                <p>• Linh hoạt và mạnh mẽ: Thư viện này cung cấp các công cụ để tạo ra các biểu đồ có tính tùy biến cao.
                    Bạn có thể tùy chỉnh mọi yếu tố của biểu đồ như kích thước, màu sắc, chú thích, nhãn, tỷ lệ trục,
                    v.v.</p>
                <p>• Khả năng hiển thị dữ liệu đa dạng: Matplotlib hỗ trợ nhiều loại biểu đồ, từ biểu đồ cơ bản đến các
                    biểu đồ phức tạp hơn như 3D, biểu đồ con, biểu đồ phân tán (scatter plots) với nhiều kích thước và
                    màu sắc khác nhau, biểu đồ kết hợp (như biểu đồ cột kết hợp với đường).</p>
                <p>• Khả năng tích hợp với các thư viện khác: Matplotlib dễ dàng tích hợp với các thư viện khác như
                    NumPy, Pandas, SciPy, và thậm chí là Seaborn để mở rộng khả năng vẽ đồ thị và phân tích dữ liệu.</p>
                <p>• Chế độ tương tác: Bạn có thể sử dụng Matplotlib ở chế độ tương tác trong môi trường như Jupyter
                    Notebook để thử nghiệm nhanh và trực quan hóa dữ liệu ngay lập tức.</p>
                <h3>Cài đặt thư viện cho bài học</h3>
                <p>Trước khi bắt đầu làm việc , bạn cần cài đặt chúng trong môi trường Python (nếu chưa cài đặt). Dưới
                    đây là cách cài đặt nhanh chóng:</p>
                <p><b style="color: #000;">Cài đặt Matplotlib:</b></p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">pip install matplotlib</span></p>
                    </div>
                </div>
                <p><b style="color: #000;">Cài đặt NumPy:</b></p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">pip install numpy</span></p>
                    </div>
                </div>
                <p>Sau khi cài đặt, bạn có thể kiểm tra bằng cách nhập chúng vào Python:</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">import matplotlib.pyplot as plt </span></p>
                        <p><span class="keyword">import numpy as np </span></p>
                    </div>
                </div>
                <p>Nếu không có lỗi, quá trình cài đặt đã thành công!</p>
                <div class="section">
                    <section>
                        <h3><a href="chapter6.php">Chương 6: MATPLOTLIB</a></h3>
                        <a href="chapter6_1.php">Pyplot cơ bản.</a>
                        <a href="chapter6_2.php">Lưu biểu đồ.</a>
                        <a href="exercise6.php">Bài tập chương 6</a>
                    </section>
                </div>
                <div class="display">
                    <a href="exercise5.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Bài tập chương 5.</div>
                        </div>
                    </a>

                    <a href="chapter6_1.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Pyplot cơ bản.</div>
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