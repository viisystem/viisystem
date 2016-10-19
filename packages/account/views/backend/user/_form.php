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
					<div class="row">
						<?php $form = ActiveForm::begin(); ?>
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
								<div class="col-md-4">
									<?= $form->field($model, 'name[first]')->label(Yii::t('account', 'First Name')) ?>
								</div>
								<div class="col-md-4">
									<?= $form->field($model, 'name[middle]')->label(Yii::t('account', 'Middle Name')) ?>
								</div>
								<div class="col-md-4">
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

						
						<?= $form->field($model, 'description') ?>

						
						</div>
						<div class="col-md-6">
							<?= $form->field($model, 'emails')->widget(\yii\widgets\MaskedInput::className(),[
								'clientOptions' => [
									'alias' =>  'email'
								],
							]) ?>
							<?= $form->field($model, 'addresses') ?>



							<?= $form->field($model, 'auth_key') ?>

							<?= $form->field($model, 'token') ?>

							<?= $form->field($model, 'data') ?>
						</div>
					</div>

						<div class="form-group">
							<?= Html::submitButton($model->isNewRecord ? Yii::t('account', 'Create') : Yii::t('account', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
						</div>

						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
