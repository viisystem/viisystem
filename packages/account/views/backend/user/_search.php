<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'birth_date') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'emails') ?>

    <?php // echo $form->field($model, 'addresses') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'last_login_datetime') ?>

    <?php // echo $form->field($model, 'data') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('account', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('account', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
