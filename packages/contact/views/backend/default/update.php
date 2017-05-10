<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\packages\article\models\Article */

$this->title = Yii::t('article', 'Update Article') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
