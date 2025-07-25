<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Làm quen với Python</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #FFFFFF;
            min-height: 100vh;
        }

        .header {
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #FFFFFF;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1336px;
            margin: 0 auto;
        }

         .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 2rem;
            font-weight: bold;
            color: #e53e3e;
            letter-spacing: 2px;
        }

        .logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Arial', sans-serif;
            font-weight: 900;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s, opacity 0.3s ease;
            border: 1px solid #e0e0e0;
            cursor: pointer;
        }

        .back-btn:hover {
            background: #f5f5f5;
            color: #333;
            transform: scale(1.05);
        }

        .back-btn:active {
            transform: scale(0.95);
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #e53e3e;
            letter-spacing: 2px;
        }

        .menu-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: 1px solid #e0e0e0;
            color: #666;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .menu-btn:hover {
            background: #f5f5f5;
            color: #333;
            transform: scale(1.05);
        }

        .menu-btn:active {
            transform: scale(0.95);
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .title-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #718096;
            font-size: 1.1rem;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 3rem;
            align-items: start;
        }

        .content-grid.sidebar-hidden {
            grid-template-columns: 1fr;
        }

        .main-content {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .content-section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            color: #2563eb;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .content-text {
            color: #4a5568;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .sidebar {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 2px solid #3b82f6;
            height: fit-content;
            transition: all 0.3s ease;
        }

        .sidebar.desktop-hidden {
            display: none;
        }

        .chapter-section {
            margin-bottom: 2rem;
        }

        .chapter-section:last-child {
            margin-bottom: 0;
        }

        .chapter-number {
            color: #2563eb;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
        }

        .chapter-items {
            list-style: none;
            margin-left: 0;
        }

        .chapter-item {
            padding: 0.6rem 0.8rem;
            color: #4a5568;
            font-size: 0.9rem;
            transition: all 0.3s;
            cursor: pointer;
            line-height: 1.4;
            border-radius: 8px;
            margin-bottom: 0.3rem;
        }

        .chapter-item:hover {
            color: #2563eb;
            background: #f0f7ff;
            transform: translateX(4px);
        }

        .chapter-item.active {
            color: #2563eb !important;
            background: #e0f2fe;
            font-weight: 600;
            border-left: 3px solid #2563eb;
        }

        .navigation {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: white;
            color: #2563eb;
            text-decoration: none;
            border: 2px solid #2563eb;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .nav-btn:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }

        .nav-btn:active {
            transform: translateY(0);
        }

        .nav-btn.prev {
            justify-content: flex-start;
        }

        .nav-btn.next {
            justify-content: flex-end;
        }

        .nav-text {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        /* Mobile sidebar styles */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .close-sidebar-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 2001;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .close-sidebar-btn:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Mobile responsive */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr !important;
                gap: 2rem;
            }
            
            .header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 2002;
                background-color: #FFFFFF;
            }

            .main-container {
                margin-top: 70px;
            }

            .sidebar {
                position: fixed;
                top: 70px;
                left: -100%;
                height: calc(100vh - 70px);
                width: 100%;
                z-index: 1999;
                transition: left 0.3s ease;
                overflow-y: auto;
                border-radius: 0;
                border: none;
                background: white;
                display: block !important;
            }
            
            .sidebar.open {
                left: 0;
            }
            
            .sidebar-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 1.5rem;
                background: #3b82f6;
                color: white;
                font-weight: 600;
                font-size: 1.1rem;
                border-bottom: 1px solid #e2e8f0;
                position: sticky;
                top: 0;
                z-index: 2000;
            }
            
            .sidebar-content {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }
            
            .header {
                padding: 0.8rem 1rem;
            }
            
            .header-content {
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                padding: 0 1rem;
            }
            
            .logo {
                font-size: 1.5rem;
                flex-grow: 1;
                text-align: center;
            }
            
            .back-btn {
                position: absolute;
                left: 0.5rem;
                padding: 0.4rem;
            }
            
            .menu-btn {
                position: absolute;
                right: 0.5rem;
                padding: 0.4rem;
            }
            
            .back-btn span, .menu-btn span {
                display: none;
            }
            
            .main-title {
                font-size: 2rem;
            }
            
            .subtitle {
                font-size: 1rem;
            }
            
            .main-content {
                padding: 1.5rem;
                border-radius: 12px;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
            
            .nav-btn {
                flex: 1;
                padding: 0.8rem 1.5rem;
                font-size: 16px;
                border: 1px solid #2574d2;
                color: #2574d2;
                background-color: transparent;
                border-radius: 999px;
                text-align: center;
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            .main-title {
                font-size: 1.5rem;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .chapter-item {
                padding: 0.5rem;
                font-size: 0.85rem;
            }
        }

        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="javascript:void(0)" class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
             <div class="logo">
                <img src="rosa.png" alt="ROSA" class="logo-img">
                <span class="logo-text">ROSA</span>
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

    <script>
        // Hàm mở/đóng sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar'); // Lấy phần tử sidebar
            const overlay = document.getElementById('sidebarOverlay'); // Lấy overlay
            const contentGrid = document.querySelector('.content-grid'); // Lấy content-grid
            const backBtn = document.querySelector('.back-btn'); // Lấy nút "Quay lại"

            if (window.innerWidth > 1200) {
                // Hành vi trên desktop
                sidebar.classList.toggle('desktop-hidden'); // Toggle hiển thị sidebar
                contentGrid.classList.toggle('sidebar-hidden'); // Toggle layout content
                if (!sidebar.classList.contains('desktop-hidden')) {
                    backBtn.style.display = 'none'; // Ẩn nút "Quay lại" khi sidebar mở
                    backBtn.style.opacity = '0'; // Hiệu ứng mờ dần
                } else {
                    backBtn.style.display = 'flex'; // Hiện nút "Quay lại" khi sidebar đóng
                    backBtn.style.opacity = '1'; // Hiệu ứng hiện lại
                }
            } else {
                // Hành vi trên mobile
                sidebar.classList.toggle('open'); // Toggle hiển thị sidebar
                overlay.classList.toggle('active'); // Toggle overlay
                if (sidebar.classList.contains('open')) {
                    backBtn.style.display = 'none'; // Ẩn nút "Quay lại" khi sidebar mở
                    backBtn.style.opacity = '0'; // Hiệu ứng mờ dần
                } else {
                    backBtn.style.display = 'flex'; // Hiện nút "Quay lại" khi sidebar đóng
                    backBtn.style.opacity = '1'; // Hiệu ứng hiện lại
                }
            }
        }

        // Hàm đóng sidebar
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar'); // Lấy phần tử sidebar
            const overlay = document.getElementById('sidebarOverlay'); // Lấy overlay
            const contentGrid = document.querySelector('.content-grid'); // Lấy content-grid
            const backBtn = document.querySelector('.back-btn'); // Lấy nút "Quay lại"

            if (window.innerWidth > 1200) {
                // Hành vi trên desktop
                sidebar.classList.add('desktop-hidden'); // Ẩn sidebar
                contentGrid.classList.add('sidebar-hidden'); // Cập nhật layout
                backBtn.style.display = 'flex'; // Hiện nút "Quay lại"
                backBtn.style.opacity = '1'; // Hiệu ứng hiện lại
            } else {
                // Hành vi trên mobile
                sidebar.classList.remove('open'); // Ẩn sidebar
                overlay.classList.remove('active'); // Ẩn overlay
                backBtn.style.display = 'flex'; // Hiện nút "Quay lại"
                backBtn.style.opacity = '1'; // Hiệu ứng hiện lại
            }
        }

        // Hàm chọn chương
        function selectChapter(element) {
            // Xóa class 'active' khỏi tất cả các mục
            document.querySelectorAll('.chapter-item').forEach(item => {
                item.classList.remove('active');
            });
            // Thêm class 'active' cho mục được chọn
            element.classList.add('active');
            
            // Đóng sidebar trên mobile sau khi chọn
            if (window.innerWidth <= 1200) {
                closeSidebar();
            }
            
            // Thêm logic điều hướng chương tại đây
            console.log('Chọn chương:', element.textContent);
        }

        // Hàm quay lại trang trước
        function goBack() {
            document.body.classList.add('loading');
            setTimeout(() => {
                if (window.history.length > 1) {
                    window.history.back();
                } else {
                    alert('Không có trang trước đó để quay lại');
                    document.body.classList.remove('loading');
                }
            }, 200);
        }

        // Hàm điều hướng đến bài trước
        function goToPrevious() {
            event.target.closest('.nav-btn').style.transform = 'translateY(-4px)';
            setTimeout(() => {
                event.target.closest('.nav-btn').style.transform = '';
                console.log('Chuyển đến bài trước');
                // Thêm logic điều hướng bài trước tại đây
            }, 200);
        }

        // Hàm điều hướng đến bài tiếp theo
        function goToNext() {
            event.target.closest('.nav-btn').style.transform = 'translateY(-4px)';
            setTimeout(() => {
                event.target.closest('.nav-btn').style.transform = '';
                console.log('Chuyển đến bài tiếp theo');
                // Thêm logic điều hướng bài tiếp theo tại đây
            }, 200);
        }

        // Xử lý thay đổi kích thước cửa sổ
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1200) {
                closeSidebar(); // Đóng sidebar khi chuyển sang desktop
            }
        });

        // Cuộn mượt lên đầu trang
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Xử lý sự kiện vuốt trên mobile
        let touchStartY = 0;
        let touchEndY = 0;

        document.addEventListener('touchstart', e => {
            touchStartY = e.changedTouches[0].screenY;
        });

        document.addEventListener('touchend', e => {
            touchEndY = e.changedTouches[0].screenY;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartY - touchEndY;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    console.log('Vuốt lên');
                } else {
                    console.log('Vuốt xuống');
                }
            }
        }

        // Thêm hiệu ứng tải khi tải trang
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('fade-in');
        });

        // Thêm hiệu ứng nhấn cho các nút
        document.querySelectorAll('button, .nav-btn, .back-btn, .chapter-item').forEach(element => {
            element.addEventListener('touchstart', () => {
                element.style.transform = 'scale(0.95)';
            });
            element.addEventListener('touchend', () => {
                element.style.transform = '';
            });
        });
    </script>
</body>
</html>