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
					<div>
						<?php $form = ActiveForm::begin(); ?>

						<?= $form->field($model, 'username') ?>

						<?= $form->field($model, 'password')->passwordInput() ?>

						<?= $form->field($model, 'name') ?>

						<?= $form->field($model, 'birth_date') ?>

						<?= $form->field($model, 'gender') ?>

						<?= $form->field($model, 'emails') ?>

						<?= $form->field($model, 'addresses') ?>

						<?= $form->field($model, 'description') ?>

						<?= $form->field($model, 'auth_key') ?>

						<?= $form->field($model, 'token') ?>

						<?= $form->field($model, 'created_date') ?>

						<?= $form->field($model, 'updated_date') ?>

						<?= $form->field($model, 'last_login_datetime') ?>

						<?= $form->field($model, 'data') ?>

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
