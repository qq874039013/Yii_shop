<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>
<div class="goods-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'cate_id')->dropDownList(\yii\helpers\ArrayHelper::map($cate,'id','name'))?>
    <?= $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map($brand,'id','name'))?>
        <?= $form->field($model, 'is_on_sale')->radioList([0=>'下架',1=>'上架'],['value'=>1])?>

        <?= $form->field($model, 'market_price') ?>
        <?= $form->field($model, 'shop_price') ?>
    <?= $form->field($model, 'stock') ?>
    <?= $form->field($model, 'sn') ->textInput(['placeholder'=>'如果不输入货号，自动填写'])?>
    <?=$form->field($model, 'logo')->widget('manks\FileInput', [
    ]);
    ?>
    <?=$form->field($model,'content')->widget('kucha\ueditor\UEditor',[]);?>
   <?php echo $form->field($model, 'goodsImg')->widget('manks\FileInput', [
    'clientOptions' => [
    'pick' => [
    'multiple' => true,
    ],
    // 'server' => Url::to('upload/u2'),
    // 'accept' => [
    // 	'extensions' => 'png',
    // ],
    ],
    ]); ?>
        <?= $form->field($model, 'sort')->textInput(['value'=>100]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-add -->
