<?php
/**
 * [PUBLISH] ブログトップ
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
$this->BcBaser->setDescription($this->Blog->getDescription());
?>
<article id="mainContents" class="main blog archives top">
<div class="wrap">
  <!-- archives title -->
  <div class="textC">
    <h2><?php $this->Blog->title() ?></h2>
  </div>

  <?php include(dirname(__FILE__) . '/posts.php'); ?>
  <!-- pagination -->
  <?php $this->BcBaser->pagination('simple'); ?>
</div><!-- /.wrap -->
</article><!-- /#mainContents -->