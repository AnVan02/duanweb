<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
// Bao gồm tệp kết nối
include('../tintuc_test/admin/config/config.php');

// Kiểm tra nếu `link` được truyền qua URL
if (!isset($_GET['link']) || empty($_GET['link'])) {
    die("Không tìm thấy link bài viết.");
}

// Lấy link bài viết từ URL và xử lý để tránh lỗi SQL Injection
$article_link = mysqli_real_escape_string($mysqli, $_GET['link']); 

// Truy vấn bài viết dựa trên `article_link`
$sql_article = "SELECT * FROM article WHERE article_link = '$article_link' LIMIT 1";
$query_article = mysqli_query($mysqli, $sql_article);

// Kiểm tra nếu xảy ra lỗi truy vấn SQL
if (!$query_article) {
    die("Lỗi truy vấn SQL: " . mysqli_error($mysqli));
}

// Kiểm tra nếu không tìm thấy bài viết
if (mysqli_num_rows($query_article) === 0) {
    die("Bài viết không tồn tại hoặc đã bị xóa.");
}

// Lấy dữ liệu bài viết
$article = mysqli_fetch_assoc($query_article);
?>
 <!-- Breadcrumb -->
<div class="container-layout">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">TRANG CHỦ</a></li>
        <li class="breadcrumb-item active" aria-current="page">TIN TỨC</li>
    </ol>
</nav>

<!--<div class="container-layout">-->
    <div class="main-layout">
        <!-- Cột bên trái: Bài viết chính -->
        <section class="article">
             <div class="article__content">
                <h1><?= htmlspecialchars($article['article_title']); ?></h1>
                <div class="article-info">
                    <div class="article-meta d-flex space-between align-center">
                        <span style="font-size:17px">
                            <?= date("d/m/Y", strtotime($article['article_date'])); ?> <?php echo " " . htmlspecialchars($article['article_author']); ?>
                        </span>
                        <span class="social-icons">
                            <a href="https://www.facebook.com/people/ROSA-AI-Computer/61559427752479/" target="_blank">
                                <i class="fab fa-facebook" style="color: #1877F2; font-size:25px"></i>
                            </a>
                            
                            <a href="https://www.linkedin.com/in/rosa-ai-computer-20980b352/" target="_blank">
                                <i class="fab fa-linkedin" style="color: #0A66C2; font-size:25px "></i>
                            </a>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">

                             <!-- Icon sao chép link -->
                            <a href="javascript:void(0);" onclick="copyLink()" title="Sao chép liên kết">
                                <i class="fas fa-link" style="color: #000000; font-size:20px;"></i>
                            </a>
                                
                          <script>
                            function copyLink() {
                                const link = "http://localhost/DARS/tintuc_test/tintuc <?= htmlspecialchars($article['article_link']); ?>";
                                navigator.clipboard.writeText(link)
                                    .then(() => {
                                        // Xóa thông báo cũ nếu tồn tại
                                        const existingNotification = document.querySelector('.copy-notification');
                                        if (existingNotification) {
                                            existingNotification.remove();
                                        }
                            
                                        // Tạo phần tử thông báo
                                        const notification = document.createElement('div');
                                        notification.className = 'copy-notification';
                            
                                        const text = document.createElement('span');
                                        text.className = 'notification-text';
                                        text.textContent = 'Link copied !';
                            
                                        notification.appendChild(text);
                            
                                        // Thêm thông báo vào vị trí ngay sau icon copy link
                                        const copyLinkIcon = document.querySelector('.social-icons a[onclick="copyLink()"]');
                                        copyLinkIcon.insertAdjacentElement('afterend', notification);
                            
                                        // Xóa thông báo sau 1 giây
                                        setTimeout(() => {
                                            notification.remove();
                                        }, 1000);
                                    })
                                    .catch(err => {
                                        console.error("Lỗi khi sao chép: ", err);
                                    });
                            }
                            </script>
                        </span>
                    </div>
                     <hr style="width=30px">
                </div>
                <div class="article__context"><?= htmlspecialchars_decode($article['article_content']); ?></div> 
                <div class="article__summary"><?= htmlspecialchars_decode($article['article_summary']); ?></div>

                <div class="article__tag">
                    <strong>Thẻ: </strong> 
                    <?php
                    $tags = explode(',', $article['article_tag']);
                    foreach ($tags as $tag) {
                        $tag = trim($tag);
                        if (!empty($tag)) {
                            echo '<a href="localhost/DARS/tintuc_test/tintuc/tag/' . urlencode($tag) . '" class="article_link">' . htmlspecialchars($tag) . '</a>';
                        }
                    }
                    ?>
                </div>

                <div class="rosa-contact">
                    <h4>ROSA COMPUTER</h4>
                    <p>Địa chỉ: 150 Ter Bùi Thị Xuân, Phường Bến Thành, TP. Hồ Chí Minh.</p>
                    <p>Phòng KD: (028) 39293770 - (028) 39293765</p>
                    <p>Phòng kỹ thuật & Bảo hành: (028) 39260996</p>
                    <p>Website: 
                        <a href="https://www.rosacomputer.vn" target="_blank">www.rosacomputer.vn</a> | 
                        <a href="https://www.rosacomputer.ai" target="_blank">www.rosacomputer.ai</a>
                    </p>
                </div>
            </div>
        </section>

        <!-- Cột bên phải: Tin tức mới -->
        <div class="sidebar">
            <div class="tab-news">
                <h3 class="tab-title">TIN MỚI NHẤT</h3>
                <?php
                    $latestNewsQuery = "SELECT article_title, article_link, article_image, article_date FROM article ORDER BY article_date DESC LIMIT 3";
                    $latestResult = mysqli_query($mysqli, $latestNewsQuery);
                    if ($latestResult && mysqli_num_rows($latestResult) > 0):
                        while ($news = mysqli_fetch_assoc($latestResult)): ?>
                            <div class="news-card">
                                <a href="/DARS/tintuc_test/tintuc/<?= htmlspecialchars($news['article_link']); ?>">
                                    <img src="/tintuc_test/admin/modules/blog/uploads/<?= htmlspecialchars($news['article_image']); ?>" alt="News Image">
                                </a>
                                <div class="news-content">
                                    <a class="news-title" href="/DARS/tintuc_test/tintuc/<?= htmlspecialchars($news['article_link']); ?>">
                                        <?= htmlspecialchars($news['article_title']); ?>
                                    </a>
                                    <p class="news-date"><?= date("d/m/Y", strtotime($news['article_date'])); ?></p>
                                </div>
                            </div>
                <?php endwhile; endif; ?>
            </div>

        </div>

    </div>
</div>



<style>
/* Reset and base styles */
body, h2, p, ul, li, a, img {
    font-family: Arial, sans-serif;
    line-height: 1.8;
    margin: 0;
    padding: 0;
    font-size: 16px;
    list-style: none;
    text-decoration: none;
    box-sizing: border-box;
    color: #333;
}
body {
    max-width: 100%;
    overflow-x: hidden;
}

img, iframe, video {
    max-width: 100%;
    height: auto;
}

a, p, div, span {
    word-wrap: break-word;
    overflow-wrap: break-word;
}


/* General image styling */
img {
    max-width: 100%;
    height: auto;
    display: block;
}

.tab-news {
    margin-bottom: 30px;
}

.tab-title {
    font-size: 1.3rem;
    font-weight: bold;
    color: #d60000;
    border-bottom: 2px solid #d60000;
    padding-bottom: 5px;
    margin-bottom: 15px;
}

.news-card {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.news-card img {
    width: 90px;
    height: 70px;
    object-fit: cover;
    border-radius: 5px;
}

.news-content {
    flex: 1;
}

.news-title {
    font-size: 0.95rem;
    font-weight: bold;
    color: #333;
    display: block;
    margin-bottom: 5px;
    line-height: 1.4;
    text-decoration: none;
}

.news-title:hover {
    color: #d60000;
    text-decoration: underline;
}

.news-date {
    font-size: 0.8rem;
    color: #777;
}

.rosa-contact h4 {
    font-size: 18px;
    font-weight: bold;
    color: #c80000;
    margin-bottom: 10px;
}

.rosa-contact a {
    color: #0073e6;
    text-decoration: none;
    font-weight: bold;
}

.rosa-contact a:hover {
    text-decoration: underline;
}


/* Container layout */
.container-layout {
    width: 70%;
    margin: 0 auto;
    padding: 0;
}

/* Breadcrumb */
.breadcrumb {
    background: #fff;
    padding: 10px 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Main layout */
.main-layout {
    display: flex;
    justify-content: space-between;
    margin: 30px 0;
    gap: 20px;
}

/* Sidebar (left column) */
.sidebar {
    width: 27%;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 20px;
    align-self: flex-start;
    max-height: calc(100vh - 40px);
}

.sidebar h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #222;
    font-weight: bold;
    color: #FF0000;
}

.sidebar p {
    font-size: 0.9rem;
    color: #777;
    margin-bottom: 20px;
}

.news-card {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    gap: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #ddd;
}

.news-card:last-child {
    border-bottom: none;
}

.news-card img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
}

.news-content {
    flex: 1;
}

.news-title a {
    font-size: 1rem;
    color: #222;
    font-weight: bold;
    text-decoration: none;
    line-height: 1.4;
}

.news-title a:hover {
    color: rgb(252, 71, 71);
}

.news-date {
    font-size: 0.85rem;
    color: #777;
    margin-top: 5px;
}

/* Article (right column) */
.article {
    width: 75%;
}

.article__content {
    padding: 44px 5%;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-weight: 400;
}

.article__content h1 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: #222;
}

.article__content span {
    font-size: 0.9rem;
    color: #000;
}

.article__context {
    font-size: 1rem;
    line-height: 1.8;
    color: #444;
    margin-bottom: 20px;
    text-align: justify;
    
    
}

.article__summary {
    margin-bottom: 30px;
}

.article__summary h1,
.article__summary h2,
.article__summary h3,
.article__summary p {
    font-family: Arial, sans-serif;
    margin-bottom: 16px;
    font-weight: normal;
    font-size: 19px;
    line-height: 1.8;
    color: #444;
}

.article__summary a {
    display: block;
    margin-bottom: 8px;
    font-size: 18px;
    color: #333;
    text-decoration: none;
    position: relative;
    padding-left: 10px;
    transition: color 0.3s;
}

.article__summary a:hover {
    color: #0a66c2;
}

.article__summary a.h2 {
    margin-left: 20px;
    font-size: 16px;
}

.article__summary a.h3 {
    margin-left: 40px;
    font-size: 14px;
}

/* Article tags */
.article__tag {
    margin-top: 10px;
}

.article__tag strong {
    font-size: 17px;
    color: #333;
    margin-right: 5px;
}

.article__tag a {
    display: inline-block;
    background: #f5f5f5;
    color: #FF0000;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 16px;
    margin: 5px;
    text-decoration: none;
    transition: background 0.3s ease;
}

.article__tag a:hover {
    background-color: rgb(223, 6, 45);
    color: #FFFFFF;
}

/* Article meta and social icons */
.article-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 20px;
}

.social-icons {
    display: flex;
    align-items: center;
}

.social-icons a {
    margin-right: 12px;
    color: #000;
    text-decoration: none;
    font-size: 25px;
}

.copy-notification {
    display: inline-flex;
    align-items: center;
    margin-left: 10px;
}

.notification-text {
    background: linear-gradient(45deg, #FF3300, #FFFFFF);
    color: #fff;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
}

/* Website links */
.website-links {
    margin: 20px 0;
    font-size: 1rem;
    color: #d32f2f;
    display: flex;
    align-items: center;
    gap: 10px;
    white-space: nowrap; /* Prevent text wrapping */
    overflow-x: auto; /* Allow horizontal scrolling on small screens if needed */
    -webkit-overflow-scrolling: touch; /* Smooth scrolling on mobile */
}

.website-links a {
    color: #d32f2f;
    text-decoration: none;
    margin: 0 5px;
    transition: color 0.3s ease;
    white-space: nowrap; /* Ensure each link stays on one line */
}

.website-links a:hover {
    color: #b71c1c;
}

.website-links a:after {
    content: " | ";
    color: #d32f2f;
}

.website-links a:last-child:after {
    content: "";
}
@media screen and (max-width: 768px) {
    .main-layout {
        display: flex;
        flex-direction: column;
    }

    .sidebar {
        order: -1; /* Đưa sidebar lên trước */
    }

    .article {
        order: 0; /* Bài viết phía dưới */
    }
}


/* Responsive styles */
@media screen and (max-width: 900px) {
    .main-layout {
        flex-direction: column-reverse;
        gap: 15px;
    }
    .sidebar,
    .article {
        width: 100%;
    }
    .sidebar {
        max-height: none;
        position: static;
        overflow-y: visible;
        margin-bottom: 20px;
    }
    .news-card {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding-bottom: 12px;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        overflow: hidden;
        background: #fff;
    }
    .news-card img {
        width: 90px;
        height: 90px;
        max-width: 90px;
        max-height: 90px;
        object-fit: cover;
        border-radius: 6px;
        flex-shrink: 0;
        background: #f5f5f5;
        display: block;
    }
    .news-content {
        flex: 1 1 0%;
        min-width: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .news-title a {
        display: block;
        white-space: normal;
        word-break: break-word;
    }
}

@media screen and (max-width: 600px) {
   .container-layout {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 10px;
    }

    .main-layout {
        flex-direction: column-reverse;zzzzar {
        width: 100%;
        padding: 10px;
        max-height: none;
        position: static;
        overflow-y: visible;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .sidebar h3 {
        font-size: 1.2rem;
        margin-bottom: 8px;
        color: #FF0000;
        font-weight: bold;
    }
    .sidebar p {
        font-size: 0.85rem;
        margin-bottom: 12px;
        color: #777;
    }
    .news-card {
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 10px;
        margin-bottom: 12px;
        border-bottom: 1px solid #eee;
        overflow: hidden;
    }
    .news-card:last-child {
        border-bottom: none;
    }
    .news-card img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 4px;
        flex-shrink: 0;
        background: #f5f5f5;
        display: block;
    }
    .news-content {
        flex: 1 1 0%;
        min-width: 0;
        overflow: hidden;
    }
    .news-title a {
        display: block;
        white-space: normal;
        word-break: break-word;
    }
    .news-date {
        font-size: 0.8rem;
        color: #777;
        margin-top: 5px;
    }
    /* Đảm bảo phần bài viết chính cũng hiển thị tốt trên mobile */
    .article {
        width: 100%;
    }
    .article__content {
        padding: 12px 2%;
        border-radius: 8px;
    }
    .article__content h1 {
        font-size: 1.2rem;
    }
    .article__context,
    .article__summary {
        font-size: 0.9rem;
    }
    .article__tag a {
        font-size: 0.9rem;
        padding: 4px 8px;
        margin: 3px;
    }
}
}
</style>




