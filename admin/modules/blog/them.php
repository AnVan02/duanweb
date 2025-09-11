<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<div class="row" style="margin-bottom: 10px;">
    <div class="col d-flex" style="justify-content: space-between; align-items: flex-end;">
        <h3>
            Thêm bài viết
        </h3>
        <a href="index.php?action=article&query=article_list" class="btn btn-outline-dark btn-fw">
            <i class="mdi mdi-reply"></i>
            Quay lại
        </a>
    </div>
</div>
<form method="POST" action="modules/blog/xuly.php" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-content">
                        <div class="input-item form-group">
                            <label for="author" class="d-block">Tên tác giả</label>
                            <input id=author type="text" name="article_author" class="d-block form-control" value="" placeholder="">
                        </div>
                        
                        <div class="form-group">
                            <label for="article_date">Ngày đăng bài:</label>
                            <input type="date" name="article_date" id="article_date" class="form-control" 
                                   value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="input-item form-group">
                            <label for="article_link" class="d-block">Link bài viết</label>
                            <input type="text" name="article_link" class="form-control" value="">
                        </div>
                        
                        <div class="input-item form-group">
                            <label for="article_tag" class="d-block">Tag bài viết</label>
                            <input type="text" name="article_tag" class="d-block form-control" value="">
                        </div>
                      
                        <div class="input-item form-group">
                            <label for="title" class="d-block">Tiêu đề bài viết</label>
                            <input type="text" name="article_title" class="d-block form-control" value="" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="article_content">Nội dung tóm tắt</label>
                            <textarea name="article_content" id="article_content" class="form-control" placeholder=""></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="article_summary">Nội dung bài viết</label>
                            <textarea name="article_summary" id="article_summary" class="form-control" placeholder=""></textarea>
                        </div>

                        <button type="submit" name="article_add" class="btn btn-primary btn-icon-text mg-t-16">
                            <i class="ti-file btn-icon-prepend"></i>
                            Thêm
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-content">
                        <div class="main-pane-top">
                            <h4 class="card-title">Sản phẩm theo danh mục</h4>
                            <h6></h6>
                        </div>

                        <div class="input-item form-group">
                            <label for="article_status">Trạng thái bài viết:</label>
                            <select name="article_status" id="article_status" required>
                                <option value="1">Xuất bản</option>
                                <option value="0">Chưa xuất bản</option>
                            </select>
                        </div>
                        <div class="input-item form-group">
                            <label for="image" class="d-block">Hình ảnh</label>
                            <input type="file" class="" name="article_image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Khởi tạo CKEditor và xử lý dán URL ảnh -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    // Khởi tạo CKEditor cho các textarea
    CKEDITOR.replace('article_content', {
        extraPlugins: 'image', // Kích hoạt plugin image
        on: {
            paste: function(evt) {
                var data = evt.data.dataValue;
                // Kiểm tra xem dữ liệu dán có phải là URL ảnh không
                if (isImageUrl(data)) {
                    // Chuyển URL thành thẻ <img>
                    evt.data.dataValue = '<img src="' + data + '" alt="Pasted Image" style="max-width:100%;height:auto;" />';
                }
            }
        }
    });

    CKEDITOR.replace('article_summary', {
        extraPlugins: 'image', // Kích hoạt plugin image
        on: {
            paste: function(evt) {
                var data = evt.data.dataValue;
                // Kiểm tra xem dữ liệu dán có phải là URL ảnh không
                if (isImageUrl(data)) {
                    // Chuyển URL thành thẻ <img>
                    evt.data.dataValue = '<img src="' + data + '" alt="Pasted Image" style="max-width:100%;height:auto;" />';
                }
            }
        }
    });

    // Hàm kiểm tra xem chuỗi có phải là URL ảnh hợp lệ không
    function isImageUrl(url) {
        // Kiểm tra xem URL có hợp lệ và kết thúc bằng các đuôi ảnh phổ biến
        return url.match(/\.(jpeg|jpg|gif|png|bmp|webp)$/i) !== null;
    }
</script>