<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property int $id
 * @property int $parent_id 父级分类
 * @property string $icon 样式
 * @property string $url 路由
 * @property string $label 菜单名称
 * @property int $is_guest 是1否0会员
 * @property string $class
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_guest'], 'integer'],
            [['icon', 'url', 'label', 'class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '父级分类',
            'icon' => '样式',
            'url' => '路由',
            'label' => '菜单名称',
            'is_guest' => '是1否0会员',
            'class' => 'Class',
        ];
    }
}
