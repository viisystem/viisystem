<?php

use vii\helpers\Html;
use vii\widgets\ActiveForm;
use vii\widgets\Select;

/* @var $this yii\web\View */
/* @var $model app\packages\contact\models\ContactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-search collapse <?= isset($_GET['ContactSearch']) ? 'in' : '' ?>" id="panel-fiter">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'default'
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'fullname') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <div class="row hidden">
        <div class="col-md-6">
            <?php  echo $form->field($model, 'created_at') ?>
        </div>
        <div class="col-md-6">
            <?php  echo $form->field($model, 'updated_at') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('blog', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('blog', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
