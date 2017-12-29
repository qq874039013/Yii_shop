<?php

namespace backend\controllers;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAdd()
    {
        $model = new \backend\models\Admin();
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                        \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);
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
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }


}
