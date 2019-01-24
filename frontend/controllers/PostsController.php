<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use frontend\models\PostsForm;
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
		return $this->render('create',['model' => $model]);
	}
}