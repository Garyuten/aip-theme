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
  <ul class="newsfeed sp_list mt0">
  <?php foreach ($posts as $key => $post): ?>
  <?php
    // var_dump($post);
    // /files/blog/news/blog_posts/
    // echo $post["BlogPost"]["eye_catch"];
    // echo $this->Blog->getPostLink($post, "");
    $postLink = $this->BcBaser->getUrl($baseCurrentUrl.$post['BlogPost']['no'],true);
    if($post["BlogPost"]["eye_catch"]){
      // アイキャッチ画像のパス
      $eyeCatch = $baseCurrentImgUrl . $post["BlogPost"]["eye_catch"];
      // アイキャッチ画像の小さいサイズを利用する
      // $eyeCatch = str_replace(".jpg","__mobile_thumb.jpg", $eyeCatch);
      // $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);
      // アイキャッチ画像の小さいサイズを利用する
      $eyeCatch = str_replace(".jpg","__mobile_thumb.jpg", $eyeCatch);
    // $eyeCatch_m = str_replace(".jpg","__thumb.jpg", $eyeCatch);
    } else {
      $eyeCatch = $this->BcBaser->getThemeUrl()."img/no-photo-thumb.png";
    }

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
    <li id="<?php echo $id; ?>" class="<?php echo implode(' ', $class) ?>">
      <a href="<?php echo $postLink; ?>" class="waves-effect waves-light">
        <?php $this->Blog->postTitle($post,false) ?><br>
        <span class="fs-small"><?php $this->Blog->postDate($post, 'Y年m月d日') ?></span>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p class="no-data">記事がありません</p>
<?php endif ?>
