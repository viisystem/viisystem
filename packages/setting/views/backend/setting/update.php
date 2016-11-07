<?php

/* @var $this yii\web\View */
/* @var $model app\packages\setting\models\Setting */

$this->title = Yii::t('setting', 'Update Setting') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('setting', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="setting-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
