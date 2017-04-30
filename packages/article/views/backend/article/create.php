<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\packages\article\models\Article */

$this->title = Yii::t('article', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
