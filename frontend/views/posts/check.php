<?php
$this->title = Yii::t('common','Check');

$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = $this->title;

if (isset($id) && !empty($id)) {
	echo '<h1>感谢您的提交，您的文章《' . $title . '》将在审核通过后展示在资讯页！</h1>';
}else {
	echo '<h1>感谢您的提交，您的文章将在审核通过后展示在资讯页！</h1>';
}