



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/chapter1_1.css">
     <link rel="stylesheet" href="static/css/code.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

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
        <h1 class="main-title">TỔNG QUAN VỀ NGÔN NGỮ LẬP TRÌNH TRONG PYTHON</h1>
       
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
                <h3>Giới thiệu chung.</h3>
                <p> Python là một ngôn ngữ lập trình bậc cao, dễ học và mạnh mẽ, được phát triển bởi Guido van Rossum và
                    ra mắt lần đầu vào năm 1991. Với cú pháp rõ ràng và dễ đọc, Python giúp lập trình viên tiết kiệm
                    thời gian và dễ dàng phát triển ứng dụng. Ngôn ngữ này hỗ trợ lập trình hướng đối tượng, đa hình và
                    kế thừa, cùng với việc sử dụng kiểu dữ liệu động, giúp mã nguồn trở nên ngắn gọn và dễ hiểu.</p>
                <div class="image">
                    <img src="static/image/guido-van-rossum.png">
                    <i><u>Người sáng lập ngôn ngữ lập trình python Guido van Rossum</u></i>
                </div>
                <p>Python được sử dụng rộng rãi trong nhiều lĩnh vực, từ phát triển phần mềm, khoa học dữ liệu, trí tuệ
                    nhân tạo, đến phát triển web và tự động hóa. Cộng đồng Python lớn mạnh và năng động, cung cấp vô số
                    thư viện và tài liệu hỗ trợ, giúp lập trình viên giải quyết mọi vấn đề một cách nhanh chóng. Những
                    thư viện mạnh mẽ như NumPy, pandas, và TensorFlow giúp Python trở thành công cụ lý tưởng cho các dự
                    án phức tạp.</p>
                <h3>Các phiên bản của python</h3>
                <p>Python đã trải qua nhiều giai đoạn phát triển quan trọng, với mỗi phiên bản mang đến những cải tiến
                    về cú pháp, hiệu suất và khả năng mở rộng. Phiên bản đầu tiên, Python 0.9, ra mắt năm 1991, giới
                    thiệu các khái niệm lập trình quan trọng như lớp (class), ngoại lệ (exception), và kiểu dữ liệu cơ
                    bản. Đến năm 1994, Python 1.0 chính thức được phát hành, bổ sung thư viện tiêu chuẩn như sys, os, và
                    re, giúp xử lý chuỗi, tệp tin và tương tác với hệ điều hành hiệu quả hơn.</p>
                <p>Năm 2000, Python 2.0 ra đời với những cải tiến như bộ thu gom rác tự động (garbage collection) và
                    danh sách (list comprehensions), giúp tối ưu hóa mã nguồn. Dòng Python 2.x tiếp tục phát triển
                    nhưng gặp nhiều hạn chế, đặc biệt là vấn đề tương thích với Unicode. Do đó, vào năm 2008, Python 3.0
                    được phát hành, mang lại sự thay đổi lớn về cú pháp, hỗ trợ tốt hơn cho Unicode và tối ưu hóa hiệu
                    suất. Tuy nhiên, do sự khác biệt lớn giữa Python 2 và Python 3, nhiều dự án tiếp tục sử dụng Python
                    2.7 (2010) trong thời gian dài, trước khi Python 2 chính thức ngừng hỗ trợ vào năm 2020. Hiện nay,
                    Python 3.x vẫn liên tục được cải tiến và trở thành tiêu chuẩn cho các ứng dụng từ phát triển phần
                    mềm, khoa học dữ liệu, đến trí tuệ nhân tạo.</p>
                <div class="image">
                    <img src="static/image/python_version.png">
                    <i><u>Qúa trình phát triển của python</u></i>
                </div>
                <h3>Sự khác biệt giữa Python 2 và Python 3</h3>
                <p>Python 2 và Python 3 có nhiều điểm khác biệt về cú pháp, cách xử lý toán học, cũng như khả năng tương
                    thích với thư viện. Dưới đây là một số thay đổi quan trọng giữa hai phiên bản:</p>
                <p><b>1. Cú pháp in dữ liệu</b></p>
                <p>Trong Python 2, print được sử dụng như một câu lệnh, không yêu cầu dấu ngoặc đơn:</p>
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
                                <button id="copyButton1"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent1">print <span>"Hello, World!"</span></code></pre>
                        </div>
                    </div>
                </div>
                <p>Trong khi đó, Python 3 coi print là một hàm, yêu cầu sử dụng dấu ngoặc đơn:</p>
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
                                <button id="copyButton2"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent2">print<span>("Hello, World!")</span></code></pre>
                        </div>
                    </div>
                </div>
                <p>Cách tiếp cận mới giúp Python 3 nhất quán hơn với cú pháp của các hàm khác trong ngôn ngữ.</p>
                <p><b>2. Phép chia số nguyên</b></p>
                <p>Một trong những thay đổi quan trọng nhất giữa hai phiên bản là cách xử lý phép chia:</p>
                <p>• Trong Python 2, phép chia hai số nguyên sẽ tự động làm tròn xuống số nguyên gần nhất:</p>
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
                                <button id="copyButton3"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent3">print 5 / 2  <span style="color: #4cca76;"># Kết quả: 2</span></code></pre>
                        </div>
                    </div>
                </div>
                <p>• Trong Python 3, phép chia / luôn trả về số thực, ngay cả khi hai số chia là số nguyên:</p>
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
                                <button id="copyButton4"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent4">print(5 / 2)  <span style="color: #4cca76;"># Kết quả: 2.5</span></code></pre>
                        </div>
                    </div>
                </div>
                <p>• Nếu muốn chia lấy số nguyên trong Python 3, bạn cần dùng //:</p>
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
                                <button id="copyButton5"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <code
                                id="codeContent5">print(5 // 2)  <span style="color: #4cca76;"># Kết quả: 2</span></code>
                        </div>
                    </div>
                </div>
                <p><b>3. Hỗ trợ thư viện</b></p>
                <p>Với sự phát triển mạnh mẽ của Python 3, ngày càng nhiều thư viện quan trọng đã ngừng hỗ trợ Python 2
                    để tập trung vào hiệu suất, bảo mật và khả năng mở rộng. Python 3 không chỉ mang lại cú pháp rõ
                    ràng, hỗ trợ Unicode tốt hơn mà còn giúp các thư viện khai thác tối đa các công nghệ hiện đại như
                    lập trình bất đồng bộ, xử lý song song và tối ưu hóa bộ nhớ. Vì vậy, phần lớn các thư viện phổ biến
                    trong lĩnh vực phát triển web, khoa học dữ liệu, trí tuệ nhân tạo và tự động hóa hiện nay đều chỉ hỗ
                    trợ Python 3. Dưới đây là một số thư viện quan trọng đã hoàn toàn chuyển sang Python 3:</p>
                <p>• <b>Django:</b> Đây là một trong những framework web mạnh mẽ nhất dành cho Python. Kể từ các phiên
                    bản mới nhất, Django đã loại bỏ hoàn toàn khả năng tương thích với Python 2 để tận dụng những cải
                    tiến về cú pháp, bảo mật và hiệu suất của Python 3. Việc chuyển sang Python 3 giúp Django hỗ trợ tốt
                    hơn các công nghệ hiện đại như WebSockets, xử lý bất đồng bộ và bảo mật nâng cao. </p>
                <p>• <b>TensorFlow:</b> Là một trong những thư viện hàng đầu trong lĩnh vực học sâu (Deep Learning),
                    TensorFlow đã chính thức ngừng hỗ trợ Python 2 từ phiên bản 2.x. Việc này giúp TensorFlow tận dụng
                    các tính năng mới của Python 3, chẳng hạn như xử lý số học hiệu quả hơn, hỗ trợ tốt hơn cho kiểu dữ
                    liệu NumPy, và tối ưu hóa hiệu suất khi chạy trên phần cứng chuyên dụng như GPU và TPU..</p>
                <p>• <b>Pandas:</b> Đây là thư viện quan trọng trong lĩnh vực khoa học dữ liệu và xử lý dữ liệu lớn. Các
                    phiên bản mới nhất của Pandas chỉ hỗ trợ Python 3, giúp cải thiện tốc độ xử lý dữ liệu, tối ưu bộ
                    nhớ và hỗ trợ tốt hơn các kiểu dữ liệu hiện đại như Categorical và Datetime64..</p>
            </div>
        </div>
    </div>
    
   <div class="navigation">
        <a href="chapter1.php" class="select">
            <div class="arrow">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="text-container_left">
                <div class="previously">PREVIOUSLY</div>
                <div class="link">Tổng quan chương 1.</div>
            </div>
        </a>

        <a href="chapter1_2.php" class="select">
            <div class="text-container_right">
                <div class="previously">UP NEXT</div>
                <div class="link">Chương trình đầu tiên làm quen với python.</div>
            </div>
            <div class="arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>
    </div>
    <script src="static/javascript/main.js"></script>
    <!-- <script src="static/javascript/code.js"></script> -->
    <script src="static/javascript/study.js"></script>
</body>

</html>