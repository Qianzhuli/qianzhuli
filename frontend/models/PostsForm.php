<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\PostsModel;
use yii\base\Object;
use common\models\RelationPostTagsModel;
use yii\db\Query;

/**
 * 文章表单模型
 */
class PostsForm extends Model
{
	public $id;
	public $title;
	public $content;
	public $label_img;
	public $cat_id;
	public $tags;

	public $_lastError = '';

	/*
	 *定义场景 创建 更新	
	 */
	const SCENARIOS_CREATE = 'create';
	const SCENARIOS_UPDATE = 'update';

	/*
	 *定义事件
	 */
	const EVENT_AFTER_CREATE = 'eventAfterCreate';
	const EVENT_AFTER_UPDATE = 'eventAfterUpdate';

	/*
	 *场景设置
	 *限制能更新的字段
	 */
	public function scenarios()
	{
		$scenarios = [
			self::SCENARIOS_CREATE => ['title','content','label_img','cat_id','tags'],
			self::SCENARIOS_UPDATE => ['title','content','label_img','cat_id','tags'],
		];
		return array_merge(parent::scenarios(),$scenarios);
	}

	public function rules()
	{
		return [
			[['id','title','content','cat_id'], 'required'],
			[['id','cat_id'], 'integer'],
			['title','string','min'=>4,'max'=>24],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('common','Id'),
			'title' => Yii::t('common','Title'),
			'content' => Yii::t('common','Content'),
			'label_img' => Yii::t('common','Label_img'),
			'cat_id' => Yii::t('common','Cat_id'),
			'tags' => Yii::t('common','Tags'),
		];
	}

	/*
	 *资讯创建
	 */
	public function create()
	{
		//事务
		$transaction = Yii::$app->db->beginTransaction();
		try{
			$model = new PostsModel();
			$model->setAttributes($this->attributes);
			$model->summary = $this->_getSummary();
			$model->user_id = Yii::$app->user->identity->id;
			$model->user_name = Yii::$app->user->identity->username;
			//默认刚创建的资讯是未审核的，需要在管理后台审核
			$model->is_valid = PostsModel::NO_VALID;
			$model->created_at = time();
			$model->updated_at = time();

            //$model->label_img = $uploadSuccessPath;
            //print_r($model->label_img);exit;

			if(!$model->save()){
				throw new \Exception("文章保存失败！");
			}
			$this->id = $model->id;

			//调用事件
			$data = array_merge($this->getAttributes(),$model->getAttributes());
			//var_dump($data);exit;
			$this->_eventAfterCreate($data);

			$transaction->commit();
			return true;
		}catch(\Exception $e){
			$transaction->rollBack();
			$this->_lastError = $e->getMessage();
			return false;
		}
	}

	private function _getSummary($s = 0,$e = 50,$char = 'utf-8'){
		if(empty($this->content)){
			return null;
		}
		return (mb_substr(str_replace('&nbsp;', '', strip_tags($this->content)),$s, $e, $char).'...');
	}

	/*
	 *创建完成后调用事件方法
	 *添加标签等
	 */
	public function _eventAfterCreate($data){
		//添加事件1
		$this->on(self::EVENT_AFTER_CREATE,[$this,'_eventAddTag'],$data);
		//触发事件
		$this->trigger(self::EVENT_AFTER_CREATE);
		//添加事件2
		//$this->on(self::EVENT_AFTER_CREATE,[$this,'_eventAddTag'],$data);
	}

	/*
	 *添加标签
	 */
	public function _eventAddTag($event){
		$tag = new TagsForm();
		//var_dump($event);exit;
		$tag->tags = explode(',', $event->data['tags']);
		//var_dump($tag->tags);exit;
		$tagIds = $tag->saveTags();
		//var_dump($tagIds);exit;

		//删除原先的关联关系
		RelationPostTagsModel::deleteAll(['post_id' => $event->data['id']]);

		//批量保存文章标签的关联关系
		if(!empty($tagIds)){
			foreach ($tagIds as $k => $id) {
				$row[$k]['post_id'] = $this->id;
				$row[$k]['tag_id'] = $id;

				$res = (new Query())->createCommand()->batchInsert(RelationPostTagsModel::tableName(),['post_id','tag_id'],$row)->execute();
				if(!$res){
					throw new \Exception("关联关系保存失败");
				}
			}
		}
	}

	/*
     *获取资讯ById
     */
    public function getPostById($id)
    {
        $post = PostsModel::find()->with('relate.tag')->where(['id'=>$id])->asArray()->one();
       	//print_r($post);exit;
       	if(!$post){
       		throw new \Exception("文章不存在", 1);
       	}
        //处理标签格式
        $post['tags'] = [];
        if(isset($post['relate']) && !empty($post['relate'])){
        	foreach ($post['relate'] as $list) {
        		//print_r($list);exit;
        		$post['tags'][] = $list['tag']['tag_name']; 
        	}
        }
        unset($post['relate']);
        //print_r($post);exit;
        return $post;
    }

    /*
     *获取资讯ByUserId
     */
    public function getPostsByUserId($userId)
    {
        $posts = PostsModel::find()->where(['user_id'=>$userId])->asArray()->all();
       	//print_r($post);exit;
       	if(!$posts){
       		//throw new \Exception("文章不存在", 1);
       		return array();
       	}
        return $posts;
    }
}