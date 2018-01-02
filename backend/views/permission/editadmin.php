<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'adminId')->label('会员')->dropDownList([$admin->id=>$admin->username],['multiple'=>'multiple']);
echo $form->field($model,'roles')->label('角色')->checkboxList($role);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();