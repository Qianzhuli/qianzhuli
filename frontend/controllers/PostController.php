<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use Yii;

/**
 * 资讯页控制器
 */
class PostController extends BaseController
{
	/**
	 *文章列表页
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}	
}