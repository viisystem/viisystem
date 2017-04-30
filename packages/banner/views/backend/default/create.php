<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\packages\banner\models\Banner */

$this->title = Yii::t('banner', 'Create Banner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Banner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
