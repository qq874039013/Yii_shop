<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Promotion */
/* @var $form ActiveForm */
?>
<div class="promotion-add">

        <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model,'title')->widget('kucha\ueditor\UEditor',[]);?>
        <?= $form->field($model, 'start_time') ?>
        <?= $form->field($model, 'end_time') ?>
       <?= $form->field($model, 'goods_id')->dropDownList(\yii\helpers\ArrayHelper::map($goods,'id','name'),['multiple'=>'multiple'])?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- promotion-add -->
<?php
$js = <<<JS
$(function() {
    var model =$model->goods_id;
  
    $(model).each(function(i,v) {
          console.dir(v);
       $("#promotion-goods_id option:eq("+v+")").prop('selected',true);
    })
  })
JS;

$this->registerJs($js);
?>