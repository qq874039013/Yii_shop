<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleCategory */
/* @var $form ActiveForm */
?>
<div class="article_category-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'intro') ?>
        <?= $form->field($model, 'sort')->textInput(['value'=>100]) ?>
        <?= $form->field($model, 'status')->radioList([1=>'激活',0=>'禁用'],['value'=>1]) ?>
        <?= $form->field($model, 'is_help')->radioList([1=>'是',0=>'否'],['value'=>1]) ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article_category-add -->
