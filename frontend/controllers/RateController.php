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
		//先读缓存，未命中再爬虫
		//调用go接口去获取评级数据
		$url = '127.0.0.1:9090';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		if (curl_errno($ch)) {
			//如果go没有抓成功，换php
			$response = $this->_getRateByPHP();
		}

		curl_close($ch);
		//var_dump($response);exit;

		//处理抓回来的数据
		$resArray = $this->_formateRateRes($response);
		//var_dump($resArray);exit;
		
		return $this->render('index',['data' => $resArray]);
	}	

	private function _getRateByPHP(){
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

	private function _formateRateRes($response){
		//去掉字符串中(MISSING)、&nbsp;等字样
		$res = str_replace('(MISSING)','',$response);
		$res = str_replace(array("&nbsp;","&amp;nbsp;","\t","\r\n","\r","\n"),array("","","","","",""),$res);
		//php内置函数去掉html、xml、php标签，并去除开始和结束的空白
		$res = trim(strip_tags($res));
		//将多个空白变成一个空白
		$res = preg_replace('/\s(?=\s)/', '', $res); 
		//最后，去掉非space 的空白，用一个空格代替 
		$res = preg_replace('/[\n\r\t]/', ' ', $res); 
		//将字符串拆分成数组，每9个为一组,舍弃最后一个‘了解详情’
		$res = explode(' ', $res);
		foreach ($res as $key => $value) {
			$count = floor($key/8);
			if ($key == 0) {
				$resArray[0]['org_name'] = $value;
				continue;
			}
			switch ($key%8) {
				case 0:
					$resArray[$count]['org_name'] = $value;
					break;
				case 1:
					$resArray[$count]['rate'] = $value;
					break;
				case 2:
					$resArray[$count]['average_income'] = $value;
					break;
				case 3:
					$resArray[$count]['build_time'] = $value;
					break;
				case 4:
					$resArray[$count]['backgroud'] = $value;
					break;
				case 5:
					$resArray[$count]['hot'] = $value;
					break;
				case 6:
					$resArray[$count]['high_praise_rate'] = $value;
					break;
				case 7:
					break;
				default:
					break;
			}
		}
		return $resArray;
	}
}