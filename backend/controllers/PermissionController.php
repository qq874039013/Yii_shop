<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/30
 * Time: 11:17
 */

namespace backend\controllers;


use backend\models\Admin;
use backend\models\AuthAssignment;
use backend\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;
//将rbac写在一个控制器中
class PermissionController extends Controller
{
    /**
     * @return string
     */
//    添加权限的方法
    public function actionAdd(){
        $model = new AuthItem();
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
           $auth =  \Yii::$app->authManager;
            //            创建权限
           $pre = $auth->createPermission($model->name);
//           添加描述
           $pre->description=$model->description;
//           加入权限
            if ($auth->add($pre)) {
                \Yii::$app->session->setFlash('success','添加成功');
            }
        }
        return $this->render('add',['model'=>$model]);
    }
////    添加角色
//    public function actionAddRole(){
//        $model = new AuthItem();
//        $request = new Request();
//        if($request->isPost){
//            $model->load($request->post());
//            $auth =  \Yii::$app->authManager;
//            //            创建角色
//            $pre = $auth->createRole($model->name);
////           添加描述
//            $pre->description=$model->description;
////           加入角色
//            if ($auth->add($pre)) {
//                \Yii::$app->session->setFlash('success','添加成功');
//            }
//        }
//        return $this->render('addrole',['model'=>$model]);
//    }
//    添加角色--权限
    public function actionAddChild(){
        $model = new AuthItem();
        $pre = \Yii::$app->authManager->getPermissions();
//        将权限转换成键名对应键值的形式
        $pre = \yii\helpers\ArrayHelper::map($pre,'name','description');
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            $auth =  \Yii::$app->authManager;
//            判断角色是否存在
            if($auth->getRole($model->role)==false){
//            创建角色
            $role = $auth->createRole($model->role);
//            添加描述
            $role->description = $model->description;
//            把角色添加进去
            $auth->add($role);}
            $parent = $auth->getRole($model->role);
            $auth->removeChildren($parent);
            foreach ($model->pre as $val) {
//                给角色添加权限
                $child = $auth->getPermission($val);
                $auth->addChild($parent,$child);
            }
            \Yii::$app->session->setFlash('success','添加角色成功');

        }
        return $this->render('addchild',['model'=>$model,'pre'=>$pre]);
    }
//    修改角色和权限
    public function actionEditRole($name){
        $model = new AuthItem();
        $auth = \Yii::$app->authManager;
        $pre = $auth->getPermissions();
//        设置回显的功能
        $model->pre =array_column($auth->getChildren($name),'name');
        $model->role = $name;
        $model->description = $auth->getRole($name)->description;
//        将权限转换成键名对应键值的形式
        $pre = \yii\helpers\ArrayHelper::map($pre,'name','description');
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            $auth =  \Yii::$app->authManager;
//            判断角色是否存在
            if($auth->getRole($model->role)==false){
                $parent = $auth->getRole($name);
            }else{
                $parent = $auth->getRole($model->role);
//                覆盖掉以前的角色
               echo "<script>alert('是否要覆盖掉存在的角色')</script>";
                $parent = $auth->getRole($model->role);
                $parent2 = $auth->getRole($name);
                //                先移除以前的角色对应的权限
                $auth->removeChildren($parent2);
                $auth->remove($parent2);
            }
            //                删除角色以前对应的权限
            $auth->removeChildren($parent);
//            在移除角色
            $auth->remove($parent);

//            重新创建角色
            $role = $auth->createRole($model->role);
//            添加描述
            $role->description = $model->description;
//            把角色添加进去
            $auth->add($role);
            $parent = $auth->getRole($model->role);
            $auth->removeChildren($parent);
            foreach ($model->pre as $val) {
//                给角色添加权限
                $child = $auth->getPermission($val);
                $auth->addChild($parent,$child);
            }
            \Yii::$app->session->setFlash('success','修改角色成功');
        }
        return $this->render('addchild',['model'=>$model,'pre'=>$pre]);
    }
    public function actionIndex(){
        //    声明一个方法用来查看权限表
        $model =\Yii::$app->authManager->getPermissions();

        return $this->render('index',['models'=>$model]);
    }
    public function actionShow(){
        //    声明一个方法用来查看角色
        $model =\Yii::$app->authManager->getRoles();
        return $this->render('show',['models'=>$model]);
    }
//    删除权限
    public function actionDel($name){
       $auth = \Yii::$app->authManager;
       $pre = $auth->getPermission($name);
        if ($auth->remove($pre)) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }
//    删除角色
    public function actionDelRole($name){
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($name);
//        先删除角色对应的权限
        $auth->removeChildren($role);
//        然后在删除角色
        if ($auth->remove($role)){
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['show']);
        }
    }
//    添加用户给角色的方法
    public function actionAddAdmin(){
        $model = new AuthItem();
//        得到所有的用户
        $admin = Admin::find()->asArray()->all();
        $admin = ArrayHelper::map($admin,'id','username');
        $auth = \Yii::$app->authManager;
//        得到所有的角色
        $role = $auth->getRoles();
        $role = ArrayHelper::map($role,'name','description');
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
//            得到角色

            foreach ($model->adminId as $val){
//                添加角色对应的用户
                foreach ($model->roles as $v){
                    $role = $auth->getRole($v);
                    $auth->assign($role,$val);
                }
            }
            \Yii::$app->session->setFlash('success',"添加会员到".$model->role."角色成功");
            $this->refresh();
        }
        return $this->render('addadmin',['role'=>$role,'admin'=>$admin, 'model' => $model]);
    }
//    显示角色对应的用户
    public function actionShowAdmin(){
       $models = AuthAssignment::find()->all();
        $auth = \Yii::$app->authManager;
        $role = $auth->getRoles();
        return $this->render('showadmin', ['models' => $models,'role'=>$role]);
    }
//    移除角色对应的用户的方法
    public function actionDelAdmin($item_name,$user_id){
          $auth = \Yii::$app->authManager;
          $role = $auth->getRole($item_name);
        if ($auth->revoke($role,$user_id)) {
            \Yii::$app->session->setFlash('success',"删除".$user_id."号会员对应".$item_name."角色成功");
            return $this->redirect(['permission/show-admin']);
        }
    }
//    修改用户的权限
    public function actionEditAdmin($item_name,$user_id){
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($item_name);
        $auth->revoke($role,$user_id);
        $parent = $auth->getRole($item_name);
        $auth->assign($parent,$user_id);
    }
    //    修改用户的权限
    public function actionEditAdm($item_name,$user_id){
        $model = new AuthItem();
        $admin = Admin::findOne($user_id);
        $model->roles = [$item_name];
        $auth = \Yii::$app->authManager;
//        得到所有的角色
        $role = $auth->getRoles();
        $role = ArrayHelper::map($role,'name','description');
        $request = new Request();
        if($request->isPost){
            $auth = \Yii::$app->authManager;
            $role = $auth->getRole($item_name);
            $auth->revoke($role,$user_id);
            $model->load($request->post());
//            得到角色
            foreach ($model->adminId as $val){
//                添加角色对应的用户
                foreach ($model->roles as $v){
                    $role = $auth->getRole($v);
                    $auth->assign($role,$val);
                }
            }
            \Yii::$app->session->setFlash('success',"添加会员到".$model->role."角色成功");
            $this->refresh();
        }
        return $this->render('editadmin',['role'=>$role,'admin'=>$admin, 'model' => $model]);
    }
}