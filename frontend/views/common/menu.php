	<div class="category fl  <?=\Yii::$app->controller->id."/".\Yii::$app->controller->action->id=='home/index'?"":"cat1"?>""> <!-- 非首页，需要添加cat1类 -->
				<div class="cat_hd <?=\Yii::$app->controller->id."/".\Yii::$app->controller->action->id=='home/index'?"":"off"?>">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
					<h2>全部商品分类</h2>
					<em></em>
				</div>
				<div class="cat_bd <?=\Yii::$app->controller->id."/".\Yii::$app->controller->action->id=='home/index'?"":"none"?>">
                    <?php foreach(backend\models\Category::find()->where(['parent_id'=>0])->all() as $k1=>$v1){?>
					<div class="cat <?=$k1==0?"item1":""?>"">
						<h3><a href="<?=\yii\helpers\Url::to(['home/list','id'=>$v1->id])?>"><?=$v1->name?></a> <b></b></h3>
						<div class="cat_detail">
                       <?php foreach (backend\models\Category::find()->where(['parent_id'=>$v1->id])->all() as $k2=>$v2){?>
							<dl class="<?=$k2==0?"dl_1st":""?>">

								<dt><a href="<?=\yii\helpers\Url::to(['home/list','id'=>$v2->id])?>"><?=$v2->name?></a></dt>

								<dd>
                                    <?php foreach(backend\models\Category::find()->where(['parent_id'=>$v2->id])->all() as $k3=>$v3){?>
									<a href="<?=\yii\helpers\Url::to(['home/list','id'=>$v3->id])?>"><?=$v3->name?></a>
                              <?php  }?>
								</dd>

							</dl>

                             <?php
					}?>


						</div>
					</div>
           <?php  }?>


				</div>

			</div>

