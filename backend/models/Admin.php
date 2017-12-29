<?php

namespace backend\models;

use Yii;

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
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $rememberMe;
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
            [['username', 'password', 'email'], 'required'],
            [['token_create_time', 'add_time', 'last_login_time', 'last_login_ip','salt '], 'safe'],
            ['email', 'match', 'pattern' => '/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ','message' => '该邮箱不合法'],

            [['username', 'email'], 'unique'],
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
}
