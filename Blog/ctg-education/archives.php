<?php
/**
 * [PUBLISH] ブログアーカイブ一覧
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
//$this->BcBaser->setTitle($this->pageTitle.'｜'.$this->Blog->getTitle());
$this->BcBaser->setDescription($this->Blog->getTitle() . '｜' . $this->BcBaser->getContentsTitle() . 'のアーカイブ一覧');


$class = "";
$ctg = false;
$tag = false;

$uri = $this->here;
if (strpos($uri, 'index.php') == 1) { //対策：スマートURLがOFF時
  $uri = substr($uri, strlen("index.php") + 1);
}

// "/subdir/" をパス先頭から除去
$ctgAry = split("/", $uri); // "/"で分割して配列に格納
// var_dump($ctgAry);

$class = "blog";
if (isset($ctgAry[1])) {
  $class .= " blog-" . $ctgAry[1] . ' ' . $ctgAry[1];
}

//ブログトップかどうか判断
if (count($ctgAry) == 2 ||
  ( count($ctgAry) == 3 && $ctgAry[2] == 'index') ) {
  $isBlogHome = true;
  $class .= " blogIndex index";
}

//ブログのアーカイブの場合
else if ($ctgAry[2] == "archives") {
  //ブログのカテゴリー一覧の場合
  if ($ctgAry[3] == "category") {
      $class .= " blogArchives archives";
      $class .= " blogCategory category";
      $class .= " ctg-" . $ctgAry[4];
      if (count($ctgAry) > 5) {
          $subCtg = $ctgAry[5]; //サブカテゴリ
          $class .= "subCtg-" . $subCtg;
      }
      $ctg = true;
  }
  //ブログのタグの場合 ex) blogTag tag blogTag-{Tag ID}
  else if ($ctgAry[3] == "tag") {
      $class .= " blogArchives archives";
      $class .= " blogTag tag-" . $ctgAry[4];
      $tag = true;
  }
  //ブログの月別アーカイブの場合 ex) blogDate date blogDate2013-08
  else if ($ctgAry[3] == "date") {
      $class .= " blogArchives archives";
      $class .= " blogDate date";
      $y = $ctgAry[4];
      $m = 0;
      if (!empty($ctgAry[5])) {
          $m = $ctgAry[5];
      }
      $class .= " blogDate-" . $y . '-' . $m;
  }
}


?>
<article id="mainContents" class="main <?php echo  $class; ?>">
<div class="wrap">
<!-- archives title -->
<div class="textC">
  <h2><?php
  if($tag) :?>TAG : <? elseif($ctg) :?>CATEGORY : <?php endif;?><?php $this->BcBaser->contentsTitle() ?></h2>
</div>
<?php include(dirname(__FILE__) . '/posts.php'); ?>

<?php /*
<!-- list -->
<?php if (!empty($posts)): ?>
	<?php foreach ($posts as $post): ?>
		<div class="post">
			<h4 class="contents-head">
			<?php $this->Blog->postTitle($post) ?>
			</h4>
					<?php $this->Blog->postContent($post, true, true) ?>
			<div class="meta"><span>
					<?php $this->Blog->category($post) ?>
					&nbsp;
					<?php $this->Blog->postDate($post) ?>
					&nbsp;
			<?php $this->Blog->author($post) ?>
				</span></div>
		<?php $this->BcBaser->element('blog_tag', array('post' => $post)) ?>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<p class="no-data">記事がありません。</p>
<?php endif; ?>
*/ ?>

<!-- pagination -->
<?php $this->BcBaser->pagination('simple'); ?>

</div><!-- /.wrap -->
</article><!-- /#mainContents -->