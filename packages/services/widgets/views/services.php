<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
?>
<?php $form = ActiveForm::begin(['action' => Url::to(['/services/frontend/default/index', 'slug' => $slug]), 'id' => 'sky-form-' . $slug, 'options' => ['class' => 'sky-form', 'style' => 'border: 0;']]); ?>
	<div class="row" style="padding: 0 15px;">
		<div class="form-group has-feedback col-md-6 custom-feedback">
		  	<label class="control-label" for="inputSuccess2">Bạn muốn vay bao nhiêu?</label>
		  	<?= $form->field($model, 'borrow_money')->widget(MaskedInput::className(), [
		    	'options' => ['id' => uniqid(), 'class' => 'form-control'],
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
		  	<div class="form-control-feedback" aria-hidden="true">đ</div>
		</div>

		<div class="form-group has-feedback col-md-6 custom-feedback">
		    <label class="control-label"  for="exampleInputName2">Bạn muốn vay bao lâu? </label>
			<?= $form->field($model, 'borrow_time')->input('text', ['class' => 'form-control'])->label(false); ?>
			<div class="form-control-feedback" aria-hidden="true">tháng</div>
		</div>
	</div>

	<div class="form-group col-md-9 col-sm-8  col-xs-12">
	    <label class="checkbox"><input type="checkbox" name="is_borrow"><i></i>Chưa có nhu cầu vay, chỉ tham khảo lãi suất</label>
	</div>
	<div class="col-md-3 col-sm-4 col-xs-12">
		<button type="submit" class="btn-u btn-u-blue pull-right form-control">Tìm ngân hàng tốt nhất</button>
	</div>
<?php ActiveForm::end(); ?>