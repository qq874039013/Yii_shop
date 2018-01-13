<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/9
 * Time: 14:30
 */

namespace frontend\controllers;


use backend\models\Category;
use backend\models\Goods;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use yii\data\Pagination;
use yii\web\Controller;

class HomeController extends Controller
{
          public function actionIndex(){

              return $this->render('index');
          }
//          展示商品
          public function actionList($id){
//              1.根据id去找到对应的tree lft rgt
              $cate = Category::findOne($id);
//              2.根据得到的tree lft rgt 再来查询所有的商品分类id
$cateIds = Category::find()->andWhere("tree=$cate->tree")->andWhere("lft>=$cate->lft")->andWhere("rgt<=$cate->rgt")->asArray()->all();
//              3.根据cate_id 再来查询所有的商品
              $cateId = array_column($cateIds,'id');
              $model = Goods::find()->where(['in',"cate_id",$cateId]);
              $count = $model->count();
              $pageObj = new Pagination(['defaultPageSize' => 1,'totalCount' => $count]);
              $model = $model->offset($pageObj->offset)->limit($pageObj->limit)->all();
//              var_dump($model);exit;
              return $this->render('list',['models'=>$model,'pageObj'=>$pageObj]);
          }
//          商品详情
          public function actionGoods($id){
              $model = Goods::findOne($id);
              $goodsGallery = GoodsGallery::find()->where(['goods_id'=>$id])->all();
              $goodsContent = GoodsIntro::findOne($id);
              return $this->render('goods',['models'=>$model,'goodsGallerys'=>$goodsGallery,'goodsContents'=>$goodsContent]);
          }

}