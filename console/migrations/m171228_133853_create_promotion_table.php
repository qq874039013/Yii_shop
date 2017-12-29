<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promotion`.
 */
class m171228_133853_create_promotion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promotion', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->comment('促销活动主题'),
            'start_time'=>$this->integer()->comment('开始时间'),
            'end_time'=>$this->integer()->comment('结束时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('promotion');
    }
}
