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
        <h3>SERIES</h3>
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
                <h3>Series là gì?</h3>
                <p>Series là một cấu trúc dữ liệu một chiều tương tự như mảng (array) trong NumPy, nhưng có khả năng gán
                    nhãn (index) cho các giá trị của nó. Điều này giúp bạn truy cập và thao tác với dữ liệu dễ dàng hơn.
                    Mỗi phần tử trong Series được gắn với một chỉ mục, và bạn có thể truy cập phần tử dựa trên chỉ mục
                    đó.</p>
                <h3>Cú pháp tạo một Series</h3>
                <p>Để tạo một <b>series</b> trong <b>pandas</b> ta sử dụng cú pháp sau:</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp :<span class="keyword">pandas.Series</span>(data, index, dtype, copy)</p>
                    </div>
                </div>

                <p><b>data</b> Dữ liệu đầu vào có thể thuộc nhiều dạng khác nhau, bao gồm:</p>
                <p>• List hoặc tuple trong Python</p>
                <p>• Mảng NumPy (numpy array)</p>
                <p>• Từ điển (dictionary)</p>
                <p>• Một giá trị đơn lẻ (constant)</p>
                <p>- <b>index</b> (tùy chọn):</p>
                <p>• Là danh sách các nhãn dùng làm chỉ mục cho Series.</p>
                <p>• Nếu không cung cấp, Pandas sẽ tự động tạo chỉ mục mặc định từ 0 đến n-1 (với n là số phần tử trong
                    data).</p>
                <p>• Chỉ mục cần đảm bảo duy nhất (không trùng lặp).</p>
                <p>- <b>dtype</b> (tùy chọn):</p>
                <p>• Xác định kiểu dữ liệu của các phần tử trong Series.</p>
                <p>• Nếu không được chỉ định, Pandas sẽ tự động suy luận từ data.</p>
                <p>- <b>copy</b> (tùy chọn, mặc định là False):</p>
                <p>• Nếu copy=True, Pandas sẽ tạo một bản sao của data thay vì tham chiếu trực tiếp đến dữ liệu gốc.</p>
                <p>• Điều này hữu ích khi bạn không muốn ảnh hưởng đến dữ liệu ban đầu trong quá trình xử lý.</p>
                <h3>Các cách tạo một Series trong Pandas</h3>
                <p><b>Tạo Series từ danh sách (List)</b></p>
                <p>Bạn có thể tạo một Series từ một danh sách Python bằng cách truyền danh sách vào pd.Series(). Nếu
                    không cung cấp index, Pandas sẽ tự động tạo chỉ mục từ 0 đến n-1.</p>

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
                                <button id="runButton53"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton53"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent53"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent53"><span style="color: #4f96e7;">data</span> = [10, 20, 30, 40]</code></pre>
                            <pre><code id="codeContent53"><span style="color: #4f96e7;">series</span> = <span style="color: #4cca76;">pd</span>.Series(<span style="color: #4f96e7;">data</span>)</code></pre>
                            <pre><code id="codeContent53">print(<span style="color: #4f96e7;">series</span>)</code></pre>
                        </div>
                        <div class="output" id="output53"></div>
                    </div>
                </div>

                <p>• Pandas tự động gán chỉ mục mặc định (0, 1, 2, 3) tương ứng với từng phần tử trong danh sách.</p>
                <p>• Kiểu dữ liệu được suy luận là int64 vì tất cả các phần tử trong danh sách đều là số nguyên.</p>
                <p><b>Tạo Series từ danh sách có index tùy chỉnh</b></p>
                <p>Thay vì chỉ mục mặc định (0, 1, 2, 3), ta chỉ định các index ['a', 'b', 'c', 'd'].</p>
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
                                <button id="runButton54"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton54"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent54"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent54"><span style="color: #4f96e7;">data</span> = [10, 20, 30, 40]</code></pre>
                            <pre><code id="codeContent54"><span style="color: #4f96e7;">series</span> = <span style="color: #4cca76;">pd</span>.Series(<span style="color: #4f96e7;">data</span>,<span style="color: #4f96e7;">index</span>=<span style="color: #c108da;">(<span>'a', 'b', 'c', 'd'</span>)</span>)</code></pre>
                            <pre><code id="codeContent54">print(<span style="color: #4f96e7;">series</span>)</code></pre>
                        </div>
                        <div class="output" id="output54"></div>
                    </div>
                </div>
                <p>Điều này có thể giúp người dùng trong việc truy xuất dữ liệu dễ dàng hơn vì có thể dùng series['b']
                    để lấy giá trị thay vì
                    series[1].</p>

                <p><b>Tạo Series từ từ điển (Dictionary).</b></p>
                <p>Khi tạo một Series từ một từ điển (dict), các khóa (keys) của dictionary sẽ trở thành chỉ mục
                    (index), còn các giá trị (values) sẽ trở thành dữ liệu của Series.</p>

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
                                <button id="runButton55"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton55"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent55"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent55"><span style="color: #4f96e7;">data</span> = {<span>'apple'</span>: 3, <span>'banana'</span>: 5, <span>'cherry'</span>: 2}</code></pre>
                            <pre><code id="codeContent55"><span style="color: #4f96e7;">series</span> = <span style="color: #4cca76;">pd</span>.Series(<span style="color: #4f96e7;">data</span>)</code></pre>
                            <pre><code id="codeContent55">print(<span style="color: #4f96e7;">series</span>)</code></pre>
                        </div>
                        <div class="output" id="output55"></div>
                    </div>
                </div>
                <p>• apple, banana, cherry trở thành index của Series.</p>
                <p>• 3, 5, 2 là các giá trị tương ứng</p>
                <p>• Pandas tự động nhận diên kiểu dữ liệu của các giá trị (int64)</p>

                <p><b>Tạo Series từ một giá trị duy nhất (Constant)</b></p>
                <p>Nếu bạn muốn tạo một Series trong đó tất cả các phần tử có cùng một giá trị, bạn có thể truyền giá
                    trị đó vào pd.Series(), kèm theo danh sách index.</p>

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
                                <button id="runButton56"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton56"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent56"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent56"><span style="color: #4f96e7;">data</span> = 100</code></pre>
                            <pre><code id="codeContent56"><span style="color: #4f96e7;">series</span> = <span style="color: #4cca76;">pd</span>.Series(<span style="color: #4f96e7;">data</span>,<span style="color: #4f96e7;">index</span>=<span style="color: #c108da;">(<span>'a', 'b', 'c', 'd'</span>)</span>)</code></pre>
                            <pre><code id="codeContent56">print(<span style="color: #4f96e7;">series</span>)</code></pre>
                        </div>
                        <div class="output" id="output56"></div>
                    </div>
                </div>

                <h3>Các thao tác trên Series:</h3>


                <p>• Tất cả các phần tử trong Series có giá trị là 100.</p>
                <p>• Các chỉ mục ('a', 'b', 'c', 'd') giúp truy xuất từng phần tử dễ dàng.</p>
                <h3>Các thao tác trên Series</h3>
                <p>Pandas cung cấp nhiều thao tác hữu ích trên Series như truy xuất phần tử bằng chỉ mục, lọc dữ liệu
                    theo điều kiện, thay đổi giá trị, thực hiện các phép toán số học và thống kê. Những thao tác này
                    giúp xử lý và phân tích dữ liệu một cách linh hoạt và hiệu quả.</p>

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
                            <td>Truy cập phần tử bằng chỉ mục</td>
                            <td>Truy cập các giá trị trong Series bằng cách sử dụng chỉ mục giống như truy cập phần tử
                                trong danh sách hoặc từ điển.</td>
                            <td>print(s['a']) # Kết quả: 10</td>
                        </tr>
                        <tr>
                            <td>Truy cập bằng vị trí (iloc)</td>
                            <td>iloc[] được dùng để truy cập giá trị dựa trên vị trí (index theo thứ tự).</td>
                            <td>print(s.iloc[1]) # Kết quả: 20</td>
                        </tr>
                        <tr>
                            <td>Cập nhật giá trị</td>
                            <td>Thay đổi giá trị của một phần tử trong Series thông qua chỉ mục.</td>
                            <td>s['b'] = 25</td>
                        </tr>
                        <tr>
                            <td>Lọc dữ liệu (Slicing)</td>
                            <td>Bạn có thể cắt (slice) Series giống như các kiểu dữ liệu khác trong Python.</td>
                            <td>print(s[1:3]) # Lọc phần tử từ vị trí 1 đến 2</td>
                        </tr>
                        <tr>
                            <td>Kiểm tra phần tử có tồn tại hay không</td>
                            <td>Sử dụng toán tử in để kiểm tra một chỉ mục có tồn tại trong Series hay không.</td>
                            <td>print('b' in s) # Kết quả: True</td>
                        </tr>
                        <tr>
                            <td>Các phép toán trên Series</td>
                            <td>Series hỗ trợ các phép toán số học trực tiếp.</td>
                            <td>s + 2, s * 3, s1 + s2</td>
                        </tr>
                        <tr>
                            <td>Xử lý dữ liệu thiếu (NaN)</td>
                            <td>Series có thể chứa giá trị NaN để biểu thị dữ liệu thiếu. Có thể sử dụng các phương pháp
                                như isnull() hoặc dropna() để xử lý.</td>
                            <td>s = pd.Series([1, 2, None, 4])</td>
                        </tr>
                        <tr>
                            <td>Áp dụng hàm (apply function)</td>
                            <td>Sử dụng apply() để áp dụng một hàm cho từng giá trị trong Series.</td>
                            <td>s.apply(lambda x: x * 2)</td>
                        </tr>
                    </tbody>
                </table>

                <div class="display">
                    <a href="chapter5.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Giới thiệu chương 5.</div>
                        </div>
                    </a>

                    <a href="chapter5_2.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Dataframe trong python.</div>
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