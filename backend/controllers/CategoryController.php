<?php

namespace backend\controllers;

use backend\models\Category;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Request;

class CategoryController extends BaseController
{
    private $data;
    public function actionIndex()
    {
        $models = Category::find()->orderBy('tree,lft');
        $count = $models->count();
        $pagination = new Pagination(['totalCount' =>$count,'defaultPageSize' => 20 ]);
        $modelList = $models->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pagObj'=>$pagination]);
    }
    /**
     * @return string
     */
//    声明一个添加数据的方法
    public function actionAdd(){
        $model = new Category();
       $request = new Request();
       $rows = Category::find()->asArray()->all();
       $rows[] = ['id'=>0,'name'=>'顶级分类','parent_id'=>0];
       $row  = Json::encode($rows);
//       var_dump($row);
//       exit;
        if ($request->isPost) {
            $model->load($request->post());
            if($model->parent_id==0){
                $model->makeRoot();
            }else{
                $parent = Category::findOne($model->parent_id);
                $model->prependTo($parent);
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['add']);
        }
       return $this->render('add', ['model' => $model, 'row' => $row]);
    }
    public function actionEdit($id){
        $model = Category::findOne($id);
        $request = new Request();
        $rows = Category::find()->asArray()->all();
        $rows[] = ['id'=>0,'name'=>'顶级分类','parent_id'=>0];
        $row  = Json::encode($rows);
//       var_dump($row);
//       exit;
        if ($request->isPost) {
            $model->load($request->post());
            if($model->parent_id==0){
//            $model->parent_id = $request->post()['Category']['parent_id'];
            $model->save();
            }else{
                $parent = Category::findOne($model->parent_id);
                $model->prependTo($parent);
            }
            \Yii::$app->session->setFlash('success','修改成功');
            return $this->redirect(['add']);
        }
        return $this->render('add', ['model' => $model, 'row' => $row]);
    }

    /**
     * @param $id
     */
    public function actionDel($id){
        $model = Category::findOne($id);
        if ($model->deleteWithChildren()) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }
////    利用ajax查询数据
//    public function actionIndex(){
//       $model = Category::find()->all();
//       $row = $this->Message($model);
//        return $this->redirect(['index']);
//    }
////  声明一个单独的方法用来整理无限极分类
//    public function Message($row,$parent_id=0){
//        foreach ($row as $val){
//            if($val->parent_id==$parent_id){
//                $this->data[] = $val;
//                $this->Message($row,$val->id);
//            }
//
//        }
//        return $this->data;
//    }
    public function actionShow()
    {
        $models = Category::find()->asArray()->orderBy('id')->all();
//        $count = $models->count();
//        $pagination = new Pagination(['totalCount' =>$count,'defaultPageSize' => 4 ]);
//        $modelList = $models->offset($pagination->offset)->limit($pagination->limit)->all();
        $modelList = Json::encode($models);
        return $this->render('show',['models'=>$modelList]);
    }
}
