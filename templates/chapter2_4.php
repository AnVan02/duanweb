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
        <h3>HÀM TRONG PYTHON</h3>
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
                <h3>Hàm có không có tham số</h3>
                <p>Hàm không có tham số là một hàm mà khi được gọi, nó không nhận bất kỳ giá trị đầu vào nào. Điều này
                    có nghĩa là khi bạn định nghĩa hàm, bạn không cần phải khai báo bất kỳ tham số nào trong danh sách
                    tham số của hàm. Thay vì nhận đầu vào, hàm không có tham số thường thực hiện một công việc cố định
                    hoặc trả về một giá trị không thay đổi, không phụ thuộc vào dữ liệu bên ngoài.</p>
                <p>Hàm không có tham số thường được sử dụng trong các tình huống sau:</p>
                <p>- Tự động hóa công việc cố định: Khi bạn cần một hàm thực hiện một nhiệm vụ cụ thể mà không cần dữ
                    liệu đầu vào từ người dùng hoặc các hàm khác. Ví dụ, một hàm hiển thị lời chào mỗi khi nó được gọi
                    mà không quan tâm đến thông tin cụ thể nào khác.</p>
                <p>- Trả về giá trị không đổi: Nếu hàm chỉ trả về một giá trị cụ thể mà không phụ thuộc vào dữ liệu đầu
                    vào, bạn có thể sử dụng hàm không có tham số.</p>
                <p>- Khởi tạo trạng thái: Trong lập trình hướng đối tượng, các phương thức khởi tạo hoặc hàm để khởi tạo
                    trạng thái ban đầu có thể không cần tham số.</p>
                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">def ten_ham()</span>:</p>
                        <p class="indent">Các lệnh được thực thi trong hàm</p>
                    </div>
                </div>
                <p>- ten_ham: tên của hàm</p>
                <p>- ‘:’ : Ký tự phân cách giữa tiêu đề hàm và phần thân hàm.</p>
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
                                <button id="runButton23"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton23"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent23"><span style="color: #4f96e7;">def</span> say_hello():</code></pre>
                            <pre><code id="codeContent23">  print(<span >"Xin chào!"</span>)</code></pre>
                            <pre><code id="codeContent23">say_hello()</code></pre>
                        </div>
                        <div class="output" id="output23"></div>
                    </div>
                </div>

                <p>• Ưu điểm:</p>
                <p>- Đơn giản: Hàm không có tham số rất dễ viết và sử dụng vì không cần xử lý đầu vào phức tạp.</p>
                <p>- Tính ổn định: Do không phụ thuộc vào dữ liệu đầu vào, hành vi của hàm luôn ổn định và có thể dự
                    đoán trước.</p>
                <p>- Tái sử dụng: Dễ tái sử dụng trong các ngữ cảnh khác nhau mà không cần chỉnh sửa.</p>
                <p>• Nhược điểm:</p>
                <p>- Giới hạn về tính linh hoạt: Vì không nhận đầu vào, hàm không có tham số chỉ thực hiện một công việc
                    duy nhất hoặc trả về một giá trị cố định, làm hạn chế khả năng áp dụng trong các tình huống cần xử
                    lý dữ liệu đầu vào.</p>
                <p>- Ít khả năng tùy chỉnh: Người dùng không thể thay đổi hành vi của hàm dựa trên các thông số đầu vào.
                </p>

                <h3>Hàm có tham số</h3>
                <p>Hàm có tham số là một hàm nhận một hoặc nhiều giá trị đầu vào khi được gọi. Các giá trị đầu vào này
                    được gọi là "tham số" hoặc "đối số". Hàm sử dụng các tham số này để thực hiện các phép tính, thao
                    tác hoặc trả về kết quả dựa trên giá trị của chúng.</p>
                <p>Hàm có tham số thường được sử dụng khi bạn cần thực hiện một công việc mà kết quả phụ thuộc vào dữ
                    liệu đầu vào, hay bạn muốn tạo ra một hàm có tính linh hoạt cao, có thể xử lý các tình huống khác
                    nhau với các đầu vào khác nhau. Cụ thể:</p>
                <p>- Xử lý dữ liệu đa dạng: Khi cần thực hiện một thao tác trên nhiều dữ liệu khác nhau mà không cần
                    viết lại hàm cho từng trường hợp cụ thể.</p>
                <p>- Tùy biến kết quả: Khi kết quả của hàm cần thay đổi dựa trên giá trị đầu vào.</p>

                <div class="formula">
                    <div class="code-container">
                        <p><span class="keyword">def ten_ham(tham_so1, tham_so2 ,...)</span>:</p>
                        <p class="indent">Các lệnh được thực thi trong hàm</p>
                    </div>
                </div>

                <p>- ten_ham: tên của hàm</p>
                <p>- tham_so: Tham số của hàm. Bạn có thể có nhiều tham số, mỗi tham số cách nhau bằng dấu phẩy.</p>
                <p>- ‘:’ : Ký tự phân cách giữa tiêu đề hàm và phần thân hàm.</p>
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
                                <button id="runButton24"><span class="material-icons">play_arrow</span></button>
                                <button id="copyButton24"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent24"><span style="color: #4f96e7;">a</span> = 10</code></pre>
                            <pre><code id="codeContent24"><span style="color: #4f96e7;">def</span> cong(<span style="color: #4f96e7;">tham_so</span>):</code></pre>
                            <pre><code id="codeContent24">  <span style="color: #4f96e7;">total</span> = <span style="color: #4f96e7;">tham_so</span> + 10</code></pre>
                            <pre><code id="codeContent24">  <span style="color: #c108da;">return</span> <span style="color: #4f96e7;">total</span></code></pre>
                            <pre><code id="codeContent24"><span style="color: #4f96e7;">total</span> = cong(<span style="color: #4f96e7;">a</span>)</code></pre>
                            <pre><code id="codeContent24">print(<span ><span style="color: #4f96e7;">f</span>'Tổng của phép tính: {<span style="color: #4f96e7;">total</span>}'</span>)</code></pre>
                        </div>
                        <div class="output" id="output24"></div>
                    </div>
                </div>

                <p>• Ưu điểm:</p>
                <p>- Linh hoạt: Hàm có tham số rất linh hoạt, cho phép bạn xử lý nhiều loại dữ liệu khác nhau chỉ bằng
                    một đoạn mã.</p>
                <p>- Tái sử dụng: Bạn có thể dễ dàng tái sử dụng một hàm có tham số với các giá trị đầu vào khác nhau mà
                    không cần phải viết lại mã.</p>
                <p>- Tùy chỉnh hành vi của hàm: Tham số cho phép bạn thay đổi hành vi của hàm tùy theo dữ liệu đầu vào,
                    giúp hàm trở nên đa năng hơn</p>
                <p>• Nhược điểm:</p>
                <p>- Cần quản lý tham số cẩn thận: Với các hàm có nhiều tham số, việc quản lý và theo dõi các giá trị
                    đầu vào có thể trở nên phức tạp.</p>
                <p>- Khả năng phát sinh lỗi: Việc truyền tham số không đúng kiểu hoặc số lượng có thể dẫn đến lỗi trong
                    quá trình thực thi hàm.</p>
                <h3>Hàm khi có và không có lệnh "return" khác nhau như thế nào?</h3>
                <p>Lệnh return trong một hàm được sử dụng để kết thúc hàm và trả về một giá trị từ hàm đó. Giá trị này
                    có thể là bất kỳ kiểu dữ liệu nào: số, chuỗi, danh sách, đối tượng, hoặc thậm chí là None (một kiểu
                    dữ liệu đặc biệt trong Python đại diện cho giá trị không tồn tại).</p>
                <p><b>Hàm có lệnh ‘return’:</b></p>
                <p>- Trả về giá trị: Hàm có lệnh return sẽ trả về giá trị sau khi hoàn thành công việc của nó. Giá trị
                    này có thể được sử dụng tiếp trong chương trình, gán cho biến khác, hoặc dùng làm đầu vào cho các
                    hàm khác.</p>
                <p>- Kết thúc hàm: Khi gặp lệnh return, hàm sẽ kết thúc ngay lập tức, ngay cả khi sau đó còn có các câu
                    lệnh khác.</p>
                <p>- Hàm có lệnh return thường được sử dụng khi bạn cần lấy kết quả từ một phép tính hoặc xử lý nào đó
                    để tiếp tục sử dụng trong phần còn lại của chương trình.</p>
                <p><b>Hàm không có lênh ‘return’:</b></p>
                <p>- Không trả về giá trị (hoặc trả về None): Nếu hàm không có lệnh return, hoặc chỉ có lệnh return mà
                    không kèm giá trị, hàm sẽ tự động trả về None khi kết thúc.</p>
                <p>- Hàm không có lệnh return thường được dùng khi bạn chỉ cần thực hiện một hành động mà không cần kết
                    quả trả về, như in dữ liệu, thay đổi trạng thái của chương trình hoặc đối tượng.</p>

                <table>
                    <thead>
                        <tr>
                            <th>Đặc điểm</th>
                            <th>Hàm có lệnh ‘return’</th>
                            <th>Hàm không có lệnh ‘return’</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kết quả trả về</td>
                            <td>Trả về giá trị cụ thể</td>
                            <td>Trả về None hoặc không trả về gì</td>
                        </tr>

                        <tr>
                            <td>Tính ứng dụng</td>
                            <td>Thường dùng để tính toán hoặc xử lý dữ liệu và cần kết quả để sử dụng tiếp</td>
                            <td>Thường dùng để thực hiện hành động mà không cần kết quả trả về</td>
                        </tr>

                        <tr>
                            <td>Hành vi kết thúc</td>
                            <td>Kết thúc ngay khi gặp lệnh ‘return’</td>
                            <td>Tiếp tục thực hiện đến khi hết các câu lệnh hoặc kết thúc khối hàm</td>
                        </tr>
                    </tbody>
                </table>
                <div class="display">
                    <a href="chapter2_3.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">try và except trong python.</div>
                        </div>
                    </a>

                    <a href="exercise2.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Bài tập chương 2.</div>
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