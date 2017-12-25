<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 19:19
 */

namespace backend\controllers;




use yii\console\Controller;

class RbacController extends Controller
{
//    声明一个添加权限的方法
    public function actionPre()
    {
        $auth = \Yii::$app->authManager;
        $pre = $auth->createPermission("brand/trash");
        $auth->add($pre);
        // 添加权限
    }
//    声明一个添加角色的方法
    public function actionRole(){
        $auth = \Yii::$app->authManager;
        $role = $auth->createRole();
//        添加权限
        $auth->add($role);
       echo 12232;
    }
//    把权限加入角色
   public function actionRolePre(){
       $auth = \Yii::$app->authManager;
        $role = $auth->getRole('admin');
       $pre = $auth->getPermission("brand/trash");
       $auth->addChild($role,$pre);
       echo 123;
   }
}