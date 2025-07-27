<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link rel="stylesheet" href="static/css/table.css">
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
        <h3>BIẾN VÀ CÁC KIỂU DỮ LIỆU CƠ BẢN TRONG PYTHON</h3>
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
                <h3>Biến trong python</h3>
                <p>Biến số (variable) là khái niệm cơ bản trong lập trình, dùng để lưu trữ và thao tác dữ liệu. Biến
                    đóng vai trò như một nhãn gợi nhớ, giúp chương trình biết được nơi cần truy xuất dữ liệu. Việc đặt
                    tên biến rõ ràng không chỉ giúp người lập trình dễ quản lý mà còn giúp đồng nghiệp dễ hiểu khi đọc
                    mã nguồn. Một cách hình dung đơn giản là biến giống như một chiếc container chứa các loại hàng hóa
                    khác nhau, được đánh nhãn để dễ dàng xác định và truy xuất. Trong python biến được khai báo với cú
                    pháp:</p>
                <p style="text-align: center;"><b>Tên biến = ‘giá trị’</b></p>
                <p>- Tên biên: nơi gợi nhớ cho dữ liệu cần xử ly</p>
                <p>- Giá trị: giá trị khởi tạo cho biến, nó được lưu trong bộ nhớ máy tính , khi chương trình cần dùng
                    sẽ gọi đến tên biến</p>

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
                                <button id="runButton9"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton9"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent9"><span style="color: #4f96e7;">a</span> = 'Hello World'</code></pre>
                            <pre><code id="codeContent9">print(<span style="color: #4f96e7;">a</span>)</code></pre>
                        </div>
                        <div class="output" id="output9"></div>
                    </div>
                </div>

                <p><b>Quy tắc đặt tên biến:</b></p>
                <p>- Bắt đầu bằng chữ cái hoặc dấu gạch dưới (ví dụ: _temp, count, check_id)</p>
                <p>- Sau ký tự đầu tiên, tên biến có thể chứa chữ cái, chữ số (0-9) hoặc dấu gạch dưới (ví dụ:
                    total_count, max_value, temp_1)</p>
                <p>- Không bắt đầu bằng số (ví dụ: 3rd_count là không hợp lệ)</p>
                <p>- Không đặt tên trung với từ khóa của python (ví dụ: if, for, while, class ...)</p>
                <p>- Python phân biệt chữ viết hoa và viết thường nên ‘Count’ và ‘count’ là hai biến khác nhau</p>
                <h3>Các kiểu dữ liệu cở bản trong python</h3>
                <p>Python cung cấp một loạt các kiểu dữ liệu cơ bản, cho phép bạn làm việc với nhiều loại dữ liệu khác
                    nhau trong các ứng dụng của mình. Những kiểu dữ liệu này là nền tảng của ngôn ngữ lập trình, giúp
                    bạn xử lý và thao tác thông tin một cách hiệu quả. Dưới đây là các kiểu dữ liệu cơ bản trong Python,
                    cùng với mô tả chi tiết về từng loại, giúp bạn hiểu rõ hơn về cách sử dụng chúng trong mã nguồn của
                    mình.</p>

                <table>
                    <tr>
                        <th>Tên tiếng Anh</th>
                        <th>Tên kiểu dữ liệu</th>
                        <th>Danh mục kiểu dữ liệu</th>
                        <th>Mô tả</th>
                        <th>Ví dụ</th>
                    </tr>
                    <tr>
                        <td>Integer</td>
                        <td>int</td>
                        <td>Kiểu số</td>
                        <td>Số nguyên dương/âm</td>
                        <td>27</td>
                    </tr>
                    <tr>
                        <td>Floating point</td>
                        <td>float</td>
                        <td>Kiểu số</td>
                        <td>Số thực dưới dạng thập phân</td>
                        <td>3.14</td>
                    </tr>
                    <tr>
                        <td>Boolean</td>
                        <td>bool</td>
                        <td>Giá trị boolean</td>
                        <td>True hoặc False</td>
                        <td>False</td>
                    </tr>
                    <tr>
                        <td>String</td>
                        <td>str</td>
                        <td>Kiểu chuỗi</td>
                        <td>Dữ liệu văn bản</td>
                        <td>“Thủ đô Việt Nam là Hà Nội”</td>
                    </tr>
                    <tr>
                        <td>List</td>
                        <td>list</td>
                        <td>Kiểu danh sách</td>
                        <td>Tập hợp các đối tượng (có thể thay đổi và có thứ tự)</td>
                        <td>[‘hoa’, ‘lá’, ‘cành’]</td>
                    </tr>
                    <tr>
                        <td>Tuple</td>
                        <td>tuple</td>
                        <td>Kiểu bộ</td>
                        <td>Tập hợp các đối tượng (không thể thay đổi và có thứ tự)</td>
                        <td>(‘Thứ’, ‘ngày’, ‘tháng’, ‘năm’)</td>
                    </tr>
                    <tr>
                        <td>Dictionary</td>
                        <td>dict</td>
                        <td>Kiểu ánh xạ</td>
                        <td>Tập hợp các cặp khóa và giá trị</td>
                        <td>{‘Họ’: ‘Đinh’, ‘Tên’: ‘Thuần’}</td>
                    </tr>
                    <tr>
                        <td>None</td>
                        <td>NoneType</td>
                        <td>Đối tượng null</td>
                        <td>Đại diện cho không có giá trị</td>
                        <td>None</td>
                    </tr>
                </table>
                <p>Trong Python, có ba kiểu dữ liệu số chính: số nguyên (int), số thực (float) và số phức (complex).</p>
                <p>• Số nguyên (int): Đại diện cho các số nguyên dương và âm, không có phần thập phân.</p>
                <p>• Số thực (float): Đại diện cho các số có phần thập phân.</p>
                <p>• Số phức (complex): Biểu diễn số dưới dạng a + bj, trong đó a là phần thực và b là phần ảo.</p>
                <p>Để kiểm tra kiểu dữ liệu của một giá trị, ta sử dụng hàm type(), còn để hiển thị giá trị ra màn hình,
                    ta dùng hàm print().</p>

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
                                <button id="runButton10"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton10"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent10"><span style="color: #4f96e7;">a</span> = 100</code></pre>
                            <pre><code id="codeContent10">print(<span style="color: #4cca76;">type</span>(<span style="color: #4f96e7;">a</span>))</code></pre>
                            <pre><code id="codeContent10">print(<span style="color: #4f96e7;">a</span>)</code></pre>
                        </div>
                        <div class="output" id="output10"></div>
                    </div>
                </div>

                <div class="display">
                    <a href="chapter1_2.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Chương trình đầu tiên làm quen với python.</div>
                        </div>
                    </a>

                    <a href="chapter1_4.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Toán tử trong python.</div>
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