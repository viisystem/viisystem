<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<!--=== Content Part ===-->
<div class="container">
	<!--Reg Block-->
	<div class="reg-block">
		<div class="reg-block-header">
			<h2>Đăng Ký</h2>
			<?= \vii\widgets\MyAuthChoice::widget([
			    'baseAuthUrl' => ['/account/frontend/default/auth'],
			    'containerItemOption' => [
			    	'class' => 'social-icons text-center'
			    ]
			]) ?>
			<p>Bạn đã có tài khoản? Click <a class="color-green" href="<?= Url::to(['/account/frontend/default/login']); ?>">Đăng nhập</a> để đăng nhập tài khoản của bạn.</p>
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
		<?= str_replace('{icon}', '<span class="input-group-addon"><i class="fa fa-user"></i></span>', $form->field($model, 'username')->textInput(['placeholder'=>'Tài khoản', 'class' => 'form-control'])) ?>
		<?= str_replace('{icon}', '<span class="input-group-addon"><i class="fa fa fa-phone"></i></span>', $form->field($model, 'phone[mobile]')->textInput(['placeholder'=>'Số điện thoại', 'class' => 'form-control'])) ?>
		<?= str_replace('{icon}', '<span class="input-group-addon"><i class="fa fa-envelope"></i></span>', $form->field($model, 'emails[0][address]')->textInput(['placeholder'=>'Email', 'class' => 'form-control'])) ?>
		<?= str_replace('{icon}', '<span class="input-group-addon"><i class="fa fa-lock"></i></span>', $form->field($model, 'password')->passwordInput(['placeholder'=>'Mật khẩu', 'class' => 'form-control'])) ?>
		<?= str_replace('{icon}', '<span class="input-group-addon"><i class="fa fa-key"></i></span>', $form->field($model, 'confirm_password')->passwordInput(['placeholder'=>'Xác nhận mật khẩu', 'class' => 'form-control'])) ?>
		<hr>

			<!-- <div class="checkbox">
				<label>
					<input type="checkbox">
					I read <a target="_blank" href="page_terms.html">Terms and Conditions</a>
				</label>
			</div> -->

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<button type="submit" class="btn-u btn-block">Đăng ký</button>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
		</div>
		<!--End Reg Block-->
	</div><!--/container-->
	<!--=== End Content Part ===-->