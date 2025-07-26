<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Làm quen với Python</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
   
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="javascript:void(0)" class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
             <div class="logo">
                <img src="../ROSA_AI_Ready.png" alt="Logo">
            </div>
            <button class="menu-btn" onclick="toggleSidebar()">
                <span>Mục lục</span>
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <div class="title-section">
        <h1 class="main-title">LÀM QUEN VỚI PYTHON</h1>
        <p class="subtitle">
            <a href="#">Chương 1: Giới thiệu chung</a> > <a href="#">Làm quen với Python</a>
        </p>
    </div>

    <div class="main-container fade-in">
        <div class="content-grid">
            <div class="main-content">
                <div class="content-section">
                    <h2 class="section-title">Giới thiệu chung</h2>
                    <p class="content-text">
                        Trong chương này, chúng ta sẽ khám phá những khái niệm cơ bản và cần thiết để làm quen với ngôn ngữ lập trình Python. Python đã trở thành một trong những ngôn ngữ lập trình phổ biến nhất trong cộng đồng lập trình viên nhờ vào sự dễ học, cú pháp rõ ràng và khả năng linh hoạt trong việc ứng dụng vào nhiều lĩnh vực khác nhau như phát triển web, khoa học dữ liệu, trí tuệ nhân tạo và tự động hóa.
                    </p>
                </div>

                <div class="content-section">
                    <h2 class="section-title">Tổng quan về Python</h2>
                    <p class="content-text">
                        Chúng ta sẽ bắt đầu bằng việc giới thiệu tổng quan về Python, lịch sử phát triển và những ưu điểm nổi bật của nó. Python không chỉ được thiết kế để dễ đọc và dễ hiểu, mà còn cung cấp một môi trường mạnh mẽ cho việc phát triển các ứng dụng phức tạp.
                    </p>
                </div>

                <div class="content-section">
                    <h2 class="section-title">Làm quen với Python</h2>
                    <p class="content-text">
                        Chúng ta sẽ thực hiện một bước đầu tiên đơn giản nhưng quan trọng: viết và chạy chương trình đầu tiên bằng Python. Qua đó, bạn sẽ hiểu rõ hơn về cách thức hoạt động của ngôn ngữ này và làm quen với công cụ lập trình. Biến và các kiểu dữ liệu cơ bản trong Python. Chúng ta sẽ tìm hiểu về biến và các kiểu dữ liệu cơ bản trong Python.
                    </p>
                </div>
            </div>

            <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
            
            <div class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <button class="close-sidebar-btn" onclick="closeSidebar()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="sidebar-content">
                    <div class="chapter-section">
                        <div class="chapter-number">Chương 1: Giới thiệu chung</div>
                        <ul class="chapter-items">
                            <li class="chapter-item" onclick="selectChapter(this)">Tổng quan về Python</li>
                            <li class="chapter-item active" onclick="selectChapter(this)">Làm quen với python.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Biến và các kiểu dữ liệu cơ bản</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Toán tử trong python.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Bài tập chương 1.</li>
                        </ul>
                    </div>

                    <div class="chapter-section">
                        <div class="chapter-number">Chương 2: Cấu trúc điều khiển</div>
                        <ul class="chapter-items">
                            <li class="chapter-item" onclick="selectChapter(this)">Câu lệnh điều kiện if.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Vòng lặp for và while.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Break và continue</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Xử lý ngoại lệ.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Bài tập chương 2.</li>
                        </ul>
                    </div>

                    <div class="chapter-section">
                        <div class="chapter-number">Chương 3: Hàm và Module</div>
                        <ul class="chapter-items">
                            <li class="chapter-item" onclick="selectChapter(this)">Định nghĩa hàm.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Tham số và đối số.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Lambda functions</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Import và module.</li>
                            <li class="chapter-item" onclick="selectChapter(this)">Bài tập chương 3.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="navigation">
            <a href="javascript:void(0)" class="nav-btn prev" onclick="goToPrevious()">
                <i class="fas fa-arrow-left"></i>
                <div>
                    <div class="nav-text">Bài trước đó</div>
                </div>
            </a>
            
            <div class="vertical-divider"></div>
            <a href="javascript:void(0)" class="nav-btn next" onclick="goToNext()">
                <div>
                    <div class="nav-text">Bài tiếp theo</div>
                </div>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <script src="static/javascript/index.js"></script>
    <script src="static/javascript/code.js"></script>
   

</body>
</html>