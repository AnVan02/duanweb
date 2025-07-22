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
        <h3>VÒNG LẬP TRONG PYTHON</h3>
        <button onclick="goToTest()" class="logout-btn">
            <i class="fa fa-sign-out-alt">Kiểm tra</i>
        </button>
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
                <h3>Vỏng lập ‘for’</h3>
                <p>Vòng lặp for trong Python là một cấu trúc rất linh hoạt và mạnh mẽ, cho phép bạn lặp qua các phần tử
                    trong một chuỗi, danh sách, tuple, từ điển, hoặc bất kỳ đối tượng nào có tính chất lặp lại
                    (iterable). Với vòng lặp for, bạn có thể duyệt qua từng phần tử của một tập hợp dữ liệu một cách dễ
                    dàng, thực hiện các hành động cụ thể trên từng phần tử mà không cần phải viết mã lặp lại nhiều lần.
                    Điều này không chỉ giúp bạn tiết kiệm thời gian mà còn làm cho mã nguồn trở nên gọn gàng và dễ bảo
                    trì hơn.</p>
                <p>Trong Python, vòng lặp for khác biệt so với một số ngôn ngữ lập trình khác. Thay vì lặp qua một chỉ
                    số như trong C hay Java, vòng lặp for của Python lặp trực tiếp qua các phần tử của một đối tượng có
                    thể lặp lại. Điều này có nghĩa là bạn có thể dễ dàng lặp qua các phần tử của một danh sách, chuỗi,
                    hoặc bất kỳ đối tượng nào mà bạn có thể tưởng tượng.</p>
                <p>Cú pháp cơ bản của vòng lập ‘for’:</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">for</span> ‘phần tử’ in ‘iterable’:</p>
                        <p class="indent">Các lệnh bên trong vòng lập</p>
                        <p>Lệnh không nằm trong vòng lập</p>
                    </div>
                </div>
                <p>Giải thích:</p>
                <p>- Phần tử: là biến tạm thời, nó sẽ nhận giá trị của từng phần tử trong đối tượng ‘iterable’ ở mỗi
                    vòng lập</p>
                <p>- iterable: là bất kỳ đối tượng nào có thể lập (danh sách, chuỗi, tuple, số, dictionary)</p>
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
                                <button id="runButton17"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton17"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent17"><span style="color: #4f96e7;">fruits </span> = [<span>"apple", "banana", "cherry"</span>]</code></pre>
                            <pre><code id="codeContent17"><span style="color: #c108da;">for</span> <span style="color: #4f96e7;">fruit</span> <span style="color: #c108da;">in</span> <span style="color: #4f96e7;">fruits</span>:</code></pre>
                            <pre><code id="codeContent17">  print(<span style="color: #4f96e7;">fruit</span>)</code></pre>
                        </div>
                        <div class="output" id="output17"></div>
                    </div>
                </div>
                <h3>Vòng lập ‘while’.</h3>
                <p>Vòng lặp while trong Python là một cấu trúc điều khiển mạnh mẽ cho phép bạn lặp lại một khối lệnh
                    nhiều lần cho đến khi một điều kiện cụ thể không còn đúng nữa. Điều này rất hữu ích trong các tình
                    huống mà bạn không biết trước số lần lặp chính xác, nhưng muốn tiếp tục thực hiện một công việc cho
                    đến khi đạt được một trạng thái hoặc điều kiện nào đó.</p>
                <p>Khi vòng lặp while được thực thi, điều kiện trong câu lệnh while sẽ được đánh giá. Nếu điều kiện này
                    là True, khối lệnh bên trong vòng lặp sẽ được thực hiện. Sau khi hoàn thành khối lệnh, điều kiện sẽ
                    được đánh giá lại. Quá trình này sẽ lặp lại cho đến khi điều kiện trở thành False. Khi điều kiện trở
                    thành False, vòng lặp sẽ dừng lại và chương trình sẽ tiếp tục với các câu lệnh sau vòng lặp.</p>
                <p>Vòng lặp while đặc biệt hữu ích trong các tình huống như:</p>
                <p><b>- Những tình huống không xác định trước số lần lặp:</b> Ví dụ như đọc dữ liệu từ người dùng cho
                    đến khi nhận được giá trị hợp lệ, hoặc tiếp tục thử kết nối mạng cho đến khi thành công.</p>
                <p><b>- Xử lý các nhiệm vụ không dự đoán trước:</b> Như là tìm kiếm trong một danh sách cho đến khi tìm
                    thấy mục tiêu hoặc không còn mục tiêu để tìm kiếm.</p>
                <p><b>- Vòng lặp điều kiện:</b> Nơi điều kiện thay đổi dần dần qua mỗi lần lặp, như là giải quyết bài
                    toán theo từng bước hoặc cập nhật trạng thái dựa trên các phép toán trong mỗi vòng lặp.</p>
                <p>Cú pháp cơ bản của vòng lập ‘while’:</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">while</span>(điều kiện):</p>
                        <p class="indent">Các câu lênh được thực hiên trong ‘while’</p>
                    </div>
                </div>
                <p>- Điều_kiện: là một biểu thức logic (Boolean expression) mà Python sẽ đánh giá là True hoặc False.
                </p>
                <p>- Nếu điều_kiện là True, các lệnh trong khối lệnh của vòng lặp sẽ được thực hiện. Sau khi khối lệnh
                    hoàn tất, điều kiện sẽ được kiểm tra lại. Nếu điều kiện vẫn là True, vòng lặp tiếp tục chạy. Nếu
                    điều kiện trở thành False, vòng lặp sẽ dừng lại và điều khiển sẽ chuyển đến câu lệnh tiếp theo sau
                    vòng lặp.</p>
                <p>- Vòng lặp while sẽ dừng lại khi điều kiện lặp trở thành False. Điều này có thể xảy ra theo nhiều
                    cách:</p>
                <p>• Điều kiện tự thay đổi: Nếu điều kiện lặp thay đổi trong quá trình thực hiện vòng lặp, nó có thể trở
                    thành False và làm cho vòng lặp dừng lại.Ví dụ:</p>

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
                                <button id="runButton19"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton19"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent19"><span style="color: #4f96e7;">count</span> = 0</code></pre>
                            <pre><code id="codeContent19"><span style="color: #c108da;">while</span> <span style="color: #4f96e7;">count</span> < 5:</code></pre>
                            <pre><code id="codeContent19">  print(<span>"Giá trị của count:"</span>,<span style="color: #4f96e7;">count</span>)</code></pre>
                            <pre><code id="codeContent19">  <span style="color: #4f96e7;">count</span>+=1</code></pre>
                        </div>
                        <div class="output" id="output19"></div>
                    </div>
                </div>

                <p>• Điều kiện không bao giớ sai: Nếu điều kiện không bao giờ trở thành False, vòng lặp sẽ trở thành
                    vòng lặp vô hạn. Để tránh điều này, cần đảm bảo rằng điều kiện lặp sẽ thay đổi trong vòng lặp hoặc
                    sử dụng lệnh break để thoát vòng lặp. Ví dụ:</p>

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
                                <button id="runButton20"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton20"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent20"><span style="color: #4f96e7;">count</span> = 0</code></pre>
                            <pre><code id="codeContent20"><span style="color: #c108da;">while</span> <span style="color: #4f96e7;">count</span> < 5:</code></pre>
                            <pre><code id="codeContent20">  print(<span>"Giá trị của count:"</span>,<span style="color: #4f96e7;">count</span>)</code></pre>
                            <pre><code id="codeContent20">  <span style="color: #c108da;">break</span></code></pre>
                        </div>
                        <div class="output" id="output20"></div>
                    </div>
                </div>

                <div class="display">
                    <a href="chapter2_1.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Cấu trúc điều kiện.</div>
                        </div>
                    </a>

                    <a href="chapter2_3.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">try và except trong python.</div>
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