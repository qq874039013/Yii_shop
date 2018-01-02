<?php

namespace frontend\controllers;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $brands = Category::find()->all();
        $model = Goods::find()->orderBy('id');
        $maxPrice = \Yii::$app->request->get('maxPrice');
        $minPrice = \Yii::$app->request->get('minPrice');
        $brand = \Yii::$app->request->get('brands');
        $sn = \Yii::$app->request->get('sn');
        $status = \Yii::$app->request->get('status');

        if($maxPrice){
            $model->andWhere("shop_price<='$maxPrice'");
        }if($minPrice){
        $model->andWhere("shop_price>='$minPrice'");
    }if($brand){
        $model->andWhere("cate_id='$brand'");
    }if($sn){
        $model->andWhere("sn like '%$sn%' or name like '%$sn%'");
    }if($status==='0'||$status==='1'){
        $model->andWhere(['is_on_sale'=>$status]);
    }
        $count = $model->count();
//        实例化分页器
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 10]);
//        读取商品列表
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', ['models' => $modelList, 'pageObj' => $pagination, 'brands' => $brands]);
    }
}
