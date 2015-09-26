<?php
/**
 * ページ用レイアウト： 1カラム
 */
?>

<!-- ページ用レイアウト： 1カラム -->
<article class="container local-contents">
  <h1 class="page-title"><?php echo $this->BcBaser->getContentsTitle() ?></h1>
  <?php $this->BcBaser->flash() ?>
  <?php $this->BcBaser->content() ?>
  <div class="entry-sns sns-links">
    <?php include(dirname(__FILE__) . '/part-sns-links.php'); ?>
  </div>
</article><!-- /.local-contents -->