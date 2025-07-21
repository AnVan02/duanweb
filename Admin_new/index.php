

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem 0;
            transition: all 0.3s ease;
        }

        .logo {
            text-align: center;
            color: white;
            font-size:24px;
            font-weight: bold;
            margin-bottom: 3rem;
            padding: 0 2rem;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin: 0.5rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(8px);
        }

        .nav-link i {
            margin-right: 1rem;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header h1 {
            color: white;
            font-size: 2rem;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            color: white;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .card-icon.users { background: linear-gradient(45deg, #667eea, #764ba2); }
        .card-icon.orders { background: linear-gradient(45deg, #f093fb, #f5576c); }
        .card-icon.revenue { background: linear-gradient(45deg, #4facfe, #00f2fe); }
        .card-icon.products { background: linear-gradient(45deg, #43e97b, #38f9d7); }

        .card-title {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .card-value {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-trend {
            color: #4ecdc4;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .card-trend.negative {
            color: #ff6b6b;
        }

        /* Content Sections */
        .content-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: none;
        }

        .content-section.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-weight: 600;
        }

        td {
            color: rgba(255, 255, 255, 0.8);
        }

        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active { background: rgba(76, 175, 80, 0.2); color: #4caf50; }
        .status-pending { background: rgba(255, 193, 7, 0.2); color: #ffc107; }
        .status-inactive { background: rgba(244, 67, 54, 0.2); color: #f44336; }

        /* Action Buttons */
        .action-btn {
            background: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(45deg, #ff6b6b, #ff5252);
            border: none;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: white;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar .nav-link span {
                display: none;
            }

            .logo {
                font-size: 1.2rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-crown"></i> ROSA AI READY
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-section="dashboard">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="users">
                        <i class="fas fa-users"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="orders">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="products">
                        <i class="fas fa-box"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="analytics">
                        <i class="fas fa-chart-bar"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="settings">
                        <i class="fas fa-cog"></i>
                        <span>Cài đặt</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="students">
                        <i class="fas fa-user-graduate"></i>
                        <span>Sinh viên</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h1 id="page-title">Dashboard</h1>
                <div class="user-info">
                    <span>Xin chào, Admin!</span>
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </header>

            <!-- Dashboard Section -->
            <section id="dashboard" class="content-section active">
                <div class="section-title">Dashboard</div>
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon users">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="card-title">Tổng người dùng</h3>
                        </div>
                        <p class="card-value">123</p>
                        <p class="card-trend">Tăng 10% so với tháng trước</p>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon orders">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 class="card-title">Tổng đơn hàng</h3>
                        </div>
                        <p class="card-value">50</p>
                        <p class="card-trend">Tăng 5% so với tháng trước</p>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon revenue">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <h3 class="card-title">Doanh thu</h3>
                        </div>
                        <p class="card-value">$12,345</p>
                        <p class="card-trend">Tăng 20% so với tháng trước</p>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon products">
                                <i class="fas fa-box"></i>
                            </div>
                            <h3 class="card-title">Tổng sản phẩm</h3>
                        </div>
                        <p class="card-value">150</p>
                        <p class="card-trend">Tăng 15% so với tháng trước</p>
                    </div>
                </div>
            </section>

            <!-- Users Section -->
            <section id="users" class="content-section">
                <div class="section-title">Quản lý người dùng</div>
                <div id="users-content">
                    <?php include 'add_student.php'; ?>
                </div>
            </section>

            <!-- Orders Section -->
            <section id="orders" class="content-section">
                <div class="section-title">Quản lý đơn hàng</div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ORD001</td>
                                <td>2023-10-27</td>
                                <td>$120</td>
                                <td><span class="status-badge status-pending">Đang chờ</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Hủy đơn</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ORD002</td>
                                <td>2023-10-26</td>
                                <td>$250</td>
                                <td><span class="status-badge status-active">Đã giao</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Hủy đơn</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ORD003</td>
                                <td>2023-10-25</td>
                                <td>$80</td>
                                <td><span class="status-badge status-inactive">Đã hủy</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Hủy đơn</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Products Section -->
            <section id="products" class="content-section">
                <div class="section-title">Quản lý sản phẩm</div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PROD001</td>
                                <td>Sản phẩm A</td>
                                <td>$50</td>
                                <td>100</td>
                                <td><span class="status-badge status-active">Còn hàng</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>PROD002</td>
                                <td>Sản phẩm B</td>
                                <td>$100</td>
                                <td>50</td>
                                <td><span class="status-badge status-pending">Hết hàng</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>PROD003</td>
                                <td>Sản phẩm C</td>
                                <td>$20</td>
                                <td>200</td>
                                <td><span class="status-badge status-inactive">Đã xóa</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Analytics Section -->
            <section id="analytics" class="content-section">
                <div class="section-title">Thống kê</div>
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon revenue">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="card-title">Doanh thu theo tháng</h3>
                        </div>
                        <div class="chart-container">
                            <!-- Placeholder for chart -->
                            <p>Biểu đồ doanh thu sẽ được hiển thị ở đây.</p>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-icon users">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h3 class="card-title">Số lượng người dùng theo tháng</h3>
                        </div>
                        <div class="chart-container">
                            <!-- Placeholder for chart -->
                            <p>Biểu đồ số lượng người dùng sẽ được hiển thị ở đây.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Settings Section -->
            <section id="settings" class="content-section">
                <div class="section-title">Cài đặt</div>
                <div class="form-group">
                    <label for="site-name" class="form-label">Tên trang web</label>
                    <input type="text" id="site-name" class="form-input" placeholder="Nhập tên trang web">
                </div>
                <div class="form-group">
                    <label for="site-description" class="form-label">Mô tả trang web</label>
                    <textarea id="site-description" class="form-input" rows="4" placeholder="Nhập mô tả trang web"></textarea>
                </div>
                <div class="form-group">
                    <label for="site-logo" class="form-label">Logo trang web</label>
                    <input type="file" id="site-logo" class="form-input">
                </div>
                <button class="action-btn btn-primary">Lưu cài đặt</button>
            </section>

            <!-- Students Section -->
            <section id="students" class="content-section">
                <div class="section-title">Quản lý sinh viên</div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã sinh viên</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SV001</td>
                                <td>Nguyễn Văn A</td>
                                <td>a@example.com</td>
                                <td>0123456789</td>
                                <td><span class="status-badge status-active">Đang học</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>SV002</td>
                                <td>Trần Thị B</td>
                                <td>b@example.com</td>
                                <td>0987654321</td>
                                <td><span class="status-badge status-pending">Nghỉ học</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>SV003</td>
                                <td>Lê Văn C</td>
                                <td>c@example.com</td>
                                <td>0112233445</td>
                                <td><span class="status-badge status-inactive">Đã tốt nghiệp</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Xem chi tiết</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.content-section');
        const sectionTitles = {
            dashboard: 'Dashboard',
            users: 'Quản lý người dùng',
            orders: 'Quản lý đơn hàng',
            products: 'Quản lý sản phẩm',
            analytics: 'Thống kê',
            settings: 'Cài đặt',
            students: 'Quản lý sinh viên',
        };

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetSection = link.getAttribute('data-section');
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                sections.forEach(s => s.classList.remove('active'));
                document.getElementById(targetSection).classList.add('active');
                document.getElementById('page-title').textContent = sectionTitles[targetSection];
            });
        });
    </script>
</body>
</html>

