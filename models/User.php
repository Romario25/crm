<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $password;
    public $password_repeat;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'login'], 'required'],
            ['login', 'unique', 'targetClass' => self::className(), 'message' => 'Пользователь с таким логином зарегистрирован'],
            [['name', 'login'], 'string', 'min' => 2, 'max' => 255],
            [['password', 'password_repeat'], 'string', 'min' => 6, 'max' => 128],
            ['password', 'compare'],
            
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'login' => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Повторить пароль'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    public static function create($name, $login, $password){
        $user = new self();
        $user->name = $name;
        $user->login = $login;
        $user->setPassword($password);
        $user->save();
        return $user;
    }
}
