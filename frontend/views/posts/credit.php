<?php

use frontend\widgets\posts\CreditPostsWidgets;
use yii\base\Widget;

$this->title = Yii::t('common','Information');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-lg-9">
		<!-- 文章列表组件 frontend/widgets/posts -->
		<?= CreditPostsWidgets::widget(); ?>
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
