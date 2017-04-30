<?php

use vii\helpers\Url;

use vii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use app\packages\banner\models\Banner;
use vii\widgets\Image;

/* @var $this yii\web\View */
/* @var $model app\packages\banner\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="tabs-container">
        <div class="pull-right">
            <a class="btn btn-info" href="<?= Url::to(['index']) ?>"><?= Yii::t('common', 'Cancel') ?></a>
            <button class="btn btn-primary" type="submit" value="save" name="action"><?=  Yii::t('common', 'Apply') ?></button>
            <button class="btn btn-primary" type="submit" value="back" name="action"><?=  Yii::t('common', 'Save') ?></button>
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#form-general"><?= Yii::t('common', 'General') ?></a></li>
        </ul>
        <div class="tab-content">
            <div id="form-general" class="tab-pane active">
                <div class="panel-body">
                    <?= $form->field($model, 'title') ?>
                    
                    <?= $form->field($model, 'link') ?>

                    <?= $form->field($model, 'sort') ?>

                    <?= $form->field($model, 'image_form')->widget(Image::className()) ?>

                    <?= $form->field($model, 'target')->widget(SwitchInput::className()) ?>

                    <?= $form->field($model, 'status')->widget(SwitchInput::className()) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
