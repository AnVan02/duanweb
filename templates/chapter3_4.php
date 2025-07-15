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
        <h3>SET TRONG PYTHON</h3>
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
                <h3>Set trong python là gì?</h3>
                <p>Trong Python, set là một cấu trúc dữ liệu cho phép lưu trữ một tập hợp các phần tử không trùng lặp.
                    Set rất hữu ích khi bạn cần một tập hợp các giá trị duy nhất và không cần quan tâm đến thứ tự của
                    các phần tử.</p>
                <p><b>Tính chất của set:</b></p>
                <p>- Không Trùng Lặp: Mỗi phần tử trong set phải là duy nhất. Các phần tử trùng lặp sẽ tự động bị loại
                    bỏ khi bạn tạo một set.</p>
                <p>- Không Thứ Tự: Set không lưu trữ các phần tử theo một thứ tự cụ thể. Điều này có nghĩa là bạn không
                    thể truy cập các phần tử của set bằng chỉ mục.</p>
                <p>- Có Thể Thay Đổi: Các set trong Python có thể được thay đổi, nghĩa là bạn có thể thêm hoặc xóa các
                    phần tử.</p>
                <h3>Cách tạo một set.</h3>
                <p>Bạn có thể tạo một set và khởi tạo nó với một tập hợp các phần tử bằng cách sử dụng dấu ngoặc nhọn
                    {}. Các phần tử trong set sẽ được phân tách bằng dấu phẩy.</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp :<span class="keyword">my_set</span> = {element1, element2, element3, ...}</p>
                    </div>
                </div>
                <p>• my_set : Tên biến dùng để lưu trữ tập hợp.</p>
                <p>• {} : Dấu ngoặc nhọn được sử dụng để định nghĩa một set.</p>
                <p>• element1, element2, element3, ... : Các phần tử của set, được phân tách bằng dấu phẩy.</p>

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
                                <button id="runButton45"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton45"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent45"><span style="color: #4f96e7;">fruits</span> = {<span>'apple', 'banana', 'cherry'</span>}</code></pre>
                            <pre><code id="codeContent45">print(<span style="color: #4f96e7;">fruits</span>)</code></pre>
                        </div>
                        <div class="output" id="output45"></div>
                    </div>
                </div>

                <p> Bạn cũng có thể sử dụng hàm set() để tạo một set bằng cách truyền bất kỳ đối tượng iterable nào vào
                    hàm, chẳng hạn như danh sách, tuple, hoặc chuỗi.</p>

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
                                <button id="runButton46"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton46"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent46"><span style="color: #4f96e7;">fruits</span> = <span style="color: #4cca76;">set</span>(<span style="color: #c108da;">(<span>'apple', 'banana', 'cherry'</span>)</span>)</code></pre>
                            <pre><code id="codeContent46">print(<span style="color: #4f96e7;">fruits</span>)</code></pre>
                        </div>
                        <div class="output" id="output46"></div>
                    </div>
                </div>
                <h3>Truy xuất phần tử trong set.</h3>
                <p>Do set là một tập hợp không có thứ tự, nên bạn không thể truy cập các phần tử của nó bằng chỉ số như
                    khi làm việc với list hoặc tuple. Thay vào đó, các phần tử trong set được lưu trữ theo một cách
                    không thứ tự, và mỗi lần bạn truy xuất các phần tử, thứ tự có thể thay đổi. Để duyệt qua toàn bộ các
                    phần tử của một set, bạn có thể sử dụng vòng lặp for, cho phép bạn truy cập từng phần tử một cách
                    tuần tự mà không cần biết vị trí chính xác của chúng. Điều này giúp bạn dễ dàng thao tác với dữ liệu
                    trong set, dù chúng không có cấu trúc thứ tự như các kiểu dữ liệu khác.</p>

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
                                <button id="runButton47"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton47"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent47"><span style="color: #4f96e7;">my_set</span> = {1, 2, 3}</code></pre>
                            <pre><code id="codeContent47"><span style="color: #c108da;">for</span> <span style="color: #4f96e7;">element</span> <span style="color: #c108da;">in</span> <span style="color: #4f96e7;">my_set</span>:</code></pre>
                            <pre><code id="codeContent47">    print(<span style="color: #4f96e7;">element</span>)</code></pre>
                        </div>
                        <div class="output" id="output47"></div>
                    </div>
                </div>
                <h3>Các phương thức cơ bản trong set.</h3>
                <p>Set trong Python cung cấp nhiều phương thức hữu ích giúp thao tác với tập hợp dữ liệu một cách hiệu
                    quả. Các phương thức này cho phép thêm, xóa phần tử, kiểm tra sự tồn tại, thực hiện các phép toán
                    tập hợp như hợp, giao, hiệu và nhiều thao tác khác. Nhờ đó, set trở thành một cấu trúc dữ liệu mạnh
                    mẽ để xử lý dữ liệu không trùng lặp và tối ưu hiệu suất trong nhiều tình huống lập trình.</p>
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
                            <td>add()</td>
                            <td>Thêm một phần tử vào tập hợp. Nếu phần tử đã tồn tại, không có gì thay đổi.</td>
                            <td>my_set.add(5)</td>
                        </tr>
                        <tr>
                            <td>remove()</td>
                            <td>Xóa một phần tử khỏi tập hợp. Nếu phần tử không tồn tại, phương thức sẽ gây lỗi.</td>
                            <td>my_set.remove(3)</td>
                        </tr>
                        <tr>
                            <td>discard()</td>
                            <td>Xóa một phần tử khỏi tập hợp. Nếu phần tử không tồn tại, không có lỗi xảy ra.</td>
                            <td>my_set.discard(3)</td>
                        </tr>
                        <tr>
                            <td>pop()</td>
                            <td>Xóa và trả về một phần tử ngẫu nhiên từ tập hợp. Nếu tập hợp rỗng, phương thức sẽ gây
                                lỗi.</td>
                            <td>my_set.pop()</td>
                        </tr>
                        <tr>
                            <td>clear()</td>
                            <td>Xóa tất cả các phần tử trong tập hợp, làm cho tập hợp trở thành rỗng.</td>
                            <td>my_set.clear()</td>
                        </tr>
                        <tr>
                            <td>union()</td>
                            <td>Trả về một tập hợp mới chứa tất cả các phần tử của hai tập hợp (hợp).</td>
                            <td>set1.union(set2)</td>
                        </tr>
                        <tr>
                            <td>intersection()</td>
                            <td>Trả về một tập hợp mới chứa các phần tử có mặt trong cả hai tập hợp (giao).</td>
                            <td>set1.intersection(set2)</td>
                        </tr>
                        <tr>
                            <td>difference()</td>
                            <td>Trả về một tập hợp mới chứa các phần tử có trong tập hợp đầu tiên nhưng không có trong
                                tập hợp thứ hai.</td>
                            <td>set1.difference(set2)</td>
                        </tr>
                        <tr>
                            <td>issubset()</td>
                            <td>Kiểm tra xem tập hợp hiện tại có phải là tập con của một tập hợp khác hay không.</td>
                            <td>set1.issubset(set2)</td>
                        </tr>
                        <tr>
                            <td>issuperset()</td>
                            <td>Kiểm tra xem tập hợp hiện tại có chứa tất cả các phần tử của một tập hợp khác hay không.
                            </td>
                            <td>set1.issuperset(set2)</td>
                        </tr>
                        <tr>
                            <td>isdisjoint()</td>
                            <td>Kiểm tra xem hai tập hợp có giao nhau hay không (trả về True nếu không có phần tử
                                chung).</td>
                            <td>set1.isdisjoint(set2)</td>
                        </tr>
                        <tr>
                            <td>update()</td>
                            <td>Thêm tất cả các phần tử từ một tập hợp khác vào tập hợp hiện tại.</td>
                            <td>set1.update(set2)</td>
                        </tr>
                        <tr>
                            <td>intersection_update()</td>
                            <td>Cập nhật tập hợp hiện tại chỉ giữ lại các phần tử có trong cả hai tập hợp.</td>
                            <td>set1.intersection_update(set2)</td>
                        </tr>
                        <tr>
                            <td>difference_update()</td>
                            <td>Cập nhật tập hợp hiện tại bằng cách loại bỏ các phần tử có trong tập hợp khác.</td>
                            <td>set1.difference_update(set2)</td>
                        </tr>
                    </tbody>
                </table>
                <p>Việc hiểu và sử dụng thành thạo các phương thức của set giúp bạn quản lý dữ liệu tốt hơn, thực hiện
                    các phép toán tập hợp nhanh chóng và xây dựng chương trình một cách linh hoạt, hiệu quả.</p>
                <div class="display">
                    <a href="chapter3_3.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Dictionary trong python.</div>
                        </div>
                    </a>

                    <a href="exercise3.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Bài tập chương 3.</div>
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