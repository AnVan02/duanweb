<?php 
require "../header.php";

// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
include('../tintuc_test/admin/config/config.php');

// Lấy link bài viết
if (!isset($_GET['link']) || empty($_GET['link'])) {
    die("Không tìm thấy link bài viết.");
}
$article_link = mysqli_real_escape_string($mysqli, $_GET['link']); 

// Truy vấn bài viết
$sql_article = "SELECT * FROM article WHERE article_link = '$article_link' LIMIT 1";
$query_article = mysqli_query($mysqli, $sql_article);
if (!$query_article || mysqli_num_rows($query_article) === 0) {
    die("Bài viết không tồn tại hoặc đã bị xóa.");
}
$article = mysqli_fetch_assoc($query_article);

// Chuẩn bị dữ liệu SEO
$title       = htmlspecialchars($article['article_title']);
$description = mb_substr(strip_tags($article['article_summary']), 0, 160);
$image       = !empty($article['article_image']) ? $article['article_image'] : "/default-image.jpg";
$url         = "https://yourdomain.com/tintuc/" . urlencode($article['article_link']);
?>

<!-- Thẻ SEO -->
<title><?= $title ?> | ROSA Computer</title>
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<link rel="canonical" href="<?= $url ?>" />

<!-- Open Graph -->
<meta property="og:title" content="<?= $title ?>" />
<meta property="og:description" content="<?= htmlspecialchars($description) ?>" />
<meta property="og:image" content="<?= $image ?>" />
<meta property="og:url" content="<?= $url ?>" />
<meta property="og:type" content="article" />

<!-- Article Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "<?= $title ?>",
  "author": {
    "@type": "Person",
    "name": "<?= htmlspecialchars($article['article_author']) ?>"
  },
  "datePublished": "<?= date('c', strtotime($article['article_date'])) ?>",
  "image": "<?= $image ?>",
  "publisher": {
    "@type": "Organization",
    "name": "ROSA Computer",
    "logo": {
      "@type": "ImageObject",
      "url": "https://yourdomain.com/logo.png"
    }
  }
}
</script>

<div class="container-layout">
  <!-- Breadcrumb với schema -->
  <nav aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <ol class="breadcrumb">
          <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
              <a itemprop="item" href="/"><span itemprop="name">Trang chủ</span></a>
              <meta itemprop="position" content="1" />
          </li>
          <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
              <a itemprop="item" href="/tintuc"><span itemprop="name">Tin tức</span></a>
              <meta itemprop="position" content="2" />
          </li>
          <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
              <span itemprop="name"><?= $title ?></span>
              <meta itemprop="position" content="3" />
          </li>
      </ol>
  </nav>

  <main class="main-layout">
    <!-- Nội dung bài viết -->
    <article class="article" itemscope itemtype="https://schema.org/Article">
      <header class="article__content">
        <h1 itemprop="headline"><?= $title ?></h1>
        <p class="article-meta">
          <time datetime="<?= date('c', strtotime($article['article_date'])) ?>" itemprop="datePublished">
            <?= date("d/m/Y", strtotime($article['article_date'])) ?>
          </time> 
          | <span itemprop="author"><?= htmlspecialchars($article['article_author']); ?></span>
        </p>
        <?php if ($image): ?>
        <div class="article__image">
          <img src="<?= $image ?>" alt="<?= $title ?>" itemprop="image" />
        </div>
        <?php endif; ?>
      </header>

      <section class="article__context" itemprop="articleBody">
        <?= htmlspecialchars_decode($article['article_content']); ?>
      </section>

      <section class="article__summary">
        <?= htmlspecialchars_decode($article['article_summary']); ?>
      </section>

      <footer class="article__tag">
        <strong>Thẻ:</strong>
        <?php foreach (explode(',', $article['article_tag']) as $tag): ?>
          <?php if (trim($tag)): ?>
            <a href="/tintuc/tag/<?= urlencode(trim($tag)) ?>" class="article_link"><?= htmlspecialchars(trim($tag)) ?></a>
          <?php endif; ?>
        <?php endforeach; ?>
      </footer>
    </article>

    <!-- Sidebar: Tin tức mới -->
    <aside class="sidebar">
      <h3>Tin mới</h3>
      <?php
        $sql_news = "SELECT article_link, article_title, article_date, article_image 
                     FROM article 
                     WHERE article_status = 1 
                     ORDER BY article_date DESC 
                     LIMIT 5";
        $query_news = mysqli_query($mysqli, $sql_news);
        while ($news = mysqli_fetch_assoc($query_news)):
      ?>
      <div class="news-card">
        <img src="<?= $news['article_image'] ?>" alt="<?= htmlspecialchars($news['article_title']) ?>">
        <div class="news-content">
          <h4 class="news-title">
            <a href="/tintuc/<?= urlencode($news['article_link']) ?>"><?= htmlspecialchars($news['article_title']) ?></a>
          </h4>
          <p class="news-date"><?= date("d/m/Y", strtotime($news['article_date'])) ?></p>
        </div>
      </div>
      <?php endwhile; ?>
    </aside>
  </main>
</div>

<div class="article__tag">
    <strong>Thẻ: </strong>
    <?php 
        $tags = explode(',', $article ['article_tag']);
        foreach ($tags as  $tag) {
            $tag = trim($tag);
            if (!empty($tag)){
                echo '<a href="../tintuc/tag/' . urldecode($tag).'" class="article_link">'.htmlspecialchars($tag).'</a>';
            }
        }
    ?>
</div></p></p>
<div class="rosa-contact">
    <h4>ROSA COMPUTER</h4>
    <p>Đia chi : 150Ter Bùi Thị Xuân, Phương Bên Thành, TP.Hồ Chí Minh.</p>
    <p>Phòng KD: (028) 39293770 - (028) 39292765</p>
    <p>Phòng kỹ thuật & Bảo hành: (028) 39260996</p>
    <p>
        <a href="https://www.rosacomputer.vn" target="_blank">www.rosacomputer.vn</p>|
        <a href="https://www.rosacomputer.ai" target="_blank">www.rosacomputer.ai</p>
    </p>
</div>
    
<?php require "../footer.php" ?>
