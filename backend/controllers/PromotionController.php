<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsPromotion;
use backend\models\Promotion;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Request;

class PromotionController extends BaseController
{
//    声明一个显示的方法
    public function actionIndex()
    {
        $model = Promotion::find();
        $count = $model->count();
//        实例化分页器
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' =>10]);
//        读取商品列表
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pageObj'=>$pagination]);
    }

    /**
     * @return string
     */
//    声明一个添加方法
    public function actionAdd(){
        $model = new Promotion();
        $goods = Goods::find()->all();
      $request = new Request();
      if($request->isPost){
          if ($model->load($request->post())) {
              $model->save(false);
            foreach ($model->goods_id as $val){
                   $pro = new GoodsPromotion();
                    $pro->promotion_id = $model->id;
                    $pro->goods_id = $val;
                    $pro->save();
            }
            \Yii::$app->session->setFlash('success','添加成功');
              return $this->redirect(['index']);
          }
      }
        return $this->render('add',['model'=>$model,'goods'=>$goods]);
  }
//  声明一个修改数据的方法
    public function actionEdit($id){
        $model = Promotion::findOne($id);
        $row = GoodsPromotion::find()->where(['promotion_id'=>$id])->asArray()->all();
        $model->goods_id = Json::encode($row);
        $goods = Goods::find()->all();
        $request = new Request();
        if($request->isPost){
            if ($model->load($request->post())) {
                $model->save(false);
                foreach ($model->goods_id as $val){
                    foreach(GoodsPromotion::find()->where(['promotion_id'=>$model->id])->all() as $value){
                        $value->delete();
                    }
                    $pro = new GoodsPromotion();
                    $pro->promotion_id = $model->id;
                    $pro->goods_id = $val;
                    $pro->save();
                }
                \Yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect(['index']);
            }
        }
        return $this->render('add',['model'=>$model,'goods'=>$goods]);
    }
//    声明一个删除数据的方法
     public function actionDel($id){
        $model = Promotion::findOne($id);
        $val = GoodsPromotion::find()->where(['promotion_id'=>$id])->all();
        if($val){
        foreach ($val as $v){
           $v->delete();
         }}
        $model->delete();
         \Yii::$app->session->setFlash('success','删除成功');
         return $this->redirect(['index']);
     }
}
