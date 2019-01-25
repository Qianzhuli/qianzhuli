<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use common\widgets\file_upload\FileUpload;
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
}