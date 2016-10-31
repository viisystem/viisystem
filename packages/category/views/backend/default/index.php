<?php

use vii\helpers\Html;

use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\packages\category\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <p>
        <?= Html::a(Yii::t('category', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
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
