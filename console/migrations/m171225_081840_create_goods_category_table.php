<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m171225_081840_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'parent_id'=>$this->integer()->comment('商品分类'),
            'left'=>$this->integer()->comment('左对齐'),
            'right'=>$this->integer()->comment('右对齐'),
            'level'=>$this->integer()->comment('级别'),
            'intro'=>$this->string()->comment('介绍'),
        ]);
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}
