<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="article-add">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'article_category_id')->dropDownList(\yii\helpers\ArrayHelper::map($cate,'id','name')) ?>
        <?= $form->field($model, 'status')->radioList([0=>'下架',1=>'上架'],['value'=>1]) ?>
        <?= $form->field($model, 'sort') ->textInput(['value'=>100])?>
        <?= $form->field($model, 'intro')->textarea() ?>
    <?=$form->field($detail,'content')->widget('kucha\ueditor\UEditor',[]);?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-add -->
