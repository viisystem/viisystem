<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<style type="text/css">
	.form-control { height:auto; }
</style>
<?php $form = ActiveForm::begin([
	'id' => 'login-form',
	'action' =>['/account/backend/auth/login'],
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
<?php ActiveForm::end(); ?>
