<?php
use yii\bootstrap\ActiveForm;
use app\packages\services\bundles\ServicesAsset;
use yii\widgets\MaskedInput;

ServicesAsset::register($this); 
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">So sánh <?= strtolower($serviceName) ?></h1>
		<ul class="pull-right breadcrumb">
			<li><a href="index.html">Trang Chủ</a></li>
			<li class="active">So sánh <?= strtolower($serviceName) ?></li>
		</ul>
	</div>
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!--=== Content Part ===-->
<div class="container content">
	<div class="row margin-bottom-30">
		<div class="col-md-12 mb-margin-bottom-30">
			<div class="headline"><h2>So sánh <?= strtolower($serviceName) ?></h2></div>

			<?php $form = ActiveForm::begin(['id' => 'sky-form3', 'options' => ['class' => 'sky-form contact-style']]); ?>
				<fieldset class="no-padding">
					<label>Bạn muốn vay bao nhiêu? <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
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
						</div>
					</div>

					<label>Bạn muốn vay bao lâu? <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<?= $form->field($model, 'borrow_time')->input('text', ['class' => 'form-control'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Họ và Tên <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<?= $form->field($model, 'fullname')->input('text', ['class' => 'form-control'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Email <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<?= $form->field($model, 'email')->input('text', ['class' => 'form-control'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Điện Thoại <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<?= $form->field($model, 'phone')->input('text', ['class' => 'form-control'])->label(false); ?>
							</div>
						</div>
					</div>

					<p><button type="submit" class="btn-u">Tìm ngân hàng tốt nhất</button></p>
				</fieldset>

				<div class="message">
					<i class="rounded-x fa fa-check"></i>
					<p>Your message was successfully sent!</p>
				</div>
			<?php ActiveForm::end(); ?>
			<p></p>
			<p>
				Lãi suất ưu đãi là lãi suất tại thời điểm bắt đầu kí kết hợp đồng tín dụng giữa ngân hàng với khách hàng.
			</p>
			<p>
				Lãi suất thường là lãi suất tham khảo khi hết lãi suất ưu đãi. Trong từng ngân hàng, có thể có sự chênh lệch lãi suất đối với với từng khách hàng, từng chi nhánh.
			</p>
			<p>
				Gốc, lãi tối đa  tính theo nguyên tắc dư nợ giảm dần
			</p>

			<?php if (\Yii::$app->request->post()): ?>
				<?= yii\widgets\ListView::widget([
	                'dataProvider' => $banks,
	                'viewParams' => ['services' => $model],
	                'itemView' => '_item_view',
	                'emptyText' => 'Không có tin tức nào trong danh mục này.',
	                'summary' => '',
	                'layout' => '<table class="table table-bordered" style="margin-top: 30px;">
					<thead>
						<tr>
							<th>Ngân hàng</th>
							<th class="hidden-sm">Lãi suất ưu đãi</th>
							<th class="hidden-sm">Lãi suất thường</th>
							<th>Lãi tối đa/tháng</th>
							<th>Gốc trả góp</th>
							<th>Gốc + lãi tối đa</th>
						</tr>
					</thead>
					<tbody>
						{items}
					</tbody>
					</table>{pager}',
					'pager' => array(
				        'maxButtonCount' => 1,
				        'nextPageLabel' => 'Trang tiếp theo &rarr;',
				        'prevPageLabel' => '&larr; Trang trước',
				        'class' => 'vii\grid\MyLinkPager',
				        'prevPageCssClass' => 'previous',
				        'pageCssClass' => 'page-amount',
				        'options' => [
				        	'class' => 'pager pager-v3 pager-sm no-margin-bottom'
				        ]
				    ),
	            ]); ?>
			<?php endif; ?>
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container-->
<!--=== End Content Part ===-->
<?php
	$this->registerJs("
		FancyBox.initFancybox();
	", yii\web\View::POS_READY);
?>	