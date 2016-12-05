<?php

use vii\helpers\DataHelper;
use vii\helpers\Url;
use vii\widgets\ActiveForm;
use vii\widgets\Select;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */

$gridId = 'category-grid';
$controllerId = Yii::$app->controller->controllerId;
?>

<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="tabs-container">
        <div class="pull-right">
            <a class="btn btn-info" href="<?= Url::to(['index']) ?>"><?= Yii::t('common', 'Cancel') ?></a>
            <button class="btn btn-primary" type="submit" value="back" name="action"><?=  Yii::t('common', 'Save') ?></button>
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#form-general"><?= Yii::t('common', 'General') ?></a></li>
        </ul>
        <div class="tab-content">
            <div id="form-general" class="tab-pane active">
                <div class="panel-body">
                    <?= $form->field($model, 'language')->widget(Select::className(), ['data' => DataHelper::getLanguageOptions()]) ?>

                    <?= $form->field($model, 'key') ?>

                    <?= $form->field($model, 'title') ?>

                    <?= $form->field($model, 'is_active')->widget(Select::className()) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

