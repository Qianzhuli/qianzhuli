<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('common','Preview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Create'),'url' => ['posts/create']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-lg-9">
		<div class="panel-title box-title">
			<span><?= '为《' . $title . '》这篇资讯选择一个预览图吧！' ?></span>
		</div>
		<div class="panel-body">
			<?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]) ?>
			
			<?= $form->field($model, "file")->fileInput() ?>
			<div>请上传2M以下的图片</div>
			<div>&nbsp;</div>

			<div class="form-group">
				<?= Html::submitButton(Yii::t('common','Submit'),['class' => 'btn btn-success']) ?>
			</div>

			<?php ActiveForm::end() ?>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel-title box-title">
			<span><?= Yii::t('common','Matters Need Attention') ?></span>
		</div>
		<div class="panel-body">
			<p>第一!绝对不意气用事!</p>
			<p>第二!绝对不漏判任何一件坏事!</p>
			<p>第三!绝对裁判的公正漂亮!</p>
		</div>
	</div>
</div>