<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>MODULE VÀ PACKAGE</h3>
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
                <h3>Giới thiệu chung</h3>
                <p>Python, module và package là hai khái niệm quan trọng giúp tổ chức và quản lý mã nguồn hiệu quả, đặc
                    biệt trong các dự án lớn. Chúng không chỉ giúp mã nguồn dễ bảo trì, mà còn tăng cường tính tái sử
                    dụng và khả năng mở rộng.</p>
                <h3>Module</h3>
                <p>- Module là một tập tin chứa mã Python với phần mở rộng .py. Nó có thể chứa các hàm, lớp, biến và
                    thậm chí là các module khác. Việc sử dụng module giúp chia nhỏ chương trình lớn thành các phần dễ
                    quản lý hơn. Bạn có thể nhập (import) một module vào bất kỳ chương trình nào để sử dụng các thành
                    phần của nó.</p>
                <p>- Ví dụ: Tạo một file math_functions.py chứa các hàm toán học, sau đó có thể import và sử dụng trong
                    các phần khác của dự án.</p>
                <h3>Package</h3>
                <p>- Package là một thư mục chứa nhiều module liên quan đến nhau, kèm theo một file __init__.py (trong
                    Python 3.3 trở đi, file này có thể không cần thiết). Package giúp tổ chức các module thành một không
                    gian tên (namespace), từ đó tránh xung đột tên và dễ dàng quản lý cấu trúc dự án.</p>
                <p>- Ví dụ: Một package geometry có thể chứa các module như shapes.py, operations.py, giúp nhóm các chức
                    năng liên quan đến hình học lại với nhau.</p>
                <p>Sử dụng module và package giúp tăng tính rõ ràng của mã nguồn, giảm sự trùng lặp và hỗ trợ cho việc
                    phát triển phần mềm theo phương pháp module hóa. Chương này sẽ giúp bạn hiểu rõ hơn về cách tạo, sử
                    dụng, và quản lý module và package trong Python.</p>
                <div class="section">
                    <section>
                        <h3><a href="chapter4.php">Chương 4: Module và package</a></h3>
                        <a href="chapter4_1.php">Module.</a>
                        <a href="chapter4_2.php">package.</a>
                        <a href="exercise4.php">Bài tập chương 4</a>
                    </section>
                </div>
                <div class="display">
                    <a href="exercise3.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Bài tập chương 3.</div>
                        </div>
                    </a>

                    <a href="chapter4_1.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Module trong python.</div>
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
</body>

</html>