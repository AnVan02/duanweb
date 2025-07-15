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
        <h3>DICTIONARY TRONG PYTHON</h3>
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
                <h3>Dictionary trong python là gì?</h3>
                <p>Dictionary trong Python là cấu trúc dữ liệu lưu trữ các cặp key-value (khóa-giá trị), trong đó mỗi
                    khóa là duy nhất và được sử dụng để truy xuất giá trị tương ứng. Các khóa thường là chuỗi hoặc số,
                    trong khi giá trị có thể là bất kỳ kiểu dữ liệu nào, từ số nguyên, chuỗi, danh sách cho đến các
                    dictionary khác. Dictionary rất hữu ích khi bạn cần ánh xạ dữ liệu và thực hiện thao tác tra cứu
                    nhanh chóng, giúp quản lý dữ liệu hiệu quả.</p>
                <p><b>Tính chất của dictionary:</b></p>
                <p>• Không có thứ tự: Các phần tử trong dictionary không có thứ tự cụ thể.</p>
                <p>• Không có phần tử trùng lập: Key trong dictionary phải là duy nhất, không được trùng lập.</p>
                <p>• Có thể thay đổi: Có thể thêm, xóa hoặc sửa các phần tử trong dictionary.</p>

                <h3>Cách tạo dictionary.</h3>
                <p>Cách đơn giản nhất để tạo một dictionary là sử dụng cặp dấu ngoặc nhọn {}, bên trong chứa các cặp
                    key-value. Mỗi cặp key và value được ngăn cách bằng dấu hai chấm (:), và các cặp key-value khác nhau
                    được phân tách bằng dấu phẩy.</p>

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
                                <button id="runButton37"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton37"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent37"><span style="color: #4f96e7;">person</span> = {</code></pre>
                            <pre><code id="codeContent37">    <span>'name'</span>: <span>'Alice'</span>,</code></pre>
                            <pre><code id="codeContent37">    <span>'age'</span>: 25,</code></pre>
                            <pre><code id="codeContent37">    <span>'city'</span>: <span>'New York'</span></code></pre>
                            <pre><code id="codeContent37">}</code></pre>
                            <pre><code id="codeContent37">print(<span style="color: #4f96e7;">person</span>)</code></pre>
                        </div>
                        <div class="output" id="output37"></div>
                    </div>
                </div>
                <p> Bạn có thể tạo một dictionary rỗng nếu muốn khởi tạo trước và thêm các cặp key-value sau. Dictionary
                    rỗng chỉ đơn giản là một cặp dấu ngoặc nhọn không có gì bên trong( ví dụ: empty_dict = {}). Sau khi
                    tạo dictionary rỗng, bạn có thể thêm các cặp key-value mới vào bằng cách gán giá trị cho một khóa.
                </p>
                <h3>Truy xuất phần tử trong dictionary.</h3>
                <p><b>Sử Dụng Key Để Truy Xuất</b></p>
                <p>Cách đơn giản nhất để truy xuất giá trị từ dictionary là sử dụng tên khóa của phần tử bạn muốn lấy.
                    Bạn chỉ cần đặt tên khóa trong cặp dấu ngoặc vuông [] sau tên của dictionary.</p>
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
                                <button id="runButton38"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton38"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent38"><span style="color: #4f96e7;">person</span> = {</code></pre>
                            <pre><code id="codeContent38">    <span>'name'</span>: <span>'Alice'</span>,</code></pre>
                            <pre><code id="codeContent38">    <span>'age'</span>: 25,</code></pre>
                            <pre><code id="codeContent38">    <span>'city'</span>: <span>'New York'</span></code></pre>
                            <pre><code id="codeContent38">}</code></pre>
                            <pre><code id="codeContent38">print(<span style="color: #4f96e7;">person</span>['name'])</code></pre>
                            <pre><code id="codeContent38">print(<span style="color: #4f96e7;">person</span>['age'])</code></pre>
                            <pre><code id="codeContent38">print(<span style="color: #4f96e7;">person</span>['city'])</code></pre>
                        </div>
                        <div class="output" id="output38"></div>
                    </div>
                </div>
                <p>Để tránh lỗi KeyError khi khóa không tồn tại trong dictionary, bạn có thể sử dụng phương thức get().
                    Phương thức này cho phép bạn cung cấp một giá trị mặc định sẽ được trả về nếu khóa không tồn tại.
                </p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp :<span class="keyword">dictionary.get</span>(key,default_value)</p>
                    </div>
                </div>
                <p>- key: Khóa bạn muốn truy xuất.</p>
                <p>- default_value: (Không bắt buộc) Giá trị sẽ được trả về nếu khóa không tồn tại. Nếu không cung cấp
                    giá trị này, phương thức sẽ trả về None nếu khóa không có trong dictionary.</p>
                <p><b>Truy Xuất Tất Cả Các Giá Trị Và Khóa</b></p>
                <p> Dictionary trong Python lưu trữ dữ liệu dưới dạng cặp key-value
                    (khóa - giá trị). Bạn có thể truy xuất tất cả khóa bằng .keys(), giá trị bằng .values(), và cả hai
                    cùng lúc bằng .items(). Những phương thức này giúp thao tác với dữ liệu dễ dàng và linh hoạt.</p>
                <p>- keys(): Trả về danh sách tất cả các khóa trong dictionary.</p>
                <p>- values(): Trả về danh sách tất cả các giá trị trong dictionary.</p>
                <p>- items(): Trả về danh sách các cặp key-value dưới dạng tuple.</p>

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
                                <button id="runButton39"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton39"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent39"><span style="color: #4f96e7;">person</span> = {</code></pre>
                            <pre><code id="codeContent39">    <span>'name'</span>: <span>'Alice'</span>,</code></pre>
                            <pre><code id="codeContent39">    <span>'age'</span>: 25,</code></pre>
                            <pre><code id="codeContent39">    <span>'city'</span>: <span>'New York'</span></code></pre>
                            <pre><code id="codeContent39">}</code></pre>
                            <pre><code id="codeContent39">print(<span style="color: #4f96e7;">person</span>.keys())</code></pre>
                            <pre><code id="codeContent39">print(<span style="color: #4f96e7;">person</span>.values())</code></pre>
                            <pre><code id="codeContent39">print(<span style="color: #4f96e7;">person</span>.items())</code></pre>
                        </div>
                        <div class="output" id="output39"></div>
                    </div>
                </div>

                <h3>Cập nhật các giá trị phần tử trong dictionary.</h3>
                <p>Dictionary trong Python cung cấp cách linh hoạt để cập nhật giá trị của một khóa, giúp dữ liệu luôn
                    được làm mới và chính xác. Bạn có thể thay đổi giá trị trực tiếp hoặc sử dụng phương thức .update(),
                    cho phép chỉnh sửa nhiều khóa cùng lúc hoặc thêm mới nếu khóa chưa tồn tại.</p>
                <p><b>Cập Nhật Giá Trị Bằng Khóa</b></p>
                <p>Trong Python, bạn có thể dễ dàng cập nhật giá trị của một phần tử trong dictionary bằng cách sử dụng
                    khóa tương ứng. Chỉ cần gán một giá trị mới cho khóa, bạn có thể thay đổi dữ liệu một cách nhanh
                    chóng, đảm bảo thông tin luôn chính xác và được cập nhật kịp thời.</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp :<span class="keyword">dictionary[key]</span> = new_value</p>
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
                                <button id="runButton40"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton40"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent40"><span style="color: #4f96e7;">person</span> = {</code></pre>
                            <pre><code id="codeContent40">    <span>'name'</span>: <span>'Alice'</span>,</code></pre>
                            <pre><code id="codeContent40">    <span>'age'</span>: 25,</code></pre>
                            <pre><code id="codeContent40">    <span>'city'</span>: <span>'New York'</span></code></pre>
                            <pre><code id="codeContent40">}</code></pre>
                            <pre><code id="codeContent40"><span style="color: #4f96e7;">person</span>[<span>'age'</span>] = 26</code></pre>
                            <pre><code id="codeContent40"><span style="color: #4f96e7;">person</span>[<span>'city'</span>] = <span>'Los Angeles'</span></code></pre>
                            <pre><code id="codeContent40">print(<span style="color: #4f96e7;">person</span>)</code></pre>
                        </div>
                        <div class="output" id="output40"></div>
                    </div>
                </div>
                <p>Việc cập nhật giá trị bằng khóa giúp bạn dễ dàng thay đổi dữ liệu một cách linh hoạt, đảm bảo tính
                    chính xác và phù hợp với yêu cầu xử lý thông tin.</p>
                <p><b>Thêm Phần Tử Mới</b></p>
                <p>Trong Python, Dictionary không chỉ cho phép cập nhật giá trị của các khóa đã tồn tại mà còn hỗ trợ
                    thêm các phần tử mới một cách linh hoạt. Khi bạn gán một giá trị cho một khóa chưa có trong
                    dictionary, Python sẽ tự động tạo khóa đó và thêm vào danh sách các phần tử.</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp :<span class="keyword">dictionary[key]</span> = new_value</p>
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
                                <button id="runButton41"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton41"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent41"><span style="color: #4f96e7;">person</span> = {</code></pre>
                            <pre><code id="codeContent41">    <span>'name'</span>: <span>'Alice'</span>,</code></pre>
                            <pre><code id="codeContent41">    <span>'age'</span>: 25,</code></pre>
                            <pre><code id="codeContent41">    <span>'city'</span>: <span>'New York'</span></code></pre>
                            <pre><code id="codeContent41">}</code></pre>
                            <pre><code id="codeContent41"><span style="color: #4f96e7;">person</span>[<span>'job'</span>] = <span>'Engineer'</span></code></pre>
                            <pre><code id="codeContent41">print(person)</code></pre>
                        </div>
                        <div class="output" id="output41"></div>
                    </div>
                </div>
                <p>Việc thêm phần tử mới giúp mở rộng dữ liệu, cho phép cập nhật thông tin một cách linh hoạt và phù hợp
                    với nhu cầu xử lý. Điều này đặc biệt hữu ích khi làm việc với dữ liệu động, nơi các khóa và giá trị
                    có thể thay đổi theo thời gian.</p>
                <h3>Cập Nhật Nhiều Phần Tử Cùng Lúc Bằng update()</h3>
                <p>Phương thức .update() trong Python cho phép cập nhật đồng thời nhiều cặp key-value trong dictionary.
                    Thay vì thay đổi từng phần tử một cách thủ công, bạn có thể truyền vào một dictionary chứa các giá
                    trị cần cập nhật, giúp quá trình xử lý dữ liệu trở nên nhanh chóng và hiệu quả hơn.</p>

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
                                <button id="runButton42"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton42"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent42"><span style="color: #4f96e7;">person</span> = {</code></pre>
                            <pre><code id="codeContent42">    <span>'name'</span>: <span>'Alice'</span>,</code></pre>
                            <pre><code id="codeContent42">    <span>'age'</span>: 25,</code></pre>
                            <pre><code id="codeContent42">    <span>'city'</span>: <span>'New York'</span></code></pre>
                            <pre><code id="codeContent42">}</code></pre>
                            <pre><code id="codeContent42"><span style="color: #4f96e7;">person</span>.update({<span>'age'</span>: 27, <span>'city'</span>: <span>'San Francisco'</span>, <span>'job'</span>: <span>'Data Scientist'</span>})</code></pre>
                            <pre><code id="codeContent42">print(person)</code></pre>
                        </div>
                        <div class="output" id="output42"></div>
                    </div>
                </div>

                <p>Ngoài việc cập nhật các khóa đã tồn tại, .update() cũng có thể thêm mới các khóa nếu chúng chưa có
                    trong dictionary. Điều này giúp linh hoạt trong việc mở rộng và cập nhật dữ liệu mà không làm mất đi
                    các giá trị cũ.</p>

                <h3>Vòng lập trong dictionary.</h3>
                <p><b>Lặp Qua Các Khóa (Keys):</b> Bạn có thể sử dụng vòng lặp for để lặp qua tất cả các khóa trong
                    dictionary. Khi bạn lặp qua dictionary, Python sẽ tự động hiểu rằng bạn đang lặp qua các khóa.</p>

                <p><b>Lặp Qua Các Giá Trị (Values):</b> Để lặp qua các giá trị trong dictionary, bạn có thể sử dụng
                    phương thức values(). Phương thức này trả về một danh sách tất cả các giá trị trong dictionary.</p>

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
                                <button id="runButton43"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton43"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent43"><span style="color: #4f96e7;">person</span> = {<span>'name'</span>: <span>'Alice'</span>, <span>'age'</span>: 27, <span>'city'</span>: <span>'New York'</span>}</code></pre>
                            <pre><code id="codeContent43"><span style="color: #c108da;">for</span> <span style="color: #4f96e7;">key</span> <span style="color: #c108da;">in</span> <span style="color: #4f96e7;">person</span>:</code></pre>
                            <pre><code id="codeContent43">  print(<span style="color: #4f96e7;">key</span>)</code></pre>
                            <pre><code id="codeContent43">print('<span>------------------------------</span>')</code></pre>
                            <pre><code id="codeContent43"><span style="color: #c108da;">for</span> <span style="color: #4f96e7;">value</span> <span style="color: #c108da;">in</span> <span style="color: #4f96e7;">person.values()</span>:</code></pre>
                            <pre><code id="codeContent43">  print(<span style="color: #4f96e7;">value</span>)</code></pre>
                        </div>
                        <div class="output" id="output43"></div>
                    </div>
                </div>

                <h3>Các phương thức cơ bản của dictionary trong python.</h3>
                <p>Dictionary cung cấp nhiều phương thức hữu ích để thao tác với dữ liệu một cách hiệu quả. Các phương
                    thức này cho phép truy xuất, cập nhật, thêm, xóa phần tử, cũng như thực hiện các thao tác trên khóa
                    và giá trị một cách linh hoạt. Việc hiểu và sử dụng thành thạo các phương thức của dictionary giúp
                    bạn làm việc với dữ liệu nhanh chóng và tối ưu hơn trong các ứng dụng thực tế.</p>
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
                            <td>keys()</td>
                            <td>Trả về một đối tượng chứa tất cả các khóa trong dictionary dưới dạng một danh sách có
                                thể lặp.</td>
                            <td>dict.keys()</td>
                        </tr>
                        <tr>
                            <td>values()</td>
                            <td>Trả về một đối tượng chứa tất cả các giá trị trong dictionary dưới dạng một danh sách có
                                thể lặp.</td>
                            <td>dict.values()</td>
                        </tr>
                        <tr>
                            <td>items()</td>
                            <td>Trả về một đối tượng chứa tất cả các cặp (key, value) trong dictionary dưới dạng danh
                                sách các tuple.</td>
                            <td>dict.items()</td>
                        </tr>
                        <tr>
                            <td>get()</td>
                            <td>Trả về giá trị của một khóa nếu khóa đó tồn tại trong dictionary. Nếu khóa không tồn
                                tại, phương thức trả về giá trị mặc định được chỉ định (hoặc `None` nếu không có giá trị
                                mặc định).</td>
                            <td>dict.get("key", "default")</td>
                        </tr>
                        <tr>
                            <td>update()</td>
                            <td>Cập nhật dictionary với một dictionary khác hoặc các cặp key-value. Nếu khóa đã tồn tại,
                                giá trị của khóa sẽ được ghi đè.</td>
                            <td>dict.update({"key1": "value1", "key2": "value2"})</td>
                        </tr>
                        <tr>
                            <td>pop()</td>
                            <td>Xóa một khóa khỏi dictionary và trả về giá trị tương ứng. Nếu khóa không tồn tại, có thể
                                chỉ định giá trị mặc định để tránh lỗi.</td>
                            <td>dict.pop("key", "default")</td>
                        </tr>
                        <tr>
                            <td>popitem()</td>
                            <td>Xóa và trả về một cặp (key, value) ngẫu nhiên từ dictionary. Nếu dictionary rỗng, phương
                                thức sẽ gây ra lỗi.</td>
                            <td>dict.popitem()</td>
                        </tr>
                        <tr>
                            <td>clear()</td>
                            <td>Xóa tất cả các phần tử trong dictionary, làm cho dictionary trở thành rỗng.</td>
                            <td>dict.clear()</td>
                        </tr>
                        <tr>
                            <td>copy()</td>
                            <td>Trả về một bản sao nông (shallow copy) của dictionary, có nghĩa là dictionary mới sẽ
                                chứa cùng dữ liệu nhưng không phải là bản sao sâu của các đối tượng lồng bên trong.</td>
                            <td>dict.copy()</td>
                        </tr>
                        <tr>
                            <td>setdefault()</td>
                            <td>Trả về giá trị của khóa nếu khóa đã tồn tại. Nếu khóa không tồn tại, thêm khóa vào
                                dictionary với giá trị mặc định và trả về giá trị đó.</td>
                            <td>dict.setdefault("key", "default")</td>
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
                                <button id="runButton44"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton44"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent44"><span style="color: #4f96e7;">person</span> = {<span>'name'</span>: <span>'Alice'</span>, <span>'age'</span>: 27, <span>'city'</span>: <span>'New York'</span>}</code></pre>
                            <pre><code id="codeContent44"><span style="color: #4f96e7;">person_copy</span> = <span style="color: #4f96e7;">person</span>.copy()</code></pre>
                            <pre><code id="codeContent44"><span style="color: #4f96e7;">person</span>.clear()</code></pre>
                            <pre><code id="codeContent44">print(<span style="color: #4f96e7;">person</span>)</code></pre>
                            <pre><code id="codeContent44">print(<span style="color: #4f96e7;">person_copy</span>)</code></pre>
                        </div>
                        <div class="output" id="output44"></div>
                    </div>
                </div>

                <div class="display">
                    <a href="chapter3_2.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Tuples trong python.</div>
                        </div>
                    </a>

                    <a href="chapter3_4.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Set trong python.</div>
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