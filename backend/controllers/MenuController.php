<?php

namespace backend\controllers;

use backend\models\Menu;
use yii\data\Pagination;
use yii\helpers\Json;

class MenuController extends \yii\web\Controller
{
//    显示数据
    public function actionIndex()
    {
//        var_dump(Menu::menu());
//        exit;
        $model = Menu::find()->orderBy('parent_id');
        $count = $model->count();
        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 10]);
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['models'=>$modelList,'pagObj'=>$pagination]);

    }
//    添加方法
    public function actionAdd()
    {
        $model = new \backend\models\Menu();
        $rows = Menu::find()->asArray()->all();
        foreach ($rows as $v){
            $row[] = [
                'id'=>$v['id'],
                'label'=>$v['label'],
                'parent_id'=>$v['parent_id'],
            ];
        }
        $row[] = ['id'=>0,'label'=>'顶级分类','parent_id'=>0];
        $row  = Json::encode($row);
//        var_dump($row);
//        exit;
//        var_dump($row);
//        exit;
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                // form inputs are valid, do something here
                return $this->refresh();
            }
        }

        return $this->render('add', [
            'model' => $model,'row'=>$row
        ]);
    }
//    修改方法
    public function actionEdit($id)
    {
        $model = Menu::findOne($id);
        $rows = Menu::find()->asArray()->all();
        foreach ($rows as $v){
            $row[] = [
                'id'=>$v['id'],
                'label'=>$v['label'],
                'parent_id'=>$v['parent_id'],
            ];
        }
        $row[] = ['id'=>0,'label'=>'顶级分类','parent_id'=>0];
        $row  = Json::encode($row);
//        var_dump($row);
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();
                return $this->redirect(['index']);
            }
        }

        return $this->render('add', [
            'model' => $model,'row'=>$row
        ]);
    }
//    删除方法
  public function actionDel($id){
       $menu = Menu::findOne($id);
       if(Menu::find()->where(['parent_id'=>$menu->id])->count()==0){
           \Yii::$app->session->setFlash('success', '删除成功');
           $menu->delete();
       }else{
           \Yii::$app->session->setFlash('danger', '删除失败');
       }
      return $this->redirect(['index']);
  }
}
