<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = Yii::$app->user->identity->username . '的资讯';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-lg-9">
		<div class="panel">
		    <div class="panel-title box-title">
		        <span><?=$data['title']?></span>
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
		                    <?php if($list['is_valid']){?>
    							<button class="btn no-radius btn-success btn-sm pull-right-mine" disabled="disabled">审 核 通 过√</button>
							<?php }else{?>
							    <button class="btn no-radius btn-default btn-sm pull-right-mine" disabled="disabled">审 核 中..</button>
							<?php }?>
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
	<div class="col-lg-3">
		<div class="panel-title box-title">
			<span><?= Yii::t('common','Matters Need Attention') ?></span>
		</div>
		<div class="panel-body">
			<p>1. 已审核通过的资讯将展示在资讯页</p>
			<p>2. 已审核通过的资讯不可修改</p>
			<p>3. 审核中的资讯如修改，将重新审核</p>
			<p>4. 最终解释权归本网站所有</p>
		</div>
	</div>
</div>

