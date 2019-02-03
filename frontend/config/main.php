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
    'controllerMap' => [
        'ueditor' => [
            'class' => 'crazydb\ueditor\UEditorController',
            'thumbnail' => false,//如果将'thumbnail'设置为空，将不生成缩略图。
            'watermark' => [    //默认不生存水印
                'path' => '', //水印图片路径
                'position' => 9 //position in [1, 9]，表示从左上到右下的 9 个位置，即如1表示左上，5表示中间，9表示右下。
            ],
            'zoom' => ['height' => 500, 'width' => 500], //缩放，默认不缩放
            'config' => [
                //server config @see http://fex-team.github.io/ueditor/#server-config
                'imagePathFormat' => '/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'scrawlPathFormat' => '/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'snapscreenPathFormat' => '/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'catcherPathFormat' => '/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                'videoPathFormat' => '/upload/video/{yyyy}{mm}{dd}/{time}{rand:6}',
                'filePathFormat' => '/upload/file/{yyyy}{mm}{dd}/{rand:4}_{filename}',
                'imageManagerListPath' => '/upload/image/',
                'fileManagerListPath' => '/upload/file/',
            ]
        ]
    ],
];
