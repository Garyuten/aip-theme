<?php
/**
 * [PUBLISH] ブログ詳細ページ
 *
 * PHP versions 5
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2014, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2014, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Blog.View
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */
// echo __FILE__;

$this->BcBaser->setDescription($this->Blog->getTitle() . '｜' . $this->Blog->getPostContent($post, false, false, 50));

$siteName = $siteConfig["name"];
if(!isset($post["BlogContent"]))  {
  $blogName ="news";
} else {
  $blogName = $post["BlogContent"]["name"];
}

$baseCurrentUrl = "/".$blogName . '/archives/';
$baseCurrentImgUrl = "/files/blog/".$blogName . "/blog_posts/";
$eyeCatch = $baseCurrentImgUrl . $post["BlogPost"]["eye_catch"];
$postLink = $this->BcBaser->getUrl($baseCurrentUrl.$post['BlogPost']['no'],true);
$id = 'post-'.$post['BlogPost']['no'];


//スマートフォンで、PC・タブレットでなければ
// アイキャッチ画像の小さいサイズを利用する

$ua = $_SERVER['HTTP_USER_AGENT'];

if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false)
  || (strpos($ua, 'iPhone') !== false)
  || (strpos($ua, 'Windows Phone') !== false))
{
  // スマートフォンからアクセスされた場合
  $path = realpath( "."); //フルパス取得
  $eyeCatch_s = str_replace(".jpg","__mobile_thumb.jpg", $eyeCatch);
  // $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);

  if(file_exists($path.$eyeCatch_s)) {
  $eyeCatch = $eyeCatch_s;
  }
} elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false)) {
    // タブレットからアクセスされた場合


} elseif ((strpos($ua, 'DoCoMo') !== false) || (strpos($ua, 'KDDI') !== false) || (strpos($ua, 'SoftBank') !== false) || (strpos($ua, 'Vodafone') !== false) || (strpos($ua, 'J-PHONE') !== false)) {
    // 携帯からアクセスされた場合

} else {
    // その他（PC）からアクセスされた場合

}
// echo $eyeCatch;
?>

<article id="main" class="col s12 m9 local-contents right">
  <header class="entry-header">
    <div class="breadcrumbs"><?php $this->BcBaser->crumbsList(); ?></div>
    <h1 class="pageTitle"><?php echo $this->BcBaser->getContentsTitle() ?></h1>
    <div class="entry-sns sns-links">
      <?php include(dirname(__FILE__) . '/../../Elements/part-sns-links.php'); ?>
    </div>
  </header>


  <div id="<?php echo $id; ?>" class="wrap">
    <div id="postHeader">
      <h1 class="postTitle"><?php $this->BcBaser->contentsTitle() ?></h1>
      <div class="postMeta">
        <time datetime="2014-08-30"><?php $this->Blog->postDate($post) ?></time>
        <span class="postCtg"><?php $this->Blog->category($post) ?></span>
        <span class="postTag"><?php $this->BcBaser->element('blog_tag', array('post' => $post)) ?>      </span>
      </div>
    </div><!-- /#postHeader -->
  <div class="main-contents">
    <?php $this->BcBaser->flash() ?>
    <?php $this->Blog->postContent($post) ?>
    <?php $this->BcBaser->content() ?>
  </div><!-- main-contents -->
    <footer class="postFooter">
      <div class="breadCrumbs">
        <?php $this->BcBaser->element('crumbs'); ?>
      </div>
      <nav class="pagination-post">
        <?php echo $this->Blog->prevLink($post,'', array('arrow'=>'<img src="<?php echo $this->BcBaser->getThemeUrl() ?>img/arrow-left.svg" alt="">')); ?>
        <?php echo $this->Blog->nextLink($post,'', array('arrow'=>'<img src="<?php echo $this->BcBaser->getThemeUrl() ?>img/arrow-right.svg" alt="">')) ?>
      </nav>
    </footer>
  </div><!-- /.wrap -->
</article><!-- /#mainContents -->

<div id="sub" class="col s12 m3 local-nav left">
  <?php include_once( dirname(__FILE__)."/../Elements/sub.php"); ?>
</div><!-- /#sub -->