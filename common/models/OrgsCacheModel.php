<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orgs_cache".
 *
 * @property int $id 自增ID
 * @property string $date 日期
 * @property string $data
 */
class OrgsCacheModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orgs_cache';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['data'], 'string'],
            [['date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'data' => Yii::t('app', 'Data'),
            'from' => Yii::t('app', 'From'),
        ];
    }
}
