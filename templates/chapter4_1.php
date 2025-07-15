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
        <h3>MODULE</h3>
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
                <h3>Module trong python là gì ?</h3>
                <p>Module trong Python là một tệp chứa mã Python, trong đó có thể bao gồm các hàm (functions), lớp
                    (classes), biến (variables) cùng với các đoạn mã thực thi khác. Việc sử dụng module giúp tổ chức mã
                    nguồn thành các phần nhỏ hơn, giúp dễ dàng quản lý, tái sử dụng và bảo trì chương trình một cách
                    hiệu quả.</p>
                <h3>Lợi ích của Module</h3>
                <p><b>Tái sử dụng mã:</b> Một module có thể được sử dụng lại nhiều lần trong các
                    chương trình khác nhau mà không cần viết lại mã.</p>
                <p><b>Dễ bảo trì:</b> Khi chương trình phát triển lớn hơn, việc chia thành các module giúp dễ dàng cập
                    nhật và sửa lỗi mà không ảnh hưởng đến toàn bộ hệ thống.</p>
                <p><b>Tổ chức mã tốt hơn:</b> Giúp chia chương trình thành nhiều phần có chức năng riêng biệt, dễ hiểu
                    và dễ quản lý hơn.</p>
                <p><b>Tránh xung đột tên biến:</b> Các module có không gian tên riêng, giúp tránh xung đột khi làm việc
                    với nhiều biến và hàm có cùng tên.</p>
                <h3>Cách tạo và sử dụng Module trong Python</h3>
                <p>Để sử dụng một module, trước tiên chúng ta cần tạo một tệp .py chứa các hàm (functions), biến
                    (variables) và lớp (classes) mà chúng ta muốn sử dụng. Sau đó, trong một chương trình khác, ta có
                    thể import module này để truy cập và sử dụng các thành phần bên trong nó.</p>
                <p><b>Tạo Một Module</b></p>
                <p>Để tạo một module, bạn chỉ cần tạo một tệp có phần mở rộng <b>.py</b> và định nghĩa các thành phần
                    cần thiết bên trong nó. Module này có thể chứa các <b>biến toàn cục</b>, <b>hàm</b>, <b>lớp</b> hoặc
                    thậm chí các đoạn mã thực thi.
                </p>
                <p>Ví dụ, giả sử bạn muốn tạo một module để xử lý các thao tác cơ bản với chuỗi, bạn có thể đặt tên cho
                    tệp là <b>my_module.py</b> và thêm các nội dung sau vào:</p>

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
                                <button id="copyButton48"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent48"><span style="color: #4f96e7;">def</span> add(a, b):</code></pre>
                            <pre><code id="codeContent48">    <span style="color: #4f96e7;">return</span> a + b</code></pre>
                            <pre><code id="codeContent48"><span style="color: #4f96e7;">def</span> subtract(a, b):</code></pre>
                            <pre><code id="codeContent48">    <span style="color: #4f96e7;">return</span> a - b</code></pre>
                        </div>
                    </div>
                </div>

                <p><b>Sử Dụng Module Trong Một Chương Trình Khác</b></p>
                <p>Sau khi đã tạo module my_module.py, bạn có thể dễ dàng sử dụng nó trong một tệp Python khác bằng cách
                    import module này.</p>
                <p>Giả sử bạn có một tệp <b>test.py</b>, và bạn muốn truy cập các hàm, biến và lớp được định nghĩa trong
                    <b>my_module.py</b>, bạn có thể thực hiện bằng cách import module vào chương trình của mình và gọi
                    các thành phần cần sử dụng.
                </p>
                <div class="folder_main">
                    <div class="folder_content">
                        <h3>Cấu Trúc Thư Mục</h3>
                        <ul class="tree">
                            <li class="folder">project_root/
                                <ul>
                                    <li class="folder">python/
                                        <ul>
                                            <li class="file">my_module.py</li>
                                            <li class="file">test.py</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <p>Từ cấu trúc thư mục trên, ta có thể sử dụng <b>my_module.py</b> trong <b>test.py</b> bằng cách import
                    module và gọi các thành phần cần thiết. Dưới đây là một số cách để thực hiện điều đó:</p>

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
                                <button id="copyButton49"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent49"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">module</span></code></pre>
                            <pre><code id="codeContent49"><span style="color: #4f96e7;">x</span> = 5</code></pre>
                            <pre><code id="codeContent49"><span style="color: #4f96e7;">y</span> = 10</code></pre>
                            <pre><code id="codeContent49"><span style="color: #4f96e7;">total</span> = <span style="color: #4cca76;">module</span>.add(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>)</code></pre>
                            <pre><code id="codeContent49"><span style="color: #4f96e7;">subtract</span> = <span style="color: #4cca76;">module</span>.subtract(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>)</code></pre>
                            <pre><code id="codeContent49">print(<span>'total: '</span>, total)</code></pre>
                            <pre><code id="codeContent49">print(<span>'subtract: '</span>, subtract)</code></pre>
                        </div>

                    </div>
                </div>

                <p><b>Import Cụ Thể Một Thành Phần Trong Module</b></p>
                <p>Trong nhiều trường hợp, bạn chỉ cần sử dụng một số hàm, biến hoặc lớp cụ thể trong module thay vì
                    import toàn bộ. Điều này giúp mã nguồn ngắn gọn, dễ đọc hơn và tránh việc nạp không cần thiết các
                    thành phần không sử dụng.</p>
                <p>Khi import một phần cụ thể từ module, bạn có thể gọi trực tiếp mà không cần sử dụng tên module làm
                    tiền tố, giúp mã nguồn trở nên rõ ràng và dễ hiểu hơn.Dưới đây là cách thực hiện:</p>

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
                                <button id="copyButton50"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent50"><span style="color: #c108da;">from</span> <span style="color: #4cca76;">module</span> <span style="color: #c108da;">import</span> <span style="color: #4f96e7;">total</span></code></pre>
                            <pre><code id="codeContent50"><span style="color: #4f96e7;">x</span> = 5</code></pre>
                            <pre><code id="codeContent50"><span style="color: #4f96e7;">y</span> = 10</code></pre>
                            <pre><code id="codeContent50"><span style="color: #4f96e7;">result</span> = total(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>)</code></pre>
                            <pre><code id="codeContent50">print(<span>'total: '</span>, result)</code></pre>
                        </div>
                    </div>
                </div>

                <div class="display">
                    <a href="chapter4.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Giới thiệu chương 4.</div>
                        </div>
                    </a>

                    <a href="chapter4_2.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Package trong python.</div>
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