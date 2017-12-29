<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%promotion}}".
 *
 * @property int $id
 * @property string $title 促销活动主题
 * @property int $start_time 开始时间
 * @property int $end_time 结束时间
 */
class Promotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $goods_id;
    public static function tableName()
    {
        return '{{%promotion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time'], 'integer'],
            [['goods_id'],'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '促销活动主题',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
        ];
    }
    public function getPro(){
        return $this->hasMany(GoodsPromotion::className(),['promotion_id'=>'id']);
    }
}
