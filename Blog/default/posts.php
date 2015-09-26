<?php
/**
 * [PUBLISH] 記事一覧
 *
 * BaserHelper::blogPosts( コンテンツ名, 件数 ) で呼び出す
 * （例）<?php $this->BcBaser->blogPosts('news', 3) ?>
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

$blogName = $posts[0]["BlogContent"]["name"];
$baseCurrentUrl = "/".$blogName . '/archives/';
$baseCurrentImgUrl = "/files/blog/".$blogName . "/blog_posts/";

//カラム幅
$m = "m3";
if(isset($colW)) {
  $m = "m".$colW;
}
?>
<?php if ($posts): ?>
<div class="row post-items">
  <?php foreach ($posts as $key => $post): ?>
  <div class="col s6 <?php echo $m; ?> item">
  <?php
    // var_dump($post);
    // /files/blog/news/blog_posts/
    // echo $post["BlogPost"]["eye_catch"];
    // echo $this->Blog->getPostLink($post, "");
    $postLink = $this->BcBaser->getUrl($baseCurrentUrl.$post['BlogPost']['no'],true);

    // var_dump($post["BlogPost"]["eye_catch"]);
    if( $this->Blog->getEyeCatch($post) ){
      // アイキャッチ画像のパス
      $eyeCatch = $baseCurrentImgUrl . $post["BlogPost"]["eye_catch"];
      // $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);
      // アイキャッチ画像の小さいサイズを利用する
      $eyeCatch = str_replace(".jpg","__mobile_thumb.jpg", $eyeCatch);
    // $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);
    } else {
      $eyeCatch = $this->BcBaser->getThemeUrl()."img/no-photo-thumb.png";
    }
    // var_dump($eyeCatch);

    $id = 'post-'.$post['BlogPost']['no'];

    $class = array('list-' . ($key + 1) );
    if ($this->BcArray->first($posts, $key)){
      $class[] = 'first';
    } elseif ($this->BcArray->last($posts, $key)) {
      $class[] = 'last';
    }
    if ($this->request->url == $baseCurrentUrl . $post['BlogPost']['no']){
      $class[]="current";
    }
    ?>
    <a href="<?php echo $postLink; ?>" class="<?php echo implode(' ', $class) ?>">
      <figure class="eyecatchImage"><span><img src="<?php echo $eyeCatch; ?>" alt=""></span></figure>
      <div class="wrap">
        <span class="ctg"><?php $this->Blog->category($post,array('link'=>false)) ?></span>
        <h3 class="title"><?php $this->Blog->postTitle($post,false) ?></h3>
        <?php if (!empty($post['PetitCustomField'])): ?>
          <?php
          $week = array("日", "月", "火", "水", "木", "金", "土");

          $event_day_start_Obj = date($this->PetitCustomField->get($post, 'event_day_start'));
          $event_day_start = date_create( $event_day_start_Obj );
          $sW = (int)date_format(date_create($event_day_start_Obj), 'w');

          $event_day_end_Obj = date($this->PetitCustomField->get($post, 'event_day_end'));
          $event_day_end = date_create( $event_day_end_Obj );
          $eW = (int)date_format(date_create($event_day_end_Obj), 'w');

          // echo time();
          // echo "<br>";
          // echo date($event_day_start_Obj);
          // echo "<br>";
          // echo strtotime("2015-04-18");
          // echo "<br>";
          // echo strtotime(date($event_day_start_Obj));

          // echo $event_day_start_Obj;
          // echo date($event_day_start_Obj );
          // echo date("Y-m-d", strtotime($event_day_start_Obj.'+1 day') );
          ?>
          <span class="fs-small">
            <!-- イベント開催日： -->
            <?php echo date_format($event_day_start, 'Y年m月d日')."(".$week[$sW].")"; ?>
            <!-- イベント終了日： -->
            <?php if($event_day_end_Obj != "") {
              echo "〜 ".date_format($event_day_end, 'm月d日')."(".$week[$eW].")" ;
            } ?>

          <?php if(( $event_day_end_Obj == "" && time() > strtotime( date("Y-m-d", strtotime($event_day_start_Obj.'+1 day') ) ) )
            || ( $event_day_end_Obj != "" && time() > strtotime( date("Y-m-d", strtotime($event_day_end_Obj.'+1 day') ) ) ) ): ?>
            <span class="event_finished">【終了】</span>
          <?php endif ?>
          </span>
        <?php else: ?>
          <span class="fs-small"><?php $this->Blog->postDate($post, 'Y年m月d日') ?></span>
        <?php endif ?>
      </div>
    </a>
  </div>
  <?php endforeach; ?>
</div><!-- row -->
<?php else: ?>
  <p class="no-data">記事がありません</p>
<?php endif ?>
