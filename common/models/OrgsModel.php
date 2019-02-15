<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orgs".
 *
 * @property int $id 自增ID
 * @property string $org_name 平台名称
 * @property string $content 平台介绍
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class OrgsModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orgs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['org_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'org_name' => Yii::t('app', 'Org Name'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
