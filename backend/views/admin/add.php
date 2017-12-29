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
         <?= $form->field($model, 'email') ?>

    
        <div class="form-group">
            <?= Html::submitButton('注册', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-add -->
