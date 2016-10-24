<?php

use vii\helpers\Html;
use vii\widgets\ActiveForm;
use vii\widgets\Select;

/* @var $this yii\web\View */
/* @var $modelItem app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => $modelItem->formName(),
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>

    <div class="modal-scroll-form">
        <div class="layout-box">
            <div class="col-md-8 bdr-r height-auto">
                <div class="p-20 p-15-xs-down">

                    <?= $form->field($modelItem, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($modelItem, 'meta_title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($modelItem, 'meta_keyword')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($modelItem, 'meta_description')->textInput(['maxlength' => true]) ?>

                </div>
            </div>

            <div class="col-md-4 bg4">
                <div class="p-20 p-15-xs-down">

                    <?= $form->field($modelItem, 'slug')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($modelItem, 'classes')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($modelItem, 'is_active')->widget(Select::className()) ?>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="form-ctrl">
        <?= Html::submitButton(Yii::t('common', ($modelItem->isNewRecord ? 'Save' : 'Update')), ['class' => 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>

