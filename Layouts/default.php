<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <?php $this->BcBaser->title() ?>
<?php
//OGP
//=====================================
$siteName = $siteConfig["name"];
$description = mb_substr( $siteConfig["description"] ,0, 297); //説明文297文字以内
$title = $this->BcBaser->getTitle(); //ページタイトル95文字以内
//タイトルにはサイトタイトルを含めない
// $title = $this->BcBaser->contentsTitle(); //ページタイトル95文字以内
$type ="website"; //記事はarticle, それ以外はwebsite
$url =$this->BcBaser->getUri($this->BcBaser->getHere());

$host = "http://".$_SERVER['HTTP_HOST']."/";
$eyeCatch = $host.$this->BcBaser->getThemeUrl()."img/ogp.png";
$eyeCatch_s = false;
$eyeCatch_m = false;

// var_dump($siteConfig);
// var_dump($post);

//ブログ記事かどうか判断
if (!empty($post)) {
  $type ="article";
  $num = 297;
  $str = strip_tags($post['BlogPost']['detail']); //タグ除去
  $str = str_replace(array("\r\n","\n","\r"), '', $str); //改行除去
  if(mb_strlen($str) >= $num) {
    $description = mb_substr($str, 0,$num-1)."…";
  } else {
    $description = $str;
  }

  //タイトルにはサイトタイトルを含めない
  $title = $this->Blog->getPostTitle($post,false)." - ".$siteConfig["formal_name"]; //ページタイトル95文字以内

  if(!isset($post["BlogContent"]))  {
    $blogName ="news";
  } else {
    $blogName = $post["BlogContent"]["name"];
  }
  $baseCurrentUrl = "/".$blogName . '/archives/';
  $baseCurrentImgUrl = "/files/blog/".$blogName . "/blog_posts/";
  echo "<!--";
  var_dump( $post["BlogPost"]["eye_catch"] );
  echo "-->";
  if(!is_null($post["BlogPost"]["eye_catch"])){
    $eyeCatch = $this->BcBaser->getUri( $baseCurrentImgUrl . $post["BlogPost"]["eye_catch"]);
    $eyeCatch_s = str_replace(".jpg","__mobile_thumb.jpg", $eyeCatch);
    $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);
  }
}

//タイトルの文字数調整
// $title_num = 95;
// if(mb_strlen($title) >= $title_num) {
//   $title = mb_substr($title, 0,$title_num-1)."…";
// }

?>
  <meta name="description" content="<?php echo $description; ?>">
  <?php $this->BcBaser->metaKeywords() ?>
  <meta name="author" content="AIP">
  <meta property="article:publisher" content="<?php echo $host; ?>">
  <meta property="og:type" content="<?php echo $type; ?>">
  <meta property="og:locale" content="ja_JP">
  <meta property="og:site_name" content="<?php echo $siteName; ?>">
  <meta property="og:title" content="<?php echo $title; ?>">
  <meta property="og:description" content="<?php echo $description; ?>">
  <meta property="og:url" content="<?php echo $url; ?>">
  <meta property="og:image" content="<?php echo $eyeCatch; ?>">
<?php //  <meta property="fb:admins" content="" /> ?>
  <meta property="fb:app_id" content="1643972982505688">
  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <?php // 写真左上 ：「アカウント名」のみ ?>
  <meta name="twitter:site" content="@npo_aip">
  <?php // by (投稿者) ：写真下の 「By アカウント名 @TwitterID 」?>
  <meta name="twitter:creator" content="@npo_aip">
  <meta name="twitter:domain" content="<?php echo $host; ?>">
  <meta name="twitter:url" content="<?php echo $url; ?>">
  <meta name="twitter:title" content="<?php echo $title; ?>">
  <meta name="twitter:description" content="<?php echo $description; ?>">
  <meta name="twitter:image" content="<?php echo $eyeCatch; ?>">
  <?php /*
  <meta name="twitter:image:src" content="<?php echo $eyeCatch; ?>">
  */ ?>

  <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
  <link rel="shortcut icon" href="/favicon.ico">
  <?php //$this->BcBaser->icon() ?>
  <?php //$this->BcBaser->rss('AIP お知らせ', '/news/index.rss') ?>
  <?php $this->BcBaser->rss('AIP お知らせ', '/news/index.rss'); ?>
  <?php $this->BcBaser->rss('AIP 講座', '/course/index.rss'); ?>
  <?php $this->BcBaser->css('admin/colorbox/colorbox') ?>


  <!-- CSS  -->
  <link href="<?php echo $this->BcBaser->getThemeUrl() ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/script.header.js"></script>
  <!--[if lt IE 9]>
  <link rel="stylesheet" href="<?php echo $this->BcBaser->getThemeUrl() ?>css/ie8.css">
  <script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/css3-mediaqueries.js"></script>
  <script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/html5shiv-printshiv.js"></script>
  <![endif]-->
  <!--[if IE]>
  <link rel="stylesheet" href="<?php echo $this->BcBaser->getThemeUrl() ?>css/ie.css">
  <![endif]-->
<?php
$bodyClasss = "";
if($this->BcBaser->isPage() && !$this->BcBaser->isHome() ) $bodyClasss .= "page";
else if( function_exists( $this->BcBaser->getTitle() ) ) {
  $bodyClasss .= "blog";
  if( isBlogCategory() ){ //カテゴリー別記事一覧ページ判定
    $bodyClasss .= " blog-category";
  } else if( isBlogDate() ){ //日別記事一覧ページ判定
    $bodyClasss .= " blog-date";
  } else if( isBlogHome() ){ //インデックスページ判定
    $bodyClasss .= " blog-home";
  } else if( isBlogMonth() ){ //月別記事一覧ページ判定
    $bodyClasss .= " blog-month";
  } else if( isBlogSingle() ){ //個別ページ判定
    $bodyClasss .= " blog-single";
  } else if( isBlogTag() ){ //タグ別記事一覧ページ判定
    $bodyClasss .= " blog-tag";
  } else if( isBlogYear() ){ //年別記事一覧ページ判定
    $bodyClasss .= " blog-year";
  }
}

if($this->BcBaser->getContentsName(false, array('underscore'=>true)) =="default") {
  $bodyClasss .= " ctg-".$this->BcBaser->getContentsName(true, array('underscore'=>true));
} else {
  $bodyClasss .= " ctg-".$this->BcBaser->getContentsName(false, array('underscore'=>true));
}

if( isset( $layoutType ) && $layoutType == "1col") {
  $bodyClasss .= " type-1col";
} else {
  $bodyClasss .= " type-2col";
}

// 例外：教育事業の固定ページ＋blogの組み合わせ
//   講座一覧、講師一覧もカテゴリ「教育事業」とする
if( strpos($bodyClasss,"teacher")
  || strpos($bodyClasss,"course")) {
  $bodyClasss .= " ctg-education";
}

?>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/google_analytics.js"></script>
</head>
<body id="<?php $this->BcBaser->contentsName(true, array('underscore'=>true)) ?>" class="<?php echo $bodyClasss; ?>">
<div class="body-wrapper" id="pagetop">
  <header id="g-header">
    <h1 class="brand-logo"><a href="/" title="NPO法人 AIP"><img src="<?php echo $this->BcBaser->getThemeUrl() ?>img/logo.png" alt="NPO法人 AIP"></a></h1>
    <nav id="g-nav" role="navigation" class="hide-on-small-only">
      <ul class="g-nav-list">
        <li class="menu-1"><a href="/community/">コミュニティ支援</a></li>
        <li class="menu-2"><a href="/project/">プロジェクト支援</a></li>
        <li class="menu-3"><a href="/education/">教育事業</a></li>
        <li class="menu-4"><a href="/about/">AIPの紹介</a></li>
        <li class="menu-5"><a href="/member">AIP会員</a></li>
        <li class="menu-6"><a href="/news/">お知らせ</a></li>
      </ul>
      <div class="site-nav">
        <ul>
          <li><a href="/staff-blog/index">スタッフブログ</a></li>
          <li><a href="/aipcafe">AIPカフェ</a></li>
          <li><a href="/contact/">お問い合わせ</a></li>
        </ul>
      </div>
    </nav>
    <a href="#sidebar" class="button-menu hide-on-med-and-up" id="toolbar-sp-bars"> <i class="mdi-navigation-menu"></i>
    </a>
  </header><!-- /#gHeader -->
<?php
// var_dump($this->BcBaser->isPage());
?>
  <?php if ($this->BcBaser->isHome()): //HOME ?>
    <?php
    include_once( dirname(__FILE__)."/../Elements/contents-home.php");
    ?>
  <?php elseif ($this->BcBaser->isPage()): //固定ページ ?>
    <?php
    if(isset( $layoutType ) && $layoutType == "1col") {
      include_once( dirname(__FILE__)."/../Elements/contents-page-1col.php");
    } else {
      include_once( dirname(__FILE__)."/../Elements/contents-page.php");
    }
    ?>
  <?php elseif ( isset($this->Mail) && $this->Mail->getDescription()): //Mail ?>
    <?php
      include_once( dirname(__FILE__)."/../Elements/contents-mail.php");
    ?>
  <?php else: //ブログ ?>
    <?php
      include_once( dirname(__FILE__)."/../Elements/contents-blog.php");
    ?>
  <?php endif ?>

<?php $this->BcBaser->footer() ?>
</div><!-- /#wrapper -->

<div id="sidebar" class="sidebar-box">
  <ul class="list-link-arrow">
    <li><a href="/">HOME</a></li>
    <li><a href="/community/">コミュニティ支援</a></li>
    <li><a href="/project/">プロジェクト支援</a></li>
    <li><a href="/education/">教育事業</a>
    <li><a href="/course/index">AIPの講座</a></li>
    <li><a href="/teacher/index">AIPの講師</a></li>
    <li><a href="/about/">AIPの紹介</a></li>
    <li><a href="/about/aipcafemembers">AIP会員</a></li>
    <li><a href="/news/index">お知らせ</a></li>
    <li><a href="/staff-blog/index">スタッフブログ</a></li>
    <li><a href="/aipcafe">AIPカフェ</a></li>
    <li><a href="/contact/">お問い合わせ</a></li>
  </ul>
</div>

<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/jquery-1.11.2.min.js"></script>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/jquery.cookie.js"></script>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/jquery.easing.1.3.js"></script>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/jquery.smoothScroll.js"></script>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/jquery.flatheights.min.js"></script>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/jquery.simplesidebar.min.js"></script>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/jquery.sliderPro.min.js"></script>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/lib/imgLiquid-min.js"></script>
<!-- <script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/materialize.min.js"></script> -->
<?php $this->BcBaser->js(array('admin/jquery.colorbox-min-1.4.5')) ?>
<script src="<?php echo $this->BcBaser->getThemeUrl() ?>js/script.footer.js"></script>

<?php $this->BcBaser->js(array(
  // 'admin/jquery-1.7.2.min',
  'admin/functions')) ?>
<?php $this->BcBaser->scripts() ?>
<?php $this->BcBaser->element('google_analytics') ?>
<?php $this->BcBaser->func() ?>
</body>
</html>
