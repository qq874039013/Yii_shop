<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/9
 * Time: 16:10
 */

namespace frontend\controllers;


use frontend\models\Member;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;

class MemberController extends Controller
{
        public function actionAddress(){
            $member = Member::find()->where(['user_id'=>\Yii::$app->user->id])->all();
            return $this->render('address',['members'=>$member]);
        }
        public function actionAdd(){
            $request = new Request();
            if ($request->isPost) {
                $model = new Member();
//                手动绑定数据
                $model->city = $request->post('city');
                $model->area = $request->post('area');
                $model->province = $request->post('province');
                $model->username = $request->post('username');
                $model->mobile = $request->post('mobile');
                $model->content = $request->post('content');
                $model->default = $request->post('default');
                $model->user_id = \Yii::$app->user->id;
                if ($model->validate()) {
                    if ($model->save()) {
                        return Json::encode([
                            'status'=>1,
                            'msg'=>'添加成功',
                            'data'=>null,
                        ]);
                    }
                }else{
                    return Json::encode([
                        'status'=>0,
                        'msg'=>'添加失败',
                        'data'=>$model->errors,
                    ]);

                }

            }
        }
    public function actionEdit($id)
    {
        $model = Member::findOne($id);

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
               $model->city=\Yii::$app->request->post('city');
               $model->province=\Yii::$app->request->post('province');
               $model->area=\Yii::$app->request->post('area');
                if ($model->save()) {

                    return $this->redirect(['member/address']);

                }

            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }
//        删除数据
            public function actionDel($id){
            $model = Member::findOne($id);
                if ($model->delete()) {
                    return $this->redirect(['member/address']);
                }

            }
//            设置为默认
            public function actionSetDefault($id){
                $member = Member::findOne($id);
                $sql = "update member set `default`='0'";
//                链接数据库
                $connection=\Yii::$app->db;
//                构造sql 语句
                $command=$connection->createCommand($sql);
//                执行sql语句
                $command->execute();
//                设为默认
               $member->default=1;
                if ($member->save()) {

                    return $this->redirect(['member/address']);
                }
            }

}