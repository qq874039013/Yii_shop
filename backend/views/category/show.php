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
<?php
$js = <<<EOF
var j = 0;
EOF;
$this->registerJs($js);
?>
<script>
    $("#span1").click()
    var shu = <?=$models?>;
    console.debug(shu);
</script>
