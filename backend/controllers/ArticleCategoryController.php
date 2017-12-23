<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\Request;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $model = new ArticleCategory();
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                if($model->save()){
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['index']);
                }
        }
        }
        return $this->render('add', [
            'model' => $model,
        ]);
    }
    public function actionIndex(){
        $model = ArticleCategory::find()->orderBy('sort');
        $count = $model->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 4]);
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pageObj'=>$pagination]);
    }
    public function actionEdit($id)
    {
        $model = ArticleCategory::findOne($id);
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success', '添加成功');
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add', [
            'model' => $model,
        ]);
    }
    public function actionDel($id){
        $model = ArticleCategory::findOne($id);
        if ($model->delete()) {
            return $this->redirect(['index']);
        }
    }
}
