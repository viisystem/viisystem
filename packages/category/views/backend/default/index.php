<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\packages\category\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('category', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'jurakit.grid\SerialColumn'],
            ['class' => 'jurakit.grid\CheckboxColumn'],
            'title',
            ['class' => 'jurakit.grid\BooleanColumn', 'attribute' => 'is_active'],
            ['class' => 'jurakit.grid\LanguageColumn'],
            [
                'class' => 'jurakit.grid\ActionColumn',
                'template' => '{update} {delete}',
            ]
        ]
    ]) ?>
    <?php Pjax::end(); ?>
</div>
