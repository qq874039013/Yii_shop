<div><div class="pull-left"><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success">添加</a></div><div class="pull-right"> <form class="form-inline">
            <div class="form-group">
                <div class="btn-group">
                    <select class="form-control" size=""  name="status" value="<?=Yii::$app->request->get('status')?>">
                        <option value="">
                            请选择分类
                        </option>
                            <option value=0>
                        下架
                        </option>
                        <option value=1>
                            上架
                        </option>
                    </select>
                </div>
                <input type="text" class="form-control" size="2" name='minPrice' placeholder="最低价" value="<?=Yii::$app->request->get('minPrice')?>">
            </div>
            ---
            <div class="form-group">
                <input type="text" class="form-control" size="2" name='maxPrice' placeholder="最高价" value="<?=Yii::$app->request->get('maxPrice')?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" size="5" name='sn' placeholder="货号 名称" value="<?=Yii::$app->request->get('sn')?>">
                <div class="btn-group">
                    <select class="form-control" size=""  name="brands" value="<?=Yii::$app->request->get('brands')?>">
                        <option value="">
                            请选择分类
                        </option>
                        <?php foreach ($brands as $brand):?>
                        <option value="<?=$brand->id?>">
                            <?=$brand->name?>
                        </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form></div></div>
<table class="table table-responsive">
    <caption><h3>商品列表</h3></caption>
    <tr>
        <td>编号</td>
        <td>商品名称</td>
        <td>商品排序</td>
        <td>货号</td>
        <td>库存</td>
        <td>商品分类</td>
        <td>商品logo</td>
        <td>品牌分类</td>
        <td>商品状态</td>
        <td>商场价格</td>
        <td>本店价格</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    <?php const STATUS=['隐藏','显示'];foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->sort?></td>
            <td><?=$model->sn?></td>
            <td><?=$model->stock?></td>
            <td></td>
            <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50])?></td>
            <td><?=$model->brand->name?></td>
            <td><?=STATUS[$model->is_on_sale]?></td>
            <td><?=$model->market_price?></td>
            <td><?=$model->shop_price?></td>
            <td><?=$model->inputtime?></td>
        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pageObj])?>
