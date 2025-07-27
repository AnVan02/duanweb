<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="shortcut icon" href="../RS_icon.jpg" />
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>CHƯƠNG TRÌNH ĐẦU TIÊN LÀM QUEN VỚI PYTHON</h3>
        <button onclick="logout()" class="logout-btn">
            <i class="fa fa-sign-out-alt">Thoát</i>
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
                <h3>Bước Đầu Làm Quen Với Python: Chương Trình "Hello, World!"</h3>
                <p>Khi bắt đầu học Python, chương trình đầu tiên mà hầu hết mọi người viết thường là "Hello, World!".
                    Đây là một cách đơn giản nhưng hiệu quả để làm quen với cú pháp cơ bản và cách thức chạy một đoạn mã
                    Python. Việc in ra dòng chữ này không chỉ giúp bạn kiểm tra môi trường lập trình mà còn tạo động lực
                    cho hành trình khám phá ngôn ngữ mạnh mẽ này.</p>

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
                                <button id="runButton6"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton6"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent6">print<span>("Hello World!")</span></code></pre>
                        </div>
                        <div class="output" id="output6"></div>
                    </div>
                </div>

                <p>• print() là một hàm tích hợp trong Python dùng để in thông tin ra màn hình.</p>
                <p>• Cụm từ "Hello, World!" là chuỗi ký tự bạn muốn hiển thị.</p>
                <p>• Lệnh print có cú pháp đầy đủ như sau:</p>
                <p style="text-align: center;"><b>print( object(s), sep=separator, end=end, file=file, flush=flush)</b>
                </p>
                <p>• Trong đó:</p>
                <p>- Object(s): Các đối tượng hoặc chuỗi bạn muốn in ra. Bạn có thể truyền vào nhiều đối tượng, được
                    phân cách bằng dấu phẩy.</p>
                <p>- Separator: Không bắt buộc. Chuỗi được chèn vào giữa các đối tượng khi bạn in nhiều đối tượng. Giá
                    trị mặc định là một dấu cách (' ').</p>

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
                                <button id="runButton7"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton7"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent7">print<span>("Hello", "World!",sep="-")</span></code></pre>
                        </div>
                        <div class="output" id="output7"></div>
                    </div>
                </div>

                <p>- End: Không bắt buộc. Chuỗi được thêm vào cuối kết quả in ra. Mặc định là một dòng mới ('\n').</p>

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
                                <button id="runButton8"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton8"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent8">print<span>("Hello", end="!")</span></code></pre>
                            <pre><code id="codeContent8">print<span>("World!")</span></code></pre>
                        </div>
                        <div class="output" id="output8"></div>
                    </div>
                </div>

                <p>- File: Không bắt buộc. Đối tượng tệp mà bạn muốn ghi kết quả vào. Mặc định là sys.stdout, tức là in
                    ra màn hình. Bạn có thể thay đổi nó để ghi vào một tệp</p>
                <p>- Flush: Một giá trị boolean, xác định xem đầu ra có được đẩy ngay lập tức đến tệp hoặc bộ đệm hay
                    không. Mặc định là False</p>

                <h3>Nhận Dữ Liệu Từ Người Dùng Bằng Lệnh input()</h3>
                <p>Lệnh <span>input()</span> được sử dụng để nhận dữ liệu từ người dùng trong Python. Khi chương trình
                    thực thi đến
                    lệnh này, nó sẽ tạm dừng và chờ người dùng nhập dữ liệu từ bàn phím. Giá trị nhập vào luôn được trả
                    về dưới dạng chuỗi (string).</p>
                <p style="text-align: center;"><b>variable = input(prompt)</b></p>
                <p>• prompt (tùy chọn) là chuỗi hiển thị để hướng dẫn người dùng nhập dữ liệu.</p>
                <p>• variable là biến dùng để lưu trữ dữ liệu mà người dùng nhập vào.</p>
                <div class="display">
                    <a href="chapter1.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Tổng quan về ngôn ngữ lập trình python.</div>
                        </div>
                    </a>

                    <a href="chapter1_2.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Biến và các kiểu dữ liệu cơ bản trong python.</div>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

       
    </div>
    <script src="static/javascript/main.js"></script>
    <script src="static/javascript/code.js"></script>
   
</body>

</html>