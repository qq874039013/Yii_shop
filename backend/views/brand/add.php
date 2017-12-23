<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form ActiveForm */
?>
<div class="brand-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')?>
        <?= $form->field($model, 'intro')->textarea() ?>
        <?= $form->field($model, 'sort')->textInput(['value'=>100])?>
        <?= $form->field($model, 'status')->radioList(['0'=>'禁用','1'=>'激活'],['value'=>1])?>
    <?=$form->field($model, 'logo')->widget('manks\FileInput', [
    ]);?>
    <?php if($model->logo){
        echo \yii\bootstrap\Html::img($model->logo,['height'=>50]);
    }?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- brand-add -->
