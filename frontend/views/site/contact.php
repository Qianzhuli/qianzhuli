<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('common','PayForUs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="row">
        <div class="col-lg-9">
            <h1 style="text-align: center;"><?= Html::encode($this->title) ?>：)</h1>

            <p>
                <?= Yii::t('common','Money assistant net loan rating website has been free, and will continue to be free, until the rating website does not exist so far.There is no plan to charge for the service at present. If you think this website is useful to you, please sponsor us. We promise that the sponsorship we receive will only be used for the purchase of servers and daily maintenance. Thank you.'); ?>
            </p>

            <?= '<img src="' . Yii::$app->params['webImages']['PayImg'] . '" class="site-contact-PayImg">'; ?>

            <p style="text-align: center;">
                <?= Yii::t('common','The sponsorship fee is 50 yuan and above, we will show your name, personal website and so on to the list of individual sponsors.'); ?>
            </p>
        </div>
        <div class="col-lg-3">
            <div class="panel-title box-title">
                <h4 style="text-align: center;"><?= Yii::t('common','List of sponsors') ?></h4>
            </div>
            <!-- 赞助者列表 -->
            <div class="panel-body">
                <p style="text-align: center;">田迪亚&nbsp;&nbsp;&nbsp;<a href="#">985901085@qq.com</a></p>
            </div>
        </div>
    </div>

</div>
