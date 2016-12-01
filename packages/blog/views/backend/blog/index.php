<?php

use vii\helpers\Html;
use vii\grid\GridView;
use vii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\packages\blog\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= Html::encode($this->title) ?></h5>
                    <div class="ibox-tools">
                        <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-xs btn-primary pull-right']) ?>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            ['class' => 'vii\grid\CheckboxColumn'],
                            ['class' => 'vii\grid\ImageColumn'],
                            'title',
                            //'cover',
                            // 'gallery',
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
