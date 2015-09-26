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

?>
<?php if ($posts): ?>
  <?php foreach ($posts as $key => $post): ?>
  <?php
    // var_dump($post);
    // /files/blog/news/blog_posts/
    // echo $post["BlogPost"]["eye_catch"];
    // echo $this->Blog->getPostLink($post, "");
    $postLink = $this->BcBaser->getUrl($baseCurrentUrl.$post['BlogPost']['no'],true);
    // アイキャッチ画像のパス
    $eyeCatch = $baseCurrentImgUrl . $post["BlogPost"]["eye_catch"];

    // アイキャッチ画像の小さいサイズを利用する
    $eyeCatch = str_replace(".jpg","__mobile_thumb.jpg", $eyeCatch);
    // $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);

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
    <section id="<?php echo $id; ?>" class="row <?php echo implode(' ', $class) ?>">
      <div class="col s12 m3">
        <h2 class="title"><?php $this->Blog->postTitle($post,false) ?></h2>
        <!-- <time datetime="">更新：<?php $this->Blog->postDate($post) ?></time> -->
      </div>
      <div class="body col s12 m9">
        <figure><?php $this->Blog->eyeCatch($post,array('link' => false)) ?></figure>
        <?php $this->Blog->postContent($post) ?>
      </div>
    </section>
  <?php endforeach; ?>
<?php else: ?>
    <p class="no-data">記事がありません</p>
<?php endif ?>
