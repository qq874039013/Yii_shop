<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AuthAssignment;
use backend\models\AuthItem;
use GuzzleHttp\Psr7\Request;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;


class AdminController extends Controller
{
//    声明一个添加数据的方法
    public function actionAdd()
    {
        $model = new Admin();
        $item = AuthItem::find()->where(['type'=>1])->all();
        if ($model->load(\Yii::$app->request->post())) {
//            $img = UploadedFile::getInstance($model,'imgFile');
//            $path = 'images/admin/'.uniqid().'.'.$img->extension;
//            $img->saveAs($path,false);
//            $model->img = '/'.$path;
              $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            if ($model->validate()) {
                if($model->save()){
                  $auth = \Yii::$app->authManager;
                  $role = $auth->getRole($model->role_pre);
                    $auth->assign($role,$model->id);
                           \Yii::$app->session->setFlash('success','添加成功');
                          return $this->redirect(['index']);
                      }
            }
        }
        return $this->render('add', [
            'model' => $model,'item' => $item,
        ]);
    }
    //    声明一个展示数据的方法
    public function actionIndex()
    {   $models = Admin::find()->orderBy('id');
       $count = $models->count();
        $pagination = new Pagination(['totalCount' =>$count,'defaultPageSize' => 4 ]);
        $modelList = $models->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pageObj'=>$pagination]);
    }//    声明一个修改数据的方法
    public function actionEdit($id)
    {
        $model = Admin::findOne($id);
        $item = AuthItem::find()->where(['type'=>1])->all();
        if ($model->load(\Yii::$app->request->post())) {
            $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            if ($model->validate()) {
                if($model->save()){
                    $auth = \Yii::$app->authManager;;
                    $role = $auth->getRole($model->role_pre);
                    $auth->assign($role,$model->id);
                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add', [
            'model' => $model,'item' => $item,
        ]);
    }//    声明一个删除数据的方法
    public function actionDel($id){
       $model = Admin::findOne($id);
        if ($model->delete()){
            \Yii::$app->session->setFlash('danger','删除成功');
            return $this->redirect(['index']);
        }
   }//    声明一个登录的方法
   public function actionLogin(){
        $model = new Admin();
        $request = new \yii\web\Request();
       if ($request->isPost) {
           $model->load($request->post());
           if ($pass = Admin::findOne(['username'=>$model->username])) {
               if (\Yii::$app->security->validatePassword($model->password,$pass->password)) {

                   if (\Yii::$app->user->login($pass)) {
                       \Yii::$app->session->setFlash('success','登录成功');
                       return $this->redirect(['brand/index']);
                   }
               }else{
                   $model->addError('密码错误');
               }
           }else{
               $model->addError('用户名错误');
           }
       }
        return $this->render('login',['model' => $model]);
   }
//   声明一个方法用来上传图片
        public function actionUpload(){
            $img = UploadedFile::getInstanceByName('file');
            if($img){
            $path = 'images/admin/'.uniqid().'.'.$img->extension;
                if ($img->saveAs($path)) {
                $rows = [
                    'code'=>0,
                    'url'=>'/'.$path,
                    'attachment'=>'/'.$path
                ];
                return json_encode($rows);
            }
        }
        }
}
