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