<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form ActiveForm */
?>
<div class="category-add">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'parent_id')->hiddenInput(['value'=>0]) ?>
    <?= \liyuze\ztree\ZTree::widget([
        'setting' => '{
			data: {
				simpleData: {
					enable: true,
					pIdKey:"parent_id"
				}
			},
			callback: {
                
				onClick:function(e,treeId, treeNode){
			    $("#category-parent_id").val(treeNode.id);
		} 
	
			}
			}',
        'nodes' =>$row
    ]);
    ?>
        <?= $form->field($model, 'intro') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- category-add -->
<!--展开js所有的目录-->
<?php
$js = <<<EOF
 var treeObj = $.fn.zTree.getZTreeObj("w1");
    treeObj.expandAll(true);
//    选中父节点
var node = treeObj.getNodeByParam("id", "$model->parent_id", null);
//给定默认样式
treeObj.selectNode(node);
EOF;
$this->registerJs($js);
?>