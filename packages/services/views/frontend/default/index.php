<?php
use yii\bootstrap\ActiveForm;
use app\packages\services\bundles\ServicesAsset;
use yii\widgets\MaskedInput;
use miloschuman\highcharts\Highcharts;
use vii\helpers\ArrayHelper;

ServicesAsset::register($this); 
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">So sánh <?= strtolower($serviceName) ?></h1>
		<ul class="pull-right breadcrumb">
			<li><a href="index.html">Trang Chủ</a></li>
			<li class="active">Dịch vụ</li>
		</ul>
	</div>
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!--=== Content Part ===-->
<div class="container content">
	<div class="row margin-bottom-30">
		<div class="col-md-12 mb-margin-bottom-30">
			<div class="tag-box tag-box-v3">
				<ul class="list-unstyled text-justify" style="padding: 0; margin-bottom: 0;">
					<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> <i>Lãi suất ưu đãi là lãi suất tại thời điểm bắt đầu kí kết hợp đồng tín dụng giữa ngân hàng với khách hàng.</i></li>
					<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> <i>Lãi suất thường là lãi suất tham khảo khi hết lãi suất ưu đãi. Trong từng ngân hàng, có thể có sự chênh lệch lãi suất đối với với từng khách hàng, từng chi nhánh.</i></li>
					<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> <i>Gốc, lãi tối đa  tính theo nguyên tắc dư nợ giảm dần</i></li>
				</ul>
			</div>
			<?php $form = ActiveForm::begin(['id' => 'sky-form3', 'options' => ['class' => 'sky-form contact-style']]); ?>
				<fieldset class="no-padding">
					<label>Bạn muốn vay bao nhiêu? <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-0">
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
						<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-0">
							<div class="row">
								<div class="col-md-3 col-xs-5">
									<?= $form->field($model, 'borrow_time')->input('text', ['class' => 'form-control'])->label(false); ?>
								</div>
								<div class="col-md-9 col-xs-7" style="padding-top: 6px; padding-left: 0;"> Tháng</div>
							</div>
						</div>
					</div>

					<label>Họ và Tên <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-0">
							<div>
								<?= $form->field($model, 'fullname')->input('text', ['class' => 'form-control'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Email</label>
					<div class="row sky-space-20">
						<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-0">
							<div>
								<?= $form->field($model, 'email')->input('text', ['class' => 'form-control'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Điện Thoại <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-0">
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

			<?php if (\Yii::$app->request->post()): ?>
				<div class="headline"><h2>Kết quả So sánh <?= strtolower($serviceName) ?></h2></div>
				<!-- Tabs -->
				<div class="tab-v1" style="margin-top: 30px;">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#home-1" data-toggle="tab"><i class="fa fa-line-chart"></i> Biểu đồ</a></li>
						<li><a href="#profile-1" data-toggle="tab"><i class="fa fa-table"></i> Bảng</a></li>
					</ul>
					<div class="tab-content">
						<!-- Validation Forms -->
						<div class="tab-pane fade  in active" id="home-1">
							<?php
								$chartRateSpecial = ArrayHelper::getValue($arrBankChart, 'rate_special');
								$chartRate = ArrayHelper::getValue($arrBankChart, 'rate');
								$chartBorrowMoney = ArrayHelper::getValue($arrBankChart, 'borrow_money');
								$chartCurrentPrice = ArrayHelper::getValue($arrBankChart, 'current_price');
								$chartCurrentBorrow = ArrayHelper::getValue($arrBankChart, 'current_borrow');
								$arrDataRate = [];
								$arrBorrowMoney = [];

								$arrDataRate[0]['name'] = 'Lãi suất ưu đãi';
								foreach ($chartRateSpecial as $bank => $bank_rate_special) {
									$arrDataRate[0]['data'][] = (float)$bank_rate_special;
								}

								$arrDataRate[1]['name'] = 'Lãi suất thường';
								foreach ($chartRate as $bank => $bank_rate) {
									$arrDataRate[1]['data'][] = (float)$bank_rate;
								}

								$arrBorrowMoney[0]['name'] = 'Lãi tối đa/tháng';
								foreach ($chartBorrowMoney as $bank => $bank_borrow_money) {
									$arrBorrowMoney[0]['data'][] = (int)$bank_borrow_money;
								}

								$arrBorrowMoney[1]['name'] = 'Gốc trả góp';
								foreach ($chartCurrentPrice as $bank => $bank_current_price) {
									$arrBorrowMoney[1]['data'][] = (int)$bank_current_price;
								}

								$arrBorrowMoney[2]['name'] = 'Gốc + lãi tối đa';
								foreach ($chartCurrentBorrow as $bank => $bank_current_borrow) {
									$arrBorrowMoney[2]['data'][] = (int)$bank_current_borrow;
								}
							?>
							<?php if (!empty($arrDataRate)): ?>
							<?= 
								Highcharts::widget([
								   'options' => [
								      	'title' => ['text' => 'Biểu đồ so sánh lãi suất'],
								      	'xAxis' => [
								         	'categories' => array_keys($chartRateSpecial)
							      		],
								      	'yAxis' => [
								         	'title' => ['text' => 'Lãi suất (%)']
								      	],
								      	'series' => $arrDataRate,
								      	'credits' => [
								      		'enabled' => false
								      	]
								   ],
								   'htmlOptions' => [
								   		'style' => 'with: 100%;'
								   ]
								]);
							?>
							<?php endif; ?>
							<?php if (!empty($arrBorrowMoney)): ?>
							<?= 
								Highcharts::widget([
								   'options' => [
								      	'title' => ['text' => 'Biểu đồ so sánh lãi tối đa & gốc trả góp'],
								      	'xAxis' => [
								         	'categories' => array_keys($chartBorrowMoney)
							      		],
								      	'yAxis' => [
								         	'title' => ['text' => 'Số tiền (VNĐ)']
								      	],
								      	'series' => $arrBorrowMoney,
								      	'credits' => [
								      		'enabled' => false
								      	]
								   ],
								   'htmlOptions' => [
								   		'style' => 'with: 100%;'
								   ]
								]);
							?>
							<?php endif; ?>
						</div>
						<!-- End Validation Forms -->

						<!-- Datepicker Forms -->
						<div class="tab-pane fade" id="profile-1">
							<?= yii\widgets\ListView::widget([
				                'dataProvider' => $banks,
				                'viewParams' => ['services' => $model],
				                'itemView' => '_item_view',
				                'emptyText' => 'Không có tin tức nào trong danh mục này.',
				                'summary' => '',
				                'layout' => '<table class="table table-bordered table-responsive">
								<thead>
									<tr>
										<th>Ngân hàng</th>
										<th>Lãi suất ưu đãi</th>
										<th>Lãi suất thường</th>
										<th>Lãi tối đa/tháng (VNĐ)</th>
										<th>Gốc trả góp (VNĐ)</th>
										<th>Gốc + lãi tối đa (VNĐ)</th>
										<th></th>
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
						</div>
						<!-- End Datepicker Forms -->
					</div>
				</div>
				<!-- End Tabs-->
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