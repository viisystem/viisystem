<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?= Html::encode($this->title) ?></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<?php $form = ActiveForm::begin(); ?>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'username') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'password')->passwordInput() ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<?= $form->field($model, 'name[prefix]')->label(Yii::t('account', 'Prefix')) ?>
								</div>
								<div class="col-md-3">
									<?= $form->field($model, 'name[first]')->label(Yii::t('account', 'First Name')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'name[middle]')->label(Yii::t('account', 'Middle Name')) ?>
								</div>
								<div class="col-md-3">
									<?= $form->field($model, 'name[last]')->label(Yii::t('account', 'Last Name')) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'gender')->radioList([
										'male' => Yii::t('account', 'Male'),
										'female' => Yii::t('account', 'Female'),
										'secret' => Yii::t('account', 'I wouldn\'t tell'),
									])->label('') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'birth_date')->widget(kartik\widgets\DatePicker::className(),[
										'type' => kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
										'language' => Yii::$app->language,
									]) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'description')->textarea(['rows'=>6]) ?>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'emails[0][address]')->widget(\yii\widgets\MaskedInput::className(),[
										'options' => [
											'id'=>'email_id_1',
											'class'=>'form-control',
										],
										'clientOptions' => [ 'alias' => 'email' ],
									])->label(Yii::t('account', 'Email')) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<?= $form->field($model, 'phone[home]')->label(Yii::t('account', 'Home Phone')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'phone[mobile]')->label(Yii::t('account', 'Mobile Phone')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'phone[working]')->label(Yii::t('account', 'Office Phone')) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<?= $form->field($model, 'addresses[0][type]')->label(Yii::t('account', 'Addres Type')) ?>
								</div>
								<div class="col-md-9">
									<?= $form->field($model, 'addresses[0][street]')->label(Yii::t('account', 'Street')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'addresses[0][city]')->label(Yii::t('account', 'City')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'addresses[0][state]')->label(Yii::t('account', 'State')) ?>
								</div>
								<div class="col-md-2">
									<?= $form->field($model, 'addresses[0][zip]')->label(Yii::t('account', 'Zip')) ?>
								</div>
								<div class="col-md-2">
									<?= $form->field($model, 'addresses[0][country]')->label(Yii::t('account', 'Country')) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?= $form->field($model, 'token') ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<?= $form->field($model, 'addresses[0][type]')->label(Yii::t('account', 'Addres Type')) ?>
								</div>
								<div class="col-md-9">
									<?= $form->field($model, 'addresses[0][street]')->label(Yii::t('account', 'Street')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'addresses[0][city]')->label(Yii::t('account', 'City')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'addresses[0][state]')->label(Yii::t('account', 'State')) ?>
								</div>
								<div class="col-md-2">
									<?= $form->field($model, 'addresses[0][zip]')->label(Yii::t('account', 'Zip')) ?>
								</div>
								<div class="col-md-2">
									<?= $form->field($model, 'addresses[0][country]')->label(Yii::t('account', 'Country')) ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" style="text-align:center">
						<?= Html::submitButton($model->isNewRecord ? Yii::t('account', 'Create') : Yii::t('account', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>