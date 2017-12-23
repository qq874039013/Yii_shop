<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m171222_083827_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('分类名称'),
            'intro'=>$this->text()->notNull()->comment('分类简介'),
            'sort'=>$this->integer()->defaultValue(1)->comment('排序'),
            'status'=>$this->integer()->defaultValue(100)->comment('状态'),
            'is_help'=>$this->integer()->comment('帮助')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
