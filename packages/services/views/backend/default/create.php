<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\packages\services\models\Services */

$this->title = Yii::t('services', 'Create Services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('services', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
