<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'role')->label('角色');
echo $form->field($model,'description')->label('描述');
echo $form->field($model,'pre')->label('权限')->checkboxList($pre);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();