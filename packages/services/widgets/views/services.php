<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
?>
<?php $form = ActiveForm::begin(['action' => Url::to(['/services/frontend/default/index', 'slug' => $slug]), 'id' => 'sky-form', 'options' => ['class' => 'sky-form', 'style' => 'border: 0;']]); ?>
	<div class="row">
		<div class="form-group col-md-6">
		    <label for="exampleInputName2">Bạn muốn vay bao nhiêu? </label>
		    <?= $form->field($model, 'borrow_money')->widget(MaskedInput::className(), [
	            'clientOptions' => [
	                'alias' =>  'decimal',
	                'groupSeparator' => '.',
	                'radixPoint' => 'Globalize.culture().numberFormat["."]',
	                'autoGroup' => true,
	                'autoUnmask' => true,
	                'removeMaskOnSubmit' => true,
	                'rightAlign' => false,
	            ],
	        ])->label(false); ?>
		</div>

		<div class="form-group col-md-6">
		    <label for="exampleInputName2">Bạn muốn vay bao lâu? </label>
		    <div class="row">
			    <div class="col-md-10 col-xs-8">
					<?= $form->field($model, 'borrow_time')->input('text', ['class' => 'form-control'])->label(false); ?>
				</div>
				<div class="col-md-2 col-xs-4" style="padding-top: 6px; padding-left: 0;"> Tháng</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
		    <label class="checkbox"><input type="checkbox" name="is_borrow"><i></i>Chưa có nhu cầu vay</label>
		</div>
		<div class="col-md-6">
			<button type="submit" class="btn-u btn-u-blue pull-right" style="margin-right: 15px;">Tìm ngân hàng tốt nhất</button>
		</div>
	</div>
<?php ActiveForm::end(); ?>