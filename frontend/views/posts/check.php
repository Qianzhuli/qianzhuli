<?php
use yii\helpers\Url;

$this->title = Yii::t('common','Check');

$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-lg-9">
		<div class="panel">
		    <div class="panel-title box-title">
		        <span>感谢您的提交，以下文章将会在网站管理员审核通过后展示在资讯页中，敬请期待...</span>
		    </div>
		    <div class="new-list">
		        <div class="panel-body border-bottom">      
		            <div class="row">
		                <div class="col-lg-2 label-img-size">
		                    <a href="<?=Url::to(['posts/view','id'=>$post['id']])?>" class="post-label-mine">
		                        <img src="<?= $post['label_img'] ?>" alt="<?=$post['title']?>">
		                    </a>
		                </div>
		                <div class="col-lg-10 btn-group">
		                    <h1><a href="<?=Url::to(['posts/view','id'=>$post['id']])?>"><?=$post['title']?></a></h1>
		                    <span class="post-tags">
		                        <span class="glyphicon glyphicon-user"></span><a href="<?=Url::to(['member/index','id'=>$post['user_id']])?>"><?=$post['user_name']?></a>&nbsp;
		                        <span class="glyphicon glyphicon-time"></span><?=date('Y-m-d',$post['created_at'])?>&nbsp;
		                        <span class="glyphicon glyphicon-eye-open"></span><?=isset($post['extends']['browser'])?$post['extends']['browser']:0?>&nbsp;
		                        <span class="glyphicon glyphicon-comment"></span><a href="<?=Url::to(['posts/view','id'=>$post['id']])?>"><?=isset($post['extend']['comment'])?$post['extend']['comment']:0?></a>
		                    </span>
		                    <p class="post-content"><?=$post['summary']?></p>
		                    <?php if($post['is_valid']){?>
    							<button class="btn no-radsius btn-success btn-sm pull-right-mine" disabled="disabled">审 核 通 过√</button>
							<?php }else{?>
							    <button class="btn no-radius btn-default btn-sm pull-right-mine" disabled="disabled">审 核 中..</button>
							<?php }?>
		                </div>
		            </div>
		            <div class="tags">
		                <?php if(!empty($post['tags'])):?>
		                <span class="fa fa-tags"></span>
		                    <?php foreach ($post['tags'] as $lt):?>
		                    <a href="#"><?=$lt?></a>，
		                    <?php endforeach;?>
		                <?php endif;?>
		            </div>
		        </div>      
		    </div>
		</div>
	</div>
</div>

