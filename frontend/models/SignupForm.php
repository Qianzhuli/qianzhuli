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
    public $rePassword;
    public $verifyCode;

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
            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u','message'=>Yii::t('common','Username is composed of letters, Chinese characters, Numbers and underscores, and cannot begin with Numbers and underscores.')],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 32],
            ['email', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common','This email address has already been taken.')],

            [['password','rePassword'], 'required'],
            [['password','rePassword'], 'string', 'min' => 4, 'max' => 32],
            ['rePassword','compare','compareAttribute'=>'password','message'=>Yii::t('common','Two times the password is not consitent.')],

            ['verifyCode','captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common','Username'),
            'email' => Yii::t('common','Email'),
            'password' => Yii::t('common','Password'),
            'rePassword' => Yii::t('common','RePassword'),
            'verifyCode' => Yii::t('common','VerifyCode'),
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
