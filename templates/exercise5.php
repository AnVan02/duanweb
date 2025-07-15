<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/code.css">
    <link rel="stylesheet" href="static/css/table.css">
    <link rel="stylesheet" href="static/css/code_running.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="button-toggle">
            <button class="button" onclick="toggleChapter()"><i class="fa fa-bars"></i></button>
        </div>
        <h3>BÀI TẬP CHƯƠNG 4</h3>
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
                <h3>Phần bài tập</h3>
                <p>1. Tạo một DataFrame từ một dictionary và thực hiện các thao tác cơ bản như xem 5 hàng đầu tiên,
                    thông tin về DataFrame và thống kê dữ liệu.</p>
                <p>Cho file excel như sau:</p>
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>City</th>
                            <th>Hire Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Alice</td>
                            <td>30</td>
                            <td>IT</td>
                            <td>70000</td>
                            <td>New York</td>
                            <td>6/15/2018</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Bob</td>
                            <td>25</td>
                            <td>HR</td>
                            <td>48000</td>
                            <td>Los Angeles</td>
                            <td>3/12/2019</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Charlie</td>
                            <td>28</td>
                            <td>IT</td>
                            <td>60000</td>
                            <td>New York</td>
                            <td>9/1/2020</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>David</td>
                            <td>35</td>
                            <td>Marketing</td>
                            <td>90000</td>
                            <td>Chicago</td>
                            <td>1/5/2016</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Eve</td>
                            <td>29</td>
                            <td>HR</td>
                            <td>52000</td>
                            <td>Los Angeles</td>
                            <td>4/17/2021</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Frank</td>
                            <td>33</td>
                            <td>IT</td>
                            <td>75000</td>
                            <td>Chicago</td>
                            <td>11/23/2017</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Grace</td>
                            <td>40</td>
                            <td>Sales</td>
                            <td>95000</td>
                            <td>Miami</td>
                            <td>8/9/2015</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Helen</td>
                            <td>22</td>
                            <td>Marketing</td>
                            <td>45000</td>
                            <td>Miami</td>
                            <td>5/6/2022</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Ivan</td>
                            <td>27</td>
                            <td>Sales</td>
                            <td>64000</td>
                            <td>New York</td>
                            <td>10/30/2019</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Jack</td>
                            <td>38</td>
                            <td>Marketing</td>
                            <td>85000</td>
                            <td>Chicago</td>
                            <td>7/19/2014</td>
                        </tr>
                    </tbody>
                </table>
                <p>2. Tính mức lương trung bình của tất cả nhân viên trong công ty. Kết quả của bạn có thể cho thấy gì
                    về mức lương trung bình so với các bộ phận khác nhau trong công ty?</p>
                <p>3. Cho biết số lượng nhân viên trong mỗi bộ phận. Bộ phận nào có nhiều nhân viên nhất và bộ phận nào
                    ít nhân viên nhất?</p>
                <p>4. Tìm số lượng nhân viên có mức lương cao hơn 50,000 nhưng không làm việc trong bộ phận Sales. Số
                    lượng này chiếm tỷ lệ bao nhiêu so với tổng số nhân viên trong công ty?</p>
                <p>5. Ai là nhân viên có thời gian làm việc lâu nhất và ngắn nhất trong công ty? Hãy chỉ ra tên, bộ
                    phận, và số năm làm việc của họ.</p>
                <!-- code -->
                <div class="code_running">
                    <div class="top-bar">
                        <span>💻 Python Online</span>
                        <button class="btn-run" onclick="runPython()"><i class="fa fa-play"></i> Chạy Code</button>
                    </div>
                    <div class="editor-container">
                        <textarea id="codeInput"></textarea>
                    </div>
                    <div class="output-container" id="output">Đang chờ code...</div>
                </div>
                <!-- code -->
                <div class="display">
                    <a href="chapter4_2.php" class="select">
                        <div class="arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="text-container_left">
                            <div class="previously">PREVIOUSLY</div>
                            <div class="link">Package trong python.</div>
                        </div>
                    </a>

                    <a href="chapter5.php" class="select">
                        <div class="text-container_right">
                            <div class="previously">UP NEXT</div>
                            <div class="link">Giới thiệu chương 5.</div>
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
    <script src="static/javascript/code_running.js"></script>
</body>

</html>