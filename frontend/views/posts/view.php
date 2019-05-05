<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = $post['title'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
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
		<!--写评论区-->
		<div class="post-view-writeComments">
			<?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]) ?>

			<?= $form->field($model, 'content')->textarea(['rows' => '5']) ?>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('common','Submit'),['class' => 'btn btn-success']) ?>
			</div>

			<?php ActiveForm::end() ?>
		</div>
		<!--展示评论区-->
		<div class="allComments">全部评论:</div>
		<div class="post-view-comments">
			<table class="table table-striped">
				<?php foreach ($comments as $comment):?>
					<tr>
						<td><span><i class="fa fa-user" aria-hidden="true"></i> &nbsp;<?= $comment['user'].':' ?></span><span style="float: right; font-size: 14px; color: gray;"><?= date('Y/m/d H:i:s', $comment['create_at']); ?></span></td>
					</tr>
					<tr>
						<td><?= $comment['content'] ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>

		<!-- 底部banner -->
		<div>
        	<?= '<img src="' . Yii::$app->params['webImages']['SiteTitle1'] . '" class="site-index-jumbotron-img">'; ?>
    	</div>
	</div>
	<div class="col-lg-3">
		<div class="panel-title box-title">
			<span><?= Yii::t('common','Hot spot information') ?></span>
		</div>
		<div class="panel-body">
			<?php if(!empty($data)){ ?>
				<?php foreach ($data as $p) { ?>
					<p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a href="view?id=<?= $p['id'] ?>"><?= $p['title']?></a></p>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>