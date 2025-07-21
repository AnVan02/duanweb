<?php
?>

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
                    <a href="modules/add_student.php" class="nav-link" data-section="users">
                        <i class="fas fa-users"></i>
                        <span>Thêm Sinh viên</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="modules/add_question.php" class="nav-link" data-section="orders">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Thêm Câu hỏi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="modules/khoahoc.php" class="nav-link" data-section="products">
                        <i class="fas fa-box"></i>
                        <span>Khoá hoc</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="modules/.php" class="nav-link" data-section="analytics">
                        <i class="fas fa-chart-bar"></i>
                        <span>Chứng chỉ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="settings">
                        <i class="fas fa-cog"></i>
                        <span>Cài đặt</span>
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
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-title">Tổng người dùng</div>
                        <div class="card-value">2,847</div>
                        <div class="card-trend">
                            <i class="fas fa-arrow-up"></i> +12.5% so với tháng trước
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon orders">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-title">Đơn hàng hôm nay</div>
                        <div class="card-value">154</div>
                        <div class="card-trend">
                            <i class="fas fa-arrow-up"></i> +8.2% so với hôm qua
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon revenue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-title">Doanh thu tháng</div>
                        <div class="card-value">₫52.4M</div>
                        <div class="card-trend">
                            <i class="fas fa-arrow-up"></i> +15.8% so với tháng trước
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-icon products">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-title">Sản phẩm</div>
                        <div class="card-value">1,234</div>
                        <div class="card-trend negative">
                            <i class="fas fa-arrow-down"></i> -2.1% cần bổ sung
                        </div>
                    </div>
                </div>
            </section>

            <!-- Users Section -->
            <section id="users" class="content-section">
                <div class="section-title">Quản lý người dùng</div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng ký</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>Nguyễn Văn A</td>
                                <td>nguyenvana@email.com</td>
                                <td><span class="status-badge status-active">Hoạt động</span></td>
                                <td>15/07/2025</td>
                                <td>
                                    <button class="action-btn btn-primary">Sửa</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td>Trần Thị B</td>
                                <td>tranthib@email.com</td>
                                <td><span class="status-badge status-pending">Chờ xác nhận</span></td>
                                <td>14/07/2025</td>
                                <td>
                                    <button class="action-btn btn-primary">Sửa</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#003</td>
                                <td>Lê Văn C</td>
                                <td>levanc@email.com</td>
                                <td><span class="status-badge status-inactive">Tạm khóa</span></td>
                                <td>13/07/2025</td>
                                <td>
                                    <button class="action-btn btn-primary">Sửa</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Orders Section -->
            <section id="orders" class="content-section">
                <div class="section-title">Quản lý đơn hàng</div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD001</td>
                                <td>Nguyễn Văn A</td>
                                <td>₫1,250,000</td>
                                <td><span class="status-badge status-active">Đã giao</span></td>
                                <td>20/07/2025</td>
                                <td>
                                    <button class="action-btn btn-primary">Xem</button>
                                    <button class="action-btn">In hóa đơn</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#ORD002</td>
                                <td>Trần Thị B</td>
                                <td>₫850,000</td>
                                <td><span class="status-badge status-pending">Đang xử lý</span></td>
                                <td>20/07/2025</td>
                                <td>
                                    <button class="action-btn btn-primary">Xem</button>
                                    <button class="action-btn">Cập nhật</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Products Section -->
            <section id="products" class="content-section">
                <div class="section-title">Quản lý sản phẩm</div>
                <div style="margin-bottom: 1rem;">
                    <button class="action-btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm sản phẩm mới
                    </button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#SP001</td>
                                <td>iPhone 15 Pro</td>
                                <td>Điện thoại</td>
                                <td>₫28,990,000</td>
                                <td>45</td>
                                <td><span class="status-badge status-active">Có sẵn</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Sửa</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#SP002</td>
                                <td>MacBook Pro M3</td>
                                <td>Laptop</td>
                                <td>₫52,990,000</td>
                                <td>12</td>
                                <td><span class="status-badge status-pending">Sắp hết</span></td>
                                <td>
                                    <button class="action-btn btn-primary">Sửa</button>
                                    <button class="action-btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Analytics Section -->
            <section id="analytics" class="content-section">
                <div class="section-title">Thống kê & Báo cáo</div>
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h3 style="color: white; margin-bottom: 1rem;">Thống kê truy cập</h3>
                        <p style="color: rgba(255,255,255,0.8);">Lượt truy cập hôm nay: <strong>3,247</strong></p>
                        <p style="color: rgba(255,255,255,0.8);">Thời gian trung bình: <strong>4m 32s</strong></p>
                        <p style="color: rgba(255,255,255,0.8);">Tỷ lệ thoát: <strong>34.5%</strong></p>
                    </div>
                    <div class="dashboard-card">
                        <h3 style="color: white; margin-bottom: 1rem;">Top sản phẩm</h3>
                        <p style="color: rgba(255,255,255,0.8);">1. iPhone 15 Pro - <strong>89 lượt xem</strong></p>
                        <p style="color: rgba(255,255,255,0.8);">2. MacBook Pro M3 - <strong>67 lượt xem</strong></p>
                        <p style="color: rgba(255,255,255,0.8);">3. AirPods Pro - <strong>45 lượt xem</strong></p>
                    </div>
                </div>
            </section>

            <!-- Settings Section -->
            <section id="settings" class="content-section">
                <div class="section-title">Cài đặt hệ thống</div>
                <div style="max-width: 600px;">
                    <div class="form-group">
                        <label class="form-label">Tên website</label>
                        <input type="text" class="form-input" value="Admin Panel" placeholder="Nhập tên website">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email liên hệ</label>
                        <input type="email" class="form-input" placeholder="admin@example.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Múi giờ</label>
                        <select class="form-input">
                            <option>GMT+7 (Việt Nam)</option>
                            <option>GMT+0 (UTC)</option>
                            <option>GMT+8 (Trung Quốc)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="action-btn btn-primary" style="padding: 0.8rem 2rem;">
                            <i class="fas fa-save"></i> Lưu cài đặt
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Navigation functionality
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.content-section');
        const pageTitle = document.getElementById('page-title');

        const sectionTitles = {
            dashboard: 'Dashboard',
            users: 'Quản lý người dùng',
            orders: 'Quản lý đơn hàng',
            products: 'Quản lý sản phẩm',
            analytics: 'Thống kê',
            settings: 'Cài đặt'
        };

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                const targetSection = link.getAttribute('data-section');
                
                // Special handling for users section - open in new page
                if (targetSection === 'users') {
                    openUsersPage();
                    return;
                }
                
                // Remove active class from all links
                navLinks.forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                link.classList.add('active');
                
                // Hide all sections
                sections.forEach(s => s.classList.remove('active'));
                
                // Show target section
                document.getElementById(targetSection).classList.add('active');
                
                // Update page title
                pageTitle.textContent = sectionTitles[targetSection];
            });
        });

        // Function to open users page in new window
        function openUsersPage() {
            const usersWindow = window.open('', '_blank', 'width=1200,height=800,scrollbars=yes,resizable=yes');
            
            usersWindow.document.write(``);
            
            usersWindow.document.close();
        }

        // Add some interactive effects
        const dashboardCards = document.querySelectorAll('.dashboard-card');
        dashboardCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Action button handlers
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('action-btn')) {
                const action = e.target.textContent.trim();
                
                if (action.includes('Xóa')) {
                    if (confirm('Bạn có chắc chắn muốn xóa mục này?')) {
                        e.target.closest('tr').style.opacity = '0.5';
                        setTimeout(() => {
                            e.target.closest('tr').remove();
                        }, 300);
                    }
                } else if (action.includes('Sửa') || action.includes('Xem')) {
                    alert(`Chức năng ${action} đang được phát triển!`);
                }
            }
        });

        // Simulate real-time updates
        function updateDashboard() {
            const values = document.querySelectorAll('.card-value');
            values.forEach(value => {
                if (Math.random() > 0.8) {
                    const currentValue = parseInt(value.textContent.replace(/[^\d]/g, ''));
                    const change = Math.floor(Math.random() * 10) - 5;
                    const newValue = Math.max(0, currentValue + change);
                    
                    value.style.transition = 'all 0.3s ease';
                    value.style.transform = 'scale(1.1)';
                    
                    setTimeout(() => {
                        value.textContent = value.textContent.replace(/\d+/, newValue);
                        value.style.transform = 'scale(1)';
                    }, 150);
                }
            });
        }

        // Update dashboard every 30 seconds
        setInterval(updateDashboard, 30000);

        // Add loading animation for form submissions
        const forms = document.querySelectorAll('form, .action-btn');
        forms.forEach(form => {
            form.addEventListener('click', function(e) {
                if (this.classList.contains('btn-primary')) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 2000);
                }
            });
        });
    </script>
</body>
</html>