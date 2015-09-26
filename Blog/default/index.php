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

<article id="main" class="col s12 m9 local-contents right blog archives top">
  <header class="entry-header">
    <h1 class="pageTitle"><?php $this->Blog->title() ?></h1>
    <div class="entry-sns sns-links">
      <?php include(dirname(__FILE__) . '/../../Elements/part-sns-links.php'); ?>
    </div>
  </header>
  <div class="main-contents">
    <?php $this->BcBaser->flash() ?>
    <?php
      $colW = 4;
      include(dirname(__FILE__) . '/posts.php');
    ?>
  </div><!-- main-contents -->
  <!-- pagination -->
  <?php $this->BcBaser->pagination('simple'); ?>
</article>

<div id="sub" class="col s12 m3 local-nav left">
  <?php //$this->BcBaser->widgetArea(); ?>
  <?php include_once( dirname(__FILE__)."/../../Elements/sub.php"); ?>
</div><!-- /#sub -->