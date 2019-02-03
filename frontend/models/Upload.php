<?php
namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * 图片上传组件
 */
class Upload extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [["file"], "file", 'maxSize'=>1024*2000,'minSize'=>1024*10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => Yii::t('common','Preview'),
        ];
    }
}