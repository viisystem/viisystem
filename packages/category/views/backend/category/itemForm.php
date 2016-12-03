<?php

use vii\helpers\Html;
use vii\widgets\ActiveForm;
use vii\widgets\Select;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]) ?>

    <div class="modal-scroll-form">
        <div class="p-20 p-15-xs-down">

            <?= $form->field($model, 'title') ?>

            <?= $form->field($model, 'slug') ?>

        </div>
    </div>

    <div class="form-ctrl">
        <?= Html::submitButton(Yii::t('common', ($model->isNewRecord ? 'Save' : 'Update')), ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>

