<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\packages\blog\models\Blog */

$this->title = Yii::t('blog', 'Create Blog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
