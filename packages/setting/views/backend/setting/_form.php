<?php

use app\packages\setting\widgets\backend\SettingItems;

use vii\helpers\Html;
use vii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\packages\setting\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper wrapper-content">
    <div class="row m-b-sm">
        <div class="col-lg-6">
            <?php if (!$model->isNewRecord) : ?>
            <div class="btn-group">
                <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->getId()], ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Delete?");']) ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6">
            <div class="btn-group pull-right">
                <?= Html::a(Yii::t('common', 'Save'), 'javascript:', ['class' => 'btn btn-success', 'onclick' => '$("#form-setting").submit()']) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= Yii::t('setting', 'Information') ?></h5>
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'options' => [
                            'id' => 'form-setting'
                        ]
                    ]); ?>

                    <?php //= $form->field($model, 'tab_id') ?>

                    <?= $form->field($model, 'module')->hiddenInput()->label(false) ?>

                    <?= $form->field($model, 'type')->dropDownList($model->getTypeOptions(), ['disabled' => $model->isNewRecord ? false : true]) ?>

                    <?= $form->field($model, 'key') ?>

                    <?= $form->field($model, 'title') ?>

                    <?php //= $form->field($model, 'description') ?>

                    <?= $form->field($model, 'items')->widget(SettingItems::className()) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
