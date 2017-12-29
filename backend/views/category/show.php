<?php
/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form ActiveForm */
?>
<div>
<span class="glyphicon glyphicon-plus" id="span1">
<!--  --><?//=$models?>
</span>
</div>
<div>
<span class="glyphicon glyphicon-plus" id="span2">
<!--  --><?//=$models?>
</span>
</div>
<div>
<span class="glyphicon glyphicon-plus" id="span3">
<!--  --><?//=$models?>
</span>
</div>
<script>
    var data = <?=$models?>;
    for(var i in data){
        console.debug("text:"+data[i].name );
    }
</script>
