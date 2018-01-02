<?php

namespace backend\controllers;

use backend\models\Admin;
use yii\web\Request;

class AdminController extends \yii\web\Controller
{

    public function actionAdd()
    {
        $model = new \backend\models\Admin();
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
                $model->token = \Yii::$app->security->generateRandomString();
                if ($model->save()) {
                        \Yii::$app->session->setFlash('success','注册成功');
                        \Yii::$app->user->login($model,3600*24*7);
                    return $this->redirect(['brand/index']);
                }
                // form inputs are valid, do something here

            }
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }
    public function actionLogin()
    {
        $model = new \backend\models\Admin();
        $request = new Request();
        if ($request->isPost) {
           $model->load($request->post());
             $username = Admin::findOne(['username'=>$model->username]);
             if($username){
                 if (\Yii::$app->security->validatePassword($model->password,$username->password)) {

                  \Yii::$app->user->login($model,3600*24*7);
                     var_dump(\Yii::$app->user->identity->getId());
                     exit;
                     \Yii::$app->session->setFlash('success','登录成功');
                     return $this->redirect(['brand/index']);

                 }else{
                     $model->addError('密码错误，请重新输入');
                 }
             }else{
                 $model->addError('用户名错误，请重新输入');
             }

        }
        \Yii::$app->session->setFlash('success','登录失败');
        return $this->render('login', [
            'model' => $model,
        ]);
    }
//    退出登录
   public function actionLogout(){
       \Yii::$app->user->identity;
       \Yii::$app->session->setFlash('退出成功');
       return $this->redirect(['admin/login']);
   }

}
