<?php require "../header.php"; ?>

<?php
// Bật hiển thị lỗi PHP để kiểm tra lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
include('../tintuc_test/admin/config/config.php');

// Kiểm tra nếu tag không tồn tại hoặc rỗng
if (!isset($_GET['tag']) || empty($_GET['tag'])) {
    die("Vui lòng chọn một tag.");
}

// Xử lý tag từ URL: loại bỏ khoảng trắng, chuyển chữ thường, chống SQL Injection
$tag = strtolower(trim(mysqli_real_escape_string($mysqli, $_GET['tag'])));

// Truy vấn bài viết có chứa tag này (chuẩn hóa khoảng trắng & chữ hoa/chữ thường)
$sql = "SELECT article_title, article_link, article_id, LEFT(article_content, 150) AS article_excerpt, 
               article_image, article_author, article_date 
        FROM article 
        WHERE FIND_IN_SET('$tag', REPLACE(LOWER(article_tag), ' ', '')) > 0 
        ORDER BY article_date DESC";

$query = mysqli_query($mysqli, $sql);

// Kiểm tra lỗi SQL
if (!$query) {
    die("Lỗi truy vấn SQL: " . mysqli_error($mysqli));
}

// Debug: Hiển thị số lượng bài viết tìm thấy
$total_articles = mysqli_num_rows($query);
echo "<p style='color: red; font-weight: bold;'>Tổng số bài viết tìm thấy: " . $total_articles . "</p>";

?>

<title>Bài viết thuộc tag: <?= htmlspecialchars($tag); ?></title>

<div class="container">
    <section class="article-list">
        <h1 style="text-transform: uppercase">Bài viết về: "<?= htmlspecialchars($tag); ?>"</h1>
        <div style="width: 40%; height: 2px; background-color:red; margin-top: 5px;"></div>
        <p></p>
        <?php
            if ($total_articles > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    // Format ngày tháng
                    $formatted_date = date("d/m/Y", strtotime($row['article_date'])); 

                    echo "<div class='article-item'>";
                    echo "<img src='/tintuc_test/admin/modules/blog/uploads/"  . htmlspecialchars($row['article_image']) . "' class='article-image'>";
                    echo "<div class='article-content'>";
                    echo "<h3><a href='/tintuc/" . urlencode($row['article_link']) . "'>" . htmlspecialchars($row['article_title']) . "</a></h3>";
                    echo "<p>" . htmlspecialchars_decode($row['article_excerpt']) . "...</p>";
                    echo "<p class='article-meta'><strong>Ngày đăng: </strong>" . $formatted_date . " | <strong>Tác giả: </strong>" . htmlspecialchars($row['article_author']) . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Không có bài viết nào trong tag này.</p>";
            }
        ?>
    </section>
</div>
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
    }
    
    .container {
        width: 80%;
        margin: auto;
        padding: 20px;
    }
    
    .article-list {
        background: white;
        padding: 60px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }
    
    .article-list h1 {
        font-size: 1.6rem;
        color: #222;
    }
    
    .article-item {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
    }
    
    .article-item:last-child {
        border-bottom: none;
    }
    
    .article-meta {
    color: #777;
    font-size: 0.9rem;
    }
    
    .article-meta strong {
        color: #333;
    }

    
    .article-image {
        max-width: 200px;
        margin-right: 30px;
        border-radius: 8px;
    }
    
    .article-content {
        flex: 1;
    }
    
    .article-item h2 {
        font-size: 1.5rem;
    }
    
    .article-item p {
        color: #0e0e0e;
    }
    
    .article-item a {
        text-decoration: none;
        color:#222222;
        font-weight: bold;
        font-size:20px;
    }
    
    .article-item a:hover {
        color: #004d99;
    }
    @media (max-width: 768px) {
    .container {
        width: 95%;
        padding: 10px;
    }

    .article-list {
        padding: 67px;
    }

    .article-item {
        flex-direction: column;
        /*text-align: center;*/
    }

    .article-image {
        max-width: 100%;
        margin: 0 auto 15px auto;
        display: block;
    }

    .article-content {
        width: 100%;
    }

    .article-item h2 {
        font-size: 1.3rem;
    }

    .article-item a {
        font-size: 18px;
    }
}

</style>

<?php require "../footer.php" ?>


