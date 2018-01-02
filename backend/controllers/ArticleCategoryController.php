<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\Request;

class ArticleCategoryController extends BaseController
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
//    查看数据的方法
    public function actionIndex(){
        $model = ArticleCategory::find()->orderBy('sort');
        $count = $model->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 4]);
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pageObj'=>$pagination]);
    }
//    修数据的方法
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
//    声明一个删除数据的方法
    public function actionDel($id){
        $model = ArticleCategory::findOne($id);
        if ($model->delete()) {
            return $this->redirect(['index']);
        }
    }
}
