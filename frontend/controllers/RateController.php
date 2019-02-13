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
		//调用go接口去获取评级数据
		$url = '127.0.0.1:9090';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		if (curl_errno($ch)) {
			$response = $this->getRateByPHP();
		}

		curl_close($ch);
		//var_dump($response);exit;

		//处理抓回来的数据
		//去掉里面不可显示的数据
		$res = str_replace('(MISSING)','',$response);

		return $this->render('index',['data' => $res]);
	}	

	public function getRateByPHP(){
		$url = 'http://www.rong360.com/licai/netloan/ajaxnetloanrating';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		if (curl_errno($ch)) {
			print curl_error($ch);
		}
		curl_close($ch);

		return $response;
	}
}