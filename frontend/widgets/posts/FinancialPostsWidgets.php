<?php

namespace frontend\widgets\posts;

use common\models\PostsModel;
use frontend\models\PostsForm;
use yii\base\Widget;
use yii\helpers\Url;
use yii\base\Object;
use yii\data\Pagination;
use Yii;

/**
 * 资讯列表组件
 */
class FinancialPostsWidgets extends Widget
{	
	//资讯标题
	public $title = '';
	//显示条数
	public $limit = 5;
	//显示更多
	public $more = true;
	//分页
	public $page = true;

	public function run()
	{
		//获取当前页，默认是1
		$curPage = Yii::$app->request->get('page',1);
		//查询条件
		$cond = ['is_valid'=>PostsModel::IS_VALID, 'cat_id' => 6];
		$res = PostsForm::getList($cond,$curPage,$this->limit);

		$result['title'] = $this->title?:"理财资讯";
		$result['more'] = Url::to(['posts/financial']);
		$result['body'] = $res['data']?:[];
		//是否显示分页
		if($this->page){
			$pages = new Pagination(['totalCount'=>$res['count'], 'pageSize'=>$res['pageSize']]);
			$result['page'] = $pages;
		}
		//var_dump($result);exit;
		return $this->render('index',['data' => $result]);
	}
}