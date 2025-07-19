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
        <h3>LIST TRONG PYTHON</h3>
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
                <h3>List trong python là gì ?</h3>
                <p>Danh sách (list) trong Python là một kiểu dữ liệu tổ hợp, cho phép lưu trữ nhiều giá trị khác nhau
                    dưới một biến duy nhất. Đây là cấu trúc dữ liệu cơ bản thuộc nhóm sequence, nơi mỗi phần tử có chỉ
                    số (index) để truy cập và thao tác.</p>
                <h3>Cấu trúc cở bản và cách tạo list.</h3>
                <p>List là một kiểu dữ liệu tổn hợp, có thể chứa nhiều phần tử, với các đặc điểm sau:</p>
                <p>-<b>Đánh chỉ số (Indexing): </b>Mỗi phần tử trong danh sách có một chỉ số (index) bắt đầu từ 0. Ví
                    dụ,
                    phần tử đầu tiên có chỉ số 0, phần tử thứ hai có chỉ số 1, và tiếp tục như vậy.</p>
                <p>-<b>Có thể thay đổi (Mutable):</b> Danh sách có thể thay đổi, nghĩa là bạn có thể thêm, xóa hoặc cập
                    nhật các phần tử sau khi danh sách đã được tạo ra.</p>
                <p>- <b>Có thể chứa các kiểu dữ liệu khác nhau:</b> Một danh sách có thể chứa các phần tử có kiểu dữ
                    liệu khác nhau, bao gồm số nguyên, chuỗi, danh sách con, từ điển, ...</p>
                <p>Cú pháp cở bản:</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">my_list</span> = [element1, element2, element3, ...]</p>
                    </div>
                </div>
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
                                <button id="copyButton25"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <code
                                id="codeContent25"><span style="color: #4f96e7;">numbers</span> = [1, 2, 3, 4, 5] <span style="color: #4cca76;"># Danh sách số nguyên</span></code>
                            <code
                                id="codeContent25"><span style="color: #4f96e7;">fruits</span> = [<span>"apple", "banana", "cherry"</span>] <span style="color: #4cca76;"># Danh sách chuỗi</span></code>
                            <code
                                id="codeContent25"><span style="color: #4f96e7;">mixed_list</span> = [1, <span>"hello"</span>, 3.14, [2, 3]] <span style="color: #4cca76;"># Danh sách chứa nhiều kiểu dữ liệu</span></code>
                        </div>
                    </div>
                </div>
                <p><b>Cách tạo một list.</b></p>
                <p>• Tạo danh sách rỗng</p>
                <p>- Danh sách rỗng là một danh sách không chứa bất kỳ phần tử nào tại thời điểm khởi tạo. Đây là cách
                    phổ biến để bắt đầu khi bạn cần xây dựng danh sách từ đầu và thêm dữ liệu vào sau này.</p>
                <p>- Cú pháp:</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp 1:<span class="keyword">empty_list</span> = []</p>
                        <p>Cú pháp 2:<span class="keyword">empty_list</span> = list()</p>
                    </div>
                </div>
                <p>• Tạo danh sách với các phần tử</p>
                <p>- Bạn có thể khởi tạo một danh sách với các phần tử cụ thể ngay từ khi tạo danh sách, thay vì bắt đầu
                    bằng một danh sách rỗng rồi thêm từng phần tử vào sau này. Cách này giúp tiết kiệm thời gian, làm
                    cho mã nguồn gọn gàng hơn và dễ đọc hơn, đặc biệt khi bạn đã biết trước các phần tử cần có trong
                    danh sách.</p>
                <p>- Cú pháp:</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp 1:<span class="keyword">my_list</span> = [element1, element2, element3, ...]</p>
                        <p>Cú pháp 2:<span class="keyword">my_list</span> = list((element1, element2, element3, ...))
                        </p>
                    </div>
                </div>
                <p>• Tạo danh sách bằng copy</p>
                <p>- Trong Python, bạn có thể tạo một danh sách mới bằng cách sao chép một danh sách có sẵn. Điều này
                    giúp giữ nguyên dữ liệu gốc mà không làm ảnh hưởng đến danh sách ban đầu khi thực hiện các thao tác
                    trên danh sách mới.</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp 1:<span class="keyword">my_list1</span> = my_list.copy()</p>
                        <p>Cú pháp 2:<span class="keyword">my_list1</span> = list(my_list1) hoặc <span
                                class="keyword">my_list1</span> = my_list
                        </p>
                    </div>
                </div>
                <h3>Truy xuất phần tử trong list.</h3>
                <p>Trong Python, danh sách (list) sử dụng chỉ số (index) để truy cập các phần tử. Chỉ số dương bắt đầu
                    từ 0 và tăng dần từ trái sang phải, trong khi chỉ số âm bắt đầu từ -1 và giảm dần, cho phép truy cập
                    phần tử từ cuối danh sách. Cách đánh chỉ số này giúp linh hoạt trong việc truy xuất dữ liệu, ngay cả
                    khi không biết trước độ dài của danh sách</p>

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
                                <button id="runButton26"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton26"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent26"><span style="color: #4f96e7;">my_list</span> = [<span>"apple", "banana", "cherry"</span>]</code></pre>
                            <pre><code id="codeContent26"><span style="color: #4f96e7;">first_item</span> = <span style="color: #4f96e7;">my_list</span>[0]</code></pre>
                            <pre><code id="codeContent26">print(<span >'phần tử đầu tiên: '</span>,<span style="color: #4f96e7;">first_item</span>)</code></pre>
                            <pre><code id="codeContent26"><span style="color: #4f96e7;">second_item</span> = <span style="color: #4f96e7;">my_list</span>[-1]</code></pre>
                            <pre><code id="codeContent26">print(<span >'phần tử đầu tiên: '</span>,<span style="color: #4f96e7;">second_item</span>)</code></pre>
                        </div>
                        <div class="output" id="output26"></div>
                    </div>
                </div>

                <p>Truy xuất đoạn trong Python cho phép bạn lấy một phần của danh sách dựa trên chỉ mục, giúp
                    trích xuất các phần tử liên tiếp một cách nhanh chóng và thuận tiện mà không cần truy xuất
                    từng phần tử riêng lẻ. Kỹ thuật này giúp tối ưu hóa việc xử lý danh sách, đặc biệt khi bạn
                    chỉ cần làm việc với một phần dữ liệu thay vì toàn bộ danh sách.</p>
                <p>Cú pháp chung của truy xuất đoạn trong Python là:</p>
                <div class="formula">
                    <div class="code-container">
                        <p>Cú pháp :<span class="keyword">new_list</span> = my_list[start:end]</p>
                    </div>
                </div>
                <p><b>start:</b> Vị trí bắt đầu của đoạn muốn lấy.</p>
                <p><b>end:</b> Vị trí kết thúc của đoạn muốn lấy.</p>

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
                                <button id="runButton27"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton27"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent27"><span style="color: #4f96e7;">my_list</span> = [<span>'apple', 'banana', 'cherry', 'date', 'fig', 'grape'</span>]</code></pre>
                            <pre><code id="codeContent27"><span style="color: #4f96e7;">sub_list</span> = <span style="color: #4f96e7;">my_list</span>[1:3]</code></pre>
                            <pre><code id="codeContent27">print(<span >'phần tử đầu tiên: '</span>,<span style="color: #4f96e7;">sub_list</span>)</code></pre>
                        </div>
                        <div class="output" id="output27"></div>
                    </div>
                </div>

                <p>• Nếu bỏ qua start, Python sẽ mặc định lấy từ đầu list (start = 0).</p>
                <p>• Nếu bỏ qua end, Python sẽ mặc định lấy đến cuối list.</p>
                <h3>Cập nhật giá trị cho phần tử trong list.</h3>
                <p>Trong Python, danh sách có thể được cập nhật dễ dàng bằng cách thay đổi giá trị của từng phần tử hoặc
                    cập nhật nhiều phần tử cùng lúc.</p>
                <p>• <b>Thay đổi giá trị bằng chỉ số:</b> Truy cập trực tiếp phần tử thông qua chỉ số và gán giá trị mới
                    để thay thế.</p>
                <p>• <b>Cập nhật một đoạn trong danh sách:</b> Sử dụng cú pháp cắt (slice) để thay đổi nhiều phần tử
                    cùng lúc, giúp cập nhật linh hoạt hơn.</p>

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
                                <button id="runButton28"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton28"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent28"><span style="color: #4f96e7;">my_list</span> = [<span>'apple', 'banana', 'cherry', 'date', 'fig', 'grape'</span>]</code></pre>
                            <pre><code id="codeContent28"><span style="color: #4f96e7;">my_list</span>[1] = <span>'blueberry'</span> <span style="color: #4cca76;">#Cập nhật phần tử tại chỉ số 1</span></code></pre>
                            <pre><code id="codeContent28"><span style="color: #4f96e7;">my_list</span>[2:4] = [<span>'kiwi', 'lemon'</span>] <span style="color: #4cca76;">#Cập nhật đoạn từ chỉ số 2 đến sau chỉ số 4</span></code></pre>
                            <pre><code id="codeContent28">print(<span style="color: #4f96e7;">my_list</span>)</code></pre>
                        </div>
                        <div class="output" id="output28"></div>
                    </div>
                </div>

                <h3>Vòng lặp trong list.</h3>
                <p><b>Sử Dụng Vòng Lặp for.</b></p>
                <p>Vòng lặp for là một cách đơn giản, trực quan và hiệu quả để duyệt qua các phần tử trong danh sách.
                    Khi sử dụng for, bạn có thể truy xuất từng phần tử theo thứ tự, giúp việc thao tác, xử lý dữ liệu
                    hoặc thực hiện các phép toán trở nên dễ dàng và linh hoạt. Đây là phương pháp phổ biến khi cần duyệt
                    qua danh sách mà không cần quan tâm đến chỉ số của từng phần tử.</p>

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
                                <button id="runButton29"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton29"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent29"><span style="color: #4f96e7;">fruits</span> = [<span>"apple", "banana", "cherry"</span>]</code></pre>
                            <pre><code id="codeContent29"><span style="color: #c108da;">for</span> <span style="color: #4f96e7;">index</span> <span style="color: #c108da;">in</span> <span style="color: #4cca76;">range</span>(len(<span style="color: #4f96e7;">fruits</span>)):</code></pre>
                            <pre><code id="codeContent29">  print(<span style="color: #4f96e7;">f</span><span>"Index <span style="color: #c108da;">{<span style="color: #4f96e7;">index</span>}</span>: <span style="color: #c108da;">{<span style="color: #4f96e7;">fruits[index]</span>}</span>"</span>)</code></pre>
                        </div>
                        <div class="output" id="output29"></div>
                    </div>
                </div>
                <p><b>Sử dụng vòng lập while</b></p>
                <p>Vòng lặp while trong Python cho phép duyệt qua danh sách bằng cách sử dụng chỉ số, giúp bạn kiểm soát
                    chặt chẽ quá trình lặp. Bằng cách khởi tạo một biến chỉ số và tăng dần sau mỗi vòng lặp, bạn có thể
                    truy cập từng phần tử trong danh sách và thực hiện các thao tác cần thiết. Dưới đây là hướng dẫn chi
                    tiết cùng ví dụ minh họa cách sử dụng while để lặp qua danh sách bằng chỉ số.</p>

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
                                <button id="runButton30"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton30"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent30"><span style="color: #4f96e7;">fruits</span> = [<span>"apple", "banana", "cherry"</span>]</code></pre>
                            <pre><code id="codeContent30"><span style="color: #4f96e7;">index</span> = <span style="color: #c108da;">0</span></code></pre>
                            <pre><code id="codeContent30"><span style="color: #c108da;">while</span> <span style="color: #4f96e7;">index</span> <span style="color: #c108da;">&lt;</span> <span style="color: #4cca76;">len</span>(<span style="color: #4f96e7;">fruits</span>):</code></pre>
                            <pre><code id="codeContent30">  print(<span style="color: #4f96e7;">f</span><span>"Index <span style="color: #c108da;">{<span style="color: #4f96e7;">index</span>}</span>: <span style="color: #c108da;">{<span style="color: #4f96e7;">fruits[index]</span>}</span>"</span>)</code></pre>
                            <pre><code id="codeContent30">  <span style="color: #4f96e7;">index</span> += <span style="color: #c108da;">1</span></code></pre>
                        </div>
                        <div class="output" id="output30"></div>
                    </div>
                </div>
                <h3>Một số phương thức cơ bản trong list</h3>
                <p>Danh sách (list) trong Python cung cấp nhiều phương thức hữu ích giúp thao tác với dữ liệu một cách
                    linh hoạt. Từ việc thêm, xóa, tìm kiếm đến sắp xếp phần tử, các phương thức này giúp bạn xử lý danh
                    sách một cách hiệu quả và tối ưu. Dưới đây là một số phương thức quan trọng thường được sử dụng khi
                    làm việc với danh sách.</p>
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
                            <td>append()</td>
                            <td>Thêm một phần tử vào cuối danh sách</td>
                            <td>list.append(x)</td>
                        </tr>
                        <tr>
                            <td>extend()</td>
                            <td>Mở rộng danh sách bằng cách thêm các phần tử từ một iterable</td>
                            <td>list.extend(iterable)</td>
                        </tr>
                        <tr>
                            <td>insert()</td>
                            <td>Chèn một phần tử vào vị trí chỉ định</td>
                            <td>list.insert(i, x)</td>
                        </tr>
                        <tr>
                            <td>remove()</td>
                            <td>Xóa phần tử đầu tiên có giá trị nhất định</td>
                            <td>list.remove(x)</td>
                        </tr>
                        <tr>
                            <td>pop()</td>
                            <td>Xóa phần tử tại vị trí chỉ định và trả về giá trị của nó</td>
                            <td>list.pop(i)</td>
                        </tr>
                        <tr>
                            <td>index()</td>
                            <td>Trả về chỉ mục của phần tử đầu tiên có giá trị nhất định</td>
                            <td>list.index(x)</td>
                        </tr>
                        <tr>
                            <td>count()</td>
                            <td>Trả về số lần xuất hiện của một giá trị</td>
                            <td>list.count(x)</td>
                        </tr>
                        <tr>
                            <td>sort()</td>
                            <td>Sắp xếp các phần tử trong danh sách</td>
                            <td>list.sort()</td>
                        </tr>
                        <tr>
                            <td>reverse()</td>
                            <td>Đảo ngược danh sách</td>
                            <td>list.reverse()</td>
                        </tr>
                        <tr>
                            <td>copy()</td>
                            <td>Trả về một bản sao của danh sách</td>
                            <td>list.copy()</td>
                        </tr>
                        <tr>
                            <td>clear()</td>
                            <td>Xóa tất cả phần tử trong danh sách</td>
                            <td>list.clear()</td>
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
                                <button id="runButton31"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton31"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent31"><span style="color: #4f96e7;">my_list</span> = [<span>"apple", "banana", "cherry"</span>]</code></pre>
                            <pre><code id="codeContent31"><span style="color: #4f96e7;">my_list</span>.append(<span>"date"</span>)</code></pre>
                            <pre><code id="codeContent31">print(<span style="color: #4f96e7;">my_list</span>)</code></pre>
                            <pre><code id="codeContent31"><span style="color: #4f96e7;">my_list</span>.extend([<span>"date", "fig"</span>])</code></pre>
                            <pre><code id="codeContent31">print(<span style="color: #4f96e7;">my_list</span>)</code></pre>
                        </div>
                        <div class="output" id="output31"></div>
                    </div>
                </div>
                <div class="display">
                    <a href="chapter3.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Giới thiệu chương 3.</div>
                        </div>
                    </a>

                    <a href="chapter3_2.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Tuples trong python.</div>
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