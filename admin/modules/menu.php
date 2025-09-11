<?php 
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    else {
        $action = "-1";
    }

    if (isset($_GET['query'])) {
        $query = $_GET['query'];
    }
    else {
        $query = "-1";
    }
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?php if ($action === 'home') { echo "active"; } ?>">
            <a class="nav-link" href="index.php?action=home&query">
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title">Đơn Hàng</span>
                <!-- <?php echo $_SESSION['account_type'] ?> -->
            </a>
        </li>
        
        <li class="nav-item <?php if ($action === 'article') { echo "active"; } ?>">
            <a class="nav-link" href="index.php?action=article&query=article_list">
                <i class="mdi mdi mdi-code-not-equal menu-icon"></i>
                <span class="menu-title">Bài viết</span>
            </a>
        </li>
        
        <li class="nav-item <?php if ($action === 'baohanh') { echo "active"; } ?>">
            <a class="nav-link" href="index.php?action=baohanh&query=baohanh">
                <i class="mdi mdi-import menu-icon"></i>
                <span class="menu-title">Upload bảo hành</span>
            </a>
        </li>
        
        <li class="nav-item <?php if ($action === 'xuatbh') { echo "active"; } ?>">
            <a class="nav-link" href="index.php?action=xuatbh&query=xuatbh">
                <i class="mdi mdi-file-excel menu-icon"></i>
                <span class="menu-title">Xuất file excel</span>
            </a>
        </li>
       
        
        <!-- <li class="nav-item <?php if ($action === 'order'){echo "active"; }?>">
            <a class ="nav-link" href="index.php?action=makes&query=test_order">
                <i class ="menu-icon mdi mdi-make"></i>
                <span class="menu-title">Order</span>
            </a>
        </li> -->

        <!-- <li class="nav-item <?php if ($action === 'banner') { echo "active"; } ?>">
            <a class="nav-link" href="index.php?action=banner&query=banner">
                    <i class="mdi mdi-image menu-icon"></i>
                    <span class="menu-title">Banner</span>
            </a>
        </li> -->
        <!-- 
        <li class="nav-item <?php if ($action === 'user') { echo "active"; } ?>">
            <a class="nav-link" href="index.php?action=user&query=user">
                <i class="mdi mdi-account-box-outline menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li> -->
     
        <?php if($_SESSION['account_type'] == 2): ?>
           
            <li class="nav-item <?php if ($action === 'settings') { echo "active"; } ?>">
                <a class="nav-link" href="index.php?action=settings&query=settings">
                    <i class="menu-icon mdi mdi-settings-box"></i>
                    <span class="menu-title">Cài đặt</span>
                </a>
            </li>
        <?php else: ?>
            <li></li>
        <?php endif; ?>
    </ul>
</nav>