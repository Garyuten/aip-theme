<?php
/*
  blog:講師専用テンプレート
 */
$this->BcBaser->setDescription($this->Blog->getDescription());
?>

<article id="main" class="col s12 m9 local-contents right blog archives top">
  <header class="entry-header">
    <div class="breadcrumbs"><?php $this->BcBaser->crumbsList(); ?></div>
    <h1 class="pageTitle"><?php $this->Blog->title() ?></h1>
    <div class="entry-sns sns-links">
      <?php include(dirname(__FILE__) . '/../../Elements/part-sns-links.php'); ?>
    </div>
  </header>
  <div class="main-contents contents-accordion-posts">
    <?php $this->BcBaser->flash() ?>
    <?php //include(dirname(__FILE__) . '/posts.php'); ?>
    <h2 id="teacher-technology" class="mb0">カテゴリA 講師</h2>
    <?php
    $this->BcBaser->blogPosts("teacher", 20 ,  array('category'=>'category-a'));
    ?>
    <h2 id="teacher-career" class="mt80 mb0">カテゴリB 講師</h2>
    <?php
    $this->BcBaser->blogPosts("teacher", 20 ,  array('category'=>'category-b'));
    ?>
  </div><!-- main-contents -->
</article>

<div id="sub" class="col s12 m3 local-nav left">
  <?php include_once( dirname(__FILE__)."/../../Elements/sub.php"); ?>
</div><!-- /#sub -->