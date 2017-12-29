<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%goods_promotion}}".
 *
 * @property int $id
 * @property int $goods_id 对应商品id
 * @property int $promotion_id 促销id
 */
class GoodsPromotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_promotion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'promotion_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '对应商品id',
            'promotion_id' => '促销id',
        ];
    }
}
