<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password 用户密码
 * @property string $salt 加盐
 * @property string $email 邮箱
 * @property string $token 自动登录令牌
 * @property int $token_create_time 令牌创建时间
 * @property int $add_time 注册时间
 * @property int $last_login_time 最后登录时间
 * @property int $last_login_ip 最后登录ip
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $rememberMe=true;
    public function scenarios()
    {
        $parent=parent::scenarios();
        return array_merge($parent,[
            'create' => ['username', 'password', 'email','img'],
            'login' => ['username', 'password', 'email','img'],
            'update' => ['username', 'password', 'email','img'],
        ]);
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['add_time'],
                ]
            ]
        ];
    }

    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            设置添加的时候，必须输入密码,修改的时候可以不输入密码
            [['username'], 'required','on'=>['update']],
            [['password','img','email'], 'safe','on'=>['update']],

//            登录密码
            [['password','username'],'required','on' => 'login'],
            [['email','img'],'safe','on' => 'login'],
            [['token_create_time', 'add_time', 'last_login_time', 'last_login_ip','salt '], 'safe'],
            ['email', 'match', 'pattern' => '/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ','message' => '该邮箱不合法','on' => 'create'],
            [['username','password','email'], 'unique','on' => 'create'],
            [['rememberMe'],'safe'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '用户密码',
            'salt' => '加盐',
            'email' => '邮箱',
            'token' => '自动登录令牌',
            'token_create_time' => '令牌创建时间',
            'add_time' => '注册时间',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录ip',
            'rememberMe' => '记住密码',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {

        return self::findOne($id);
        // TODO: Implement findIdentity() method.
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
//        var_dump($this->id);
//        exit;
        return $this->id;
        // TODO: Implement getId() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
//        得到令牌
        return $this->token;
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->token === $authKey;
        // TODO: Implement validateAuthKey() method.
    }
}
