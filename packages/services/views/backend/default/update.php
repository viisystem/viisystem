<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\packages\services\models\Services */

$this->title = Yii::t('services', 'Update Services') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('services', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="services-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
