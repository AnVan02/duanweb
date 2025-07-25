function toggleChapter() {
    const chapter = document.getElementById('chapter');
    if (chapter.style.display === "none") {
        chapter.style.display = "block";
    } else {
        chapter.style.display = "none"
    }
}

document.querySelector(".button-toggle").addEventListener("click", function () {
    document.querySelector(".container").classList.toggle("hide-chapter");
    document.querySelector(".chapter").classList.toggle("hidden");
});
// hiện thị 
  // Navigation functions
        function goBack() {
            // Add loading effect
            document.body.classList.add('loading');
            
            // Simulate going back with smooth transition
            setTimeout(() => {
                // Check if there's browser history
                if (window.history.length > 1) {
                    window.history.back();
                } else {
                    // If no history, show a message or redirect to home
                    alert('Không có trang trước đó để quay lại');
                    document.body.classList.remove('loading');
                }
            }, 200);
        }

        function goToPrevious() {
            // Add visual feedback
            event.target.closest('.nav-btn').style.transform = 'translateY(-4px)';
            setTimeout(() => {
                event.target.closest('.nav-btn').style.transform = '';
                // Add your navigation logic here
                console.log('Navigating to previous lesson');
            }, 200);
        }

        function goToNext() {
            // Add visual feedback
            event.target.closest('.nav-btn').style.transform = 'translateY(-4px)';
            setTimeout(() => {
                event.target.closest('.nav-btn').style.transform = '';
                // Add your navigation logic here
                console.log('Navigating to next lesson');
            }, 200);
        }

        // Sidebar functions
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const contentGrid = document.querySelector('.content-grid');
            
            if (window.innerWidth > 1200) {
                // Desktop behavior
                sidebar.classList.toggle('desktop-hidden');
                contentGrid.classList.toggle('sidebar-hidden');
            } else {
                // Mobile behavior
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const contentGrid = document.querySelector('.content-grid');
            
            if (window.innerWidth > 1200) {
                // Desktop behavior
                sidebar.classList.add('desktop-hidden');
                contentGrid.classList.add('sidebar-hidden');
            } else {
                // Mobile behavior
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            }
        }

        function showSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const contentGrid = document.querySelector('.content-grid');
            
            if (window.innerWidth > 1200) {
                // Desktop behavior
                sidebar.classList.remove('desktop-hidden');
                contentGrid.classList.remove('sidebar-hidden');
            } else {
                // Mobile behavior
                sidebar.classList.add('open');
                overlay.classList.add('active');
            }
        }

        function selectChapter(element) {
            // Remove active class from all items
            document.querySelectorAll('.chapter-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to selected item
            element.classList.add('active');
            
            // Close sidebar on mobile after selection
            if (window.innerWidth <= 1200) {
                closeSidebar();
            }
            
            // Add your chapter navigation logic here
            console.log('Selected chapter:', element.textContent);
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1200) {
                closeSidebar();
            }
        });

        // Add smooth scroll to top when navigating
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Handle touch events for better mobile experience
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
                    // Swiped up - could trigger some action
                    console.log('Swiped up');
                } else {
                    // Swiped down - could trigger some action
                    console.log('Swiped down');
                }
            }
        }

        // Add loading animation
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('fade-in');
        });

        // Improve button feedback
        document.querySelectorAll('button, .nav-btn, .back-btn, .chapter-item').forEach(element => {
            element.addEventListener('touchstart', () => {
                element.style.transform = 'scale(0.95)';
            });
            
            element.addEventListener('touchend', () => {
                element.style.transform = '';
            });
        });
        