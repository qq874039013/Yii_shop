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
use flyok666\qiniu\Qiniu;
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
//
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
       $model = Brand::find()->orderBy('id')->where(['status'=>1]);
       $count = $model->count();
       $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 2]);
       $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
       return $this->render('index',['models'=>$modelList,'pagObj'=>$pagination]);
   }
//   声明一个修改数据的方法
    public function actionEdit($id){
        $model = Brand::findOne($id);
        $oldImg = $model->logo;
        $request = new Request();
//        判断文件是否更改
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
    /*
     *
     */
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
//    声明一个单独上传文件的方法
    public function actionUpload(){
        $config = [
            'accessKey' => 'EAd29Qrh05q78_cZhajAWcbB1wYCBLyHLqkanjOG',//AK
            'secretKey' => '_R5o3ZZpPJvz8bNGBWO9YWSaNbxIhpsedbiUtHjW',//SK
            'domain' => 'http://p1ht4b07w.bkt.clouddn.com',//临时域名
            'bucket' => 'php0830',//空间名称
            'area' => Qiniu::AREA_HUADONG//区域
        ];

//var_dump($_FILES);exit;
        $qiniu = new Qiniu($config);
//var_dump($qiniu);exit;
        $key = time();//上传后的文件名  多文件上传有坑
        $qiniu->uploadFile($_FILES['file']["tmp_name"], $key);//调用上传方法上传文件
        $url = $qiniu->getLink($key);//得到上传后的地址
        //返回的结果
        $result = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url

        ];
        return json_encode($result);
    }

    /*
     *
     */
//    声明一个方法用来加入回收站
    public function actionAddTrash($id){
        $model = Brand::findOne($id);
        $model->status=!$model->status;
        if ($model->save()) {
            return $this->redirect(['index']);
        }
    }
//    声明一个方法用来查看回收站
    public function actionTrash(){
        $model = Brand::find()->orderBy('id')->where(['status'=>0]);
        $count = $model->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 2]);
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pagObj'=>$pagination]);
    }

}