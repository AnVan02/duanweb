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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>TUPLES TRONG PYTHON</h3>
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
                <h3>Tuples trong python là gì?</h3>
                <p>Tuples là một kiểu dữ liệu cơ bản trong Python, tương tự như danh sách (list), nhưng có một đặc điểm
                    quan trọng khiến chúng trở nên khác biệt: Tuples là bất biến (immutable). Điều này có nghĩa là sau
                    khi một tuple được khởi tạo, các phần tử của nó không thể bị thay đổi, thêm vào, hoặc xóa bỏ. Điều
                    này đảm bảo tính toàn vẹn của dữ liệu, làm cho tuples trở thành lựa chọn lý tưởng khi bạn cần lưu
                    trữ một tập hợp các giá trị mà không mong muốn thay đổi chúng.</p>

                <h3>Cách tạo tuples</h3>
                <p>Tuple là một cấu trúc dữ liệu trong Python được khai báo bằng dấu ngoặc đơn () với các phần tử bên
                    trong được ngăn cách bằng dấu phẩy. Tuple cung cấp cách tổ chức dữ liệu một cách rõ ràng và đảm bảo
                    tính bất biến (immutable), tức là không thể thay đổi giá trị của các phần tử sau khi đã khởi tạo.
                    Điều này giúp tăng hiệu suất và đảm bảo tính toàn vẹn của dữ liệu trong quá trình xử lý.</p>
                <p>Ngoài cách khai báo trực tiếp, bạn cũng có thể tạo một tuple bằng hàm tuple(). Hàm này chuyển đổi các
                    đối tượng có thể lặp lại (iterable) như danh sách (list), chuỗi (string), hoặc các iterable khác
                    thành tuple.</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp 1:<span class="keyword">tuple_name</span> = (value1, value2, value3, ...)</p>
                        <p>Cú pháp 2:<span class="keyword">tuple_name</span> = tuple(value)</p>
                    </div>
                </div>

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
                                <button id="runButton32"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton32"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent32"><span style="color: #4f96e7;">my_tuples</span> = (1, 2, 3, <span>"apple", "banana"</span>)</code></pre>
                            <pre><code id="codeContent32">print(<span style="color: #4f96e7;">my_tuples</span>)</code></pre>
                            <pre><code id="codeContent32"><span style="color: #4f96e7;">list_data</span> = [1, 2, 3, 4, 5]</code></pre>
                            <pre><code id="codeContent32"><span style="color: #4f96e7;">tuple_from_list</span> = tuple(<span style="color: #4f96e7;">list_data</span>)</code></pre>
                            <pre><code id="codeContent32">print(<span>"Tuple từ danh sách:"</span>, <span style="color: #4f96e7;">tuple_from_list</span>)</code></pre>
                        </div>
                        <div class="output" id="output32"></div>
                    </div>
                </div>

                <h3>Truy xuất các phần tử trong tuples</h3>
                <p><b>Truy xuất Phần tử Bằng Chỉ mục:</b> Chỉ mục là số xác định vị trí phần tử trong tuple, bắt đầu từ
                    0 cho phần tử đầu tiên và tăng dần. Bạn có thể truy xuất các phần tử cụ thể từ tuple bằng chỉ mục.
                </p>

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
                                <button id="runButton33"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton33"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent33"><span style="color: #4f96e7;">my_tuple</span> = (10, 20, 30, 40, 50)</code></pre>
                            <pre><code id="codeContent33"><span style="color: #4f96e7;">first_element</span> = <span style="color: #4f96e7;">my_tuple</span>[0]</code></pre>
                            <pre><code id="codeContent33">print(<span>"Phần tử đầu tiên:"</span>, <span style="color: #4f96e7;">first_element</span>)</code></pre>
                            <pre><code id="codeContent33"><span style="color: #4f96e7;">last_element</span> = <span style="color: #4f96e7;">my_tuple</span>[-1]</code></pre>
                            <pre><code id="codeContent33">print(<span>"Phần tử cuối cùng:"</span>, <span style="color: #4f96e7;">last_element</span>)</code></pre>
                        </div>
                        <div class="output" id="output33"></div>
                    </div>
                </div>

                <p><b>Cắt Tuple:</b> Cắt tuple (slicing) là kỹ thuật giúp trích xuất một phần của tuple bằng cách chỉ
                    định khoảng chỉ mục với cú pháp start:stop:step.</p>

                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp <span class="keyword">new_tuple</span> = original_tuple[start:stop:step]</p>
                    </div>
                </div>

                <p>- Start: Chỉ mục bắt đầu (bao gồm trong kết quả).</p>
                <p>- Stop: Chỉ mục kết thúc (không bao gồm trong kết quả).</p>
                <p>- Step: Khoảng cách giữa các phần tử, mặc định là 1.</p>

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
                                <button id="runButton34"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton34"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent34"><span style="color: #4f96e7;">my_tuple</span> = (10, 20, 30, 40, 50, 60, 70, 80, 90)</code></pre>
                            <pre><code id="codeContent34"><span style="color: #4f96e7;">slice1</span> = <span style="color: #4f96e7;">my_tuple</span>[2:6]</code></pre>
                            <pre><code id="codeContent34">print(<span>"Cắt từ chỉ mục 2 đến 5:"</span>, <span style="color: #4f96e7;">slice1</span>)</code></pre>
                            <pre><code id="codeContent34"><span style="color: #4f96e7;">slice2</span> = <span style="color: #4f96e7;">my_tuple</span>[:5]</code></pre>
                            <pre><code id="codeContent34">print(<span>"Cắt từ đầu đến chỉ mục 4:"</span>, <span style="color: #4f96e7;">slice2</span>)</code></pre>
                            <pre><code id="codeContent34"><span style="color: #4f96e7;">slice3</span> = <span style="color: #4f96e7;">my_tuple</span>[4:]</code></pre>
                            <pre><code id="codeContent34">print(<span>"Cắt từ chỉ mục 4 đến hết tuple:"</span>, <span style="color: #4f96e7;">slice3</span>)</code></pre>
                            <pre><code id="codeContent34"><span style="color: #4f96e7;">slice4</span> = <span style="color: #4f96e7;">my_tuple</span>[::2]</code></pre>
                            <pre><code id="codeContent34">print(<span>"Cắt toàn bộ với bước 2:"</span>, <span style="color: #4f96e7;">slice4</span>)</code></pre>
                        </div>
                        <div class="output" id="output34"></div>
                    </div>
                </div>

                <h3>Vòng lập của tuples</h3>
                <p>Vòng lặp (looping) là kỹ thuật quan trọng trong lập trình, cho phép thực hiện các thao tác lặp đi lặp
                    lại trên các phần tử của cấu trúc dữ liệu. Đối với tuples, bạn có thể sử dụng vòng lặp để duyệt qua
                    từng phần tử và thực hiện các hành động cần thiết. Python hỗ trợ nhiều cách để lặp qua tuple, phổ
                    biến nhất là sử dụng vòng lặp for.Các phương pháp duyệt qua tuple gồm:</p>
                <p>• <b>Duyệt từng phần tử trực tiếp:</b> Lặp qua từng phần tử của tuple mà không cần quan tâm đến chỉ
                    mục.</p>
                <p>• <b>Duyệt bằng chỉ mục:</b> Sử dụng chỉ mục để truy cập từng phần tử, phù hợp khi cần biết vị trí
                    của phần tử trong tuple.</p>

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
                                <button id="runButton35"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton35"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent35"><span style="color: #4f96e7;">my_tuple</span> = (10, 20, 30)</code></pre>
                            <pre><code id="codeContent35"><span style="color: #c108da;">for</span> <span style="color: #4f96e7;">item</span> <span style="color: #c108da;">in</span> <span style="color: #4f96e7;">my_tuple</span>:</code></pre>
                            <pre><code id="codeContent35">    print(<span style="color: #4f96e7;">item</span>)</code></pre>
                            <pre><code id="codeContent35"><span style="color: #c108da;">for</span> <span style="color: #4f96e7;">index</span>, <span style="color: #4f96e7;">item</span> <span style="color: #c108da;">in</span> <span style="color: #4cca76;">enumerate</span>(<span style="color: #4f96e7;">my_tuple</span>):</code></pre>
                            <pre><code id="codeContent35">    print(<span style="color: #4f96e7;">f</span><span>"Chỉ mục <span style="color: #c108da;">{<span style="color: #4f96e7;">index</span>}</span>: <span style="color: #c108da;">{<span style="color: #4f96e7;">item</span>}</span>"</span>)</code></pre>
                        </div>
                        <div class="output" id="output35"></div>
                    </div>
                </div>
                <h3>Các phương thức cơ bản trong tuples</h3>
                <p>Mặc dù tuple trong Python là một kiểu dữ liệu bất biến (immutable), nhưng nó vẫn cung cấp một số
                    phương thức hữu ích để thao tác với dữ liệu. Các phương thức này giúp bạn tìm kiếm, đếm số lần xuất
                    hiện của phần tử và thực hiện một số thao tác quan trọng khác. Dưới đây là những phương thức phổ
                    biến thường được sử dụng khi làm việc với tuple.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Phương thức</th>
                            <th>Mô tả</th>
                            <th>Ví dụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>count()</td>
                            <td>Trả về số lần xuất hiện của một giá trị trong tuple</td>
                            <td>tuple.count(x)</td>
                        </tr>
                        <tr>
                            <td>index()</td>
                            <td>Trả về chỉ mục của phần tử đầu tiên có giá trị nhất định</td>
                            <td>tuple.index(x)</td>
                        </tr>
                    </tbody>
                </table>
                <p>Phương thức tuple.index() có hai tham số tùy chọn đặc biệt là start và end, giúp giới hạn phạm vi tìm
                    kiếm trong tuple:</p>
                <p>• start: Xác định vị trí bắt đầu tìm kiếm, bỏ qua các phần tử trước đó.</p>
                <p>• end: Xác định vị trí kết thúc tìm kiếm, bỏ qua các phần tử sau đó.</p>
                <p>Nhờ hai tham số này, ta có thể linh hoạt tìm kiếm trong một đoạn cụ thể của tuple thay vì quét toàn
                    bộ.</p>

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
                                <button id="runButton36"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton36"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent36"><span style="color: #4f96e7;">my_tuple</span> = (1, 2, 3, 2, 2, 4, 5)</code></pre>
                            <pre><code id="codeContent36"><span style="color: #4f96e7;">count_of_2</span> = <span style="color: #4f96e7;">my_tuple</span>.count(2)</code></pre>
                            <pre><code id="codeContent36">print(<span>"Số lần xuất hiện của 2:"</span>, <span style="color: #4f96e7;">count_of_2</span>)</code></pre>
                            <pre><code id="codeContent36"><span style="color: #c108da;">if</span> 3 <span style="color: #c108da;">in</span> <span style="color: #4f96e7;">my_tuple</span>:</code></pre>
                            <pre><code id="codeContent36">    <span style="color: #4f96e7;">index_of_3</span> = <span style="color: #4f96e7;">my_tuple</span>.index(3)</code></pre>
                            <pre><code id="codeContent36">    print(<span>"Chỉ mục của 3:"</span>, <span style="color: #4f96e7;">index_of_3</span>)</code></pre>
                            <pre><code id="codeContent36"><span style="color: #c108da;">if</span> 4 <span style="color: #c108da;">in</span> <span style="color: #4f96e7;">my_tuple</span>[3:]:</code></pre>
                            <pre><code id="codeContent36">    <span style="color: #4f96e7;">index_of_4</span> = <span style="color: #4f96e7;">my_tuple</span>.index(4, 3)</code></pre>
                            <pre><code id="codeContent36">    print(<span>"Chỉ mục của 4 từ chỉ mục 3:"</span>, <span style="color: #4f96e7;">index_of_4</span>)</code></pre>
                        </div>
                        <div class="output" id="output36"></div>
                    </div>
                </div>

                <div class="display">
                    <a href="chapter3_1.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">List trong python.</div>
                        </div>
                    </a>

                    <a href="chapter3_3.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Dictionary trong python.</div>
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