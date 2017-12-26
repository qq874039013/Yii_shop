<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_category".
 *
 * @property int $id
 * @property int $parent_id 商品分类
 * @property int $left 左对齐
 * @property int $right 右对齐
 * @property int $level 级别
 * @property string $intro 介绍
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'left', 'right', 'level','name'], 'integer'],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'parent_id' => '顶级分类',
            'left' => '左对齐',
            'right' => '右对齐',
            'level' => '级别',
            'intro' => '介绍',
            'name'=>'商品名称'
        ];
    }
    public function getCate(){
        return $this->hasOne();
    }
}
