<?php /* @var $this yii\web\View */?>
<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add'])?> class="glyphicon glyphicon-plus btn btn-success"></a>
    <button id="allSelected" class="btn btn-success">全选</button><button id="selDel" class="btn btn-danger">选中删除</button><button id="all" class="btn btn-info">反选
        <caption><h3>商品分类列表</h3></caption>
    <tr>
        <td></td>
        <td>编号</td>
        <td>商品分类</td>
        <td>介绍</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr class="cate_tr" data_lft="<?=$model->lft?>" data_rgt="<?=$model->rgt?>" data_tree="<?=$model->tree?>">
        <td><input type="checkbox"></td>
        <td title="id"><?=$model->id?></td>
        <td ><span  class="glyphicon glyphicon-eye-open"><?=$model->depthname?></span></td>
        <td><?=$model->intro?></td>
        <td><a href=<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?> class="glyphicon glyphicon-edit btn btn-success"></a><a href=<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>  class="glyphicon glyphicon-remove-circle btn btn-danger"></a></td>
</tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pagObj])?>
<?php
$js=<<<JS
    $(".cate_tr").click(function() {
        // 找到当前行，更改图标
     $(this).find("span").toggleClass("glyphicon-eye-open");
     $(this).find("span").toggleClass("glyphicon-eye-close");
     // 根据左右值
        var obj = $(this);
        var data_lft = obj.attr('data_lft');
        var data_rgt = obj.attr('data_rgt');
        var data_tree = obj.attr('data_tree');
        $(".cate_tr").each(function(i,v) {
          var lft = $(v).attr('data_lft');
          var rgt = $(v).attr('data_rgt');
          var tree = $(v).attr('data_tree');
          // console.log(lft,data_rgt,data_lft,data_tree,rgt,tree);
          // 判断左值右值与树的关系
          if(tree==data_tree && lft-data_lft>0 && rgt-data_rgt<0){
               // console.log(lft,data_rgt,data_lft,data_tree,rgt,tree);
              // 找到该类下面的样式       
            if(obj.find("span").hasClass('glyphicon-eye-open')){
                obj.removeClass('glyphicon-eye-open');
                obj.addClass('glyphicon-eye-close');
                $(v).hide();      
            }else {
                // console.debug(123);
                 obj.removeClass('glyphicon-eye-close');
                obj.addClass('glyphicon-eye-open');
                  $(v).show();
               
            }       
        }
        })
        })
       
$("#allSelected").click(function () {
$("input").prop('checked',true);
})
$("#all").click(function () {
$("input").prop('checked',function() {
  this.checked = !this.checked;
});
})
$("#selDel").click(function () {
    if(confirm("你确定要一起删除吗?")){
    $(".cate_tr").each(function(i,v) { 
        // 判断选中的对象当中的checked值
      if($(v).find('input').prop('checked')==true){
         // 获取text 文本
         var id = $(v).find("[title='id']").text();
      
         $.getJSON(' http://admin.yii.cn/category/del',{id:id},function() {
           // $(v).hide();
         })
      }
    })
    }
});
JS;
$this->registerJs($js);
?>
