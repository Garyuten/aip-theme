<?php
/**
 * [PUBLISH] メールフォーム確認ページ
 *
 * PHP versions 5
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2015, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Mail.View
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */
$this->BcBaser->css(array('admin/jquery-ui/ui.all'), array('inline' => false));
$this->BcBaser->js(array('admin/jquery-ui-1.8.19.custom.min', 'admin/i18n/ui.datepicker-ja'), false);
if ($freezed) {
	$this->Mailform->freeze();
}
?>
<?php if ($freezed): ?>
	<h2 class="title-center-line"><span>入力内容の確認</span></h2>
	<p class="mt20">入力した内容に間違いがなければ「送信する」ボタンをクリックしてください。</p>
<?php else: ?>

<?php endif ?>

<div class="section">
	<?php $this->BcBaser->flash() ?>
	<?php $this->BcBaser->element('mail_form') ?>
</div>
