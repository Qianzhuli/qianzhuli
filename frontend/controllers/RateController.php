<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use common\models\OrgsCacheModel;
use common\models\OrgsModel;
use Yii;

/**
 * 评级页控制器
 */
class RateController extends BaseController
{
	/**
	 * 评级index页
	 */
	public function actionIndex()
	{	
		//先读数据库缓存，未命中再爬虫
		$date = date('Ymd');
		$res = OrgsCacheModel::find()->where(['date' => $date])->one();
		if (!empty($res)) {
			$resArray = unserialize($res['data']);
		}else {
			//调用go接口去获取评级数据,php后备
			$response = $this->_getRateByGolang();
			//处理抓回来的数据
			$resArray = $this->_formateRateRes($response);
			//将处理好的数据序列化后存库
			$model = new OrgsCacheModel();
			$model->date = $date;
			$model->data = serialize($resArray);
			$model->save();
		}
		return $this->render('index',['data' => $resArray]);
	}	

	/**
	 * 平台详情页
	 */
	public function actionView($org_name)
	{
		$data = OrgsModel::find()->where(['org_name' => $org_name])->asArray()->one();
		if (!$data) {
			$data['org_name'] = $org_name;
			$data['error'] = '信息采集中...';
		}
		return $this->render('view', ['data' => $data]);
	}

	/**
	 * golang获取评级信息
	 */
	private function _getRateByGolang()
	{
		$url = '127.0.0.1:9090/getRateList';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec($ch);
		//var_dump($response);exit;
		$info = curl_getinfo($ch);
		if (curl_errno($ch)) {
			//如果go没有抓成功，换php
			$response = $this->_getRateByPHP();
			//var_dump($response);exit;
		}

		curl_close($ch);
		//var_dump($response);exit;

		return $response;
	}

	/**
	 * PHP获取评级信息
	 */
	private function _getRateByPHP()
	{
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

	/**
	 * 格式化获取的评级信息数据
	 */
	private function _formateRateRes($response)
	{
		//去掉字符串中(MISSING)、&nbsp;等字样
		$res = str_replace('(MISSING)','',$response);
		$res = str_replace(array("&nbsp;","&amp;nbsp;","\t","\r\n","\r","\n","!"),array("","","","","","",""),$res);
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
					$resArray[$count]['high_praise'] = $value;
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