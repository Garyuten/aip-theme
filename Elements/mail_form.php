<?php
/**
 * [PUBLISH] フォーム
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
$prefix = '';
if (Configure::read('BcRequest.agent')) {
	$prefix = '/' . Configure::read('BcRequest.agentAlias');
}
?>
<?php /*
<script type="text/javascript">
$(function(){
  $(".form-submit").click(function(){
    var mode = $(this).attr('id').replace('BtnMessage', '');
    $("#MessageMode").val(mode);
    return true;
  });
});
</script>
*/ ?>
<?php /* フォーム開始タグ */ ?>
<?php if (!$freezed): ?>
	<?php echo $this->Mailform->create('Message', array('url' => $prefix . '/' . $mailContent['MailContent']['name'] . '/confirm', 'type' => 'file' )) ?>
<?php else: ?>
	<?php echo $this->Mailform->create('Message', array('url' => $prefix . '/' . $mailContent['MailContent']['name'] . '/submit' )) ?>
<?php endif; ?>
<?php /* フォーム本体 */ ?>

<?php echo $this->Mailform->hidden('Message.mode') ?>

<?php
	$st_class = "";
	if($freezed) { //確認画面
		$st_class = " table-form-confirm";
	}
?>

<table class="table-form<?php echo $st_class; ?>">
	<?php $this->BcBaser->element('mail_input', array('blockStart' => 1)) ?>
<?php if ($mailContent['MailContent']['auth_captcha']): ?>
	<?php if (!$freezed): ?>
	<tr>
		<th>画像認証</th>
    <td>
			<div class="auth-captcha">
        <figure><?php $this->BcBaser->img($prefix . '/' . $mailContent['MailContent']['name'] . '/captcha', array('alt' => '認証画像', 'class' => 'auth-captcha-image')) ?>
        </figure>
			 <?php echo $this->Mailform->text('Message.auth_captcha') ?>
			 <p>画像の文字を入力してください</p>
			<?php echo $this->Mailform->error('Message.auth_captcha', '入力された文字が間違っています。入力をやり直してください。') ?>
		  </div>
    </td>
  </tr>
	<?php else: ?>
		<?php echo $this->Mailform->hidden('Message.auth_captcha') ?>
	<?php endif ?>
<?php endif ?>
</table>


<?php /* 送信ボタン */ ?>
<div class="box-submit center">
  <p>メールフォームよりいただいた情報は、お問い合わせの回答や講座申込者への連絡以外の目的で使用することはありません。</p>
	<?php if ($freezed): ?>
		<?php //echo $this->Mailform->submit('書き直す', array('div' => false, 'class' => 'btn waves-effect waves-light form-submit', 'id' => 'BtnMessageBack')) ?>
		<?php //echo $this->Mailform->submit('送信する', array('div' => false, 'class' => 'btn waves-effect waves-light form-submit', 'id' => 'BtnMessageSubmit')) ?>

		<button class="btn small waves-effect waves-light form-submit" id="BtnMessageBack" type="submit" value="Back">書き直す
		</button>

		<button class="btn waves-effect waves-light form-submit" name="data['Message']['mode']" id="BtnMessageSubmit" type="submit" value="">送信する
		</button>
	<?php elseif ($this->action != 'submit'): ?>
		<?php //echo $this->Mailform->submit('入力内容を確認する', array('div' => false, 'class' => 'btn waves-effect waves-light form-submit', 'id' => 'BtnMessageConfirm')) ?>
		<button class="btn waves-effect waves-light form-submit" id="BtnMessageConfirm" type="submit" value="">入力内容を確認する
		</button>
	<?php endif; ?>
</div>

<?php echo $this->Mailform->end() ?>
