<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $article_category_id
 * @property string $intro
 * @property integer $inputtime
 * @property string $name
 * @property integer $status
 * @property integer $sort
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
//    public $content;
// 创建自动更新时间
    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::className(),
//                设置事件函数
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['inputtime'],
                    ActiveRecord::EVENT_AFTER_UPDATE => ['inputtime']]
            ]
        ];
    }
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_category_id'], 'required'],
            [['article_category_id', 'inputtime', 'status', 'sort'], 'integer'],
            [['intro', 'name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_category_id' => '所属分类',
            'intro' => '介绍',
//            'inputtime' => 'Inputtime',
            'name' => '文章题目',
            'status' => '状态',
            'sort' => '默认排序',
        ];
    }
    public function getCate(){
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }

}
