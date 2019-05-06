<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel">
		    <div class="panel-title box-title">
		        <span><?=$data['title']?></span>
		        <?php if($this->context->more):?>
		        <span class="pull-right"><a href="<?=$data['more']?>" class="font-12">更多»</a></span>
		        <?php endif;?>
		    </div>
		 	<div class="new-list">
		    <?php foreach ($data['body'] as $list):?>
		        <div class="panel-body border-bottom">      
		            <div class="row">
		                <div class="col-lg-2 label-img-size">
		                    <a href="<?=Url::to(['posts/view','id'=>$list['id']])?>" class="post-label-mine">
		                        <img src="<?= $list['label_img'] ?>" alt="<?=$list['title']?>">
		                    </a>
		                </div>
		                <div class="col-lg-10 btn-group">
		                    <h1><a href="<?=Url::to(['posts/view','id'=>$list['id']])?>"><?=$list['title']?></a></h1>
		                    <span class="post-tags">
		                        <span class="glyphicon glyphicon-user"></span><a href="<?=Url::to(['member/index','id'=>$list['user_id']])?>"><?=$list['user_name']?></a>&nbsp;
		                        <span class="glyphicon glyphicon-time"></span><?=date('Y-m-d',$list['created_at'])?>&nbsp;
		                        <span class="glyphicon glyphicon-eye-open"></span><?=isset($list['extends']['browser'])?$list['extends']['browser']:0?>&nbsp;
		                        <span class="glyphicon glyphicon-comment"></span><a href="<?=Url::to(['posts/view','id'=>$list['id']])?>"><?=isset($list['extend']['comment'])?$list['extend']['comment']:0?></a>
		                    </span>
		                    <p class="post-content"><?=$list['summary']?></p>
		                    <a href="<?=Url::to(['posts/view','id'=>$list['id']])?>"><button class="btn no-radius btn-warning btn-sm pull-right-mine">阅读全文</button></a>
		                </div>
		            </div>
		            <div class="tags">
		                <?php if(!empty($list['tags'])):?>
		                <span class="fa fa-tags"></span>
		                    <?php foreach ($list['tags'] as $lt):?>
		                    <a href="#"><?=$lt?></a>，
		                    <?php endforeach;?>
		                <?php endif;?>
		            </div>
		        </div>
		    <?php endforeach;?>            
		    </div>
		    <?php if($this->context->page):?>
		    	<div class="page"><?=LinkPager::widget(['pagination' => $data['page']]);?></div>
		    <?php endif;?>
		</div>
	</div>
</div>