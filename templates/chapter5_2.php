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
        <h3>DATAFRAME</h3>
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
                <h3>Dataframe là gì?</h3>
                <p>DataFrame là một cấu trúc dữ liệu hai chiều trong Pandas, tương tự như một bảng tính hoặc một bảng
                    trong cơ sở dữ liệu, với dữ liệu được tổ chức theo hàng và cột. Đây là một trong những cấu trúc quan
                    trọng và linh hoạt nhất của Pandas, cho phép lưu trữ, xử lý và phân tích dữ liệu có cấu trúc một
                    cách hiệu quả.</p>
                <h3>Cách tạo dataframe</h3>
                <p>Có nhiều cách để tạo một DataFrame trong Pandas, bao gồm từ danh sách, từ từ điển, từ mảng NumPy hoặc
                    từ tệp dữ liệu. Mỗi phương pháp đều có ưu điểm riêng, giúp linh hoạt trong việc xử lý và phân tích
                    dữ liệu.</p>
                <p><b>Tạo từ từ điển (dictionary)</b></p>
                <p>Một trong những cách phổ biến và trực quan nhất để tạo DataFrame trong Pandas là sử dụng từ điển
                    (dictionary). Trong đó, các khóa (keys) của từ điển sẽ đại diện cho tên các cột, còn giá trị
                    (values) là danh sách chứa các phần tử tương ứng trong từng cột.</p>

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
                                <button id="runButton57"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton57"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent57"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent57"><span style="color: #4f96e7;">data</span> = {</code></pre>
                            <pre><code id="codeContent57">    <span>'Name'</span>: [<span>'Join', 'Anna', 'Peter'</span>],</code></pre>
                            <pre><code id="codeContent57">    <span>'Age'</span>: [28, 24, 35],</code></pre>
                            <pre><code id="codeContent57">    <span>'City'</span>: [<span>'New York', 'Paris', 'London'</span>]</code></pre>
                            <pre><code id="codeContent57">}</code></pre>
                            <pre><code id="codeContent57"><span style="color: #4f96e7;">df</span> = <span style="color: #4cca76;">pd</span>.DataFrame(<span style="color: #4f96e7;">data</span>)</code></pre>
                            <pre><code id="codeContent57">print(<span style="color: #4f96e7;">df</span>)</code></pre>
                        </div>

                        <div class="output" id="output57"></div>
                    </div>
                </div>
                <p>Cách này giúp tổ chức dữ liệu một cách rõ ràng và dễ đọc, đặc biệt hữu ích khi bạn muốn tạo nhanh một
                    DataFrame từ dữ liệu có cấu trúc dạng bảng.</p>

                <p><b>Tạo từ danh sách của danh sách (list)</b></p>
                <p>Bạn có thể tạo một DataFrame từ danh sách lồng nhau, trong đó mỗi danh sách con đại diện cho một hàng
                    trong bảng dữ liệu. Khi tạo DataFrame theo cách này, bạn có thể chỉ định tên cột bằng tham số
                    columns, nếu không, Pandas sẽ tự động gán chỉ mục mặc định cho các cột.</p>
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
                                <button id="runButton58"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton58"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent58"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent58"><span style="color: #4f96e7;">data</span> = [[1, <span>'Join'</span>, 28], [2, <span>'Anna'</span>, 24], [3, <span>'Peter'</span>, 35]]</code></pre>
                            <pre><code id="codeContent58"><span style="color: #4f96e7;">df</span> = <span style="color: #4cca76;">pd</span>.DataFrame(<span style="color: #4f96e7;">data</span>, <span style="color: #4f96e7;">columns</span>=[<span>'ID'</span>, <span>'NAME'</span>, <span>'AGE'</span>])</code></pre>
                            <pre><code id="codeContent58">print(<span style="color: #4f96e7;">df</span>)</code></pre>
                        </div>
                        <div class="output" id="output58"></div>
                    </div>
                </div>
                <p>Phương pháp này đặc biệt hữu ích khi dữ liệu được tổ chức theo hàng và cần chuyển đổi nhanh chóng
                    thành DataFrame để xử lý.</p>
                <p><b>Tạo từ Series</b></p>
                <p>Bạn có thể tạo một DataFrame từ một hoặc nhiều Series. Khi sử dụng một Series duy nhất, DataFrame sẽ
                    có một cột tương ứng với Series đó. Khi kết hợp nhiều Series, chúng sẽ trở thành các cột trong
                    DataFrame, với chỉ mục chung được tự động căn chỉnh.</p>
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
                                <button id="runButton59"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton59"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent59"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent59"><span style="color: #4f96e7;">s</span> = <span style="color: #4cca76;">pd</span>.Series([10, 20, 30], <span style="color: #4f96e7;">index</span>=[<span>'a', 'b', 'c'</span>])</code></pre>
                            <pre><code id="codeContent59"><span style="color: #4f96e7;">df</span> = <span style="color: #4cca76;">pd</span>.DataFrame(<span style="color: #4f96e7;">s</span>, <span style="color: #4f96e7;">columns</span>=[<span>'Giá trị'</span>])</code></pre>
                            <pre><code id="codeContent59">print(<span style="color: #4f96e7;">df</span>)</code></pre>
                        </div>

                        <div class="output" id="output59"></div>
                    </div>
                </div>
                <p>Phương pháp này hữu ích khi bạn có nhiều Series riêng lẻ và muốn gộp chúng thành một DataFrame để dễ
                    dàng phân tích dữ liệu.</p>
                <p><b>Đọc dữ liệu từ file</b></p>
                <p>Pandas hỗ trợ đọc dữ liệu từ nhiều định dạng khác nhau như CSV, Excel, JSON, SQL, v.v.</p>
                <p>Ví dụ: tạo file csv có tên là book1.csv với dữ liệu như sau: </p>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Alice</td>
                            <td>30</td>
                            <td>New York</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Bod</td>
                            <td>25</td>
                            <td>Chicago</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Charlie</td>
                            <td>18</td>
                            <td>MiaMi</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Eve</td>
                            <td>27</td>
                            <td>New York</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Frank</td>
                            <td>19</td>
                            <td>Chicago</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Jack</td>
                            <td>20</td>
                            <td>MiaMi</td>
                        </tr>
                    </tbody>
                </table>

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
                                <button id="copyButton60"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent60"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">pandas</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">pd</span></code></pre>
                            <pre><code id="codeContent60"><span style="color: #4f96e7;">df</span> = <span style="color: #4cca76;">pd</span>.read_csv(<span>'Book1.csv'</span>)</code></pre>
                            <pre><code id="codeContent60">print(<span style="color: #4f96e7;">df</span>)</code></pre>
                        </div>
                    </div>
                </div>
                <h3>Các thao tác trên DataFrame</h3>
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
                            <td>Truy cập cột</td>
                            <td>Bạn có thể truy cập các cột bằng tên cột.</td>
                            <td>print(df['Name'])</td>
                        </tr>
                        <tr>
                            <td>Truy cập hàng</td>
                            <td>Sử dụng iloc[] hoặc loc[] để truy cập hàng theo vị trí hoặc chỉ mục.</td>
                            <td>
                                print(df.iloc[1]) # Truy cập hàng thứ hai<br>
                                print(df.loc[0]) # Truy cập hàng với chỉ mục 0
                            </td>
                        </tr>
                        <tr>
                            <td>Thêm cột mới</td>
                            <td>Thêm cột bằng cách gán dữ liệu cho một tên cột chưa tồn tại.</td>
                            <td>df['Country'] = ['USA', 'France', 'UK']</td>
                        </tr>
                        <tr>
                            <td>Lọc dữ liệu (Slicing)</td>
                            <td>Bạn có thể lọc DataFrame dựa trên điều kiện.</td>
                            <td>print(df[df['Age'] > 25])</td>
                        </tr>
                        <tr>
                            <td>Xóa cột hoặc hàng</td>
                            <td>Sử dụng drop() để xóa cột hoặc hàng.</td>
                            <td>df = df.drop(columns=['Country'])</td>
                        </tr>
                        <tr>
                            <td>Thống kê cơ bản</td>
                            <td>DataFrame cung cấp các phương thức thống kê như mean(), sum(), describe().</td>
                            <td>print(df.describe())</td>
                        </tr>
                        <tr>
                            <td>Xem dữ liệu đầu hoặc cuối</td>
                            <td>Xem dữ liệu đầu hoặc cuối của DataFrame bằng head() hoặc tail().</td>
                            <td>
                                print(df.head()) # Mặc định in 5 dòng đầu<br>
                                print(df.tail(3)) # In 3 dòng cuối
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="display">
                    <a href="chapter5_1.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Series trong Python.</div>
                        </div>
                    </a>

                    <a href="exercise5.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Bài tập chương 5.</div>
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