<?php
// サブ・コンテンツ
// widgetの分岐
?>
<?php

$ctg = $this->BcBaser->getContentsName(true, array('underscore'=>true));
if($ctg == "default") {
  echo "default";
  $ctg = $this->BcBaser->getContentsName(false, array('underscore'=>true));
}

// echo "<!--";
// echo $ctg;
// echo "-->";

if($this->BcBaser->getContentsName(false, array('underscore'=>true)) =="default") {
  // echo $ctg2 = $this->BcBaser->getContentsName(true, array('underscore'=>true));
} else {
  // echo $ctg2 = $this->BcBaser->getContentsName(false, array('underscore'=>true));
}

// 特別ローカルナビ用
// ローカルナビの現在位置表示のclass出力用
function sub_lc($pageID, $ctg) {
  $lcAry = array(
    "page-01" => "education",
    "page-02" => "education_orientation",
    "page-03" => "course",
    "page-03-01" => "course",
    "page-03-02" => "teacher",
    "page-04" => "hogehoge"
  );

  $current = "";
  if( (isset($lcAry[$pageID]) && $lcAry[$pageID] === $ctg )
    || strpos($ctg,$lcAry[$pageID]) !== false) {
    $current = " current";
  }
  // var_dump(strpos($lcAry[$pageID],$ctg));
  echo $current;
}

// var_dump(sub_lc("page-02",$ctg));
// var_dump(strpos($ctg,"course"));

if( $ctg != "education" && $ctg != "education_orientation"
  && strpos($ctg,"teacher") === false
  && strpos($ctg,"course") === false):
// if (in_array($ctg, $lcAry)) :
  $this->BcBaser->widgetArea();

else :

?>
<div class="widget-area">
  <div class="widget widget-local-navi">
    <h2>教育事業</h2>
    <ul>
      <li class="page-01 first<?php //sub_lc("page-01",$ctg); ?>"><a href="/education/">教育事業</a></li>
      </li>
      <li class="page-02<?php sub_lc("page-02",$ctg); ?>"><a href="/education/orientation">新人研修</a></li>
      <li class="page-03<?php //sub_lc("page-03",$ctg); ?>"><a href="/course/">講座</a>
        <ul>
          <li class="page-03-01<?php sub_lc("page-03-01",$ctg); ?>"><a href="/course/">講座一覧</a></li>
          <li class="page-03-02<?php sub_lc("page-03-02",$ctg); ?>"><a href="/teacher/">講師一覧</a></li>
        </ul>
      <li class="page-04 last<?php sub_lc("page-04",$ctg); ?>"><a href="#">資格・検定</a></li>
    </ul>
  </div>
</div>

<div class="widget-area">
  <?php $this->BcBaser->widgetArea(4); ?>
</div>
<?php endif; ?>

<!-- 共通バナーウィジェット -->
<div class="widget-area">
  <?php $this->BcBaser->widgetArea(5); ?>
</div>
