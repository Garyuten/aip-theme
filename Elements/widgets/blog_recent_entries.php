<?php
/**
 * [PUBLISH] ブログ最近の投稿
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
if (!isset($count)) {
	$count = 5;
}
// var_dump($blog_content_id);

if (isset($blog_content_id) ) {
  $id = $blog_content_id;
} else {
  $id = $blogContent['BlogContent']['id'];
}

$data = $this->requestAction('/blog/blog/get_recent_entries/' . $id . '/' . $count);
$recentEntries = $data['recentEntries'];
$blogContent = $data['blogContent'];
$baseCurrentUrl = $blogContent['BlogContent']['name'] . '/archives/';
?>


<div class="widget widget-blog-recent-entries widget-blog-recent-entries-<?php echo $id ?> blog-widget">
  <?php if ($name && $use_title): ?>
  <h2 class="title"><?php echo $name ?></h2>
  <?php endif ?>
  <?php if ($recentEntries): ?>
  <ul class="list-entry">
  <?php foreach ($recentEntries as $recentEntry): ?>
    <?php if ($this->request->url == $baseCurrentUrl . $recentEntry['BlogPost']['no']): ?>
    <?php $class = ' class="current"' ?>
    <?php else: ?>
    <?php $class = '' ?>
    <?php endif ?>
    <li<?php echo $class ?>>

    <?php
    // var_dump($recentEntry);
    ?>

      <?php if (!empty($recentEntry['PetitCustomField'])): ?>
        <?php

          $week = array("日", "月", "火", "水", "木", "金", "土");

          $event_day_start_Obj = date($this->PetitCustomField->get($recentEntry, 'event_day_start'));
          $event_day_start = date_create( $event_day_start_Obj );
          $sW = (int)date_format(date_create($event_day_start_Obj), 'w');

          $event_day_end_Obj = date($this->PetitCustomField->get($recentEntry, 'event_day_end'));
          $event_day_end = date_create( $event_day_end_Obj );
          $eW = (int)date_format(date_create($event_day_end_Obj), 'w');

        ?>
        <span class="fs-small">
          <!-- イベント開催日： -->
          <?php echo date_format($event_day_start, 'Y年m月d日')."(".$week[$sW].")"; ?>
          <!-- イベント終了日： -->
          <?php if($event_day_end_Obj != "") {
            echo "〜 ".date_format($event_day_end, 'm月d日')."(".$week[$eW].")" ;
          } ?>
          <?php if(( $event_day_end_Obj == "" && time() > strtotime( date("Y-m-d", strtotime($event_day_start_Obj.'+1 day') ) ) )
            || ( $event_day_end_Obj != "" && time() > strtotime( date("Y-m-d", strtotime($event_day_end_Obj.'+1 day') ) ) ) ): ?>
            <span class="event_finished">【終了】</span><br>
          <?php else: ?>
            &nbsp;開催<br>
          <?php endif ?>
        </span>
      <?php endif ?>


      <?php $this->BcBaser->link($recentEntry['BlogPost']['name'], array('admin' => false, 'plugin' => '', 'controller' => $blogContent['BlogContent']['name'], 'action' => 'archives', $recentEntry['BlogPost']['no'])) ?>

    </li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</div>
