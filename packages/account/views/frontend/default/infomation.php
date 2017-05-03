<?php
use app\themes\inspinia\frontend\assets\FrontendAsset;
$this->registerCssFile($this->theme->baseUrl . '/assets/publish/plugins/sky-forms-pro/skyforms/css/sky-forms.css', ['depends' => FrontendAsset::className()]);
$this->registerCssFile($this->theme->baseUrl . '/assets/publish/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css', ['depends' => FrontendAsset::className()]);
$this->registerCssFile($this->theme->baseUrl . '/assets/publish/css/pages/profile.css', ['depends' => FrontendAsset::className()]);
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!--=== Profile ===-->
<div class="container content profile">
	<div class="row">
		<!-- Profile Content -->
		<div class="col-md-12">
			<div class="profile-body margin-bottom-20">
				<?php if(Yii::$app->session->hasFlash('success')): ?>
				<div class="alert alert-success fade in">
					<strong><?= Yii::$app->session->getFlash('success') ?></strong>
				</div>
				<?php endif; ?>
				<div class="tab-v1">
					<ul class="nav nav-justified nav-tabs">
						<li class="active"><a data-toggle="tab" href="#profile"><i class="fa fa-user-circle" aria-hidden="true"></i> Thông tin cá nhân</a></li>
						<li><a data-toggle="tab" href="#passwordTab"><i class="icon-append fa fa-lock"></i> Thay đổi mật khẩu</a></li>
					</ul>
					<div class="tab-content">
						<div id="profile" class="profile-edit tab-pane fade in active">
							<?php $form = ActiveForm::begin([
								'options' => [
									'class' => 'sky-form'
								]
							]); ?>
							<dl class="dl-horizontal">
								<dd style="margin: 0;">
									<?= $form->field($model, 'name[first]')->label('Họ') ?>
									<?= $form->field($model, 'name[middle]')->label('Tên đệm') ?>
									<?= $form->field($model, 'name[last]')->label('Tên') ?>
								</dd>
								<hr>
								<dt><strong>Giới tính </strong></dt>
								<dd>
									<section>
									<?= $form->field($model, 'gender')->radioList([
										'male' => Yii::t('account', 'Male'),
										'female' => Yii::t('account', 'Female'),
									],[
		                                'item' => function($index, $label, $name, $checked, $value) {
		                                	$strCheck = null;
		                                	if ($checked)
		                                		$strCheck = 'checked=""';

		                                    $return = '<label class="radio">';
		                                    $return .= '<input ' . $strCheck . ' type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
		                                    $return .= '<i class="rounded-x"></i>';
		                                    $return .= ucwords($label);
		                                    $return .= '</label>';

		                                    return $return;
		                                },
		                                'class' => 'inline-group'
		                            ])->label('') ?>
		                            </section>
								</dd>
								<hr>
								<dt><strong>Email </strong></dt>
								<dd>
									<?= $form->field($model, 'emails[0][address]')->widget(\yii\widgets\MaskedInput::className(),[
										'options' => [
											'id'=>'email_id_1',
											'class'=>'form-control',
										],
										'clientOptions' => [ 'alias' => 'email' ],
									])->label(false) ?>
								</dd>
								<hr>
								<dt><strong>Ngày sinh </strong></dt>
								<dd>
									<?= $form->field($model, 'birth_date')->widget(kartik\widgets\DatePicker::className(),[
										'type' => kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
										'language' => Yii::$app->language,
									])->label(false) ?>
								</dd>
								<hr>
								<dt><strong>Số điện thoại</strong></dt>
								<dd>
									<?= $form->field($model, 'phone[mobile]')->label(false) ?>
								</dd>
								<hr>
							</dl>
							<button type="submit" class="btn-u">Lưu thay đổi</button>
							<?php ActiveForm::end(); ?>
						</div>

						<div id="passwordTab" class="profile-edit tab-pane fade">
							<?php $form = ActiveForm::begin([
								'options' => [
									'class' => 'sky-form'
								]
							]); ?>
								<dl class="dl-horizontal">
									<dt>Mật khẩu</dt>
									<dd>
										<section>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<?= $form->field($model, 'new_pass')->passwordInput()->label(false) ?>
											</label>
										</section>
									</dd>
									<dt>Nhật lại mật khẩu</dt>
									<dd>
										<section>
											<label class="input">
												<i class="icon-append fa fa-lock"></i>
												<?= $form->field($model, 'confirm_password')->passwordInput()->label(false) ?>
											</label>
										</section>
									</dd>
								</dl>
								<button class="btn-u" type="submit">Lưu thay đổi</button>
							<?php ActiveForm::end(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Profile Content -->
	</div><!--/end row-->
</div>
<!--=== End Profile ===-->