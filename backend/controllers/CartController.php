<?php

namespace backend\controllers;

use backend\models\Cart;
use yii\web\Request;

//use Symfony\Component\BrowserKit\Request;

class CartController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        $model = new Cart();
        $request = new Request();
        if ($request->isPost) {
            var_dump($model->load($request->post()));
            exit;
        }

        return $this->render('add', [
            'model' => $model,
        ]);

    }
}
