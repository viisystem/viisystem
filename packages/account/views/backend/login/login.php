<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
	.form-control { height:auto; }
</style>
<div class="site-login" style="width:380px">
    <h2><?= Html::encode($this->title) ?></h2>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
		'options'=>[
			'class' => 'm-t',
		],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{input}",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'Username']) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "{input} {label}",
        ]) ?>

        <div class="form-group">
			<?= Html::submitButton('Login', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
        </div>
	
		<a href="#"><small>Forgot password?</small></a>
		<p class="text-muted text-center"><small>Do not have an account?</small></p>
		<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>

    <?php ActiveForm::end(); ?>
</div>