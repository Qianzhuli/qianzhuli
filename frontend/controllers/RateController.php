<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use Yii;

/**
 * 评级页控制器
 */
class RateController extends BaseController
{
	/**
	 *
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}	
}