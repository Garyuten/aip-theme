<?php
/**
 * Mail用共通レイアウト： 1カラム
 */
?>
<!-- Mail用レイアウト： 1カラム -->
<article class="container local-contents mail_form">
  <h1 class="page-title"><?php echo $this->BcBaser->getContentsTitle() ?></h1>
  <?php $this->BcBaser->flash() ?>
  <?php $this->BcBaser->content() ?>
</article><!-- /.local-contents -->