<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\PostCommentsModel;

/**
 * 标签的表单模型
 */
class PostCommentsForm extends Model
{
	public $id;

	public $post_id;

	public $content;

	public $user;

	public function saveComment($comment,$post_id,$user){
		$commentsModel = new PostCommentsModel();
		$commentsModel->content = $comment;
		$commentsModel->post_id = $post_id;
		$commentsModel->user = $user;
		if ($commentsModel->save()) {
			return 1;
		}
		return 0;
	}

	public function getComments($id){
		$commentsModel = new PostCommentsModel();
		$comments = $commentsModel->find()->where(['post_id' => $id])->asArray()->all();
		return $comments;
	}

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['post_id'], 'integer'],
            [['content'], 'string'],
            [['user'], 'string', 'max' =>255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'content' => Yii::t('common', 'Comments'),
        ];
    }
}