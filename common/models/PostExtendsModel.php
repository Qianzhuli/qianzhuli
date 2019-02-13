<?php

namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property int $id 自增ID
 * @property int $post_id 文章id
 * @property int $browser 浏览量
 * @property int $collect 收藏量
 * @property int $praise 点赞
 * @property int $comment 评论
 */
class PostExtendsModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
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
            'browser' => Yii::t('app', 'Browser'),
            'collect' => Yii::t('app', 'Collect'),
            'praise' => Yii::t('app', 'Praise'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    /**
     * 更新文章统计,每次阅读+1
     */
    public function upCounter($cond, $attibute, $num)
    {
        $counter = $this->findOne($cond);
        //var_dump($counter);exit;
        if (!$counter) {
            $this->setAttributes($cond);
            $this->$attibute = $num;
            $this->save();
            //return $this->browser;
        }else{
            $countDate[$attibute] = $num;
            $counter->updateCounters($countDate);
        }
    }
}
