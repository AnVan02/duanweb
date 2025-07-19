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
        <h3>PYPLOT</h3>
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
                <h3>Pyplot là gì?</h3>
                <p>Pyplot là một module trong thư viện Matplotlib của Python, được sử dụng để tạo ra các biểu đồ 2D. Nó
                    cung cấp một giao diện giống như MATLAB, giúp việc vẽ đồ thị trở nên dễ dàng hơn cho các nhà phân
                    tích dữ liệu và lập trình viên.</p>
                <p>Tính năng chính:</p>
                <p>- Dễ dàng vẽ nhiều loại biểu đồ (đường, cột, tròn, phân tán, v.v.).</p>
                <p>- Tùy chỉnh các yếu tố của biểu đồ như màu sắc, nhãn, tiêu đề và kích thước.</p>
                <p>- Hỗ trợ cho việc lưu trữ biểu đồ dưới nhiều định dạng hình ảnh.</p>
                <h3>Cấu trúc cơ bản của Pyplot</h3>
                <p>Matplotlib cung cấp mô-đun <b>pyplot</b> giúp tạo và tùy chỉnh biểu đồ một cách linh hoạt. Để vẽ một
                    biểu đồ bằng pyplot, ta thực hiện theo các bước sau:</p>
                <p><b>Nhập thư viện:</b> Trước tiên, cần nhập thư viện Matplotlib và mô-đun pyplot để có thể sử dụng các
                    hàm vẽ biểu đồ.</p>
                <p><b>Chuẩn bị dữ liệu:</b> Dữ liệu đầu vào có thể là danh sách, mảng NumPy hoặc DataFrame từ Pandas. Dữ
                    liệu này sẽ được dùng làm giá trị cho các trục hoành (x) và trục tung (y). Tùy theo loại biểu đồ, dữ
                    liệu có thể gồm một hoặc nhiều tập hợp giá trị.</p>
                <p><b>Tạo biểu đồ:</b> Sử dụng các hàm vẽ của pyplot để tạo biểu đồ phù hợp với mục đích trực quan hóa.
                    Một số hàm phổ biến bao gồm:</p>
                <p style="margin-left: 20px;">• <b>plt.plot():</b> Vẽ biểu đồ đường (line plot).</p>
                <p style="margin-left: 20px;">• <b>plt.bar():</b> Vẽ biểu đồ cột (bar chart).</p>
                <p style="margin-left: 20px;">• <b>plt.scatter():</b> Vẽ biểu đồ tán xạ (scatter plot).</p>
                <p style="margin-left: 20px;">• <b>plt.hist():</b> Vẽ biểu đồ histogram (phân bố dữ liệu).</p>
                <p style="margin-left: 20px;">• <b>plt.pie():</b> Vẽ biểu đồ tròn (pie chart).</p>

                <p><b>Tùy chỉnh biểu đồ:</b> Sau khi vẽ, có thể tùy chỉnh biểu đồ bằng cách:</p>
                <p style="margin-left: 20px;">• <b>Thêm tiêu đề (plt.title()):</b> Giúp người xem hiểu nội dung biểu đồ.
                </p>
                <p style="margin-left: 20px;">• <b>Đặt tên trục (plt.xlabel(), plt.ylabel()):</b>Cung cấp thông tin về
                    giá trị trên các trục.</p>
                <p style="margin-left: 20px;">• <b>Thêm lưới (plt.grid()):</b> Giúp dễ quan sát các giá trị trên biểu
                    đồ.</p>
                <p style="margin-left: 20px;">• <b>Chú thích (Legend) (plt.legend()):</b> Hiển thị nhãn cho từng đường
                    hoặc tập dữ liệu trong biểu đồ.</p>
                <p><b>Hiển thị và lưu biểu đồ:</b> Sau khi hoàn tất vẽ và tùy chỉnh, có thể hiển thị biểu đồ trên màn
                    hình bằng plt.show(). Nếu cần lưu biểu đồ để sử dụng sau này, có thể dùng plt.savefig(), hỗ trợ
                    nhiều định dạng tệp như PNG, PDF, SVG,...</p>
                <h3>Vẽ biểu đồ đường</h3>
                <p>Biểu đồ đường là một trong những loại biểu đồ phổ biến, thường được sử dụng để thể hiện sự thay đổi
                    của một biến theo thời gian hoặc một biến độc lập khác.</p>
                <p>Cách thức hoạt động:</p>
                <p>- Bạn sẽ cung cấp một danh sách các giá trị cho trục X và một danh sách tương ứng cho trục Y.</p>
                <p>- Hàm plt.plot() sẽ kết nối các điểm với nhau bằng một đường.</p>
                <p><b>Ví dụ 1</b></p>
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
                                <button id="copyButton61"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent61"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">matplotlib.pyplot</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">plt</span></code></pre>
                            <pre><code id="codeContent61"><span style="color: #4f96e7;">x</span> = [1,2,3,4,5]</code></pre>
                            <pre><code id="codeContent61"><span style="color: #4f96e7;">y</span> = [2,3,5,7,11]</code></pre>
                            <pre><code id="codeContent61"><span style="color: #4cca76;">plt</span>.plot(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>)</code></pre>
                            <pre><code id="codeContent61"><span style="color: #4cca76;">plt</span>.title(<span>"Test"</span>)</code></pre>
                            <pre><code id="codeContent61"><span style="color: #4cca76;">plt</span>.xlabel(<span>'x'</span>)</code></pre>
                            <pre><code id="codeContent61"><span style="color: #4cca76;">plt</span>.ylabel(<span>'y'</span>)</code></pre>
                            <pre><code id="codeContent61"><span style="color: #4cca76;">plt</span>.show()</code></pre>
                        </div>
                    </div>
                </div>

                <p><b>Kết quả:</b></p>
                <div class="image">
                    <img src="static/image/matplotlib1.png">
                    <i><u>Kết quả ví dụ một</u></i>
                </div>
                <p>Ta có thể tùy chỉnh biểu đồ để làm cho nó trở nên trực quan hơn. Điều này bao gồm việc thay đổi màu
                    sắc, kiểu đường, và hình dạng của các điểm</p>
                <p>Các tùy chọn tùy chỉnh:</p>
                <p>- color: Đặt màu sắc cho đường.</p>
                <p>- linestyle: Thay đổi kiểu đường (liền, gạch, chấm, v.v.).</p>
                <p><b>Ví dụ 2</b></p>

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
                                <button id="copyButton62"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent62"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">matplotlib.pyplot</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">plt</span></code></pre>
                            <pre><code id="codeContent62"><span style="color: #4f96e7;">x</span> = [1,2,3,4,5]</code></pre>
                            <pre><code id="codeContent62"><span style="color: #4f96e7;">y</span> = [2,3,5,7,11]</code></pre>
                            <pre><code id="codeContent62"><span style="color: #4cca76;">plt</span>.plot(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>, <span style="color: #4f96e7;">color</span>=<span>'red'</span>, <span style="color: #4f96e7;">linestyle</span>=<span>'--'</span>, <span style="color: #4f96e7;">marker</span>=<span>'o'</span>)</code></pre>
                            <pre><code id="codeContent62"><span style="color: #4cca76;">plt</span>.title(<span>"Test"</span>)</code></pre>
                            <pre><code id="codeContent62"><span style="color: #4cca76;">plt</span>.xlabel(<span>'x'</span>)</code></pre>
                            <pre><code id="codeContent62"><span style="color: #4cca76;">plt</span>.ylabel(<span>'y'</span>)</code></pre>
                            <pre><code id="codeContent62"><span style="color: #4cca76;">plt</span>.show()</code></pre>
                        </div>

                    </div>
                </div>
                <p><b>Kết quả:</b></p>
                <div class="image">
                    <img src="static/image/matplotlib2.png">
                    <i><u>Kết quả ví dụ hai</u></i>
                </div>
                <h3>Vẽ biểu đồ cột.</h3>
                <p>Biểu đồ cột là một cách trực quan để so sánh các giá trị giữa các danh mục khác nhau. Mỗi cột thể
                    hiện một giá trị cho một danh mục cụ thể.</p>
                <p>Cách thức hoạt động: Bạn sẽ cung cấp một danh sách các danh mục cho trục X và một danh sách các giá
                    trị tương ứng cho trục Y.</p>
                <p><b>Ví dụ 3</b></p>
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
                                <button id="copyButton63"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent63"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">matplotlib.pyplot</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">plt</span></code></pre>
                            <pre><code id="codeContent63"><span style="color: #4f96e7;">categories</span> = [<span>'A','B','C','D'</span>]</code></pre>
                            <pre><code id="codeContent63"><span style="color: #4f96e7;">values</span> = [4,7,1,8]</code></pre>
                            <pre><code id="codeContent63"><span style="color: #4cca76;">plt</span>.bar(<span style="color: #4f96e7;">categories</span>, <span style="color: #4f96e7;">values</span>)</code></pre>
                            <pre><code id="codeContent63"><span style="color: #4cca76;">plt</span>.title(<span>"Test"</span>)</code></pre>
                            <pre><code id="codeContent63"><span style="color: #4cca76;">plt</span>.xlabel(<span>'x'</span>)</code></pre>
                            <pre><code id="codeContent63"><span style="color: #4cca76;">plt</span>.ylabel(<span>'y'</span>)</code></pre>
                            <pre><code id="codeContent63"><span style="color: #4cca76;">plt</span>.show()</code></pre>
                        </div>
                    </div>
                </div>
                <p><b>Kết quả:</b></p>
                <div class="image">
                    <img src="static/image/matplotlib3.png">
                    <i><u>Kết quả ví dụ ba</u></i>
                </div>

                <h3>Vẽ biểu đồ tròn.</h3>
                <p>Biểu đồ tròn được sử dụng để thể hiện tỷ lệ phần trăm của các phần trong tổng thể, giúp người xem dễ
                    dàng so sánh sự đóng góp của từng thành phần. Mỗi phần trong biểu đồ đại diện cho một danh mục cụ
                    thể, với kích thước của nó tỷ lệ thuận với giá trị của danh mục đó so với tổng thể.</p>
                <p>Để tạo biểu đồ tròn, bạn cần cung cấp một danh sách các giá trị đại diện cho từng phần và danh sách
                    nhãn tương ứng. Matplotlib sẽ tự động tính toán tỷ lệ phần trăm và chia biểu đồ thành các phần tương
                    ứng với dữ liệu được cung cấp. Ngoài ra, bạn có thể tùy chỉnh màu sắc, hiển thị phần trăm, xoay biểu
                    đồ hoặc tách rời một phần để nhấn mạnh thông tin quan trọng.</p>
                <p><b>Ví dụ 4</b></p>
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
                                <button id="copyButton64"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent64"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">matplotlib.pyplot</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">plt</span></code></pre>
                            <pre><code id="codeContent64"><span style="color: #4f96e7;">labels</span> = [<span>'A'</span>, <span>'B'</span>, <span>'C'</span>, <span>'D'</span>]</code></pre>
                            <pre><code id="codeContent64"><span style="color: #4f96e7;">sizes</span> = [15,30,45,10]</code></pre>
                            <pre><code id="codeContent64"><span style="color: #4cca76;">plt</span>.pie(<span style="color: #4f96e7;">sizes</span>, <span style="color: #4f96e7;">labels</span>=<span style="color: #4f96e7;">labels</span>, <span style="color: #4f96e7;">autopct</span>=<span>'%1.1f%%'</span>)</code></pre>
                            <pre><code id="codeContent64"><span style="color: #4cca76;">plt</span>.title(<span>'Biểu đồ tròn'</span>)</code></pre>
                            <pre><code id="codeContent64"><span style="color: #4cca76;">plt</span>.show()</code></pre>
                        </div>

                    </div>
                </div>
                <p><b>Kết quả:</b></p>
                <div class="image">
                    <img src="static/image/matplotlib4.png">
                    <i><u>Kết quả ví dụ bốn</u></i>
                </div>

                <h3>Biểu đồ phân tán(Scatter).</h3>
                <p>Biểu đồ scatter vẽ các điểm dữ liệu trên một hệ tọa độ, với mỗi điểm đại diện cho một cặp giá trị từ
                    hai biến. Sử dụng biểu đồ scatter để phân tích mối quan hệ giữa hai biến (có thể là tương quan, xu
                    hướng, hoặc phân phối). Nó giúp người xem nhận biết được sự phân bố và mối liên hệ giữa các điểm dữ
                    liệu.</p>
                <p>Các Thành Phần Chính của Biểu Đồ Scatter</p>
                <p>- <b>Trục x và trục y:</b> Đại diện cho hai biến mà bạn muốn phân tích.</p>
                <p>- <b>Điểm dữ liệu:</b> Mỗi điểm đại diện cho một cặp giá trị từ hai biến. Màu sắc và kích thước của
                    điểm có thể được điều chỉnh để truyền đạt thêm thông tin.</p>
                <p><b>Ví dụ 5</b></p>
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
                                <button id="copyButton65"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent65"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">matplotlib.pyplot</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">plt</span></code></pre>
                            <pre><code id="codeContent65"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">numpy</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">np</span></code></pre>
                            <pre><code id="codeContent65"><span style="color: #4f96e7;">x</span> = <span style="color: #4cca76;">np</span>.random.rand(50) * 100</code></pre>
                            <pre><code id="codeContent65"><span style="color: #4f96e7;">y</span> = <span style="color: #4cca76;">np</span>.random.rand(50) * 100</code></pre>
                            <pre><code id="codeContent65"><span style="color: #4cca76;">plt</span>.scatter(<span style="color: #4f96e7;">x</span>, <span style="color: #4f96e7;">y</span>)</code></pre>
                            <pre><code id="codeContent65"><span style="color: #4cca76;">plt</span>.title(<span>'Scatter'</span>)</code></pre>
                            <pre><code id="codeContent65"><span style="color: #4cca76;">plt</span>.xlabel(<span>'x'</span>)</code></pre>
                            <pre><code id="codeContent65"><span style="color: #4cca76;">plt</span>.ylabel(<span>'y'</span>)</code></pre>
                            <pre><code id="codeContent65"><span style="color: #4cca76;">plt</span>.show()</code></pre>
                        </div>
                    </div>
                </div>
                <p><b>Kết quả:</b></p>
                <div class="image">
                    <img src="static/image/matplotlib5.png">
                    <i><u>Kết quả ví dụ năm</u></i>
                </div>
                <h3>Biểu đồ Histogram.</h3>
                <p>Biểu đồ histogram là một biểu đồ cột, trong đó mỗi cột đại diện cho số lượng dữ liệu nằm trong một
                    khoảng giá trị cụ thể. Sử dụng histogram để phân tích phân bố dữ liệu, xác định các đặc điểm như
                    tính chất đồng nhất, độ lệch chuẩn, và các mẫu cụ thể trong tập dữ liệu.</p>
                <p>Các Thành Phần Chính của Biểu Đồ Histogram</p>
                <p>- Trục x: Đại diện cho các khoảng giá trị (bins) mà dữ liệu được chia.</p>
                <p>- Trục y: Đại diện cho tần suất (số lượng) của dữ liệu trong mỗi khoảng.</p>
                <p>- Cột: Mỗi cột thể hiện số lượng dữ liệu trong khoảng tương ứng.</p>

                <p><b>Ví dụ 6</b></p>
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
                                <button id="copyButton66"><span class="material-icons">content_copy</span></button>
                            </div>
                        </div>
                        <div class="code">
                            <pre><code id="codeContent66"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">matplotlib.pyplot</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">plt</span></code></pre>
                            <pre><code id="codeContent66"><span style="color: #c108da;">import</span> <span style="color: #4cca76;">numpy</span> <span style="color: #c108da;">as</span> <span style="color: #4cca76;">np</span></code></pre>
                            <pre><code id="codeContent66"><span style="color: #4cca76;">np</span>.random.seed(0)</code></pre>
                            <pre><code id="codeContent66"><span style="color: #4f96e7;">data</span> = <span style="color: #4cca76;">np</span>.random.randn(1000)</code></pre>
                            <pre><code id="codeContent66"><span style="color: #4cca76;">plt</span>.figure(figsize=(10,6))</code></pre>
                            <pre><code id="codeContent66"><span style="color: #4cca76;">plt</span>.hist(<span style="color: #4f96e7;">data</span>, bins=30, color=<span>'blue'</span>, alpha=0.7, edgecolor=<span>'black'</span>)</code></pre>
                            <pre><code id="codeContent66"><span style="color: #4cca76;">plt</span>.title(<span>"Biểu đồ tần suất"</span>)</code></pre>
                            <pre><code id="codeContent66"><span style="color: #4cca76;">plt</span>.xlabel(<span>'x'</span>)</code></pre>
                            <pre><code id="codeContent66"><span style="color: #4cca76;">plt</span>.ylabel(<span>'y'</span>)</code></pre>
                            <pre><code id="codeContent66"><span style="color: #4cca76;">plt</span>.show()</code></pre>
                        </div>

                    </div>
                </div>
                <p><b>Kết quả:</b></p>
                <div class="image">
                    <img src="static/image/matplotlib5.png">
                    <i><u>Kết quả ví dụ sáu</u></i>
                </div>

                <div class="display">
                    <a href="chapter6.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Giới thiệu chương sáu.</div>
                        </div>
                    </a>

                    <a href="chapter6_2.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Lưu biểu đồ.</div>
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