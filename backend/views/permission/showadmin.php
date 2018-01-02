<?php
/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form ActiveForm */
?>
<table class="table">
    <a href=<?=\yii\helpers\Url::to(['permission/add-admin'])?> class="glyphicon glyphicon-plus btn btn-success"></a>
        <a href=<?=\yii\helpers\Url::to(['index'])?> class="glyphicon glyphicon-book btn btn-success"></a>
    <tr>
        <td>角色名称</td>
        <td>会员名称</td>
        <td>更改角色名称</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>

        <td title="name"><?=$model->item_name?></td>
        <td title="id" data_id="<?=$model->user_id?>"><?=$model->admin->username?></td>
        <td><select class="form-control">
                <?php foreach ($role as $v):?>
                <option value="<?=$v->name?>"><?=$v->name?></option>
            <?php endforeach;?>
            </select></td>
        <td><a href="<?=\yii\helpers\Url::to(['del-admin','user_id'=>$model->user_id,'item_name'=>$model->item_name])?>" class="glyphicon glyphicon-trash btn btn-success"></a> <a href="javascript:void(0)" class="glyphicon glyphicon-edit btn btn-success"></a> <a href="<?=\yii\helpers\Url::to(['edit-adm','user_id'=>$model->user_id,'item_name'=>$model->item_name])?>" class="glyphicon glyphicon-envelope btn btn-success"></a></td>
    </tr>
    <?php endforeach;?>
</table>
<?php
$js=<<<JS
 $(function() {
   $(".glyphicon glyphicon-edit btn btn-success").click(function(){
   var item_name = $(this).parent().find("select").prop('value');
   var user_id = $(this).parent().find("td[title='id']").attr('data_id');
   
    var obj = this;
   $.getJSON('index.php?r=Permission/edit-admin',{'item_name':item_name,'user_id':user_id},function() {
      $(obj).parent().find("td[title='name']").text(item_name);
   })
  })
 })
JS;
$this->registerJs($js);
?>