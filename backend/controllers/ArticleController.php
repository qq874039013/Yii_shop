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

class ArticleController extends BaseController
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    //声明一个方法用来查看数据
             public function actionIndex(){
             //
             $model = Article::find()->orderBy('id');
             $count = $model->count();
//             实例化分页器
             $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 2]);
             $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
             return $this->render('index',['models'=>$modelList,'pageObj'=>$pagination]);
         }
//         添加数据的方法
    public function actionAdd()
    {
//        双模型
        $model = new Article();
        $detail = new ArticleDetail();
        $cate = ArticleCategory::find()->all();
        $request = new Request();
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {
                if ($model->save()) {
                                 $detail->load($request->post());
//                                 得到存入的article_id存入数据库
                                $detail->article_id = $model->id;
                                $detail->save();
                    \Yii::$app->session->setFlash('success', '添加成功');
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add', [
            'model' => $model,'cate'=>$cate,'detail'=>$detail
        ]);
    }
//    删除数据的方法
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
//    修改数据的方法
    public function actionEdit($id)
    {
        $model = Article::findOne($id);
        $detail =ArticleDetail::findOne($id);
        $cate = ArticleCategory::find()->all();
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            $detail->load($request->post());
            if($model->validate()) {
                if ($model->save()&&$detail->save()) {
                    \Yii::$app->session->setFlash('success', '编辑成功');
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add', [
            'model' => $model,'cate'=>$cate,'detail'=>$detail
        ]);
    }
//    写入内容的方法
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