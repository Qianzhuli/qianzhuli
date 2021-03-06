<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use xj\ueditor\Ueditor;
use pudinglabs\tagsinput\TagsinputWidget;

//echo '<h1>这是文章创建方法</h1>';

$this->title = Yii::t('common','Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-lg-9">
		<div class="panel-title box-title">
			<span><?= Yii::t('common','Create Post') ?></span>
		</div>
		<div class="panel-body">
			<?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]) ?>

			<?= $form->field($model, 'title')->textinput(['maxlength' => true]) ?>
			<?= $form->field($model, 'cat_id')->dropDownlist($cats) ?>
			<?= $form->field($model, 'content')->widget(\crazydb\ueditor\UEditor::className()) ?>
			<?= $form->field($model, 'tags')->widget(TagsinputWidget::classname(), [
			            'options' => [],
			            'clientOptions' => [],
			            'clientEvents' => []
			]);?>

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