<?php
/**
 * HOME用レイアウト
 */
?>
<?php
$BlogPost = ClassRegistry::init('Blog.BlogPost');
$posts = $BlogPost->find('all', array(
    'conditions' => array_merge($BlogPost->getConditionAllowPublish(), array(
      // お知らせ、講義、スタッフブログ
        'BlogPost.blog_content_id' => array(1,2,4)
    )),
    'order' => array('BlogPost.posts_date DESC'),
  'limit' => 5
));
// var_dump($posts);
?>
<article class="container local-contents">
  <div id="area-main-image" class="slider-pro">
    <div class="sp-slides">
  <?php if ($posts): ?>
    <?php foreach ($posts as $key => $post): ?>
    <?php
    $blogName = $post["BlogContent"]["name"];
    $baseCurrentUrl = "/".$blogName . '/archives/';
    $baseCurrentImgUrl = "/files/blog/".$blogName . "/blog_posts/";

    $postLink = $this->BcBaser->getUrl($baseCurrentUrl.$post['BlogPost']['no'],true);
    if($post["BlogPost"]["eye_catch"]){
      // アイキャッチ画像のパス
      $eyeCatch = $baseCurrentImgUrl . $post["BlogPost"]["eye_catch"];
      // アイキャッチ画像の小さいサイズを利用する
      // $eyeCatch = str_replace(".jpg","__mobile_thumb.jpg", $eyeCatch);
      // $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);
    } else {
      $eyeCatch = $this->BcBaser->getThemeUrl() ."img/no-photo.png";
    }
    $id = 'post-'.$post['BlogPost']['no'];
  ?>
      <div class="sp-slide">
        <a href="<?php echo $postLink; ?>" class="___waves-effect">
        <img class="sp-image" src="_shared/img/blank.gif"
            data-src="<?php echo $eyeCatch; ?>">

        <div class="sp-layer sp-black sp-padding hide-small-screen"
          data-position="bottomLeft"
          data-horizontal="0" data-vertical="0" data-width="100%"
          data-show-transition="top" data-show-delay="100" data-hide-transition="bottom" data-hide-delay="500">
          <h2 class="slide-title"><?php $this->Blog->postTitle($post,false) ?></h2>
          <p class="slide-description">
          <?php
          // $post['BlogPost']['content'] //概要
          // $post['BlogPost']['detail'] //本文
          // 指定文字数にカット
          $num = 110;
          //概要がある場合
          if($post['BlogPost']['content']) {
            $str = strip_tags($post['BlogPost']['content']);
          }else {
            //概要がない場合：本文を文字数指定で出力
            $str = strip_tags($post['BlogPost']['detail']);
          }

          if(mb_strlen($str) >= $num) {
            echo mb_substr($str, 0,$num)."…";
          } else {
            echo $str;
          }
          ?>
          </p>
        </div>
        </a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="no-data">記事がありません</p>
  <?php endif ?>
    </div>
  </div>


  <div id="news" class="row mt10">
    <div class="col s12 m12 sec">
      <h2 class="title-h2">お知らせ</h2>
      <a href="/news/" class="link-more right">お知らせ一覧</a>
      <?php $this->BcBaser->blogPosts('news', 8);?>
    </div>
  </div><!-- row -->

  <div id="course" class="row mt10">
    <div class="col s12 m12 sec">
      <h2 class="title-h2">新着講座</h2>
      <a href="/course/" class="link-more right">講座一覧</a>
      <?php $this->BcBaser->blogPosts('course', 4);?>
    </div>
  </div><!-- row -->

  <div id="course" class="row mt10">
    <div class="col s12 m12 sec">
      <h2 class="title-h2">スタッフブログ</h2>
      <a href="/staff-blog/" class="link-more right">記事一覧</a>
      <?php $this->BcBaser->blogPosts('staff-blog', 8);?>
    </div>
  </div><!-- row -->


  <?php if($this->BcBaser->content()) : ?>
    <?php $this->BcBaser->flash() ?>
    <?php $this->BcBaser->content() ?>
  <?php endif; ?>

  <div class="row mt10 list-aside flatH-col">
    <div class="col s12 m4 aip_blue">
      <a href="/about/" class="waves-effect waves-light">
        <strong>AIPの紹介</strong>
        <p>福岡に根ざし、ITの利活用を通してコミュニティと街をつくるNPOです。</p>
        <p class="btn">詳しくはこちら</p>
      </a>
    </div>
    <div class="col s12 m4 aip_red">
      <a href="/aipcafe" class="waves-effect waves-light">
        <strong>AIPカフェ</strong>
        <p>勉強会や交流会の場。<br>AIPが提供するコミュニティスペースです。</p>
        <p class="btn">詳しくはこちら</p>
      </a>
    </div>
    <div class="col s12 m4">
      <a href="/member" class="waves-effect waves-light">
        <strong>AIPへの協力・支援者募集中</strong>
        <p>福岡を元気にする人材づくりを担うAIPへのご協力をお願いします！</p>
        <p class="btn">詳しくはこちら</p>
      </a>
    </div>
  </div>
  <div class="row mt10">
    <div class="col s12 m12 entry-sns sns-links">
      <?php include(dirname(__FILE__) . '/part-sns-links.php'); ?>
    </div>
  </div><!-- row -->
</article><!-- /.local-contents -->