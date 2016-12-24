<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\packages\blog\models\Blog */

$this->title = Yii::t('blog', 'Translate Blog') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['update', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Translate');
?>
<div class="blog-translate">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
