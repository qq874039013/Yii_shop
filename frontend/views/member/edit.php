<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */
/* @var $form ActiveForm */
?>
<div class="member-edit">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'mobile') ?>

    <script language="javascript" src="/PCASClass.js"></script>

   地址： <select name="province" value="<?=$model->province?>"></select><select name="city" value="<?=$model->city?>"></select><select name="area" value="<?=$model->area?>"></select>
    <?= $form->field($model, 'content') ?>
    <script language="javascript" defer>
        new PCAS("province","city","area",'<?=$model->province?>','<?=$model->city?>','<?=$model->area?>');
    </script>
        <div class="form-group">
            <?= Html::submitButton('修改', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- member-edit -->
