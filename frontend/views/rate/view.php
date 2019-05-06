<?php

$this->title = Yii::t('common','Platform for details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Rating'),'url' => ['rate/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if (isset($data['error'])) {?>
	<h1><?= $data['org_name'] ?>的信息正在采集中，就快有啦...</h1>
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
			<?php if(!empty($data2)){ ?>
				<?php foreach ($data2 as $p) { ?>
					<p><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a href="view?id=<?= $p['id'] ?>"><?= $p['title']?></a></p>
				<?php } ?>
			<?php } ?>
		</div>
		</div>
	</div>
<?php }?>