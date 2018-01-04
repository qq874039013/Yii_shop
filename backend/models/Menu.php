<?php

namespace backend\models;

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
            [['icon','class','parent_id', 'is_guest'], 'safe'],
            [['label','url'],'unique']
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
    public static function menu()
    {
//        $menu1 = [
//            [
//                'label' => '商品管理',
//                'icon' => 'share',
//                'url' => '#',
//                'items' => [
//                    ['label' => '添加商品', 'icon' => 'fighter-jet', 'url' => ['/goods/add']],
//                    ['label' => '商品列表', 'icon' => 'dashboard', 'url' => ['/goods/index'],],
//                ],
//            ],
//            [
//                'label' => '商品管理',
//                'icon' => 'share',
//                'url' => '#',
//                'items' => [
//                    ['label' => '添加商品', 'icon' => 'fighter-jet', 'url' => ['/goods/add']],
//                    ['label' => '商品列表', 'icon' => 'dashboard', 'url' => ['/goods/index'],],
//                ],
//            ],
//            //  \backend\models\Mulu::menu(),
//        ];
//        声明一个数组用来储存菜单列表
        $newMenus = [];
       $parent = self::find()->where(['parent_id'=>0])->all();
//       遍历父级菜单
        foreach ($parent as $menu) {
            //分别赋值
            $newMenu = [
                'label' => $menu->label,
                'icon' => $menu->icon,
                'url' => '#',
            ];
            //循环当前分类的二级分类
            foreach (self::find()->where(['parent_id' => $menu->id])->all() as $v) {
                //给每个二级分类赋值
                $newMenu['items'][] = [
                    'label' => $v->label,
                    'icon' => $v->icon,
                    'url' => [$v->url]
                ];
            }
            //把一级分类追加到数组中，没循环一次追加一次
            $newMenus[]=$newMenu;
        }
        //返回
        return $newMenus;
        // return self::find()->all();
    }
        // return self::find()->all();
//        返回菜单列表

//        return $menu;

}
