<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key') ?>

    <?= $form->field($model, 'root') ?>

    <?= $form->field($model, 'lft') ?>

    <?= $form->field($model, 'rgt') ?>

    <?= $form->field($model, 'depth') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_extra') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'classes') ?>

    <?= $form->field($model, 'skin') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'meta_title') ?>

    <?= $form->field($model, 'meta_keyword') ?>

    <?= $form->field($model, 'meta_description') ?>

    <?= $form->field($model, 'is_active') ?>

    <?= $form->field($model, 'is_promotion') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'source_language_id') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('category', 'Create') : Yii::t('category', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
