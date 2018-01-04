<?php

namespace backend\controllers;

use backend\models\Admin;
use yii\data\Pagination;
use yii\web\Request;

class AdminController extends \yii\web\Controller
{
//  注册之后，自动登录
    public function actionEdit($id)
    {
        $model = Admin::findOne($id);
        $model->setScenario('update');
//        保存下密码
        $password = $model->password;
        $model->password = '';
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                if (trim($model->password)){
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
                }else{
                    $model->password = $password;
                }
                if ($model->save()) {
                        \Yii::$app->session->setFlash('success','修改成功');
//                        \Yii::$app->user->login($model,3600*24*7);
                    return $this->redirect(['index']);
                }
                // form inputs are valid, do something here

            }
        }


        return $this->render('add', [
            'model' => $model,
        ]);
    }
//    声明一个修改方法
    public function actionAdd()
    {
        $model = new Admin();
        $model->setScenario('create');
        if ($model->load(\Yii::$app->request->post())) {
//            验证
            if ($model->validate()) {

//                写入哈希密码
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
                $model->token = \Yii::$app->security->generateRandomString();
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success','注册成功');
//                    登录
                    \Yii::$app->user->login($model,$model->rememberMe?3600*24*7:0);
                    return $this->redirect(['brand/index']);
                }
                // form inputs are valid, do something here

            }
        }
        return $this->render('add', [
            'model' => $model,
        ]);
    }
//    修改方法
    public function actionIndex(){
        $model = Admin::find()->orderBy('id');
        $count = $model->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 2]);
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pageObj'=>$pagination]);
    }

//        登录用户
    public function actionLogin()
    {
        $model = new \backend\models\Admin();
//        登录的时候调用
        $model->setScenario('login');
        $request = new Request();
        if ($request->isPost) {
           $model->load($request->post());
             $admin = Admin::findOne(['username'=>$model->username]);
             if($admin){
                 if (\Yii::$app->security->validatePassword($model->password,$admin->password)) {
//                     获取ip
                     $admin->last_login_ip=ip2long(\Yii::$app->request->userIP);
//                   获取时间
                     $admin->last_login_time = time();
//                     加入数据库
                     $admin->save();
                  \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                     \Yii::$app->session->setFlash('success','登录成功');
                     return $this->redirect(['brand/index']);
                 }else{
                     $model->addError('password','密码错误，请重新输入');
                 }
             }else{
//                 var_dump($model->username);
//                 exit;
                 $model->addError('username','用户名错误，请重新输入');
             }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
//    退出登录
   public function actionLogout(){
       if (\Yii::$app->user->logout()) {
           \Yii::$app->session->setFlash('退出成功');
           return $this->redirect(['admin/login']);
       }
   }
//   删除会员
   public function actionDel($id){
       $model = Admin::findOne($id);
       if ($model->delete()) {
           \Yii::$app->session->setFlash('danger','删除成功');
           return $this->redirect(['admin/index']);
       }

   }

}
