<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\packages\blog\models\Blog */

$this->title = Yii::t('blog', 'Update {modelClass}: ', [
    'modelClass' => 'Blog',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'Update');
?>
<div class="blog-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
