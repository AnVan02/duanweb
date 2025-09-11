<title>Tin Tức</title>
<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php require "../header.php" ?>

<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Lấy bài viết nổi bật (bài viết mới nhất)
$sqlFeatured = "SELECT * FROM article WHERE article_status = 1 ORDER BY article_date DESC LIMIT 1";
$resultFeatured = $conn->query($sqlFeatured);
$featuredNews = ($resultFeatured->num_rows > 0) ? $resultFeatured->fetch_assoc() : null;

// Lấy trang hiện tại từ URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9; // Số bài viết mỗi trang (trang 1 sẽ khác biệt)
$start = ($page - 1) * $limit;

// Nếu là trang đầu tiên, hiển thị bài viết nổi bật + bài viết cũ hơn
if ($page == 1) {
    $sql = "SELECT * FROM article WHERE article_status = 1 ORDER BY article_date DESC LIMIT 1, $limit"; // Bỏ qua bài viết mới nhất
} else {
    $sql = "SELECT * FROM article WHERE article_status = 1 ORDER BY article_date DESC LIMIT $start, $limit";
}
$result = $conn->query($sql);
$currentPageItems = ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Tính tổng số bài viết và trang
$sqlCount = "SELECT COUNT(*) AS total FROM article WHERE article_status = 1";
$resultCount = $conn->query($sqlCount);
$totalItems = ($resultCount->num_rows > 0) ? $resultCount->fetch_assoc()['total'] : 0;
$totalPages = ceil($totalItems / $limit);
?>

<div class="featured-news"> 
    <h4>TIN TỨC NỔI BẬT</h4>
    <?php if ($featuredNews): ?>
        <?php
            // Xử lý ảnh cho bài viết nổi bật
            $img = isset($featuredNews['article_image']) ? trim($featuredNews['article_image']) : '';
            $imgSrc = ($img !== '' && preg_match('/^https?:\/\//i', $img))
                ? $img
                : '../tintuc_test/admin/modules/blog/uploads/' . $img;
        ?>
        <div class="news-item">
            <div class="news-image">
                <img src="<?= htmlspecialchars($imgSrc); ?>" alt="Featured Image">
            </div>
            <div class="news-content">
                <h2>
                    <a href="../tintuc/<?= htmlspecialchars($featuredNews['article_link']); ?>">
                        <?= htmlspecialchars($featuredNews['article_title']); ?>
                    </a>
                </h2>
                
                <small>
                    <i class="fa-regular fa-calendar-days"></i> <?= date("d/m/Y", strtotime($featuredNews['article_date'])); ?>
                    &nbsp;|&nbsp;
                    Người viết: <?= htmlspecialchars($featuredNews['article_author']); ?>
                </small>

                <p class="description"><?= htmlspecialchars_decode($featuredNews['article_content']); ?></p>
            </div>
        </div>
    <?php else: ?>
        <p>Không có bài viết nổi bật.</p>
    <?php endif; ?>
</div>

<div class="news-container">
    <?php foreach ($currentPageItems as $item): ?>
        <?php
            // Xử lý ảnh cho danh sách bài viết
            $img = isset($item['article_image']) ? trim($item['article_image']) : '';
            $imgSrc = ($img !== '' && preg_match('/^https?:\/\//i', $img))
                ? $img
                : '../tintuc_test/admin/modules/blog/uploads/' . $img;
        ?>
        <div class="news-item">
            <a href="tintuc/<?= htmlspecialchars($item['article_link']); ?>">
                <div class="news-image">
                    <img src="<?= htmlspecialchars($imgSrc); ?>" alt="Image">
                </div>
            </a>

            <div class="news-content">
                <h2>
                    <a href="../tintuc/<?= htmlspecialchars($item['article_link']); ?>">
                        <?= htmlspecialchars($item['article_title']); ?>
                    </a>
                </h2>
                <small><i class="fa-regular fa-calendar-days"></i> <?= date("d/m/Y", strtotime($item['article_date'])); ?></small>
                <small>Người viết: <?= htmlspecialchars($item['article_author']); ?></small>
                <?php
                    $content = isset($item['article_content']) ? htmlspecialchars_decode($item['article_content']) : '';
                    $short_content = substr(strip_tags($content), 0, 200) . '...';
                ?>
                <p class="description"><?= $short_content; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1; ?>">&larr;</a>
    <?php endif; ?>

    <?php if ($page > 3): ?>
        <a href="?page=1">1</a>
        <?php if ($page > 4): ?>
            <span>...</span>
        <?php endif; ?>
    <?php endif; ?>

    <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
        <a href="?page=<?= $i; ?>" <?= $i == $page ? "class='active'" : ""; ?>><?= $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $totalPages - 2): ?>
        <?php if ($page < $totalPages - 3): ?>
            <span>...</span>
        <?php endif; ?>
        <a href="?page=<?= $totalPages; ?>"><?= $totalPages; ?></a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1; ?>">&rarr;</a>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>


<style>
a {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

 
/* Global Styles */
/*body {*/
/*    font-family: Arial, sans-serif;*/
/*    background-color: #f9f9f9;*/
/*    color: #333;*/
/*    line-height: 1.8;*/
/*    margin: 0;*/
/*    padding: 0;*/
/*}*/

/* Featured News Section */
.featured-news {
    background-color: #fff;
    padding: 29px 15%;
    margin-bottom: 40px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.featured-news h4 {
    font-size: 2.0rem;
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    font-weight: bold;
    
}

.featured-news .news-item {
    display: flex;
    flex-direction: row;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.featured-news .news-item:hover {
    transform: translateY(-10px);
}

.featured-news .news-image {
    flex: 1;
    height: 250px;
    overflow: hidden;
}

.featured-news .news-image img {
    width: 86%;
    height: 99%;
    object-fit: cover;
}

.featured-news .news-content {
    flex: 2;
    padding: 20px;
}

.featured-news .news-content h2 {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 10px;
}

.featured-news .news-content small {
    display: block;
    color: #666;
    margin-bottom: 10px;
    font-size: 0.9rem;
}

.featured-news .news-content p {
    font-size: 1rem;
    color: #555;
    line-height: 1.6;
}

/* News List Section */
.news-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    padding: 0 15%;
}

.news-item {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.news-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.news-image {
    height: 200px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-content {
    padding: 20px;
}

.news-content h2 {
    font-size: 1.4rem;
    margin-bottom: 10px;
}

.news-content small {
    display: block;
    color:#0a0a0a;
    margin-bottom: 10px;
    font-size: 0.9rem;
}

.news-content p {
    font-size: 0.95rem;
    color:#0a0a0a;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination a {
    padding: 10px 20px;
    margin: 0 5px;
    /*background-color: #0066cc;*/
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: #004d99;
}

.pagination a.active {
    background-color: #003366;
}
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
}

.pagination a, .pagination span {
    padding: 10px 15px;
    margin: 0 5px;
    text-decoration: none;
    /*background-color: #fff;*/
    /*color: #333;*/
    border-radius: 50%;
    border: 1px solid #ddd;
    display: inline-block;
    transition: all 0.3s ease;
}

.pagination a:hover {
    background-color: #0066cc;
    color: white;
}

.pagination a.active {
    background-color: #ff0000;
    color: white;
    font-weight: bold;
}

.pagination span {
    border: none;
    font-weight: bold;
    color: #666;
}

/*.pagination a:first-child, .pagination a:last-child {*/
/*    font-weight: bold;*/
/*    background-color: red;*/
    /*color: #666;*/
/*    border: none;*/
/*}*/

/* Responsive Design */
@media (max-width: 768px) {
    .featured-news {
        padding: 20px 5%;
    }

    .featured-news h1 {
        font-size: 2rem;
    }

    .featured-news .news-item {
        flex-direction: column;
    }

    .news-container {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 0 5%;
    }

    .news-item {
        flex-direction: column;
    }

    .news-image {
        height: 150px;
    }
}

@media (max-width: 480px) {
    body {
        font-size: 14px;
    }

    .featured-news h1 {
        font-size: 1.5rem;
    }

    .featured-news .news-item {
        flex-direction: column;
    }

    .featured-news .news-image {
        height: 150px;
    }

    .news-container {
        grid-template-columns: 1fr;
    }

    .pagination a {
        padding: 8px 15px;
    }
}



</style>
<!--  -->