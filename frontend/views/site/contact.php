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
        <div class="col-lg-8">
            <h1><?= Html::encode($this->title) ?>：)</h1>

            <p>
                <?= Yii::t('common','Money assistant net loan rating website has been free, and will continue to be free, until the rating website does not exist so far.There is no plan to charge for the service at present. If you think this website is useful to you, please sponsor us.'); ?>
            </p>

            <?= '<img src="' . Yii::$app->params['webImages']['PayImg'] . '" class="site-contact-PayImg">'; ?>

            <p style="text-align: center;">
                <?= Yii::t('common','The sponsorship fee is 50 yuan and above, we will show your name, personal website and so on to the list of individual sponsors.'); ?>
            </p>
        </div>
        <div class="col-lg-4">
            <h1 style="text-align: center;">赞助者列表</h1>
        </div>
    </div>

</div>
