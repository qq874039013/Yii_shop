<?php

namespace backend\models;

use backend\components\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $tree 树节点
 * @property int $lft 左对齐
 * @property int $rgt 右对齐
 * @property int $depth 深度
 * @property string $name 分类名称
 * @property int $parent_id 父类id
 * @property string $intro 介绍
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id','intro'], 'safe'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => '树节点',
            'lft' => '左对齐',
            'rgt' => '右对齐',
            'depth' => '深度',
            'name' => '分类名称',
            'parent_id' => '父类id ',
            'intro' => '介绍',
        ];
    }
    public function getDepthName(){
        return str_repeat('---',$this->depth).$this->name;
    }
}
