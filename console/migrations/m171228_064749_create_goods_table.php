<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171228_064749_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('商品名称'),
            'cate_id' => $this->string()->notNull()->comment('分类id'),
            'sn' => $this->string()->notNull()->comment('货号'),
            'is_on_sale' => $this->integer()->notNull()->comment('1是 0否上架'),
            'sort' => $this->integer()->defaultValue(100)->notNull()->comment('排序'),
            'market_price'=>$this->decimal()->notNull()->comment('市场价格'),
            'shop_price'=>$this->decimal()->notNull()->comment('本店价格'),
            'stock'=>$this->integer()->notNull()->comment('库存'),
            'inputtime'=>$this->integer()->notNull()->comment('录入时间'),
            'logo'=>$this->string()->notNull()->comment('图片'),
            'brand_id'=>$this->integer()->notNull()->comment('品牌id'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
