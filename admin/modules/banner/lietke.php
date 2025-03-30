<!-- <?php
$sql_banners_list = "SELECT * FROM banners WHERE banners_status = 1 ORDER BY banners_id DESC";
$query_banners_list = mysqli_query($mysqli, $sql_banners_list);
?>

<div class="row">
    <div class="col">
        <div class="banner_list d-flex space-between align-center">
            <h3 class="card-title"style="margin:0;">Danh sách banner</h3>
            <div class="action_group">
                <a href=""class="">Thêm banner mới</a>
            </div>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="main-pane-top d-flex justify-center align-center">
                    <div class="input__search p-relative">
                        <i class="input__search p-relative">
                        <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-action">
                        <thead>
                            <th>
                            <input type="checkbox"id="checkAll">
                            </th>
                            <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($quert_banner_lish)) 
                            $i++;
                        ?>
                </div>
            </div>
        </div>
    </div>
</div> -->
