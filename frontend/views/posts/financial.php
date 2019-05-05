<?php

use frontend\widgets\posts\FinancialPostsWidgets;
use yii\base\Widget;

$this->title = Yii::t('common','Information');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-lg-9">
		<!-- 文章列表组件 frontend/widgets/posts -->
		<?= FinancialPostsWidgets::widget(); ?>
	</div>
	<div class="col-lg-3">
		
	</div>
</div>
