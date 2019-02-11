<?php

use frontend\widgets\posts\PostsWidgets;
use yii\base\Widget;

$this->title = Yii::t('common','Information');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= PostsWidgets::widget(); ?>