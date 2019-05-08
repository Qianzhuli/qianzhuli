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
        <div class="row" style="padding-top: -5px; border-bottom: 1px solid blue;">
            <div class="col-lg-12" >
                <div style="float: left;"><h3>热门平台</h3></div>
                <div style="float: right; margin-top: 20px; font-size: 16px; color: gray;">本网贷评级结果仅供参考，不构成投资建议,投资需谨慎！&nbsp;</div>
            </div>
        </div>
        <div class="row" style="border-bottom: 1px solid blue; padding-bottom: 2px;">
                    <div class="col-lg-2 animated_div">
                        <?= '<a href= "https://www.renrendai.com/ppb/cv1/page/5c92146469224a2fad10d989.html?utm_source=pc_pz_sogou&utm_medium=98727&utm_campaign=831733554&utm_content=20110572&utm_term=49_150589817057211"><img src="' . Yii::$app->params['webImages']['Renrendai'] . '"></a>'?>
                    </div>
                    <div class="col-lg-2 animated_div">
                        <?= '<a href= "https://www.myerong.com/phone/landPage.html?from=sogou&sourceid=H5LC-84&activiteid=yhcgb"><img src="' . Yii::$app->params['webImages']['Yinduowang'] . '"></a>'?>
                    </div>
                    <div class="col-lg-2 animated_div">
                        <?= '<a href= "https://www.hexindai.com/"><img src="' . Yii::$app->params['webImages']['Hexindai'] . '"></a>'?>
                    </div>
                    <div class="col-lg-2 animated_div">
                        <?= '<a href= "https://licai.wealth365.com.cn/breezenew/landPage/backflowFour.html?ch=1060182997"><img src="' . Yii::$app->params['webImages']['Zhangzhongjinrong'] . '"></a>'?>
                    </div>
                    <div class="col-lg-2 animated_div">
                        <?= '<a href= "http://www.maizijf.com/"><img src="' . Yii::$app->params['webImages']['Maizijinfu'] . '"></a>'?>
                    </div>
                    <div class="col-lg-2 animated_div">
                        <?= '<a href= "https://www.51tuodao.com/#tyshouye4"><img src="' . Yii::$app->params['webImages']['Tuodaojinfu'] . '"></a>'?>
                    </div>
        </div>
    </div>
</div>




