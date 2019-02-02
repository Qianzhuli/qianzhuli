<?php
$this->title = Yii::t('common','Check');

$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = $this->title;

echo '<h1>感谢您的提交!<br/>您的文章' . '<a href="#">《' . $title . '》</a>' .'将在审核通过后展示在资讯页！</h1>';