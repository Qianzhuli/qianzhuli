<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use common\models\OrgsCacheModel;
use common\models\OrgsModel;
use frontend\models\PostsForm;
use common\models\PostsModel;
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
		//先读redis缓存
		$cache = Yii::$app->cache;
		$date = date('Ymd');

		//钱助理
		$key1 = 'RateQianzhuli' . $date;
		if ($cache->exists($key1)) {
			$res1 = $cache->get($key1);
		}else{
			$date = 20190304;
			$res1 = OrgsCacheModel::find()->where(['date' => $date, 'from' => 1])->one();
			$cache->set($key1,$res1,86400);
		}
		//判断是否取到，未取到再去爬
		if (!empty($res1)) {
			$resArray1 = unserialize($res1['data']);
		}else {
			//去爬代码并存库
		}

		//融360
		$key2 = 'RateRong360' . $date;
		if ($cache->exists($key2)) {
			$res2 = $cache->get($key2);
		}else{
			$date = 20190304;
			$res2 = OrgsCacheModel::find()->where(['date' => $date, 'from' => 2])->one();
			$cache->set($key2,$res2,86400);
		}
		//判断是否取到，未取到再去爬
		if (!empty($res2)) {
			$resArray2 = unserialize($res2['data']);
		}else {
			//去爬代码并存库
		}

		//网贷天眼
		$key3 = 'RateWangdaitianyan' . $date;
		if ($cache->exists($key3)) {
			$res3 = $cache->get($key3);
		}else{
			$date = 20190304;
			$res3 = OrgsCacheModel::find()->where(['date' => $date, 'from' => 3])->one();
			$cache->set($key3,$res3,86400);
		}
		//判断是否取到，未取到再去爬
		if (!empty($res3)) {
			$resArray3 = unserialize($res3['data']);
		}else {
			//去爬代码并存库
		}

		//网贷之家
		$key4 = 'RateQianzhuli' . $date;
		if ($cache->exists($key4)) {
			$res4 = $cache->get($key4);
		}else{
			$date = 20190304;
			$res4 = OrgsCacheModel::find()->where(['date' => $date, 'from' => 4])->one();
			$cache->set($key4,$res4,86400);
		}
		//判断是否取到，未取到再去爬
		if (!empty($res4)) {
			$resArray4 = unserialize($res4['data']);
		}else {
			//去爬代码并存库
		}
		
		return $this->render('index',['data1' => $resArray1, 'data2' => $resArray2, 'data3' => $resArray3, 'data4' => $resArray4]);
	}	

	/**
	 * 平台详情页
	 */
	public function actionView($org_name)
	{
		$data = OrgsModel::find()->where(['org_name' => $org_name])->asArray()->one();
		if ($data['content']) {
			return $this->redirect($data['content']);
		}else {
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
		$res = OrgsModel::find()->where(['org_name' => 'RateUrl'])->asArray()->one();
		$url = $res['content'];
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