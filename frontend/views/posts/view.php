<?php
$this->title = $post['title'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->user->identity->username . Yii::t('common','Information'),'url' => ['posts/mine']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-lg-9">
		<div class="page-title">
			<h1><?= $post['title'] ?></h1>
			<span>作者：<?= $post['user_name']; ?>&nbsp;&nbsp;</span>
			<span>时间：<?= date('Y-m-d',$post['created_at']); ?>&nbsp;&nbsp;</span>
			<span>浏览次数：<?= isset($post['extends']['browser'])?$post['extends']['browser']:0 ?>次</span>
		</div>
		<div class="page-content">
			<?= $post['content']; ?>
		</div>
		<div class="page-tag">
			标签：
				<?php foreach ($post['tags'] as $tag): ?>
				<span><a href="#"><?= $tag ?></a></span>
				<?php endforeach;?>
		</div>
	</div>
	<div class="col-lg-3">
		
	</div>
</div>