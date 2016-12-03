<?php

use vii\helpers\Html;
use vii\helpers\Url;
use vii\grid\GridView;
use vii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\packages\blog\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Blogs');
$this->params['breadcrumbs'][] = $this->title;

$pjaxId = 'blog-pjax';
$gridId = 'blog-grid';
?>
<div class="blog-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="ibox-title-lft">
                        <div class="dropdown dropdown-inline">
                            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">
                                <?= Yii::t('common', 'Actions') ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:" onclick="jurakit.grid.bulkAction('<?= $gridId ?>', '<?= Url::to(['bulk-active-on']) ?>')"><?= Yii::t('common', 'Active') ?></a></li>
                                <li><a class="dropdown-item" href="javascript:" onclick="jurakit.grid.bulkAction('<?= $gridId ?>', '<?= Url::to(['bulk-active-off']) ?>')"><?= Yii::t('common', 'Inactive') ?></a></li>
                                <li class="divider"></li>
                                <li><a class="dropdown-item" href="javascript:" onclick="jurakit.grid.bulkDelete('<?= $gridId ?>', '<?= Url::to(['bulk-delete']) ?>')"><?= Yii::t('common', 'Delete') ?></a></li>
                            </ul>
                        </div>

                        <a class="btn btn-info" href="javascript:"><i class="fa fa-filter"></i></a>
                    </div>
                    <div class="ibox-title-rgt">
                        <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="ibox-content">
                    <?php Pjax::begin(['id' => $pjaxId, 'enablePushState' => false]); ?>
                    <?= GridView::widget([
                        'id' => $gridId,
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            ['class' => 'vii\grid\CheckboxColumn'],
                            ['class' => 'vii\grid\ImageColumn'],
                            'title',
                            // 'category',
                            // 'excerpt',
                            // 'content',
                            // 'seo_title',
                            // 'seo_keyword',
                            // 'seo_description',
                            // 'tags',
                            // 'skin',
                            // 'sort',
                            // 'is_promotion',
                            // 'is_active',
                            // 'created_at',
                            // 'created_by',
                            // 'updated_at',
                            // 'updated_by',
                            // 'language',
                            // 'source_id',

                            ['class' => 'vii\grid\BooleanColumn', 'attribute' => 'is_promotion'],
                            ['class' => 'vii\grid\BooleanColumn', 'attribute' => 'is_active'],
                            ['class' => 'vii\grid\LanguageColumn'],
                            [
                                'class' => 'vii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'headerOptions' => ['class' => 'hidden-md-down hidden-print w-100']
                            ]
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
