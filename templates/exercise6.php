<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link rel="stylesheet" href="static/css/table.css">
    <link rel="stylesheet" href="static/css/code_running.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>BÀI TẬP CHƯƠNG 4</h3>
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
                <h3>Phần bài tập</h3>
                <p>1. Một thành phố có 4 khu vực với tỉ lệ dân số lần lượt là: 25%, 35%, 20%, và 20%. Hãy sử dụng
                    matplotlib để vẽ biểu đồ tròn thể hiện tỉ lệ dân số của từng khu vực, đồng thời thêm nhãn và phần
                    trăm để hiển thị cụ thể từng khu vực trên biểu đồ.</p>
                <p>2. Giả sử có điểm kiểm tra của 5 học sinh như sau: [7, 8, 9, 6, 7]. Hãy sử dụng biểu đồ thanh (bar
                    chart) để vẽ và so sánh điểm số của từng học sinh. Đặt tên cho các cột là tên học sinh từ A đến E.
                </p>
                <p>3. Vẽ biểu đồ đường của hàm số y = x^2 trong khoảng từ -10 đến 10. Hãy tính giá trị y cho từng giá
                    trị x trong khoảng này và dùng matplotlib để vẽ biểu đồ thể hiện đồ thị của hàm số này.</p>
                <p>4. Bạn có dữ liệu về nhiệt độ của một ngày tại một thành phố, đo mỗi giờ từ 0 giờ đến 23 giờ. Dữ liệu
                    nhiệt độ biến đổi theo công thức: T = 20 + 10*sin(2*pi*t/24) trong đó t là giờ trong ngày (từ 0 đến
                    23). Hãy vẽ biểu đồ đường để thể hiện sự biến đổi nhiệt độ theo giờ trong ngày và đánh dấu giờ có
                    nhiệt độ cao nhất và thấp nhất.</p>
                <!-- code -->
                <div class="code_running">
                    <div class="top-bar">
                        <span>💻 Python Online</span>
                        <button class="btn-run" onclick="runPython()"><i class="fa fa-play"></i> Chạy Code</button>
                    </div>
                    <div class="editor-container">
                        <textarea id="codeInput"></textarea>
                    </div>
                    <div class="output-container" id="output">Đang chờ code...</div>
                </div>
                <!-- code -->
                <div class="display">
                    <a href="chapter6_2.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Lưu biểu đồ trong matplotlib.</div>
                        </div>
                    </a>
                    <a href="index.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Giới thiệu khóa học.</div>
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
    <script src="static/javascript/code.js"></script>
    <script src="static/javascript/code_running.js"></script>
</body>

</html>