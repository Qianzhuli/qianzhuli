<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\TagsModel;

/**
 * 标签的表单模型
 */
class TagsForm extends Model
{
	public $id;

	public $tags;

	public function rules()
	{
		return [
			['tags', 'required'],
			['tags', 'each', 'rule'=>['string']],
		];
	}

	/*
	 *保存标签方法
	 */
	public function saveTags()
	{
		$ids = [];
		if(!empty($this->tags)){
			//var_dump($this->tags);exit;
			foreach ($this->tags as $tag) {
				$ids[] = $this->_saveTag($tag);
			}
		}

		return $ids;
	}


	/*
	 *保存单个的标签
	 */
	private function _saveTag($tag){
		$model = new TagsModel();
		$res = $model->find()->where(['tag_name' => $tag])->one();

		//新建标签
		if(!$res){
			$model->tag_name = $tag;
			$model->post_num = 1;
			if (!$model->save()) {
				throw new \Exception("保存标签失败");
			}

			return $model->id;
		}else{
			//每次累加1
			$res->updateCounters(['post_num' => 1]);
		}

		return $res->id;
	}
}