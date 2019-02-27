<?php

use frontend\widgets\banner\BannerWidgets;
use frontend\widgets\posts\PostsWidgets;


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
                <div class="row">
                    <div class="col-lg-4">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h2>Heading</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" style="text-align: center;">
                
            </div>
        </div>

        <!-- 第二部分 -->
        <div class="row">
            <div class="col-lg-12">
                <!-- 文章列表组件 frontend/widgets/posts -->
                <?= PostsWidgets::widget() ?>
            </div>
        </div>

    </div>
</div>




