<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\packages\banner\models\Banner */

$this->title = Yii::t('banner', 'Update Banner') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Banner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="banner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
