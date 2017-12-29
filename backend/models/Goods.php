<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property int $id
 * @property string $name 商品名称
 * @property string $cate_id 分类id
 * @property string $sn 货号
 * @property int $is_on_sale 1是 0否上架
 * @property int $sort 排序
 * @property string $market_price 市场价格
 * @property string $shop_price 本店价格
 * @property int $stock 库存
 * @property int $inputtime 录入时间
 * @property string $logo 图片
 * @property int $brand_id 品牌id
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $goodsImg;
    public $content;
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cate_id', 'is_on_sale', 'market_price', 'shop_price', 'stock', 'inputtime', 'logo', 'brand_id'], 'required'],
            [['is_on_sale', 'sort', 'stock', 'inputtime', 'brand_id'], 'integer'],
            [['sn','goodsImg','content'],'safe'],
            [['market_price', 'shop_price'], 'number'],
            [['name', 'cate_id', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'cate_id' => '分类id',
            'sn' => '货号',
            'is_on_sale' => '1是 0否上架',
            'sort' => '排序',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'inputtime' => '录入时间',
            'logo' => '图片',
            'brand_id' => '品牌id',
        ];
    }

    public function getCate()
    {
        return $this->hasOne(Category::className(), ['id' => 'cate_id']);
    }
    public function getBrand(){
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }
}
