<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/23
 * Time: 12:29
 */
namespace backend\filters;

use yii\base\ActionFilter;

class CheckFilter extends ActionFilter
{
    public function beforeAction($action)
    {
//        return false;
        if(\Yii::$app->user->can($action->uniqueId)){

            return true;
//            return
        }else{
            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
        }
    }
}