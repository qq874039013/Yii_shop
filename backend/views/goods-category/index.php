<table class="table">
    <tr>
        <td>选项</td>
        <td>编号</td>
        <td>商品分类</td>
        <td>上级分类</td>
        <td>左对齐</td>
        <td>右对齐</td>
        <td>顶级</td>
        <td>介绍</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><C</td>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>

        <td><?=$model->parent_id?></td>
        <td><?=$model->left?></td>
        <td><?=$model->right?></td>
        <td><?=$model->level?></td>
        <td><?=$model->intro?></td>
        <td>操作</td>
</tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pagObj])?>