<?php
use yii\helpers\Url;
use app\themes\inspinia\frontend\assets\FrontendAsset;
?>
<?php

$this->registerCssFile($this->theme->baseUrl . '/assets/publish/plugins/layer-slider/layerslider/css/layerslider.css', ['depends' => FrontendAsset::className()]);
$this->registerCssFile($this->theme->baseUrl . '/assets/publish/plugins/layer-slider/layerslider/skins/fullwidth/skin.css', ['depends' => FrontendAsset::className()]);
$this->registerJsFile($this->theme->baseUrl . '/assets/publish/plugins/layer-slider/layerslider/js/greensock.js', ['depends' => FrontendAsset::className()]);
$this->registerJsFile($this->theme->baseUrl . '/assets/publish/plugins/layer-slider/layerslider/js/layerslider.transitions.js', ['depends' => FrontendAsset::className()]);
$this->registerJsFile($this->theme->baseUrl . '/assets/publish/plugins/layer-slider/layerslider/js/layerslider.kreaturamedia.jquery.js', ['depends' => FrontendAsset::className()]);
$this->registerJsFile($this->theme->baseUrl . '/assets/publish/js/plugins/layer-slider.js', ['depends' => FrontendAsset::className()]);
$this->registerJs("
    LayerSlider.initLayerSlider();
", yii\web\View::POS_READY);
$this->registerCss("
     @media screen and (min-width: 1800px) {
        .ls-hack-left {left:0!important; width:700px!important; height:auto!important}
     }
     
");

?>

<!--=== Slider ===-->
<div id="layerslider" style="width: 100%; height: 500px; margin: 0px auto;">
	<?= app\packages\banner\widgets\Banner::widget(); ?>
</div><!--/layer_slider-->
<!--=== End Slider ===-->

<!-- Services Section -->
<section id="services">
	<div class="container content-lg">
		<div class="title-v1">
			<h2>dịch vụ</h2>
			<p style="font-size: 16px;">Bằng việc ứng dụng công nghệ cùng đội ngũ nhân viên chuyên nghiệp, <strong>FindBank</strong> không chỉ mang đến cho khách hàng thông tin chi tiết về các sản phẩm của ngân hàng, mà còn giúp người vay vay được tiền <strong>nhanh hơn</strong>, <strong>thuận tiện hơn</strong></p>
		</div>

		<div class="row">
			<!-- <a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'vay-mua-nha']); ?>">
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
			</a> -->
			<div class="container">
				<!-- Tabs -->
				<div class="tab-v1">
					<ul class="nav nav-tabs tab-header">
						<li class="active"><a href="#muanha" data-toggle="tab"><span class="fa fa-home"></span> Vay mua nhà</a></li>
						<li><a href="#muaoto" data-toggle="tab"><span class="fa fa-car"></span> Vay mua ô tô</a></li>
						<li><a href="#tinchap" data-toggle="tab"><span class="fa fa-shopping-bag"></span> Vay tiêu dùng</a></li>
						<li><a href="#tindung" data-toggle="tab"><span class="fa fa-credit-card"></span> Thẻ tín dụng</a></li>
					</ul>
					<div class="tab-content">
						<!-- Datepicker Forms -->
						<div class="tab-pane fade in active" id="muanha">
							<?= app\packages\services\widgets\Services::widget([
								'_params' => [
									'slug' => 'vay-mua-nha'
								]
							]) ?>
						</div>
						<!-- End Datepicker Forms -->

						<!-- Validation Forms -->
						<div class="tab-pane fade" id="muaoto">
							<?= app\packages\services\widgets\Services::widget([
								'_params' => [
									'slug' => 'vay-mua-o-to'
								]
							]) ?>
						</div>
						<!-- End Validation Forms -->

						<!-- Masking Forms -->
						<div class="tab-pane fade" id="tinchap">
							<?= app\packages\services\widgets\Services::widget([
								'_params' => [
									'slug' => 'vay-tin-chap-tieu-dung'
								]
							]) ?>
						</div>
						<!-- End Masking Forms -->

						<!-- Masking Forms -->
						<div class="tab-pane fade" id="tindung">
							<?= app\packages\services\widgets\Services::widget([
								'_params' => [
									'slug' => 'the-tin-dung'
								]
							]) ?>
						</div>
						<!-- End Masking Forms -->
					</div>
				</div>
				<!-- End Tabs-->
			</div>
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
<?php
$this->registerCssFile($this->theme->baseUrl . '/assets/publish/plugins/sky-forms-pro/skyforms/css/sky-forms.css', ['depends' => FrontendAsset::className()]);
$this->registerCssFile($this->theme->baseUrl . '/assets/publish/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css', ['depends' => FrontendAsset::className()]);
?>