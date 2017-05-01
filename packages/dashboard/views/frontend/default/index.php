<?php
use yii\helpers\Url;
?>
<!--=== Slider ===-->
<div class="tp-banner-container">
	<div class="tp-banner">
		<ul>
			<?= app\packages\banner\widgets\Banner::widget(); ?>
		</ul>
		<div class="tp-bannertimer tp-bottom"></div>
	</div>
</div>
<!--=== End Slider ===-->

<!-- Services Section -->
<section id="services">
	<div class="container content-lg">
		<div class="title-v1">
			<h2>dịch vụ</h2>
			<p style="font-size: 16px;">Bằng việc ứng dụng công nghệ cùng đội ngũ nhân viên chuyên nghiệp, <strong>FindBank</strong> không chỉ mang đến cho khách hàng thông tin chi tiết về các sản phẩm của ngân hàng, mà còn giúp người vay vay được tiền <strong>nhanh hơn</strong>, <strong>thuận tiện hơn</strong></p>
		</div>

		<div class="row service-box-v1">
			<a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'vay-mua-nha']); ?>">
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="service-block service-block-default">
						<i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-home"></i>
						<h2 class="heading-md">Vay Mua Nhà</h2>
						<ul class="list-unstyled text-left" style="padding: 0;">
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Thời gian vay tối đa 180 tháng</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Lãi suất ưu đãi 7,5%/năm</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Số tiền vay tối đa 70% giá trị TSĐB</li>
						</ul>
					</div>
				</div>
			</a>
			<a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'vay-mua-o-to']); ?>">
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="service-block service-block-default">
						<i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-car"></i>
						<h2 class="heading-sm">Vay Mua Ô Tô</h2>
						<ul class="list-unstyled text-left" style="padding: 0;">
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Thời gian vay tối đa 84 tháng</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Lãi suất ưu đãi, cạnh tranh</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Số tiền vay tối đa lên đến 90% giá trị xe</li>
						</ul>
					</div>
				</div>
			</a>
			<a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'vay-tin-chap-tieu-dung']); ?>">
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="service-block service-block-default">
						<i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-money"></i>
						<h2 class="heading-sm">Vay Tín Chấp Tiêu Dùng</h2>
						<ul class="list-unstyled text-left" style="padding: 0;">
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Thủ tục vay đơn giản, linh hoạt</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Không cần tài sản bảo đảm</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Lãi suất ưu đãi, số tiền vay lên đến 300 triệu</li>
						</ul>
					</div>
				</div>
			</a>
			<a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'the-tin-dung']); ?>">
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="service-block service-block-default">
						<i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-credit-card"></i>
						<h2 class="heading-sm">Thẻ Tín Dụng</h2>
						<ul class="list-unstyled text-left" style="padding: 0;">
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Thủ tục đơn giản, linh hoạt</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Hạn mức rút tiền mặt lên đến 100% hạn mức tín dụng</li>
							<li style="margin: 0; font-size: 13px; border-top: 0;"><i class="fa fa-check color-green"></i> Miễn phí rút tiền mặt tại ATM</li>
						</ul>
					</div>
				</div>
			</a>
		</div>
	</div>
</section>
<!-- End Services Section -->

<!--=== Content Part ===-->
<!--=== Service Block v4 ===-->
<div class="service-block-v4">
	<div class="container content-sm">
		<!-- Owl Clients v1 -->
	<div class="headline"><h2>ĐỐI TÁC TÀI CHÍNH</h2></div>
	<div class="owl-clients-v1 margin-bottom-30">
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/techcombank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/acb.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/mb.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/agribank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/bidv.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/vietcom.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/vpbank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/abbank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/hdbank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/gpbank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/oceanbank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/martimebank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/viettinbank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/tpbank.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/anz.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/ocb.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/donga.png', '', ['class' => 'img-responsive']); ?>
		</div>
		<div class="item">
			<?= Yii::$app->imageCache->img($this->theme->basePath . '/assets/publish/logo-bank/scb.png', '', ['class' => 'img-responsive']); ?>
		</div>
	</div>
	<!-- End Owl Clients v1 -->
	</div><!--/container-->
	<!-- End Content Part -->
</div>
<!--=== End Service lock v4 ===-->

<div class="container content-sm">
	<!-- Recent Works -->
	<div class="headline"><h2>Tin Tức</h2></div>
	<div class="row margin-bottom-20">
		<?= \app\packages\article\widgets\Articles::widget([
			'settings' => [
				'params' => [
					[
						'name' => 'type',
						'value' => 'promotion',
					],
					[
						'name' => 'view',
						'value' => 'article-post',
					],
				]
			]
		]); ?>
	</div>
	<!-- End Recent Works -->
</div><!--/end container-->