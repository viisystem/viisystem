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
		<h1 class="pull-left">Bảng chi tiết lịch trả nợ ngân hàng <?= $bank ?> với dư nợ giảm dần</h1>
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
				<ul class="list-unstyled text-left" style="padding: 0; margin-bottom: 0;">
					<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> <i>Lãi suất ưu đãi là lãi suất tại thời điểm bắt đầu kí kết hợp đồng tín dụng giữa ngân hàng với khách hàng.</i></li>
					<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> <i>Lãi suất thường là lãi suất tham khảo khi hết lãi suất ưu đãi. Trong từng ngân hàng, có thể có sự chênh lệch lãi suất đối với với từng khách hàng, từng chi nhánh.</i></li>
					<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> <i>Gốc, lãi tối đa  tính theo nguyên tắc dư nợ giảm dần</i></li>
				</ul>
			</div>
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Kỳ Thanh Toán</th>
						<th>Lãi tối đa/tháng (VNĐ)</th>
						<th>Gốc trả góp (VNĐ)</th>
						<th>Gốc + lãi tối đa (VNĐ)</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0; $total = 0; $interest_rate = 0;
					for ($i = $time; $i > 0; $i--): ?>
						<?php
							$current_price = $money / $time;
							$money_rate = ($money - ($current_price * $stt)) * (($rate / 100) / 12);
							$total += round($current_price);
							$interest_rate += round($money_rate);
						?>
						<tr>
							<td><?= $stt + 1 ?></td>
							<td><?= Yii::$app->formatter->format(round($money_rate), ['decimal', 0]); ?></td>
							<td><?= Yii::$app->formatter->format(round($current_price), ['decimal', 0]); ?></td>
							<td><?= Yii::$app->formatter->format(round($money_rate) + round($current_price), ['decimal', 0]); ?></td>
						</tr>
					<?php $stt++; endfor; ?>
				</tbody>
				<tfoot>
					<tr>
						<th>Tổng cộng</th>
						<th><?= Yii::$app->formatter->format($interest_rate, ['decimal', 0]); ?></th>
						<th><?= Yii::$app->formatter->format($total, ['decimal', 0]); ?></th>
						<th><?= Yii::$app->formatter->format($total + $interest_rate, ['decimal', 0]); ?></th>
					</tr>
				</tfoot>
			</table>
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container-->
<!--=== End Content Part ===-->
<?php
	$this->registerJs("
		FancyBox.initFancybox();
	", yii\web\View::POS_READY);
?>	