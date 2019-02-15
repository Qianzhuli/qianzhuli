<?php

$this->title = Yii::t('common','Platform for details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Rating'),'url' => ['rate/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if (isset($data['error'])) {?>
	<h1>信息采集中...</h1>
<?php }else {?>
	<div class="row">
		<div class="col-lg-9">
			<div class="page-title">
				<h1><?= $data['org_name'] ?></h1>
				<span>时间：<?= date('Y-m-d',$data['created_at']); ?>&nbsp;&nbsp;</span>
			</div>
			<div class="page-content">
				<?= $data['content']; ?>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel-title box-title">
				<span><?= Yii::t('common','Hot spot information') ?></span>
			</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div>
<?php }?>