<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'key') ?>

    <?= $form->field($model, 'root') ?>

    <?= $form->field($model, 'lft') ?>

    <?= $form->field($model, 'rgt') ?>

    <?php // echo $form->field($model, 'depth') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'title_extra') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'classes') ?>

    <?php // echo $form->field($model, 'skin') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'meta_title') ?>

    <?php // echo $form->field($model, 'meta_keyword') ?>

    <?php // echo $form->field($model, 'meta_description') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_promotion') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'source_language_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('category', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('category', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
