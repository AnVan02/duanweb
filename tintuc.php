<?php require "../header.php" ?>

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
                             <!-- Icon sao chép link -->
                            <a href="javascript:void(0);" onclick="copyLink()" title="Sao chép liên kết">
                                <i class="fas fa-link" style="color: #000000; font-size:20px;"></i>
                            </a>
                                
                          <script>
                            function copyLink() {
                                const link = "https://localhost/tintuc_test/tintuc/<?= htmlspecialchars($article['article_link']); ?>";
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
                            echo '<a href="../tintuc/tag/' . urlencode($tag) . '" class="article_link">' . htmlspecialchars($tag) . '</a>';
                        }
                    }
                    ?>
                </div><p></p>
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
       
    </div>
</div>

<style>


/* ---------- 1. CSS Reset & Root Vars ---------- */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;font-size:18px}
body{font-family:"Arial",sans-serif;line-height:1.6;color:#333;background:#fafafa}
a{text-decoration:none}
ul,ol{list-style:none}
img{max-width:100%;display:block;height:auto}
.article__content img,
.article__summary img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%;
    height: auto;
}

:root{
  --clr-primary:#ff0000;
  --clr-secondary:#0a66c2;
  --clr-bg:#fff;
  --clr-muted:#777;
  --radius:8px;
  --shadow:0 4px 8px rgba(0,0,0,0.1);
  --transition:0.25s ease-in-out;
}

/* ---------- 2. Layout Containers ---------- */
.container-layout{
  width:min(100%,1100px);
  margin-inline:auto;
  padding-inline:clamp(1rem,3vw,2rem);
}

.breadcrumb{
  background:var(--clr-bg);
  border-radius:var(--radius);
  padding:0.75rem 1rem;
  margin-block:1rem 2rem;
  box-shadow:0 1px 3px rgba(0,0,0,0.08);
}
.breadcrumb li+li::before{content:"/";margin-inline:0.5rem;color:var(--clr-muted)}
.breadcrumb a:hover{color:var(--clr-primary)}

.main-layout{
  display:flex;
  align-items:flex-start;
  gap:2rem;
}

/* ---------- 3. Article Column ---------- */
.article{
  flex:1 1 0;
  min-width:0; /* Required for overflow */
}
.article__content{
  background:var(--clr-bg);
  padding:2.75rem 5%;
  border-radius:var(--radius);
  box-shadow:var(--shadow);
}
.article__content h1{font-size:clamp(1.75rem,2vw+1rem,2.25rem);margin-bottom:1rem;color:#222}
.article__content .article-meta{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;font-size:0.95rem;gap:0.5rem;color:#000}
.article__context{margin-block:1.25rem;font-size:1rem;line-height:1.8;text-align:justify;color:#444}
.article__summary{margin-block:2rem}
.article__summary p{margin-bottom:1.125rem;font-size:1.0625rem;color:#444}

.article__tag{margin-top:2rem;display:flex;flex-wrap:wrap;gap:0.5rem;align-items:center}
.article__tag strong{margin-right:0.25rem;font-size:1rem}
.article__tag a{background:#f5f5f5;color:var(--clr-primary);padding:0.35rem 0.75rem;border-radius:var(--radius);font-size:0.9rem;transition:var(--transition)}
.article__tag a:hover{background:var(--clr-primary);color:#fff}

/* Social icons */
.social-icons{display:flex;align-items:center;gap:0.75rem}
.social-icons a{font-size:1.4rem;transition:var(--transition)}
.social-icons a:hover{transform:scale(1.1)}
.notification-text{background:linear-gradient(45deg,var(--clr-primary),#fff);padding:0.25rem 0.75rem;border-radius:var(--radius);font-weight:700;font-size:0.8rem;text-transform:uppercase;color:#fff}

/* ---------- 4. Sidebar Column ---------- */
.sidebar{
  flex:0 0 290px;
  position:sticky;
  top:1.25rem;
  align-self:flex-start;
  background:var(--clr-bg);
  padding:1.5rem;
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  max-height:calc(100vh - 2.5rem);
  overflow:auto;
}
.sidebar h3{font-size:1.25rem;font-weight:700;margin-bottom:0.5rem;color:var(--clr-primary)}
.sidebar p{font-size:0.9rem;color:var(--clr-muted);margin-bottom:1.25rem}

.news-card{display:flex;gap:0.75rem;align-items:center;margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid #e5e5e5}
.news-card:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0}
.news-card img{flex:0 0 90px;height:90px;object-fit:cover;border-radius:5px}
.news-content{flex:1}
.news-title a{font-size:1rem;font-weight:600;line-height:1.3;color:#222;transition:var(--transition)}
.news-title a:hover{color:var(--clr-primary)}
.news-date{font-size:0.8125rem;color:var(--clr-muted);margin-top:0.25rem}

/* ---------- 5. Website Links Row ---------- */
.website-links{display:flex;flex-wrap:nowrap;gap:0.5rem;margin-block:1.5rem;overflow-x:auto;-webkit-overflow-scrolling:touch;font-size:0.95rem}
.website-links a{white-space:nowrap;color:var(--clr-primary);padding-inline:0.25rem;transition:var(--transition)}
.website-links a:hover{color:#b71c1c}
.website-links a::after{content:"|";margin-left:0.35rem;color:var(--clr-primary)}
.website-links a:last-child::after{content:""}

/* ---------- 6. Headlines Section (Featured News) ---------- */
.heading-featured{font-weight:700;color:var(--clr-primary);font-size:1.15rem;margin-block:2rem 1rem}

/* ---------- 7. Media Queries ---------- */
@media (max-width:992px){
  .sidebar{flex:0 0 240px}
  .article__content{padding:2rem 1.25rem}
}

@media (max-width:768px){
  .main-layout{flex-direction:column-reverse}
  .sidebar{position:static;max-height:none;overflow:visible;width:100%}
  .news-card img{width:80px;height:80px}
  .article__content{padding:1.25rem}
  .article__content h1{font-size:1.65rem}
}

@media (max-width:480px){
  html{font-size:15px}
  .article__context,.article__summary p{font-size:0.95rem}
  .news-card{gap:0.5rem}
  .news-card img{width:70px;height:70px}
  .website-links{font-size:0.85rem}
  .social-icons a{font-size:1.2rem}
}

/* ---------- 8. Helper Classes ---------- */
.text-center{text-align:center}
.hidden{display:none!important}


/* ====== anh link ===== */

.article__image {
    margin: 1rem 0;
    text-align: center;
}
.article__image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}
/* End of stylesheet */
</style>


<?php require "../footer.php" ?>

