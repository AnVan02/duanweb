<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/chapter1_1.css">
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
        <h3>LƯU BIỂU ĐỒ</h3>
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
                <p>Matplotlib hỗ trợ nhiều định dạng hình ảnh khác nhau cho việc lưu biểu đồ, bao gồm:</p>
                <p>• PNG (Portable Network Graphics): Định dạng phổ biến, hỗ trợ nền trong suốt và không bị mất chất
                    lượng khi nén.</p>
                <p>• JPEG (Joint Photographic Experts Group): Thích hợp cho hình ảnh có nhiều màu sắc nhưng không hỗ trợ
                    trong suốt và có thể mất chất lượng khi nén.</p>
                <p>• PDF (Portable Document Format): Thích hợp cho tài liệu in ấn và cung cấp độ phân giải cao.</p>
                <p>• SVG (Scalable Vector Graphics): Định dạng vector, có thể phóng to mà không bị mất chất lượng, thích
                    hợp cho đồ họa vector.</p>
                <p>Hàm plt.savefig() được sử dụng để lưu biểu đồ. Cú pháp như sau:</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">plt.savefig</span>('tên_file.ext', format='định_dạng', dpi=300,
                            bbox_inches='tight')</p>
                    </div>
                </div>
                <p>- 'tên_file.ext': Tên file đầu ra với định dạng mong muốn (vd: bieu_do.png).</p>
                <p>- format: Định dạng file (có thể bỏ qua nếu đuôi file đã chỉ định).</p>
                <p>- dpi: Độ phân giải của hình ảnh (dots per inch). Giá trị cao hơn sẽ tạo ra hình ảnh sắc nét hơn,
                    nhưng cũng làm tăng kích thước file.</p>
                <p>- bbox_inches: Điều chỉnh vùng hiển thị của biểu đồ. Giá trị 'tight' giúp cắt bớt không gian trắng
                    xung quanh biểu đồ.</p>
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
                                <button id="copyButton67"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent67"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">matplotlib.pyplot</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">plt</span></code></pre>
                            <pre><code id="codeContent67"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">numpy</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">np</span></code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">np</span>.random.seed(0)</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4f96e7;">data</span> = <span style="color: #4cca76;">np</span>.random.randn(1000)</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">plt</span>.figure(figsize=(10,6))</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">plt</span>.hist(<span style="color: #4f96e7;">data</span>, bins=30, color=<span>'blue'</span>, alpha=0.7, edgecolor=<span>'black'</span>)</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">plt</span>.title(<span>"Biểu đồ tần suất"</span>)</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">plt</span>.xlabel(<span>'x'</span>)</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">plt</span>.ylabel(<span>'y'</span>)</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">plt</span>.savefig(<span>'bieu_do.png'</span>, dpi=300)</code></pre>
                            <pre><code id="codeContent67"><span style="color: #4cca76;">plt</span>.show()</code></pre>
                        </div>
                    </div>
                </div>
                <p>Sau khi thực thi đoạn mã Python, hình ảnh biểu đồ sẽ được tạo và lưu lại trong thư mục. Dưới
                    đây là mô tả chi tiết về cách hình ảnh được lưu và tổ chức trong thư mục:</p>
                <div class="folder_main">
                    <div class="folder_content">
                        <h3>Cấu Trúc Thư Mục</h3>
                        <ul class="tree">
                            <li class="folder">project_root/
                                <ul>
                                    <li class="folder">python/
                                        <ul>
                                            <li class="file">test.py</li>
                                            <li class="file">bieu_do.png</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <p>Như vậy, sau khi thực thi đoạn mã Python, hình ảnh bieu_do.png sẽ được tự động tạo và lưu trong thư
                    mục project_root/, giúp bạn dễ dàng quản lý và sử dụng. </p>
                <div class="display">
                    <a href="chapter6_1.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Pyplot trong matplotlib.</div>
                        </div>
                    </a>

                    <a href="exercise6.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Bài tập chương 6.</div>
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