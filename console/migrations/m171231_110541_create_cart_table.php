<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m171231_110541_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->comment('用户id'),
            'goods_id' => $this->integer()->comment('商品id'),
            'amount' => $this->integer()->comment('数量'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cart');
    }
}
