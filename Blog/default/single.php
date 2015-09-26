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

// var_dump($blogName);
$blogSlug = $this->BcBaser->getContentsName(false, array('underscore'=>true));
// var_dump($blogSlug);

$mainContensClass = null;
//講座の場合はアコーディオンコンテンツのclassを付ける
if($blogName == "course") {
 $mainContensClass = "contents-accordion";
}

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


$week = array("日", "月", "火", "水", "木", "金", "土");
?>

<article id="main" class="col s12 m9 local-contents right blog archives top">
  <header class="entry-header">
    <div class="meta-top">
      <span class="postCtg">
        <?php $this->BcBaser->crumbsList(); ?>
        <?php
        // var_dump($post["BlogCategory"]);
        //パンくずリスト（カスタマイズ）
        // $blogTitle = $post["BlogContent"]["title"];
        // $blogUrl = '/'.$post["BlogContent"]["name"];
        // $blogUrlIndex = $blogUrl ."/index";
        // $this->BcBaser->addCrumb($blogTitle,$blogUrlIndex);
        // if( isset($post["BlogCategory"])){
        //   $blogCtgs = $post["BlogCategory"];
        //   $blogCtgTitle = $post["BlogCategory"]["title"];
        //   $blogCtgUrl = $blogUrl ."/archives/category/".$post["BlogCategory"]["name"];
        //   $this->BcBaser->addCrumb($blogCtgTitle,$blogCtgUrl);
        // }
        // $this->BcBaser->crumbs(' &gt; ');
        // // $this->BcBaser->crumbsList();
        ?>
        <?php //$this->Blog->category($post) ?>
      </span>
      <?php if (!empty($post['PetitCustomField'])): ?>
        <?php
        $event_day_start_Obj = date($this->PetitCustomField->get($post, 'event_day_start'));
        $event_day_start = date_create( $event_day_start_Obj );
        $sW = (int)date_format(date_create($event_day_start_Obj), 'w');

        $event_day_end_Obj = date($this->PetitCustomField->get($post, 'event_day_end'));
        $event_day_end = date_create( $event_day_end_Obj );
        $eW = (int)date_format(date_create($event_day_end_Obj), 'w');
        ?>
        <time>
          イベント開催日：
          <?php echo date_format($event_day_start, 'Y年m月d日')."(".$week[$sW].")"; ?>
          <!-- イベント終了日： -->
          <?php if($event_day_end_Obj != "") {
            echo "〜 ".date_format($event_day_end, 'm月d日')."(".$week[$eW].")" ;
          } ?>
        </time>
      <?php else: ?>
        <?php $postdate = date_create($this->Blog->getPostDate($post)); ?>
        <time datetime="<?php echo date_format($postdate,'Y-m-d\TH:i:sP'); ?>">更新：<?php echo date_format($postdate,'Y年m月d日'); ?></time>
      <?php endif ?>
    </div>
    <?php if (!empty($post['PetitCustomField'])): ?>
      <?php if(( $event_day_end_Obj == "" && time() > strtotime( date("Y-m-d", strtotime($event_day_start_Obj.'+1 day') ) ) )
          || ( $event_day_end_Obj != "" && time() > strtotime( date("Y-m-d", strtotime($event_day_end_Obj.'+1 day') ) ) ) ): ?>
        <span class="event_finished">終了イベント</span>
      <?php endif ?>
    <?php endif ?>
    <h1 class="pageTitle">
      <?php $this->BcBaser->contentsTitle() ?>
    </h1>
    <div class="meta">
      <div class="keyword">
        <span class="postTag"><?php $this->BcBaser->element('blog_tag', array('post' => $post)) ?></span>
      </div>
    </div>
    <div class="entry-sns sns-links">
      <?php include(dirname(__FILE__) . '/../../Elements/part-sns-links.php'); ?>
    </div>
  </header>

  <div class="main-contents <?php echo $mainContensClass; ?>">
    <figure class="eyecatchImage"><?php $this->Blog->eyeCatch($post,array('link' => false, 'imgsize'=>'large')) ?></figure>
    <?php $this->Blog->postContent($post) ?>
  </div><!-- /.wrap -->
  <footer class="entry-footer">
    <?php echo $this->Blog->prevLink($post,'', array('arrow'=>'')); ?>
    <?php echo $this->Blog->nextLink($post,'', array('arrow'=>'')) ?>
  </footer>
  <!-- pagination -->
  <?php //$this->BcBaser->pagination('simple'); ?>
</article>

<div id="sub" class="col s12 m3 local-nav left">
  <?php include_once( dirname(__FILE__)."/../../Elements/sub.php"); ?>
  <?php //$this->BcBaser->widgetArea(); ?>
</div><!-- /#sub -->