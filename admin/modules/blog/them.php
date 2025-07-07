<?php
// Bật hiển thị lỗi để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Xử lý ảnh upload từ CKEditor (ngay trong chính file này)
if (isset($_GET['upload-image']) && isset($_FILES['upload'])) {
    $uploadDir = 'uploads/ckeditor/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = time() . '_' . basename($_FILES['upload']['name']);
    $targetFile = $uploadDir . $fileName;
    $webPath = '/' . $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['upload']['tmp_name'], $targetFile)) {
        $funcNum = $_GET['CKEditorFuncNum'];
        echo "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$webPath', 'Upload ảnh thành công');</script>";
    } else {
        echo "Upload ảnh thất bại!";
    }
    exit;
}

?>

</head>
<body>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col d-flex justify-content-between align-items-end">
                <h3>Thêm bài viết</h3>
                <a href="index.php?action=article&query=article_list" class="btn btn-outline-dark">
                    <i class="mdi mdi-reply"></i> Quay lại
                </a>
            </div>
        </div>

        <form method="POST" action="modules/blog/xuly.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="author">Tên tác giả</label>
                                <input id="author" type="text" name="article_author" class="form-control" placeholder="Nhập tên tác giả" required>
                            </div>
                            <div class="form-group">
                                <label for="article_date">Ngày đăng bài</label>
                                <input type="date" name="article_date" id="article_date" class="form-control" 
                                       value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="article_link">Link bài viết</label>
                                <input type="text" name="article_link" class="form-control" placeholder="Nhập link bài viết (ví dụ: bai-viet-1)" required>
                            </div>
                            <div class="form-group">
                                <label for="article_tag">Thẻ bài viết</label>
                                <input type="text" name="article_tag" class="form-control" placeholder="Nhập các thẻ, ví dụ: tintuc,congnghe">
                            </div>
                            <div class="form-group">
                                <label for="title">Tiêu đề bài viết</label>
                                <input type="text" name="article_title" class="form-control" placeholder="Tiêu đề bài viết" required>
                            </div>
                            <div class="form-group">
                                <label for="article_content">Nội dung tóm tắt</label>
                                <textarea name="article_content" id="article_content" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="article_summary">Nội dung chính bài viết</label>
                                <textarea name="article_summary" id="article_summary" class="form-control"></textarea>
                            </div>
                            <button type="submit" name="article_add" class="btn btn-primary btn-icon-text mt-3">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i> Thêm
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="article_status">Trạng thái bài viết</label>
                                <select name="article_status" id="article_status" class="form-control" required>
                                    <option value="1">Xuất bản</option>
                                    <option value="0">Chưa xuất bản</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="article_image">Hình ảnh đại diện</label>
                                <input type="file" id="article_image" name="article_image" class="form-control-file" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
 <!-- Khởi tạo CKEditor cho các textarea -->
    <script>
        CKEDITOR.replace('article_content', {
            filebrowserUploadUrl: '?upload-image=1',
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('article_summary', {
            filebrowserUploadUrl: '?upload-image=1',
            filebrowserUploadMethod: 'form'
        });
    </script>