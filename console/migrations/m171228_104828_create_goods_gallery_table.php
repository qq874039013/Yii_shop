<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_gallery`.
 */
class m171228_104828_create_goods_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_gallery', [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer()->comment('商品id'),
            'img'=>$this->string()->comment('图片')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_gallery');
    }
}
