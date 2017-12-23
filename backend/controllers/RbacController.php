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
    public function actionPre($name)
    {
        $auth = \Yii::$app->authManager;
        $pre = $auth->createPermission($name);
        $auth->add($pre);
        // 添加权限
    }
//    声明一个添加角色的方法
    public function actionRole($name){
        $auth = \Yii::$app->authManager;
        $role = $auth->createRole($name);
//        添加权限
        $auth->add($role);

    }
   public function actionRolePre($parent,$child){
       $auth = \Yii::$app->authManager;
       $role = $auth->getRole($parent);
       $pre = $auth->getPermission($child);
       $auth->addChild($role,$pre);
   }
}