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
    <?php echo $form->field($model, 'logo')->widget('manks\FileInput', [
    ]); ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- brand-add -->
