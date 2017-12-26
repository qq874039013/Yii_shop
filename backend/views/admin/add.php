<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form ActiveForm */
?>
<div class="admin-add">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'role_pre')->dropDownList(\yii\helpers\ArrayHelper::map($item,'name','name')) ?>
    <?=$form->field($model, 'img')->widget('manks\FileInput', [
    ]);?>
        <?= $form->field($model, 'sex')->radioList([0=>'男',1=>'女'],['value'=>0]) ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-add -->
