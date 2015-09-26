<?php
/**
 * ページ用レイアウト： 2カラム
 */
?>

<!-- ページ用レイアウト： 2カラム -->
<div id="contents" class="container type-2col">
  <div class="row">
    <article id="main" class="col s12 m9 local-contents right">
      <header class="entry-header">
        <div class="meta-top">
          <span class="postCtg"><?php $this->BcBaser->crumbsList(); ?></span>
        </div>
        <h1 class="pageTitle"><?php echo $this->BcBaser->getContentsTitle() ?></h1>
        <div class="entry-sns sns-links">
          <?php include(dirname(__FILE__) . '/part-sns-links.php'); ?>
        </div>
      </header>
      <div class="main-contents">
        <?php $this->BcBaser->flash() ?>
        <?php $this->BcBaser->content() ?>
      </div><!-- main-contents -->
    </article>

    <div id="sub" class="col s12 m3 local-nav left">
      <?php include_once( dirname(__FILE__)."/../Elements/sub.php"); ?>
    </div><!-- /#sub -->
  </div><!-- /.row -->
</div><!-- /#contents -->
