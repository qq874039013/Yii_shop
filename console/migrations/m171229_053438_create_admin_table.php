<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171229_053438_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->comment('用户名'),
            'password' => $this->string()->notNull()->comment('用户密码'),
            'salt' => $this->string()->notNull()->comment('加盐'),
            'email' => $this->string()->notNull()->comment('邮箱'),
            'token' => $this->string()->comment('自动登录令牌'),
            'token_create_time' => $this->integer()->comment('令牌创建时间'),
            'add_time' => $this->integer()->comment('注册时间'),
            'last_login_time' => $this->integer()->comment('最后登录时间'),
            'last_login_ip' => $this->integer()->comment('最后登录ip'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
