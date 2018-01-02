<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cart */
/* @var $form ActiveForm */
?>
<div class="cart-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member_id') ?>
        <?= $form->field($model, 'goods_id') ?>
   <span class="glyphicon glyphicon-minus"></span><input type="text" name="amount" value="1" id="amount"><span class="glyphicon glyphicon-plus"></span>
    <div>&emsp;</div>
        <div class="form-group">
            <?= Html::submitButton('加入购物车', ['class' => 'btn btn-inverse']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- cart-add -->
<?php
$js = <<<JS
$(".glyphicon-minus").click(function() {
    if( $("#amount").val()>=1){
        $("#amount").prop('value',$("#amount").val()-1);
    }
  
})
 $(".glyphicon-plus").mouseover(function() {
    
      $(this).css('cursor:hand');
    })
    $(".glyphicon-minus").mouseover(function() {
    
      $(this).css('cursor:hand');
    })
$(".glyphicon-plus").click(function() {
    if( $("#amount").val()>=0){
        $("#amount").prop('value',parseInt($("#amount").val())+1);
        
    }
  
})
JS;

$this->registerJs($js);
?>