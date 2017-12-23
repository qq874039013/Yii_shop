<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 13:44
 */

namespace backend\controllers;


use backend\filters\CheckFilter;
use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;

class BrandController extends Controller
{
////    注入rbac
//    public function behaviors()
//    {
//        return [[
//            'class'=>CheckFilter::className()
//        ]];
//    }
//    声明一个添加数据的方法
    public function actionAdd(){
       $model = new Brand();
       $request = new Request();
       if($request->isPost){
           $model->load($request->post());
           if($model->validate()) {
               if ($model->save()) {
                   \Yii::$app->session->setFlash('success', "注册成功");
                   return $this->redirect(['index']);
               }
           }
       }
       return $this->render('add',compact('model'));
   }

    /**
     * @return string
     */
//    声明一个显示数据的方法
    public function actionIndex(){
       $model = Brand::find()->orderBy('sort');
       $count = $model->count();
       $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 5]);
       $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
       return $this->render('index',['models'=>$modelList,'pagObj'=>$pagination]);
   }
//   声明一个修改数据的方法
    public function actionEdit($id){
        $model = Brand::findOne($id);
        $oldImg = $model->logo;
        $request = new Request();
        if($request->isPost){
               $model->load($request->post());
               if($model->logo!==$oldImg){
                if(file_exists(ltrim($oldImg,'/'))){
                unlink(ltrim($oldImg,'/'));
            }
               }
            if($model->validate()){
            if($model->save()){
                \Yii::$app->session->setFlash('success',"编辑成功");
                return $this->redirect(['index']);
            }
            }
        }
        return $this->render('add',compact('model'));
    }
//    声明一个删除的方法
    public function actionDel($id)
    {
        $model = Brand::findOne($id);
        if(file_exists(ltrim($model->logo,'/'))){
            unlink(ltrim($model->logo,'/'));
        }
        if ($model->delete()) {
          return $this->redirect(['index']);
        }
    }
    public function actionUpload(){
         $img = UploadedFile::getInstanceByName('file');
        $path = "images/brand/".uniqid().".".$img->extension;
        if ($img->saveAs($path,false)) {
              $row = [
                  'code'=>0,
                  'url'=>'/'.$path,
                  'attachment'=>'/'.$path
              ];
            return json_encode($row);
        }
    }
}