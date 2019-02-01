<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    //开启中文显示
    'language' => 'zh-CN',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\UserModel',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //url后缀
            //'suffix' => '.html',
        ],

        //语言包配置
        'i18n' => [
                'translations' => [
                        '*' => [
                                'class' => 'yii\i18n\PhpMessageSource',
                                //'basePath' => '/messages',
                                'fileMap' => [
                                        'common' => 'common.php',
                                ]
                        ]
                ],
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    // 'categories' => ['qianzhuli'], //自定义日志分类
                    // 'maxFileSize' => 1024 *20,  //设置文件大小，以k为单位
                    // 'logFile' => '@runtime/../logs/qianzhuli'.date('Ymd'), //自定义文件路径
                    // 'logVars' => ['_POST'],  //捕获请求参数
                    // 'fileMode' => 0775, //设置日志文件权限
                    // 'maxLogFiles' => 100,  //同个文件名最大数量
                    // 'rotateByCopy' => false, //是否以复制的方式rotate
                    // 'prefix' => function() {   //日志格式自定义 回调方法
                    //     if (Yii::$app === null) {
                    //         return '';
                    //     }
                    //     $request = Yii::$app->getRequest();
                    //     $ip = $request instanceof Request ? $request->getUserIP() : '-';
                    //     $controller = Yii::$app->controller->id;
                    //     $action = Yii::$app->controller->action->id;
                    //     return "[$ip][$controller-$action]";
                    // }
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
