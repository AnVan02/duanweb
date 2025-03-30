<?php
$sql_article_edit = "SELECT * FROM article WHERE article_link = '$_GET[article_link]' LIMIT 1";
$query_article_edit = mysqli_query($mysqli, $sql_article_edit);
?>


<div class="row" style="margin-bottom: 10px;">
    <div class="col d-flex" style="justify-content: space-between; align-items: flex-end;">
        <h3>
            Sửa bài viết
        </h3>
        <a href="index.php?action=article&query=article_list" class="btn btn-outline-dark btn-fw">
            <i class="mdi mdi-reply"></i>
            Quay lại
        </a>
    </div>
</div>

<?php while ($row = mysqli_fetch_array($query_article_edit)) { ?>
    <form method="POST" action="modules/blog/xuly.php?article_link=<?php echo $row['article_link'] ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="input-item form-group">
                            <label for="author" class="d-block">Tên tác giả</label>
                            <input id="author" type="text" name="article_author" class="d-block form-control" value="<?php echo $row['article_author'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="article_date">Ngày đăng bài:</label>
                            <input type="date" name="article_date" id="article_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="input-item form-group">
                            <label for="article_link" class="d-block">Link bài viết</label>
                            <input type="text" name="article_link" class="form-control">
                        </div>
                        <div class="input-item form-group">
                            <label for="article_tag" class="d-block">Tab bài viết</label>
                            <input type="text" name="article_tag" class="d-block form-control">
                        </div>
                        <div class="input-item form-group">
                            <label for="title" class="d-block">Tiêu đề bài viết</label>
                            <input type="text" name="article_title" class="d-block form-control" value="<?php echo $row['article_title'] ?>">
                        </div>
                        <div class="input-item form-group">
                            <label for="article_content" class="d-block">Nội dung tóm tắt</label>
                            <textarea id="article_content" name="article_content"><?php echo $row['article_content'] ?></textarea>
                        </div>
                        <div class="input-item form-group">
                            <label for="article_summary" class="d-block">Nội dung chính bài viết</label>
                            <textarea id="article_summary" name="article_summary"><?php echo $row['article_summary'] ?></textarea>
                        </div> 
                        <button type="submit" name="article_edit" class="btn btn-primary btn-icon-text mg-t-16">
                            <i class="ti-file btn-icon-prepend"></i>
                            Lưu lại
                        </button>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="over-flow-hidden">
                            <div class="main-pane-top">
                            </div>
                            <div class="input-item form-group">
                                <label for="article_status" class="d-block">Trang thái</label>
                                <select name="article_status" id="article_status" class="form-control">
                                    <option value="0" <?php if ($row['article_status'] == 0) {
                                                            echo "selected";
                                                        } ?>>Bản nháp</option>
                                    <option value="1" <?php if ($row['article_status'] == 1) {
                                                            echo "selected";
                                                        } ?>>Xuất bản</option>
                                </select>
                            </div>
                            <div class="input-item form-group">
                                <label for="image" class="">Image</label>
                                <img src="modules/blog/uploads/<?php echo $row['article_image'] ?>" class="article__image w-100 h-100" style="width: 50px; height: 50px;" alt="image">
                                <input type="file" name="article_image" value="<?php echo $row['article_image'] ?>">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

<script>
    CKEDITOR.replace('article_summary');
    CKEDITOR.replace('article_content');
    
    var btnAccept = document.getElementById("btnAccept");
    var btnDelete = document.getElementById("btnDelete");
    var checkAll = document.getElementById("checkAll");
    var checkboxes = document.getElementsByClassName("checkbox");
    var dialogControl = document.querySelector('.dialog__control');
    // Thêm sự kiện click cho checkbox checkAll
    checkAll.addEventListener("click", function() {
        // Nếu checkbox checkAll được chọn
        if (checkAll.checked) {
            // Đặt thuộc tính "checked" cho tất cả các checkbox còn lại
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = true;
            }
        } else {
            // Bỏ thuộc tính "checked" cho tất cả các checkbox còn lại
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
            }
        }
        testChecked();
        getCheckedCheckboxes();
    });

    console.log(checkboxes[0]);

    function testChecked() {
        var count = 0;
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                count++;
                console.log(count);
            }
        }
        if (count > 0) {
            dialogControl.classList.add('active');
        } else {
            dialogControl.classList.remove('active');
            checkAll.checked = false;
        }
    }

    function getCheckedCheckboxes() {
        var checkeds = document.querySelectorAll('.checkbox:checked');
        var checkedComment = [];
        for (var i = 0; i < checkeds.length; i++) {
            checkedComment.push(checkeds[i].id);
        }
        btnAccept.href = "modules/blog/xuly.php?&article_link=<?php echo $_GET['article_link'] ?>&acceptcomment=1&data="+ JSON.stringify(checkedComment);
        btnDelete.href = "modules/blog/xuly.php?&article_link=<?php echo $_GET['article_link'] ?>&deletecomment=1&data="+ JSON.stringify(checkedComment);
    }
    
</script>

