<?php

use vii\helpers\Html;
use vii\grid\GridView;
use vii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\packages\category\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

$pjaxId = 'category-pjax';
$gridId = 'category-grid';
?>
<div class="category-index">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
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
                'columns' => [
                    ['class' => 'vii\grid\SerialColumn'],
                    ['class' => 'vii\grid\CheckboxColumn'],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function($data) {
                            return Html::a(Html::encode($data->title), ['view', 'id' => $data->getId()], ['data-pjax' => 0]);
                        }
                    ],
                    ['class' => 'vii\grid\BooleanColumn', 'attribute' => 'is_active'],
                    ['class' => 'vii\grid\LanguageColumn'],
                    [
                        'class' => 'vii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'headerOptions' => ['class' => 'hidden-md-down hidden-print w-100']
                    ]
                ]
            ]) ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <p>

    </p>

</div>
