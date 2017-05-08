<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<!--== Content Part ===-->
<div class="container">
	<!--Reg Block-->
	<div class="reg-block">
		<div class="reg-block-header">
			<h2>Đăng nhập</h2>
			<?= \vii\widgets\MyAuthChoice::widget([
			    'baseAuthUrl' => ['/account/frontend/default/auth'],
			    'containerItemOption' => [
			    	'class' => 'social-icons text-center'
			    ]
			]) ?>
			<p>Bạn chưa có tài khoản? Click <a class="color-green" href="<?= Url::to(['/account/frontend/default/register']); ?>">Đăng ký</a> để tạo tài khoản.</p>
		</div>
		<?php $form = ActiveForm::begin([
			'id' => 'login-form',
			'options'=>[
				'class' => 'm-t',
			],
			//'layout' => 'horizontal',
			'fieldConfig' => [
				'template' => "<div class='input-group margin-bottom-20'>{icon}{input}</div>{error}",
				'labelOptions' => ['class' => 'col-lg-1 control-label'],
			],
		]); ?>
		
		
		<?= str_replace('{icon}', '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>', $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'Tài khoản'])) ?>

		<?= str_replace('{icon}', '<span class="input-group-addon"><i class="fa fa-lock"></i></span>', $form->field($model, 'password')->passwordInput(['placeholder'=>'Mật khẩu'])) ?>

		<hr>

		<!-- <div class="checkbox">
			<label>
				<input type="checkbox">
				<p>Always stay signed in</p>
			</label>
		</div> -->

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<button type="submit" class="btn-u btn-block">Đăng nhập</button>
			</div>
		</div>
		<?php ActiveForm::end(); ?>
	</div>
	<!--End Reg Block-->
</div><!--/container-->
<!--=== End Content Part ===-->