<?php
/*
 * 1カラム指定用レイアウトテーマ
 *   default.php内で分岐するための変数のみ
 *
 *   指定方法）
 *   ・固定ページ＞オプションに以下のコードを挿入
 *     <?php $this->layout = '1col' ?>
*/

$layoutType = "1col";
include_once( dirname(__FILE__)."/default.php");
?>
