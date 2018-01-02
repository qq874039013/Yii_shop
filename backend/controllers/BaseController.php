<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/30
 * Time: 22:34
 */

namespace backend\controllers;


use backend\filters\CheckFilter;
use yii\web\Controller;

class BaseController extends Controller
{
////    注入过滤器
  public function behaviors()
  {
      return [
          [
              'class'=>CheckFilter::className(),
          ]
      ];
  }
}