<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/formula.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>TRY VÀ EXCEPT TRONG PYTHON</h3>
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
                <p> Trong Python, việc xử lý các lỗi hoặc ngoại lệ là rất quan trọng để đảm bảo chương trình hoạt động
                    ổn định ngay cả khi gặp phải các tình huống bất ngờ. Để xử lý các ngoại lệ, Python cung cấp các câu
                    lệnh try và except. Những câu lệnh này giúp bạn quản lý các lỗi có thể xảy ra trong quá trình thực
                    thi chương trình mà không làm cho chương trình bị ngừng đột ngột.</p>
                <p>Cú pháp cơ bản:</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">try</span>:</p>
                        <p class="indent">Khối lệnh có thể gây ra ngoại lệ</p>
                        <p><span class="keyword">except</span>‘loại ngoại lệ’:</p>
                        <p class="indent">Khối lệnh xử lý ngoại lệ</p>
                    </div>
                </div>
                <p>- Khối try: Đây là nơi bạn đặt các lệnh có thể gây ra lỗi. Python sẽ thực hiện các lệnh trong khối
                    try và nếu không có lỗi nào xảy ra, khối except sẽ bị bỏ qua.</p>
                <p>- Khối except: Đây là nơi bạn xử lý các ngoại lệ mà khối try có thể gặp phải. Nếu một lỗi xảy ra
                    trong khối try, Python sẽ chuyển đến khối except tương ứng để xử lý lỗi đó.</p>
                <p><b>Ví dụ:</b></p>
                <div class="main_code">
                    <div class="example">
                        <div class="header">
                            <div class="circle">
                                <svg width="30" height="30">
                                    <circle cx="10" cy="10" r="8" fill="red" />
                                </svg>

                                <svg width="30" height="30">
                                    <circle cx="10" cy="10" r="8" fill="yellow" />
                                </svg>

                                <svg width="30" height="30">
                                    <circle cx="10" cy="10" r="8" fill="green" />
                                </svg>
                                <p>>_ python</p>
                            </div>
                            <div class="button">
                                <button id="runButton21"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton21"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent21"><span style="color: #4f96e7;">name</span> = <span>'Nguyễn Văn A'</span></code></pre>
                            <pre><code id="codeContent21"><span style="color: #4f96e7;">age</span> = 20</code></pre>
                            <pre><code id="codeContent21"><span style="color: #c108da;">try</span>:</code></pre>
                            <pre><code id="codeContent21">  <span style="color: #4f96e7;">data</span> = <span style="color: #4f96e7;">name</span> + <span style="color: #4f96e7;">age</span></code></pre>
                            <pre><code id="codeContent21">  print(<span style="color: #4f96e7;">data</span>)</code></pre>
                            <pre><code id="codeContent21"><span style="color: #c108da;">except</span> <span style="color: #4cca76;">Exception</span> <span style="color: #c108da;">as</span> <span style="color: #4f96e7;">e</span>:</code></pre>
                            <pre><code id="codeContent21">  print(<span style="color: #4f96e7;">e</span>)</code></pre>
                        </div>
                        <div class="output" id="output21"></div>
                    </div>
                </div>

                <p>Trong đoạn mã trên, chúng ta gặp lỗi vì đang cố gắng cộng (+) một chuỗi (name) với một số nguyên
                    (age). Python không cho phép nối chuỗi với số nguyên trực tiếp, dẫn đến ngoại lệ TypeError.</p>
                <p>Khi lỗi xảy ra, chương trình sẽ không dừng lại mà thay vào đó, khối except sẽ xử lý lỗi và in ra
                    thông báo lỗi tương ứng.</p>

                <div class="display">
                    <a href="chapter2_2.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Vòng lập trong python.</div>
                        </div>
                    </a>

                    <a href="chapter2_4.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Hàm trong python.</div>
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
</body>

</html>