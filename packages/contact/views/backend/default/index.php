<?php

use vii\helpers\Html;
use vii\helpers\Url;
use vii\grid\GridView;
use vii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\packages\contact\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('contact', 'Contact');
$this->params['breadcrumbs'][] = $this->title;

$pjaxId = 'contact-pjax';
$gridId = 'contact-grid';
?>
<div class="contact-index">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="ibox-title-lft">
                <div class="dropdown dropdown-inline">
                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">
                        <?= Yii::t('common', 'Actions') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:" onclick="jurakit.grid.bulkDelete('<?= $gridId ?>', '<?= Url::to(['bulk-delete']) ?>')"><?= Yii::t('common', 'Delete') ?></a></li>
                    </ul>
                </div>
                <a class="btn btn-info" data-toggle="collapse" href="#panel-fiter"><i class="fa fa-filter"></i></a>
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
                    'fullname',
                    'email',
                    'phone',
                    ['class' => 'vii\grid\LanguageColumn'],
                    [
                        'class' => 'vii\grid\ActionColumn',
                        'template' => '{view} {delete}',
                        'headerOptions' => ['class' => 'hidden-md-down hidden-print w-100']
                    ]
                ]
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
