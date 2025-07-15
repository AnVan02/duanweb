<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/formula.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link rel="stylesheet" href="static/css/table.css">
    <link rel="stylesheet" href="static/css/folder.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>PACKAGE</h3>
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
                <h3>Package trong python là gì?</h3>
                <p>Package là một thư mục chứa một hoặc nhiều module hoặc các package con, được tạo ra để tổ chức và sắp
                    xếp các module có liên quan đến nhau. Mục đích chính của package là giúp phân loại các thành phần có
                    cùng chức năng hoặc mục đích, tạo ra cấu trúc dễ quản lý và bảo trì mã nguồn. Điều này không chỉ
                    giúp giữ cho dự án gọn gàng mà còn tăng khả năng tái sử dụng và tránh xung đột tên giữa các module
                    khác nhau trong hệ thống lớn.</p>
                <h3>Lợi ích của package</h3>
                <p>Việc sử dụng package trong Python mang lại nhiều lợi ích quan trọng, giúp quản lý và phát triển phần
                    mềm một cách hiệu quả hơn:</p>
                <p><b>Tổ chức mã nguồn rõ ràng:</b> Package giúp nhóm các module liên quan vào cùng một thư mục, tạo ra
                    cấu trúc dễ quản lý và duy trì.</p>
                <p><b>Tái sử dụng mã nguồn:</b> Các module bên trong package có thể được sử dụng lại trong nhiều dự án
                    mà không cần phải viết lại từ đầu.</p>
                <p><b>Tránh xung đột tên:</b> Khi dự án mở rộng, package cung cấp không gian tên riêng biệt, giúp tránh
                    trùng lặp giữa các module có cùng tên.</p>
                <p><b>Dễ bảo trì và mở rộng:</b> Việc chia nhỏ ứng dụng thành các package giúp dễ dàng nâng cấp hoặc
                    thay đổi một phần mà không ảnh hưởng đến toàn bộ hệ thống.</p>
                <p><b>Cải thiện hiệu suất phát triển:</b> Package hỗ trợ việc làm việc nhóm tốt hơn, khi nhiều lập trình
                    viên có thể phát triển các module riêng biệt mà không ảnh hưởng lẫn nhau.</p>
                <p><b>Tích hợp tốt với hệ thống lớn:</b> Trong các dự án phức tạp, package giúp tổ chức mã nguồn khoa
                    học, hỗ trợ phát triển phần mềm theo kiến trúc module hóa.</p>
                <h3>Cấu trúc của một package trong python</h3>
                <p>Trong Python, package là một thư mục đặc biệt dùng để chứa các module hoặc các package con, giúp tổ
                    chức mã nguồn một cách khoa học và dễ quản lý.</p>
                <p><b>Thành phần chính của một package</b></p>
                <p>• Thư mục package</p>
                <p>- Đây là thư mục chính của package, trong đó có thể chứa nhiều <b>module</b> (tệp .py) hoặc
                    <b>package con</b> để phân loại các chức năng liên quan.
                </p>
                <p>Tên thư mục này chính là <b>tên của package</b> và sẽ được dùng khi import vào các chương trình khác.
                </p>
                <p>• Tệp <b>__init__.py</b></p>
                <p>- Đây là tệp quan trọng, có vai trò giúp Python nhận diện thư mục đó là một package hợp lệ. Nếu không
                    có tệp này, Python sẽ không coi thư mục đó là một package.</p>
                <p>- Trong Python 3.3 trở đi, có thể không cần tệp __init__.py, nhưng việc sử dụng nó vẫn là một thực
                    tiễn tốt, giúp quản lý package hiệu quả hơn.</p>
                <p>- Tệp __init__.py có thể để trống hoặc chứa mã khởi tạo cho package, chẳng hạn như:</p>
                <p style="margin-left: 30px;"><b>+ Khai báo biến hoặc hằng số chung</b> dùng cho toàn bộ package.</p>
                <p style="margin-left: 30px;"><b>+ Import các module con</b> để khi import package, có thể sử dụng ngay
                    các module bên trong.</p>
                <p style="margin-left: 30px;"><b>+ Thực hiện các thiết lập ban đầu</b> khi package được nạp vào chương
                    trình.</p>
                <p>Giả sử bạn đang phát triển một dự án về xử lý dữ liệu, bạn có thể tổ chức package như sau:</p>

                <div class="folder_main">
                    <div class="folder_content">
                        <h3>Cấu Trúc Thư Mục</h3>
                        <ul class="tree">
                            <li class="folder">project_root/
                                <ul>
                                    <li class="folder">data_processing/
                                        <ul>
                                            <li class="file">__init__.py</li>
                                            <li class="file">module1.py</li>
                                            <li class="file">module2.py</li>
                                        </ul>
                                    </li>
                                    <li class="file">main.py</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <p>Code trong module1.py như sau:</p>
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
                                <button id="copyButton51"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent51"><span style="color: #4f96e7;">def</span> add(<span style="color: #4f96e7;">a</span>,<span style="color: #4f96e7;">b</span>):</code></pre>
                            <pre><code id="codeContent51">    <span style="color: #c108da;">return</span> <span style="color: #4f96e7;">a</span> + <span style="color: #4f96e7;">b</span></code></pre>
                            <pre><code id="codeContent51"><span style="color: #4f96e7;">def</span> subtract(<span style="color: #4f96e7;">a</span>,<span style="color: #4f96e7;">b</span>):</code></pre>
                            <pre><code id="codeContent51">    <span style="color: #c108da;">return</span> <span style="color: #4f96e7;">a</span> - <span style="color: #4f96e7;">b</span></code></pre>
                        </div>
                    </div>
                </div>
                <p>Code trong module2.py như sau:</p>
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
                                <button id="copyButton52"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent52"><span style="color: #4f96e7;">def </span>Hello(<span style="color: #4f96e7;">a</span>):</code></pre>
                            <pre><code id="codeContent52">    <span style="color: #c108da;">return</span> <span style="color: #4f96e7;">f</span><span>'Hello {<span style="color: #4f96e7;">a</span>}'</span></code></pre>
                        </div>
                    </div>
                </div>
                <p>Với cấu trúc trên, bạn có thể import và sử dụng package như sau:</p>
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
                                <button id="copyButton52"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent52"><span style="color: #c108da;">from</span> <span style="color: #4cca76;">mypackega</span> <span style="color: #c108da;">import</span> <span style="color: #4cca76;">module1</span>, <span style="color: #4cca76;">module2</span></code></pre>
                            <pre><code id="codeContent52"><span style="color: #4f96e7;">x</span> = 5</code></pre>
                            <pre><code id="codeContent52"><span style="color: #4f96e7;">y</span> = 10</code></pre>
                            <pre><code id="codeContent52"><span style="color: #4f96e7;">total</span> = <span style="color: #4cca76;">module1</span>.add(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>)</code></pre>
                            <pre><code id="codeContent52"><span style="color: #4f96e7;">subtract</span> = <span style="color: #4cca76;">module1</span>.subtract(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>)</code></pre>
                            <pre><code id="codeContent52"><span style="color: #4f96e7;">hello</span> = <span style="color: #4cca76;">module2</span>.Hello('Join')</code></pre>
                            <pre><code id="codeContent52">print(<span>'total: '</span>, <span style="color: #4f96e7;">total</span>)</code></pre>
                            <pre><code id="codeContent52">print(<span>'subtract: '</span>, <span style="color: #4f96e7;">subtract</span>)</code></pre>
                        </div>
                    </div>
                </div>
                <p>Việc tổ chức mã nguồn theo package giúp dự án có cấu trúc rõ ràng, dễ tìm kiếm và quản lý. Mỗi module
                    đảm nhiệm một chức năng cụ thể, giảm sự phụ thuộc lẫn nhau, giúp bảo trì và mở rộng hệ thống dễ dàng
                    hơn.</p>
                <p>Bên cạnh đó, package còn tăng khả năng tái sử dụng mã nguồn, tránh xung đột tên giữa các module và hỗ
                    trợ phát triển phần mềm theo hướng module hóa. Điều này giúp xây dựng các hệ thống linh hoạt, dễ mở
                    rộng và thích ứng với thay đổi nhanh chóng.</p>
                <div class="display">
                    <a href="chapter4_1.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Module trong python.</div>
                        </div>
                    </a>

                    <a href="exercise4.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Bài tập chương 4.</div>
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