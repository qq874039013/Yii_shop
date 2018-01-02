<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 */
class m180101_054405_create_member_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('member', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->comment('用户名'),
            'password' => $this->string()->comment('密码'),
            'telephone' => $this->string()->comment('电话'),
            'email' => $this->string()->comment('邮箱'),
            'add_time' => $this->integer()->comment('添加时间'),
            'last_login_time' => $this->integer()->comment('最后登录时间'),
            'last_login_ip' => $this->integer()->comment('最后登录 ip'),
            'salt' => $this->string()->comment("加盐"),
            'status' => $this->integer()->comment('状态'),
            'token' => $this->string()->comment('登录口令'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('member');
    }
}
