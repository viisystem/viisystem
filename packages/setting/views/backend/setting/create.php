<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\packages\setting\models\Setting */

$this->title = Yii::t('setting', 'Create Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('setting', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
