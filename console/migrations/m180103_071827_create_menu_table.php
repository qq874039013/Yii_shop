<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m180103_071827_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->comment('父级分类'),
            'icon' => $this->string()->comment('样式'),
            'url' => $this->string()->comment('路由'),
            'label' => $this->string()->comment('菜单名称'),
            'is_guest' => $this->integer()->defaultValue(1)->comment('是1否0会员'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
