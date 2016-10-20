<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('account', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->displayName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('account', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->displayName, 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('account', 'Update');
?>
<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
