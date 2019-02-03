<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use frontend\models\PostsForm;
use common\models\PostsModel;
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
	 *创建资讯
	 */
	public function actionCreate()
	{
		$model = new PostsForm();
		//定义场景
		$model->setScenario(PostsForm::SCENARIOS_CREATE);
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			//用Yii::$app->request->post()获取表单传的数据,不加参数的话是个数组
			//var_dump(Yii::$app->request->post()['PostsForm']['title']);exit;
			if(!$model->create()){
				Yii::$app->session->setFlash('warning',$model->_lastError);
			}else{
				return $this->redirect(['posts/check','id'=>$model->id]);
			}
		}
		$cats = CatsModel::getAllCats();
		return $this->render('create',['model' => $model, 'cats' => $cats]);
	}

	/**
	 *资讯审核
	 */
	public function actionCheck($id)
	{
		if (empty($id)) {
			throw new \Exception("文章不存在", 1);
		}

		//去数据库取资讯名，展示在前端
		$model = new PostsForm();
		$post = $model->getPostById(Yii::$app->request->get()['id']);
		$title = $post['title'];
		return $this->render('check',['post' => $post]);
	}

	/**
	 *资讯展示
	 */
	public function actionView($id){
		$model = new PostsForm();
		$post = $model->getPostById($id);

		return $this->render('view',['post' => $post]);
	}

	/**
	 *我的资讯页
	 */
	public function actionMine(){
		$model = new PostsForm();
		$userId = Yii::$app->user->identity->id;
		$posts = $model->getPostsByUserId($userId);

		return $this->render('mine',['posts' => $posts]);
	}

}