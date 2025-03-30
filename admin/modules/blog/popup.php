<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('button[name="article_add"]').addEventListener('click', function (e) {
        e.preventDefault(); // Ngăn form submit ngay lập tức

        const title = document.querySelector('input[name="article_title"]').value.trim();
        const link = document.querySelector('input[name="article_link"]').value.trim();

        if (!title || !link) {
            Swal.fire({
                icon: 'warning',
                title: 'Cảnh báo',
                text: 'Vui lòng nhập đầy đủ tiêu đề và link bài viết!'
            });
            return;
        }

        // Gửi yêu cầu AJAX để kiểm tra trùng lặp
        const formData = new FormData(document.querySelector('form'));

        fetch('modules/blog/xuly.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    // Hiển thị popup lỗi nếu trùng
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: data.message
                    });
                } else if (data.status === 'success') {
                    // Hiển thị popup thành công
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: data.message
                    }).then(() => {
                        // Nếu thành công, gửi form để lưu bài viết
                        document.querySelector('form').submit();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi hệ thống',
                    text: 'Đã xảy ra lỗi khi kiểm tra bài viết. Vui lòng thử lại!'
                });
            });
    });
</script>
