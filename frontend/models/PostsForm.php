<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

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

	public function rules()
	{
		return [
			[['id','title','content','cat_id'], 'required'],
			[['id','cat_id'], 'integer'],
			['title','string','min'=>4,'max'=>50],
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
}