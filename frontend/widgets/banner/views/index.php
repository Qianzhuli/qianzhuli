<?php

use yii\helpers\Url;

?>

<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <?php foreach ($data['items'] as $k => $list): ?>
        	<li data-target="#myCarousel" data-slide-to="<?= $k ?>" class="<?= (isset($list['active']) && $list['active'])?'active':'' ?>"></li>
        <?php endforeach; ?>
    </ol>   
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
    	<?php foreach ($data['items'] as $k => $list): ?>
        	<div class="item <?= (isset($list['active']) && $list['active'])?'active':'' ?>">
            	<a href="<?= Url::to($list['url']) ?>"><img src="<?= $list['image_url'] ?>" alt="<?= $list['label'] ?>"></a>
        	</div>
        <?php endforeach; ?>    
    </div>
    <!-- 轮播（Carousel）导航 -->
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>