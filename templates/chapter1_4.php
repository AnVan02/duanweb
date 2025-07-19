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
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>TOÁN TỬ TRONG PYTHON</h3>
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
                <h3>Các toán tử trong python hiểu và ứng dụng</h3>
                <p>Trong Python, toán tử là công cụ quan trọng giúp bạn thực hiện các phép toán và kiểm tra điều kiện
                    trên biến và giá trị. Chúng không chỉ hỗ trợ các phép toán số học mà còn giúp xây dựng các biểu thức
                    logic và điều kiện phức tạp, giúp điều khiển luồng chương trình một cách linh hoạt.</p>
                <p>Python cung cấp nhiều loại toán tử khác nhau, mỗi loại có vai trò riêng trong xử lý dữ liệu và điều
                    kiện. Hiểu rõ cách hoạt động của chúng sẽ giúp bạn viết mã hiệu quả hơn và tối ưu hóa thuật toán.
                </p>
                <p>Dưới đây là các loại toán tử chính trong Python, kèm theo ví dụ cụ thể để bạn dễ dàng áp dụng trong
                    lập trình.</p>
                <h3>Toán tử số học</h3>
                <p>Toán tử số học trong Python giúp thực hiện các phép tính cơ bản như cộng (+), trừ (-), nhân (*), chia
                    (/), chia lấy phần nguyên (//), lấy dư (%), và lũy thừa (**). Chúng đóng vai trò quan trọng trong xử
                    lý dữ liệu số, từ các phép toán đơn giản đến tính toán phức tạp.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Toán tử số học (Arithmetic Operators)</th>
                            <th>Tên phép toán</th>
                            <th>Ví dụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>+</td>
                            <td>Cộng</td>
                            <td>x + y</td>
                        </tr>
                        <tr>
                            <td>-</td>
                            <td>Trừ</td>
                            <td>x - y</td>
                        </tr>
                        <tr>
                            <td>*</td>
                            <td>Nhân</td>
                            <td>x * y</td>
                        </tr>
                        <tr>
                            <td>/</td>
                            <td>Chia</td>
                            <td>x / y</td>
                        </tr>
                        <tr>
                            <td>%</td>
                            <td>Chia lấy dư</td>
                            <td>x % y</td>
                        </tr>
                        <tr>
                            <td>**</td>
                            <td>Lấy lũy thừa</td>
                            <td>x ** y</td>
                        </tr>
                        <tr>
                            <td>//</td>
                            <td>Chia lấy phần nguyên</td>
                            <td>x // y</td>
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
                                <button id="runButton11"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton11"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent11"><span style="color: #4f96e7;">n</span> = 1 + 2 + 3.5</code></pre>
                            <pre><code id="codeContent11">print(<span style="color: #4cca76;">type</span>(<span style="color: #4f96e7;">n</span>))</code></pre>
                            <pre><code id="codeContent11">print(<span style="color: #4f96e7;">n</span>)</code></pre>
                        </div>
                        <div class="output" id="output11"></div>
                    </div>
                </div>
                <p>Những toán tử này giúp bạn thực hiện các phép tính nhanh chóng và linh hoạt trong lập trình Python.
                </p>
                <h3>Toán tử gán</h3>
                <p>Toán tử gán trong Python được sử dụng để gán giá trị cho biến. Toán tử cơ bản nhất là =, ngoài ra còn
                    có các toán tử gán kết hợp như +=, -=, *=, /=, //=, %=, và **=, giúp thực hiện phép toán và gán giá
                    trị mới cho biến trong cùng một câu lệnh.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Toán tử gán (Assignment Operator)</th>
                            <th>Mô tả</th>
                            <th>Ví dụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>=</td>
                            <td>Sử dụng để gán giá trị cho một biến</td>
                            <td>A = 3</td>
                        </tr>
                        <tr>
                            <td>+=</td>
                            <td>Cộng giá trị hiện tại của biến với một giá trị mới và gán kết quả cho biến đó</td>
                            <td>A += 3</td>
                        </tr>
                        <tr>
                            <td>-=</td>
                            <td>Trừ giá trị hiện tại của biến với một giá trị mới và gán kết quả cho biến đó</td>
                            <td>A -= 3</td>
                        </tr>
                        <tr>
                            <td>*=</td>
                            <td>Nhân giá trị hiện tại của biến với một giá trị mới và gán kết quả cho biến đó</td>
                            <td>A *= 5</td>
                        </tr>
                        <tr>
                            <td>/=</td>
                            <td>Chia giá trị hiện tại của biến với một giá trị mới và gán kết quả cho biến đó dưới dạng
                                số thực</td>
                            <td>A /= 9</td>
                        </tr>
                        <tr>
                            <td>%=</td>
                            <td>Nó chia giá trị hiện tại của biến với một giá trị mới và gán phần dư của phép chia cho
                                biến đó</td>
                            <td>A %= 3</td>
                        </tr>
                        <tr>
                            <td>//=</td>
                            <td>Nó tính phép chia lấy phần nguyên giữa giá trị hiện tại của biến và một giá trị khác và
                                gán kết quả cho biến đó</td>
                            <td>A //= 2</td>
                        </tr>
                        <tr>
                            <td>**=</td>
                            <td>Phép lũy thừa của giá trị hiện tại của biến với một giá trị mới và gán kết quả cho biến
                                đó</td>
                            <td>A **= 3</td>
                        </tr>
                        <tr>
                            <td>&=</td>
                            <td>Thực hiện phép toán AND nhị phân giữa giá trị hiện tại của biến và một giá trị khác, sau
                                đó gán kết quả cho biến đó</td>
                            <td>A &= 2</td>
                        </tr>
                        <tr>
                            <td>|=</td>
                            <td>Thực hiện phép toán OR nhị phân giữa giá trị hiện tại của biến và một giá trị khác, sau
                                đó gán kết quả cho biến đó</td>
                            <td>X |= 3</td>
                        </tr>
                    </tbody>
                </table>

                <p>Các toán tử này giúp mã ngắn gọn hơn và tối ưu hóa việc xử lý dữ liệu trong chương trình.</p>

                <h3>Toán tử logic</h3>
                <p>Toán tử logic trong Python được sử dụng để kết hợp các điều kiện, giúp kiểm tra nhiều điều kiện cùng
                    lúc và đưa ra kết quả True hoặc False. Ba toán tử logic phổ biến là:</p>
                <table>
                    <thead>
                        <tr>
                            <th>Toán tử logic</th>
                            <th>Ý nghĩa</th>
                            <th>Ví dụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>and</td>
                            <td>Trả về True nếu cả hai mệnh đề là đúng</td>
                            <td>X &lt; 5 and y &lt; 10</td>
                        </tr>
                        <tr>
                            <td>or</td>
                            <td>Trả về True nếu một trong hai mệnh đề là đúng</td>
                            <td>X &lt; 5 or y &gt; 6</td>
                        </tr>
                        <tr>
                            <td>not</td>
                            <td>Trả về False nếu mệnh đề đúng</td>
                            <td>not( x &lt; 5 and y &lt; 9)</td>
                        </tr>
                    </tbody>
                </table>
                <p>Những toán tử này giúp xây dựng các biểu thức điều kiện phức tạp, đặc biệt hữu ích trong câu lệnh if,
                    vòng lặp và xử lý logic trong chương trình.</p>
                <h3>Toán tử định danh</h3>
                <p>Toán tử định danh trong Python (is và is not) được sử dụng để so sánh địa chỉ vùng nhớ của hai đối
                    tượng, thay vì so sánh giá trị của chúng.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Toán tử</th>
                            <th>Ý nghĩa</th>
                            <th>Ví dụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>is</td>
                            <td>Trả về True nếu cả 2 cùng đối tượng</td>
                            <td>x is y</td>
                        </tr>
                        <tr>
                            <td>is not</td>
                            <td>Trả về True nếu cả 2 không cùng đối tượng</td>
                            <td>x is not y</td>
                        </tr>
                    </tbody>
                </table>
                <p>Toán tử định danh thường được sử dụng khi cần kiểm tra xem hai biến có trỏ đến cùng một đối tượng hay
                    không, đặc biệt quan trọng khi làm việc với kiểu dữ liệu phức tạp như danh sách hoặc đối tượng trong
                    lập trình hướng đối tượng.</p>
                <h3>Toán Tử Thành Viên (Membership Operators)</h3>
                <p>Toán tử thành viên trong Python (in và not in) được sử dụng để kiểm tra xem một giá trị có tồn tại
                    trong một chuỗi, danh sách, bộ dữ liệu (tuple), tập hợp (set) hoặc từ điển (dictionary) hay không.
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Toán tử</th>
                            <th>Ý nghĩa</th>
                            <th>Ví dụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>in</td>
                            <td>Trả về True nếu một chuỗi với giá trị được chỉ định có trong đối tượng</td>
                            <td>x in y</td>
                        </tr>
                        <tr>
                            <td>not in</td>
                            <td>Trả về True nếu một chuỗi với giá trị được chỉ định không có trong đối tượng</td>
                            <td>x not in y</td>
                        </tr>
                    </tbody>
                </table>
                <p>Toán tử này rất hữu ích khi làm việc với cấu trúc dữ liệu và xử lý chuỗi, giúp kiểm tra sự tồn tại
                    của phần tử một cách nhanh chóng và dễ dàng.</p>
                <div class="display">
                    <a href="chapter1_3.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Biến và các kiểu dữ liệu cơ bản trong python.</div>
                        </div>
                    </a>

                    <a href="exercise1.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Bài tập chương 1.</div>
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