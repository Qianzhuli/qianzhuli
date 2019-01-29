<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use frontend\models\PostsForm;
use common\models\CatsModel;
use Yii;

/**
 * 资讯页控制器
 */
class PostsController extends BaseController
{
	/**
	 *文章列表页
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 *创建文章
	 */
	public function actionCreate()
	{
		$model = new PostsForm();
		$cats = CatsModel::getAllCats();
		return $this->render('create',['model' => $model, 'cats' => $cats]);
	}


	/**
	 * 百度富文本编译器配置（这个配置用途不详）
	 */
	public function actions() {
		return [
		    'upload' => [
		        'class' => \xj\ueditor\actions\Upload::className(),
		        'uploadBasePath' => '@webroot/image', //file system path
		        'uploadBaseUrl' => '@web/image', //web path
			'csrf' => true, //csrf校验
		        'configPatch' => [
		            'imageMaxSize' => 1024 * 1024, //图片
		            'scrawlMaxSize' => 500 * 1024, //涂鸦
		            'catcherMaxSize' => 500 * 1024, //远程
		            'videoMaxSize' => 1024 * 1024, //视频
		            'fileMaxSize' => 1024 * 1024, //文件
		            'imageManagerListPath' => '/', //图片列表
		            'fileManagerListPath' => '/', //文件列表
		        ],
		        // OR Closure
		        'pathFormat' => [
		            'imagePathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
		            'scrawlPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
		            'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
		            'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
		            'catcherPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
		            'videoPathFormat' => 'video/{yyyy}{mm}{dd}/{time}{rand:6}',
		            'filePathFormat' => 'file/{yyyy}{mm}{dd}/{time}{rand:6}',
		        ],
		        
		        // For Closure
		        'pathFormat' => [
		            'imagePathFormat' => [$this, 'format'],
		            'scrawlPathFormat' => [$this, 'format'],
		            'snapscreenPathFormat' => [$this, 'format'],
		            'snapscreenPathFormat' => [$this, 'format'],
		            'catcherPathFormat' => [$this, 'format'],
		            'videoPathFormat' => [$this, 'format'],
		            'filePathFormat' => [$this, 'format'],
		        ],
		        
		        'beforeUpload' => function($action) {
		//          throw new \yii\base\Exception('error message'); //break
		        },
		        'afterUpload' => function($action) {
		            /*@var $action \xj\ueditor\actions\Upload */
		            
		            var_dump($action->result);
		            //  'state' => string 'SUCCESS' (length=7)
		            //  'url' => string '/attachment/201109/1425310269294251.jpg' (length=61)
		            //  'relativePath' => string '201109/1425310269294251.jpg' ()
		            //  'title' => string '1425310269294251.jpg' (length=20)
		            //  'original' => string 'Chrysanthemum.jpg' (length=17)
		            //  'type' => string '.jpg' (length=4)
		            //  'size' => int 879394
		            
		            throw new \yii\base\Exception('error message'); //break
		        },
		    ],
		];
	}

	// for Closure Format
	public function format(\xj\ueditor\actions\Uploader $action) {
	    $fileext = $action->fileType;
	    $filehash = sha1(uniqid() . time());
	    $p1 = substr($filehash, 0, 2);
	    $p2 = substr($filehash, 2, 2);
	    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
	}
}