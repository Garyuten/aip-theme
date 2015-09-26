<?php $this->BcBaser->css(array('admin/admin_icon')); ?>
<div id="AlertMessage" class="message" style="display:none"></div>

<div class="float-left" style="width:66%">
	<div class="panel-box corner10">
		<h2>サイト管理メニュー</h2>
		<div class="clearfix">
			<div class="iconBox">
		      <?php $this->BcBaser->img('admin/icons/course.png', array('url' => '/admin/blog/blog_posts/index/2')) ?>
		      <br />
		      <?php $this->BcBaser->link('講座', '/admin/blog/blog_posts/index/2') ?>
		    </div>
		    <div class="iconBox">
		      <?php $this->BcBaser->img('admin/icons/teacher.png', array('url' => '/admin/blog/blog_posts/index/3')) ?>
		      <br />
		      <?php $this->BcBaser->link('講師', '/admin/blog/blog_posts/index/3') ?>
		    </div>
			<div class="iconBox">
		      <?php $this->BcBaser->img('admin/icons/news.png', array('url' => '/admin/blog/blog_posts/index/1')) ?>
		      <br />
		      <?php $this->BcBaser->link('お知らせ', '/admin/blog/blog_posts/index/1') ?>
		    </div>
			<div class="iconBox">
		      <?php $this->BcBaser->img('admin/icons/page.png', array('url' => '/admin/pages/index')) ?>
		      <br />
		      <?php $this->BcBaser->link('固定ページ管理', '/admin/pages/index') ?>
		    </div>
		</div>
	</div>
</div>

<div class="float-left" style="width:33%">
	<div class="panel-box corner10">
		<h2>最近の動き</h2>
		<div id="DblogList">
			<?php $this->BcBaser->element('dashboard/index_dblog_list') ?>
		</div>
	</div>
</div>
