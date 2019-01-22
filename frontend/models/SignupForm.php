<?php
namespace frontend\models;

use common\models\UserModel;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common','This username has already been taken.')],
            ['username', 'string', 'min' => 4, 'max' => 32],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 32],
            ['email', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common','This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 4, 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common','Username'),
            'email' => Yii::t('common','Email'),
            'password' => Yii::t('common','Password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new UserModel();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
