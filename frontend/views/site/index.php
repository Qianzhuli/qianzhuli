<?php

use frontend\widgets\banner\BannerWidgets;
use frontend\widgets\posts\PostsWidgets;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = Yii::t('common','Qianzhuli-a trusted loan rating website');
?>

<div class="site-index">

    <div>
        <?= '<img src="' . Yii::$app->params['webImages']['SiteTitle1'] . '" class="site-index-jumbotron-img">'; ?>
    </div>

    <div class="body-content">
        <!-- 第一部分 -->
        <div class="row">
            <div class="col-lg-9">
                <!-- 图片轮播组件 frontend/widgets/bannner -->
                <?= BannerWidgets::widget() ?>
            </div>
            <div class="col-lg-3" style="text-align: center;">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#news" data-toggle="tab">&nbsp;&nbsp;&nbsp;热点&nbsp;&nbsp;&nbsp;</a></li>
                    <li><a href="#posts" data-toggle="tab">&nbsp;&nbsp;&nbsp;原创&nbsp;&nbsp;&nbsp;</a></li>
                    <li><a href="#platform" data-toggle="tab">&nbsp;&nbsp;&nbsp;报告&nbsp;&nbsp;&nbsp;</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="news" style="text-align: left; padding: 10px;">
                        <?php if(!empty($data['data1'])){ ?>
                            <?php foreach ($data['data1'] as $p) { ?>
                                <p><i class="fa fa-hacker-news" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a href="<?=Url::to(['posts/view','id'=>$p['id']])?>"><?= $p['title']?></a></p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="posts" style="text-align: left; padding: 10px;">
                        <?php if(!empty($data['data2'])){ ?>
                            <?php foreach ($data['data2'] as $p) { ?>
                                <p><i class="fa fa-hacker-news" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a href="<?=Url::to(['posts/view','id'=>$p['id']])?>"><?= $p['title']?></a></p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="platform" style="text-align: left; padding: 10px;">
                        <?php if(!empty($data['data3'])){ ?>
                            <?php foreach ($data['data3'] as $p) { ?>
                                <p><i class="fa fa-hacker-news" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a href="<?=Url::to(['posts/view','id'=>$p['id']])?>"><?= $p['title']?></a></p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 第二部分 -->
        <div class="row">
                    <div class="col-lg-3">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                    </div>
                    <div class="col-lg-3">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                    </div>
                    <div class="col-lg-3">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                    </div>
                    <div class="col-lg-3">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                    </div>
        </div>
    </div>
</div>




