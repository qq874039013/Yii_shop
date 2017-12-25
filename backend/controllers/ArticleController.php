<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/24
 * Time: 13:31
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\db\DataReader;
use yii\web\Controller;
use yii\web\Request;

class ArticleController extends Controller
{
             public function actionIndex(){
             //    声明一个方法用来查看回收站
             $model = Article::find()->orderBy('id');
             $count = $model->count();
             $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 2]);
             $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
             return $this->render('index',['models'=>$modelList,'pageObj'=>$pagination]);
         }
    public function actionAdd()
    {
        $model = new Article();
        $cate = ArticleCategory::find()->all();
        $request = new Request();
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success', '添加成功');
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add', [
            'model' => $model,'cate'=>$cate
        ]);
    }
    public function actionDel($id){
              $model = Article::findOne($id);
        if (ArticleDetail::findOne(['article_id'=>$id])) {
            $detail = ArticleDetail::findOne(['article_id'=>$id]);
                 $detail->delete();
        }

        if ($model->delete()) {
            return $this->redirect(['index']);
        }
    }
    public function actionEdit($id)
    {
        $model = Article::findOne($id);
        $cate = ArticleCategory::find()->all();
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
            'model' => $model,'cate'=>$cate
        ]);
    }
    public function actionWrite($id){
        $model = Article::findOne($id);
        if (ArticleDetail::findOne(['article_id'=>$id])) {
            $detail = ArticleDetail::findOne(['article_id'=>$id]);
        }else{
       $detail = new ArticleDetail();}
       $request = new Request();
       if($request->isPost){
           $detail->load($request->post());
           if ($detail->validate()) {
               if ($detail->save()) {
                   return $this->redirect(['index']);
               }
           }
       }
        return $this->render('write', [
            'model' => $model,'cate'=>$detail
        ]);
    }
}