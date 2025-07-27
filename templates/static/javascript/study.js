// Thêm vào file JavaScript của bạn (main.js hoặc study.js)

function toggleSidebar() {
    const container = document.querySelector('.container');
    const menuBtn = document.querySelector('.menu-btn');
    
    // Toggle class hide-chapter
    container.classList.toggle('hide-chapter');
    
    // Toggle active state của menu button
    menuBtn.classList.toggle('active');
}

// Đảm bảo trạng thái ban đầu đúng khi trang load
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.container');
    
    // Mặc định ẩn chapter trên mobile (hiển thị nội dung bài học)
    if (window.innerWidth <= 768) {
        container.classList.add('hide-chapter');
    }
});

// Xử lý khi resize window
window.addEventListener('resize', function() {
    const container = document.querySelector('.container');
    
    if (window.innerWidth <= 768) {
        // Trên mobile: mặc định ẩn chapter
        if (!container.classList.contains('hide-chapter')) {
            container.classList.add('hide-chapter');
        }
    } else {
        // Trên desktop: luôn hiển thị chapter
        container.classList.remove('hide-chapter');
    }
});

function goBack() {
    // Xử lý quay lại - có thể dùng history.back() hoặc redirect
    window.history.back();
}