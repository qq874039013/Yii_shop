<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Category;
use backend\models\Goods;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\web\Request;


class GoodsController extends BaseController
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $brands = Category::find()->all();
        $model = Goods::find()->orderBy('id');
        $maxPrice = \Yii::$app->request->get('maxPrice');
        $minPrice = \Yii::$app->request->get('minPrice');
        $brand = \Yii::$app->request->get('brands');
        $sn = \Yii::$app->request->get('sn');
        $status = \Yii::$app->request->get('status');

       if($maxPrice){
                  $model->andWhere("shop_price<='$maxPrice'");
       }if($minPrice){
        $model->andWhere("shop_price>='$minPrice'");
    }if($brand){
        $model->andWhere("cate_id='$brand'");
    }if($sn){
        $model->andWhere("sn like '%$sn%' or name like '%$sn%'");
    }if($status==='0'||$status==='1'){
        $model->andWhere(['is_on_sale'=>$status]);
    }
        $count = $model->count();
//        实例化分页器
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 10]);
//        读取商品列表
        $modelList = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', ['models' => $modelList, 'pageObj' => $pagination, 'brands' => $brands]);
    }

//    声明一个添加方法
    public function actionAdd()
    {
        $model = new Goods();
        $cates = Category::find()->orderBy('tree,lft')->all();
        $brand = Brand::find()->where('status=1')->all();
        $request = new Request();
        if ($request->isPost) {
//            绑定数据
            $model->load($request->post());
            $model->inputtime = date('Ymd', time());
            if (trim(empty($model->sn))) {
//              自动编号
                $count = Goods::find()->andWhere(['like', 'inputtime', date('Ymd')])->count();
//              判定字符串的个数
                $length = strlen($count);
//              补齐四个0
                $model->sn = date('Ymd', time()) . str_repeat('0', (4 - $length)) . ($count + 1);
            }
            if ($model->validate()) {
                if ($model->save(false)) {
                    foreach ($model->goodsImg as $img) {
                        $gallery = new GoodsGallery();
                        $gallery->img = $img;
                        $gallery->goods_id = $model->id;
//                  上传图片
                        $gallery->save();
                    }
                }
                $intro = new GoodsIntro();
                $intro->id = $model->id;
//              上传内容
                $intro->content = $model->content;
                $intro->save();
//              添加成功
                \Yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['index']);
            }

        }
        return $this->render('add', ['model' => $model, 'cate' => $cates, 'brand' => $brand]);
    }

//    修改数据的方法
    public function actionEdit($id)
    {
        $model = Goods::findOne($id);
        $imgs = GoodsGallery::find()->where(['goods_id' => $id])->asArray()->all();
        $intro = GoodsIntro::findOne($id);
//        遍历图片赋值
        foreach ($imgs as $img) {
            $model->goodsImg[$img['id']] = $img['img'];
        }
        $model->content = $intro->content;
        $cates = Category::find()->orderBy('tree,lft')->all();
        $brand = Brand::find()->where('status=1')->all();
        $request = new Request();
        if ($request->isPost) {
//            绑定数据
            $model->load($request->post());
            $model->inputtime = date('Ymd', time());
            if (trim(empty($model->sn))) {
//              自动编号
                $count = Goods::find()->andWhere(['like', 'inputtime', date('Ymd')])->count();
//              判定字符串的个数
                $length = strlen($count);
//              补齐四个0
                $model->sn = date('Ymd', time()) . str_repeat('0', (4 - $length)) . ($count + 1);
            }
            if ($model->save(false)) {
                foreach ($imgs as $img) {
                    $gallery = GoodsGallery::findOne($img['id']);
                    $gallery->delete();
                }
                foreach ($model->goodsImg as $val) {
//                    判断图片存不存在
                    $gallery = new GoodsGallery();
                    $gallery->goods_id = $model->id;
                    $gallery->img = $val;
                    $gallery->save(false);
                }
            }
            $intro->id = $model->id;
//              上传内容
            $intro->content = $model->content;
            $intro->save(false);
//              添加成功
            \Yii::$app->session->setFlash('success', '编辑成功');
            return $this->redirect(['index']);
        }
        return $this->render('add', ['model' => $model, 'cate' => $cates, 'brand' => $brand]);
    }

////    上传文件
    public function actionUp()
    {
        $config = [
            'accessKey' => '5oL6adBOpKWxbuDgKtRz9M8yAU5wBAm_wAaEx1xM',//AK
            'secretKey' => 'T_FO0rpYEi3rkmTtWtrehZsPG5Pcqogcxt3jPQJJ',//SK
            'domain' => 'http://p1o0rcjok.bkt.clouddn.com',//临时域名
            'bucket' => 'php0830',//空间名称
            'area' => Qiniu::AREA_HUADONG//区域
        ];

//var_dump($_FILES);exit;
        $qiniu = new Qiniu($config);

//var_dump($qiniu);exit;
        $key = uniqid();//上传后的文件名  多文件上传有坑
        $qiniu->uploadFile($_FILES['file']["tmp_name"], $key);//调用上传方法上传文件
        $url = $qiniu->getLink($key);//得到上传后的地址
        //返回的结果
        $result = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url

        ];
        return json_encode($result);
    }

    public function actionDel($id)
    {
        $model = Goods::findOne($id);
        if ($imgs = GoodsGallery::findOne(['goods_id' => $id]) && $Intro = GoodsIntro::findOne($id)) {
            $imgs->delete();
            $Intro->delete();
        };
        if ($model->delete()) {
            \Yii::$app->session->setFlash('success', '删除成功');
            return $this->redirect(['index']);
        }
    }
}
