<?php
namespace frontend\widgets\banner;

use Yii;
use yii\base\Widget;
/**
 * 
 */
class BannerWidgets extends Widget
{
	
	public $items = [];

	public function init()
	{
		if (empty($this->items)) {
			$this->items = [
				['label' => 'demo1', 'image_url' => Yii::$app->params['banner']['b_0'], 'url' => ['site/index'], 'active' => 'active'],//active是默认显示
				['label' => 'demo2', 'image_url' => Yii::$app->params['banner']['b_1'], 'url' => ['site/index']],
				['label' => 'demo3', 'image_url' => Yii::$app->params['banner']['b_2'], 'url' => ['site/index']],
			];
		}
	}

	public function run()
	{
		$data['items'] = $this->items;
		return $this->render('index',['data' => $data]);
	}
}