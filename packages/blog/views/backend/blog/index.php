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
                <a class="btn btn-info" data-toggle="collapse" href="#panel-fiter"><i class="fa fa-filter"></i></a>
            </div>
            <div class="ibox-title-rgt">
                <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="ibox-content">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
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
                    [
                        'attribute' => 'category',
                        'headerOptions' => ['class' => 'hidden-md-down w-160'],
                        'contentOptions' => ['class' => 'hidden-md-down w-160'],
                        'format' => 'raw',
                        'filter' => $searchModel->getCategory()->getOptions(),
                        'value' => function ($data) {
                            /* @var $data app\packages\blog\models\Blog */
                            return $data->getCategory()->getCategoriesText($data->category);
                        }
                    ],
                    ['class' => 'vii\grid\BooleanColumn', 'attribute' => 'is_promotion'],
                    ['class' => 'vii\grid\BooleanColumn', 'attribute' => 'is_active'],
                    ['class' => 'vii\grid\LanguageColumn'],
                    [
                        'class' => 'vii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'headerOptions' => ['class' => 'hidden-md-down hidden-print w-100']
                    ]
                ]
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
