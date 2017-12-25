<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171224_051033_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'article_category_id'=>$this->integer()->notNull()->comment('文章所属分类'),
            'intro'=>$this->string()->comment('介绍'),
            'inputtime'=>$this->integer()->comment('录入时间'),
            'name'=>$this->string()->comment('文章名称'),
            'status'=>$this->integer()->comment('状态 0=下线，1=上线'),
            'sort'=>$this->integer()->defaultValue('100')->comment('排序'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
