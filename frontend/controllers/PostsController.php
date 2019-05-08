<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use frontend\models\PostsForm;
use common\models\PostsModel;
use common\models\CatsModel;
use frontend\models\PostCommentsForm;
use yii\web\UploadedFile;
use frontend\models\Upload;
use common\models\PostExtendsModel;
use yii\data\Pagination;
use Yii;

/**
 * 资讯页控制器
 */
class PostsController extends BaseController
{
	public $title = '';
	public $limit = 5;
	public $page = true;
	/**
	 *贷款资讯页
	 */
	public function actionLoan()
	{
		$curPage = Yii::$app->request->get('page',1);
		//查询条件
		$cond = ['is_valid' => PostsModel::IS_VALID];
		//$cond = [];
		$this->limit = 12;
		$res = PostsForm::getList($cond,$curPage,$this->limit);
		return $this->render('loan',['data' => $res['data']]);
	}
	/**
	 *理财资讯页
	 */
	public function actionFinancial()
	{
		$curPage = Yii::$app->request->get('page',1);
		//查询条件
		$cond = ['is_valid' => PostsModel::IS_VALID];
		//$cond = [];
		$this->limit = 12;
		$res = PostsForm::getList($cond,$curPage,$this->limit);
		return $this->render('financial',['data' => $res['data']]);
	}
	/**
	 *信用卡资讯页
	 */
	public function actionCredit()
	{
		$curPage = Yii::$app->request->get('page',1);
		//查询条件
		$cond = ['is_valid' => PostsModel::IS_VALID];
		//$cond = [];
		$this->limit = 12;
		$res = PostsForm::getList($cond,$curPage,$this->limit);
		return $this->render('credit',['data' => $res['data']]);
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
			//var_dump(Yii::$app->request->post());exit;
			if(!$model->create()){
				Yii::$app->session->setFlash('warning',$model->_lastError);
			}else{
				return $this->redirect(['posts/upload','id'=>$model->id]);
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
		//var_dump($post);exit;
		return $this->render('check',['post' => $post]);
	}

	/**
	 *资讯展示
	 */
	public function actionView($id){
		$model = new PostCommentsForm();
		$PostsFormModel = new PostsForm();
		$post = $PostsFormModel->getPostById($id);
		//var_dump($post['extends']);exit;

		//文章统计
		$Extendsmodel = new PostExtendsModel();
		$Extendsmodel->upCounter(['post_id' => $id], 'browser', 1);

		//右侧热点资讯，按照浏览量排
		//获取当前页，默认是1
		$curPage = Yii::$app->request->get('page',1);
		//查询条件
		$cond = ['is_valid' => PostsModel::IS_VALID];
		//$cond = [];
		$this->limit = 12;
		$res = PostsForm::getList($cond,$curPage,$this->limit);
		//var_dump($res['data']);exit;

		$comments = $model->getComments($id);

		//先看有没有提交评论
		if($model->load(Yii::$app->request->post())){
			//用Yii::$app->request->post()获取表单传的数据,不加参数的话是个数组
			//var_dump(Yii::$app->request->post()['PostCommentsForm']['content']);exit;
			$SubmitComment = Yii::$app->request->post()['PostCommentsForm']['content'];
			if (!empty($SubmitComment)) {
				if (!empty(Yii::$app->user->identity->username)) {
					$user = Yii::$app->user->identity->username;
				}else {
					$user = '游客';
				}
				if($model->saveComment($SubmitComment,$id,$user)){
					//跳回本頁面
					//评论数+1
					$Extendsmodel->upCounter(['post_id' => $id], 'comment', 1);
					//重新获取新的评论
					$comments = $model->getComments($id);
					//刷新model
					$model = new PostCommentsForm();
					return $this->render('view',['post' => $post, 'data' => $res['data'], 'model' => $model, 'comments' => $comments]);
				}else{
					//報錯
					echo '保存评论失败';
				}
				//刷新model
				$model = new PostCommentsForm();
				return $this->render('view',['post' => $post, 'data' => $res['data'], 'model' => $model, 'comments' => $comments]);
			}
		}

		return $this->render('view',['post' => $post, 'data' => $res['data'], 'model' => $model, 'comments' => $comments]);
	}

	/**
	 *我的资讯页
	 */
	public function actionMine(){
		//获取当前页，默认是1
		$curPage = Yii::$app->request->get('page',1);
		//查询条件
		$cond = ['user_id' => Yii::$app->user->identity->id];
		$res = PostsForm::getList($cond,$curPage,$this->limit);

		$result['title'] = $this->title?:"我的资讯";
		$result['body'] = $res['data']?:[];
		//是否显示分页
		if($this->page){
			$pages = new Pagination(['totalCount'=>$res['count'], 'pageSize'=>$res['pageSize']]);
			$result['page'] = $pages;
		}
		//var_dump($result);exit;
		return $this->render('mine',['data' => $result]);
	}


	public function actionUpload($id){
		
		$model = new Upload();
		//var_dump($model);exit;
		$postsModel = new PostsModel();
        $post = $postsModel->find()->where(['id'=>$id])->one();
        $title = $post->title;
        $uploadSuccessPath = "";
        
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, "file");
            //文件上传存放的目录
            $dir = "../web/yii2-widget-fileinput/".date("Ymd");
            if (!is_dir($dir))
                mkdir($dir);
            if ($model->validate()) {
                //文件名
                $fileName = date("HiiHsHis") . rand(0,100) . "." . $model->file->extension;
                $dir = $dir."/". $fileName;
                $model->file->saveAs($dir);
                $uploadSuccessPath = '/yii2-widget-fileinput/'.date("Ymd")."/".$fileName;
            }
        	$post->label_img = $uploadSuccessPath;
        	if (!$post->save()) {
        		throw new \Exception("预览图保存失败,请联系管理员", 1);
        		
        	}
        	return $this->redirect(['posts/check','id'=>$id]);
        }    

        return $this->render("upload", [
            "model" => $model,
            "uploadSuccessPath" => $uploadSuccessPath,
            "title" => $title,
        ]);
	}
}