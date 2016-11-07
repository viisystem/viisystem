<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */

$this->title = Yii::t('category', 'Update Category') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => (string) $model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
