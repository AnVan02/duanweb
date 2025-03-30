<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

    <!-- Tải Froala CSS và JS -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
</head>
<body>
<div class="row" style="margin-bottom: 10px;">
    <div class="col d-flex" style="justify-content: space-between; align-items: flex-end;">
        <h3>Thêm bài viết</h3>
        <a href="index.php?action=article&query=article_list" class="btn btn-outline-dark btn-fw">
            <i class="mdi mdi-reply"></i> Quay lại
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
                            <input id="author" type="text" name="article_author" class="d-block form-control" value="" placeholder="">
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

                        <div class="input-item form-group">
                            <label for="article_content" class="d-block">Nội dung tóm tắt</label>
                            <textarea name="article_content" id="article_content" class="form-control" placeholder="Tóm tắt bài viết"></textarea>
                        </div>

                        <div class="input-item form-group">
                            <label for="article_summary" class="d-block">Nội dung chính bài viết</label>
                            <textarea name="article_summary" id="article_summary" class="form-control" placeholder="Nhập nội dung chính"></textarea>
                        </div>

                        <form method="POST" action="modules/blog/xuly.php" enctype="multipart/form-data">
                        <!-- Các input khác -->
                        
                        <div class="input-item form-group">
                            <label for="video" class="d-block">Video</label>
                            <input type="file" name="video" class="form-control" accept="video/*">
                        </div>

                        <button type="submit" name="article_add" class="btn btn-primary btn-icon-text mg-t-16">
                            <i class="ti-file btn-icon-prepend"></i> Thêm
                        </button>
                    </form>
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
                            <label for="image" class="d-block">Image</label>
                            <input type="file" class="" name="article_image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Script khởi tạo Froala -->
<script>
    new FroalaEditor('#article_content', {
        height: 200,
        imageUploadURL: 'modules/blog/xuly.php',
        videoUploadURL: 'modules/blog/xuly.php',
        toolbarButtons: ['bold', 'italic', 'underline', '|', 'insertImage', 'insertVideo', 'insertLink'],
        language: 'vi',
        videoAllowedTypes: ['mp4', 'webm', 'ogg', 'mov', 'avi'],
        videoMaxSize: 50 * 1024 * 1024,
        events: {
            'video.beforeUpload': function (video) {
                console.log('Bắt đầu upload video:', video[0].name, video[0].size, video[0].type);
            },
            'video.uploaded': function (response) {
                console.log('Video uploaded successfully:', response);
            },
            'video.uploadError': function (error, response) {
                console.log('Lỗi upload video:', error, response);
                let errorMsg = response ? JSON.parse(response).error : error.message;
                console.log('Chi tiết lỗi:', errorMsg);
                alert('Lỗi upload video: ' + errorMsg);
            }
        }
    });

    new FroalaEditor('#article_summary', {
        height: 300,
        imageUploadURL: 'modules/blog/xuly.php',
        videoUploadURL: 'modules/blog/xuly.php',
        toolbarButtons: ['bold', 'italic', 'underline', '|', 'insertImage', 'insertVideo', 'insertLink'],
        language: 'vi',
        videoAllowedTypes: ['mp4', 'webm', 'ogg', 'mov', 'avi'],
        videoMaxSize: 50 * 1024 * 1024,
        events: {
            'video.beforeUpload': function (video) {
                console.log('Bắt đầu upload video:', video[0].name, video[0].size, video[0].type);
            },
            'video.uploaded': function (response) {
                console.log('Video uploaded successfully:', response);
            },
            'video.uploadError': function (error, response) {
                console.log('Lỗi upload video:', error, response);
                let errorMsg = response ? JSON.parse(response).error : error.message;
                console.log('Chi tiết lỗi:', errorMsg);
                alert('Lỗi upload video: ' + errorMsg);
            }
        }
    });

    const client = filestack.init('YOUR_API_KEY');
        client.picker({
            onUploadDone: (res) => {
                console.log('Video uploaded successfully:', res);
            },
            onError: (error) => {
                console.error('Error uploading video:', error);
            }
        }).open();

        
</script>