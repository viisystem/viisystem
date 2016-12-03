<?php

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */

$this->title = Yii::t('category', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
