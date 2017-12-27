<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171226_023733_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull()->comment('树节点'),
            'lft' => $this->integer()->notNull()->comment('左对齐'),
            'rgt' => $this->integer()->notNull()->comment('右对齐'),
            'depth' => $this->integer()->notNull()->comment('深度'),
            'name' => $this->string()->notNull()->comment('分类名称'),
            'parent_id'=>$this->integer()->notNull()->defaultValue(0)->comment('父类id'),
            'intro'=>$this->string()->comment('介绍')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
