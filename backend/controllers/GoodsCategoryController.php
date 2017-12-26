<?php

namespace backend\controllers;

use Yii;
use backend\models\GoodsCategory;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Request;

/**
 * GoodsCategoryController implements the CRUD actions for GoodsCategory model.
 */
class GoodsCategoryController extends Controller
{
    private  $data;
  public function actionIndex(){
      $model = GoodsCategory::find();
      $count = $model->count();
      $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 2]);
      $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
      return $this->render('index',['models'=>$modelList,'pagObj'=>$pagination]);
  }
  public function actionAdd(){
      $model = new GoodsCategory();
      $parent = GoodsCategory::find()->all();
      $rows = $this->Message($parent);
      $row = ArrayHelper::map($rows,'id','name');
      $request = new Request();
      if($request->isPost){
          $model->load($request->post());
          if ($model->validate()) {
              if($model->save()){

              }
          }

      }
      return $this->render('add',[ 'model' => $model,'parent'=>$row]);
  }
//  声明一个单独的方法用来整理无限极分类
  public function Message($row,$parent_id=0){
        foreach ($row as $val){
            if($val->parent_id==$parent_id){
                $this->data[] = $val;
                $this->Message($row,$val->id);
            }

        }
      return $this->data;
  }

}
