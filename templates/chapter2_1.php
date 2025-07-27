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
        <h1 class="main-title">GIỚI THIỆU CHUNG VỀ PYTHON</h1>
        <p class="subtitle">
            <a href="#">Chương 1: Giới thiệu chung</a> > <a href="#">Làm quen với Python</a>
        </p>
    </div>

    <div class="title-section">
        <h1 class="main-title">CÂU ĐIỀU KIỆN</h1>
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
                <h3>Cấu trúc chỉ có ‘if’</h3>
                <p>Trong Python, cấu trúc if được sử dụng để kiểm tra một điều kiện cụ thể và quyết định xem một đoạn mã
                    có nên được thực thi hay không. Nếu điều kiện được đánh giá là đúng (True), chương trình sẽ thực thi
                    khối lệnh bên trong if. Ngược lại, nếu điều kiện sai (False), khối lệnh sẽ bị bỏ qua và chương trình
                    tiếp tục thực thi các câu lệnh tiếp theo bên ngoài khối if. Đây là một trong những cấu trúc điều
                    khiển quan trọng giúp lập trình viên xây dựng logic linh hoạt và kiểm soát luồng thực thi của chương
                    trình một cách hiệu quả.</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">if</span> (điều kiện):</p>
                        <p class="indent">Đoạn mã được thực thi</p>
                        <p>Đoạn mã không nằm trong if</p>
                    </div>
                </div>
                <p><b> Ví dụ về cấu trúc ‘if’ với điều kiện đúng:</b></p>

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
                                <button id="runButton12"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton12"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent12"><span style="color: #4f96e7;">a</span> = 1</code></pre>
                            <pre><code id="codeContent12"><span style="color: #c108da;">if</span> <span style="color: #4f96e7;">a</span> == 1:</code></pre>
                            <pre><code id="codeContent12">  print(<span>"Điều kiện này là True"</span>)</code></pre>
                            <pre><code id="codeContent12">print(<span style="color: #4f96e7;">a</span>)</code></pre>
                        </div>
                        <div class="output" id="output12"></div>
                    </div>
                </div>

                <p><b>Ví dụ về cấu trúc ‘if’ với điều kiện sai:</b></p>

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
                                <button id="runButton13"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton13"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent13"><span style="color: #4f96e7;">a</span> = 1</code></pre>
                            <pre><code id="codeContent13"><span style="color: #c108da;">if</span> <span style="color: #4f96e7;">a</span> == 2:</code></pre>
                            <pre><code id="codeContent13">  print(<span>"Điều kiện này là True"</span>)</code></pre>
                            <pre><code id="codeContent13">print(<span style="color: #4f96e7;">a</span>)</code></pre>
                        </div>
                        <div class="output" id="output13"></div>
                    </div>
                </div>

                <h3>Cấu trúc ‘if-else’</h3>
                <p>Cấu trúc điều kiện if-else trong Python cho phép bạn thực hiện các hành động khác nhau dựa trên việc
                    điều kiện được kiểm tra có đúng hay không. Đây là một trong những cấu trúc điều kiện cơ bản và quan
                    trọng nhất trong lập trình.</p>
                <p>- Phần if: Kiểm tra điều kiện. Nếu điều kiện đúng (True), các câu lệnh trong khối if sẽ được thực
                    thi.</p>
                <p>- Phần else: Thực hiện các câu lệnh khác nếu điều kiện trong phần if không đúng (False).</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">if</span> (điều kiện đúng):</p>
                        <p class="indent">Các câu lệnh nếu điều kiện đúng</p>
                        <p><span class="keyword">else</span>:</p>
                        <p class="indent">Các câu lệnh nếu điều kiện sai</p>
                        <p>Đoạn mã không nằm trong if</p>
                    </div>
                </div>
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
                                <button id="runButton14"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton14"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent14"><span style="color: #4f96e7;">a</span> = 1</code></pre>
                            <pre><code id="codeContent14"><span style="color: #c108da;">if</span> <span style="color: #4f96e7;">a</span> == 1:</code></pre>
                            <pre><code id="codeContent14">  print(<span>"điều kiện là đúng."</span>)</code></pre>
                            <pre><code id="codeContent14"><span style="color: #c108da;">else</span>:</code></pre>
                            <pre><code id="codeContent14">  print(<span>"điều kiện là sai."</span>)</code></pre>
                            <pre><code id="codeContent14">print(<span>('lưu ý tab trong if else')</span>)</code></pre>
                        </div>
                        <div class="output" id="output14"></div>
                    </div>
                </div>
                <h3>Cấu trúc ‘if-elif-else’</h3>
                <p>Cấu trúc if-elif-else trong Python cho phép bạn kiểm tra nhiều điều kiện khác nhau và thực hiện các
                    hành động khác nhau dựa trên các điều kiện đó. Đây là một phần mở rộng của cấu trúc if-else, giúp
                    bạn xử lý nhiều tình huống khác nhau hơn.</p>
                <p>- Phần if: Kiểm tra điều kiện đầu tiên. Nếu điều kiện này đúng (True), các câu lệnh trong khối if sẽ
                    được thực thi.</p>
                <p>- Phần elif: Viết tắt của "else if". Đây là phần kiểm tra các điều kiện bổ sung nếu điều kiện trong
                    if không đúng. Bạn có thể có nhiều khối elif để kiểm tra nhiều điều kiện khác nhau.</p>
                <p>- Phần else: Thực hiện các câu lệnh nếu tất cả các điều kiện trong phần if và elif đều không đúng.
                    Phần này là tùy chọn.</p>

                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">if</span> ( điều kiện 1):</p>
                        <p class="indent">các câu lệnh nếu điều kiện 1 đúng</p>
                        <p><span class="keyword">if</span> ( điều kiện 2):</p>
                        <p>...</p>
                        <p class="indent">các câu lệnh nếu điều kiện 2 đúng</p>
                        <p><span class="keyword">else</span>:</p>
                        <p class="indent">Các câu lệnh nếu tất cả các điều kiện không đúngi</p>
                        <p>Lệnh không nằm trong if-elif-else</p>
                    </div>
                </div>

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
                                <button id="runButton15"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton15"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent15"><span style="color: #4f96e7;">a</span> = 3</code></pre>
                            <pre><code id="codeContent15"><span style="color: #c108da;">if</span> <span style="color: #4f96e7;">a</span> == 1:</code></pre>
                            <pre><code id="codeContent15">  print(<span>"điều kiện 1 là đúng."</span>)</code></pre>
                            <pre><code id="codeContent15"><span style="color: #c108da;">elif</span> <span style="color: #4f96e7;">a</span> == 2:</code></pre>
                            <pre><code id="codeContent15">  print(<span>"điều kiện 2 là đúng."</span>)</code></pre>
                            <pre><code id="codeContent15"><span style="color: #c108da;">elif</span> <span style="color: #4f96e7;">a</span> == 3:</code></pre>
                            <pre><code id="codeContent15">  print(<span>"điều kiện 3 là đúng."</span>)</code></pre>
                            <pre><code id="codeContent15"><span style="color: #c108da;">else</span>:</code></pre>
                            <pre><code id="codeContent15">  print(<span>"Không có điều kiện nào đúng."</span>)</code></pre>
                            <pre><code id="codeContent15">print(<span>('lưu ý tab trong if-elif-else')</span>)</code></pre>
                        </div>
                        <div class="output" id="output15"></div>
                    </div>
                </div>

                <h3>Cấu trúc if lồng nhau.</h3>
                <p>Trong Python, việc sử dụng các câu lệnh if lồng nhau là một phương pháp mạnh mẽ để kiểm tra nhiều
                    điều kiện liên tiếp, đặc biệt khi logic của chương trình đòi hỏi phải ra quyết định dựa trên nhiều
                    yếu tố khác nhau. Việc lồng các câu lệnh if cho phép tạo ra các khối điều kiện theo tầng, nơi một
                    điều kiện chỉ được kiểm tra nếu các điều kiện trước đó đã được thỏa mãn. Điều này rất hữu ích trong
                    các tình huống mà bạn cần phải kiểm soát chặt chẽ luồng thực thi của chương trình.</p>

                <p>Khi bạn sử dụng một câu lệnh if lồng trong một câu lệnh if khác, bạn đang tạo ra một "cây điều kiện",
                    trong đó các nhánh chỉ được đi sâu hơn nếu các điều kiện tại nhánh trước đó là đúng. Điều này tạo ra
                    một hệ thống logic có trật tự, giúp chương trình chỉ thực thi các đoạn mã cần thiết, tránh kiểm tra
                    các điều kiện không cần thiết và tiết kiệm tài nguyên.</p>

                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">if</span> ( điều kiện 1):</p>
                        <p class="indent">Mã thực thi nếu điều kiện 1 đúng</p>
                        <p class="indent"><span class="keyword">if</span> (điều_kiện_2):</p>
                        <p class="double-indent">Mã thực thi nếu điều kiện 1 và điều kiện 2 đều đúng</p>
                        <p class="double-indent"><span class="keyword">if</span> (điều_kiện_3):</p>
                        <p class="triple-indent">Mã thực thi nếu điều kiện 1, điều kiện 2, và điều kiện 3 đều đúng</p>
                        <p class="double-indent"><span class="keyword">else</span>:</p>
                        <p class="triple-indent">Mã thực thi nếu điều kiện 1 và điều kiện 2 đúng, nhưng điều kiện 3 sai
                        </p>
                        <p class="indent"><span class="keyword">else</span>:</p>
                        <p class="double-indent">Mã thực thi nếu điều kiện 1 đúng nhưng điều kiện 2 sai</p>
                        <p><span class="keyword">else</span>:</p>
                        <p class="indent">Mã thực thi nếu điều kiện 1 sai</p>
                    </div>
                </div>

                <p><b>Giải thích:</b></p>
                <p>- Điều kiện 1 được kiểm tra đầu tiên. Nếu điều_kiện_1 đúng (True), chương trình sẽ tiếp tục kiểm tra
                    điều_kiện_2.</p>
                <p>- Nếu điều_kiện_2 đúng, chương trình sẽ tiếp tục kiểm tra điều_kiện_3.</p>
                <p>- Nếu tất cả các điều kiện trên đều đúng, chương trình sẽ thực hiện đoạn mã tương ứng. Nếu một trong
                    các điều kiện sai, chương trình sẽ bỏ qua các kiểm tra tiếp theo và thực hiện các hành động khác.
                </p>

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
                                <button id="runButton16"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton16"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent16"><span style="color: #4f96e7;">age</span> = 22</code></pre>
                            <pre><code id="codeContent16"><span style="color: #4f96e7;">income</span> = 45000</code></pre>
                            <pre><code id="codeContent16"><span style="color: #4f96e7;">credit_score</span> = 720</code></pre>
                            <pre><code id="codeContent16"><span style="color: #c108da;">if</span> <span style="color: #4f96e7;">age</span> >= 18:</code></pre>
                            <pre><code id="codeContent16">  print(<span>"Bạn đủ tuổi để đăng ký thẻ tín dụng."</span>)</code></pre>
                            <pre><code id="codeContent16"><span style="color: #c108da;">  if</span> <span style="color: #4f96e7;">income</span> >= 30000:</code></pre>
                            <pre><code id="codeContent16">    print(<span>"Thu nhập của bạn đủ điều kiện."</span>)</code></pre>
                            <pre><code id="codeContent16"><span style="color: #c108da;">    if</span> <span style="color: #4f96e7;">credit_score</span> >= 650:</code></pre>
                            <pre><code id="codeContent16">      print(<span>"Điểm tín dụng của bạn đủ tốt"</span>)</code></pre>
                            <pre><code id="codeContent16">      print(<span>"Bạn đủ điều kiện nhận thẻ tín dụng!"</span>)</code></pre>
                            <pre><code id="codeContent16"><span style="color: #c108da;">    else</span>:</code></pre>
                            <pre><code id="codeContent16">      print(<span>"Điểm tín dụng của bạn không đủ để nhận thẻ tín dụng."</span>)</code></pre>
                            <pre><code id="codeContent16"><span style="color: #c108da;">  else</span>:</code></pre>
                            <pre><code id="codeContent16">    print(<span>"Thu nhập của bạn không đủ điều kiện."</span>)</code></pre>
                            <pre><code id="codeContent16"><span style="color: #c108da;">else</span>:</code></pre>
                            <pre><code id="codeContent16">  print(<span>"Bạn chưa đủ tuổi để đăng ký thẻ tín dụng."</span>)</code></pre>
                        </div>
                        <div class="output" id="output16"></div>
                    </div>
                </div>

                <p>Ngoài cấu trúc if lồng nhau, bạn cũng có thể sử dụng kết hợp if, elif, và else để xây dựng các nhánh
                    điều kiện phức tạp. Việc kết hợp các cấu trúc này cho phép bạn kiểm tra nhiều điều kiện một cách có
                    tổ chức, giúp mã nguồn dễ đọc và quản lý hơn. Cấu trúc này rất linh hoạt và có thể áp dụng cho nhiều
                    tình huống khác nhau, từ các bài toán đơn giản đến các logic phức tạp trong lập trình.</p>

                <p>Khi sử dụng kết hợp if, elif, và else, bạn có thể tạo ra các nhánh điều kiện hoạt động độc lập nhưng
                    có liên kết logic với nhau. Mỗi nhánh elif là một điều kiện thay thế cho các nhánh trước đó, và chỉ
                    được kiểm tra nếu tất cả các điều kiện trước đó đều không thỏa mãn. Điều này giúp bạn xử lý các
                    trường hợp loại trừ lẫn nhau một cách hiệu quả. Cấu trúc else cuối cùng đóng vai trò là một phương
                    án dự phòng, được thực hiện khi không có điều kiện nào trong các nhánh if và elif là đúng. Điều này
                    giúp đảm bảo rằng chương trình của bạn sẽ luôn có một nhánh được thực thi, ngay cả khi không có điều
                    kiện cụ thể nào thỏa mãn. Cách tiếp cận này không chỉ làm cho mã nguồn dễ hiểu hơn mà còn giúp bạn
                    kiểm soát rõ ràng luồng logic, đặc biệt trong các ứng dụng đòi hỏi phải ra quyết định phức tạp.</p>

                <div class="display">
                    <a href="chapter2.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Giới thiệu chương 2</div>
                        </div>
                    </a>

                    <a href="chapter2_2.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Vòng lập trong python.</div>
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
    <script src="static/javascript/study.js"></script>

</body>
</html>
