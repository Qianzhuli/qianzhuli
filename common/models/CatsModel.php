<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;

/**
 * This is the model class for table "cats".
 *
 * @property int $id 自增ID
 * @property string $cat_name 分类名称
 */
class CatsModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cat_name' => Yii::t('app', 'Cat Name'),
        ];
    }

    public static function getAllCats()
    {
        $cats = ['0' => '暂无分类'];
        $res = self::find()->asArray()->all();
        //var_dump($res);exit;
        if($res){
            foreach($res as $k => $list){
                $cats[$list['id']] = $list['cat_name'];
            }
        }
        //var_dump($cats);exit;
        return $cats;
    }
}
