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
        <h3>GIỚI THIỆU CHUNG VỀ PYTHON</h3>
        <div onclick="logout()" class="logout-btn">
            <a class="fa fa-sign-out-alt" style="color: #4f96e7"></a> Quay lại
        </div>
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
            <h3><a href="chapter4.php">Chương 4: Module và package</a></h3>
            <a href="chapter4_1.php">Module.</a>
            <a href="chapter4_2.php">package.</a>
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
                <h3>Giới thiệu chung về Python</h3>
                <p>Python là một ngôn ngữ lập trình cực kỳ phổ biến, dễ học và dễ sử dụng. Nếu bạn là người mới bắt đầu
                    lập
                    trình, Python chính là lựa chọn tuyệt vời để bắt đầu. Với cú pháp đơn giản và dễ hiểu, Python giúp
                    bạn lập
                    trình nhanh chóng mà không gặp phải quá nhiều khó khăn.</p>

                <h3>Python Làm Được Gì?</h3>
                <div class="feature">
                    <img src="https://img.icons8.com/color/48/000000/python.png" alt="Python">
                    <p>Python có thể được sử dụng trong rất nhiều lĩnh vực khác nhau, bao gồm:</p>
                </div>

                <ul>
                    <li><b>Phát triển web:</b> Với các framework như <b>Django</b> và <b>Flask</b>, bạn có thể tạo ra
                        các
                        website và ứng dụng web tuyệt vời.</li>
                    <li><b>Khoa học dữ liệu:</b> Sử dụng Python với các thư viện như <b>Pandas</b>, <b>NumPy</b> để phân
                        tích và
                        trực quan hóa dữ liệu một cách dễ dàng.</li>
                    <li><b>Trí tuệ nhân tạo:</b> Với TensorFlow, PyTorch, bạn có thể tạo ra các mô hình học máy và trí
                        tuệ nhân
                        tạo mạnh mẽ.</li>
                    <li><b>Tự động hóa:</b> Python giúp bạn tự động hóa các công việc lặp đi lặp lại, giúp tiết kiệm
                        thời gian
                        và công sức.</li>
                </ul>

                <h3>Các Ngành Nghề Dùng Python</h3>
                <div class="card">
                    <h4>Khoa học Dữ liệu</h4>
                    <p>Python là ngôn ngữ chính trong việc phân tích, xử lý dữ liệu và trực quan hóa. Với các công cụ
                        như
                        Pandas, NumPy và Matplotlib, bạn có thể dễ dàng làm việc với dữ liệu lớn và xây dựng các mô hình
                        phân
                        tích hiệu quả.</p>
                </div>

                <div class="card">
                    <h4>Phát triển Web</h4>
                    <p>Python giúp xây dựng các ứng dụng web mạnh mẽ với Django và Flask. Bạn có thể tạo ra các website,
                        blog,
                        và hệ thống quản lý dễ dàng.</p>
                </div>

                <div class="card">
                    <h4>Trí tuệ Nhân tạo</h4>
                    <p>Các chuyên gia AI sử dụng Python để phát triển các mô hình dự đoán, nhận diện hình ảnh, và xử lý
                        ngôn ngữ
                        tự nhiên.</p>
                </div>
                <div class="section">
                    <section>
                        <h3><a href="chapter1.php">Chương 1:Giới thiệu chung về Python</a></h3>
                        <a href="chapter1_1.php">Tổng quan về ngôn ngữ lập trình python.</a>
                        <a href="chapter1_2.php">Chương trình đầu tiên làm quen với python.</a>
                        <a href="chapter1_3.php">Biến và các kiểu dữ liệu cơ bản trong python.</a>
                        <a href="chapter1_4.php">Toán tử trong python.</a>
                        <a href="exercise1.php">Bài tập chương 1</a>
                    </section>
                    <section>
                        <h3><a href="chapter2.php">Chương 2: Cấu trúc điều kiên, vòng lập và hàm trong
                                python</a></h3>
                        <a href="chapter2_1.php">Cấu trúc điều kiện.</a>
                        <a href="chapter2_2.php">Vòng lập trong python.</a>
                        <a href="chapter2_3.php">try và except trong python.</a>
                        <a href="chapter2_4.php">Hàm trong python.</a>
                        <a href="exercise2.php">Bài tập chương 2</a>
                    </section>
                    <section>
                        <h3><a href="chapter3.php">Chương 3: Cấu trúc dữ liệu trong python</a></h3>
                        <a href="chapter3_1.php">List trong python.</a>
                        <a href="chapter3_2.php">Tuples trong python.</a>
                        <a href="chapter3_3.php">Dictionary trong python.</a>
                        <a href="chapter3_4.php">Set trong python.</a>
                        <a href="exercise3.php">Bài tập chương 3</a>
                    </section>
                    <section>
                        <h3><a href="chapter4.php">Chương 4: Module và package</a></h3>
                        <a href="chapter4_1.php">Module.</a>
                        <a href="chapter4_2.php">package.</a>
                        <a href="exercise4.php">Bài tập chương 4</a>
                    </section>
                    <section>
                        <h3><a href="chapter5.php">Chương 5: PANDAS</a></h3>
                        <a href="chapter5_1.php">Series.</a>
                        <a href="chapter5_2.php">Dataframe.</a>
                        <a href="exercise5.php">Bài tập chương 5</a>
                    </section>
                    <section>
                        <h3><a href="chapter6.php">Chương 6: MATPLOTLIB</a></h3>
                        <a href="chapter6_1.php">Pyplot cơ bản.</a>
                        <a href="chapter6_2.php">Lưu biểu đồ.</a>
                        <a href="exercise6.php">Bài tập chương 6</a>
                    </section>
                </div>
            </div>
        </div>
        <div class="space">
        </div>
    </div>
    <script src="static/javascript/main.js"></script>
    <script>
         function logout() {
            window.location.href = "../overview.php";
        }
    </script>
</body>

</html>