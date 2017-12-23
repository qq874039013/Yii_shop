<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171223_012552_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(100)->notNull()->comment('用户名'),
            'password'=>$this->string(100)->notNull()->comment('用户密码'),
            'sex'=>$this->integer()->notNull()->defaultValue(0)->comment('0代表男，1代表女'),
            'role_id'=>$this->integer()->notNull()->comment('所属权限'),
            'img'=>$this->string()->notNull()->comment('头像'),
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
