<?php

use vii\helpers\Html;
use vii\widgets\ActiveForm;
use vii\widgets\Select;

/* @var $this yii\web\View */
/* @var $model app\packages\category\common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]) ?>

    <div class="modal-scroll-form">
        <div class="layout-box">
            <div class="col-md-8 bdr-r height-auto">
                <div class="p-20 p-15-xs-down">

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

                </div>
            </div>

            <div class="col-md-4 bg4">
                <div class="p-20 p-15-xs-down">

                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'classes')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'is_active')->widget(Select::className(), ['options' => ['id' => 'category_item-is_active']]) ?>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="form-ctrl">
        <?= Html::submitButton(Yii::t('common', ($model->isNewRecord ? 'Save' : 'Update')), ['class' => 'btn btn-normal pull-right']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>

