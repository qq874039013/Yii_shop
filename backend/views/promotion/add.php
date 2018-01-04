<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="article-add">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6"><?= $form->field($model, 'start_time')->textInput(['type'=>'date']) ?></div>
    <div class="col-md-6"> <?= $form->field($model, 'end_time') ->textInput(['type'=>'date'])?></div>
    <?=$form->field($model,'title')->widget('kucha\ueditor\UEditor',[]);?>
    <?=$form->field($model,'goods_id')->label('参与商品')->dropDownList(\yii\helpers\ArrayHelper::map($goods,'id','name'),['multiple'=>'multiple'])?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-add -->
