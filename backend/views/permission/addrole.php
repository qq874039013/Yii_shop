<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->label('角色');
echo $form->field($model,'description')->label('角色描述');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();