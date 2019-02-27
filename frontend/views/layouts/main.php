<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="' . Yii::$app->params['layout']['logo'] . '" class="layout-logo">',
        //'brandLabel' => '<i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;' . Yii::t('common','Qianzhuli'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    if (Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => Yii::t('yii','Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('common','Rating'), 'url' => ['/rate/index']],
            ['label' => Yii::t('common','Information'), 'url' => ['/posts/index']],
            ['label' => Yii::t('common','PayForUs'), 'url' => ['/site/contact']],
        ];
        $menuItems[] = ['label' => Yii::t('common','Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('common','Login'), 'url' => ['/site/login']];
    } else {
        $menuItems = [
            ['label' => Yii::t('yii','Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('common','Rating'), 'url' => ['/rate/index']],
            ['label' => Yii::t('common','Information'), 'url' => ['/posts/index']],
            ['label' => Yii::t('common','CreateInformation'), 'url' => ['/posts/create']],
            ['label' => Yii::t('common','PayForUs'), 'url' => ['/site/contact']],
        ];
        $menuItems[] = [
            'label' => '<img src = "' . Yii::$app->params['portrait']['small'] . '" alt ="'. Yii::$app->user->identity->username . '">&nbsp;&nbsp;' . Yii::$app->user->identity->username,
            'linkOptions' => ['class' => 'portrait'],
            'items' => [
                [
                    'label' => '<i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;' . Yii::t('common','Personal center'),
                    'url' => ['/user/index'],
                ],
                [
                    'label' => '<i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;' . Yii::t('common','My Information'),
                    'url' => ['/posts/mine'],
                ],
                [
                    'label' => '<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;' . Yii::t('common','Logout'),
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        //代码过滤，不加下面这行的话会在前端显示头像的这个<img>标签代码
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
