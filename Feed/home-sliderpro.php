<?php
/**
 * [PUBLISH] フィード
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
* Copyright 2008 - 2015, baserCMS Users Community
*
 * @copyright   Copyright 2008 - 2015, baserCMS Users Community
 * @link      http://basercms.net baserCMS Project
 * @package     Feed.View
 * @since     baserCMS v 0.1.0
 * @license     http://basercms.net/license/index.html
 */
$this->Feed->saveCachetime();
?>
<!--nocache-->
<?php $this->Feed->cacheHeader() ?>
<!--/nocache-->
<pre>
<?php var_dump($items); ?>
</pre>
<?php if (!empty($items)): ?>
<?php foreach ($items as $key =>$post): ?>
<?php $no = sprintf('%02d', $key + 1) ?>
<div class="sp-slide">
  <img class="sp-image" src="<?php echo $this->BcBaser->getThemeUrl() ?>img/blank.gif"
    data-src="http://npo-aip.lomo.jp/files/blog/news/blog_posts/2015/05/00000001_eye_catch.png">
  <div class="sp-layer sp-black sp-padding hide-small-screen"
    data-position="bottomLeft"
    data-horizontal="0" data-vertical="0" data-width="100%"
    data-show-transition="top" data-show-delay="100" data-hide-transition="bottom" data-hide-delay="500">
    <a href="<?php echo $post['link']['value']; ?>">
      <span class="date">
      <?php echo date("Y.m.d", strtotime($post['pubDate']['value'])); ?></span>
      <h2 class="slide-title"><?php echo $post['title']['value']; ?></h2>
      <p class="slide-description">開催する講座について、これまで以上に内容を分かりやすくお伝えすると共に、AIPが誇る講師群の紹介を充実させました。</p>
    </a>
  </div>
</div>
<?php endforeach; ?>
<?php else: ?>
<p>現在、記事はありません</p>
<?php endif; ?>