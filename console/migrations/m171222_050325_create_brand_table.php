<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m171222_050325_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('品牌名称'),
            'intro'=>$this->text()->comment('品牌简介'),
            'logo'=>$this->string(255)->comment('品牌logo'),
            'sort'=>$this->integer(11)->defaultValue(100)->comment('排序'),
            'status'=>$this->integer(1)->defaultValue(1)->comment('状态'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
