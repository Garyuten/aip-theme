<?php
/**
 * blog用共通レイアウト： 2カラム
 */
?>
<!-- blog 2col -->
<div id="contents" class="container type-2col blog">
  <div class="row">
    <?php $this->BcBaser->flash() ?>
    <?php $this->BcBaser->content() ?>
  </div><!-- /.row -->
</div><!-- /#contents -->
