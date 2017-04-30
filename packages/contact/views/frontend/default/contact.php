<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\packages\contact\bundles\ContactAsset;

ContactAsset::register($this); 
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
	<div class="container">
		<h1 class="pull-left">Liên Hệ</h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::home(); ?>">Trang Chủ</a></li>
			<li class="active">Liên Hệ</li>
		</ul>
	</div>
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!-- Google Map -->
<div id="map" class="map"></div>
<!-- End Google Map -->

<!--=== Content Part ===-->
<div class="container content">
	<div class="row margin-bottom-30">
		<div class="col-md-9 mb-margin-bottom-30">
			<div class="headline"><h2>Thông Tin Liên Hệ</h2></div>

			<?php $form = ActiveForm::begin(['id' => 'sky-form3', 'options' => ['class' => 'sky-form contact-style']]); ?>
				<?php if(!Yii::$app->session->hasFlash('form_success')): ?>
				<fieldset class="no-padding">
					<label>Họ Tên <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<?= $form->field($item, 'fullname')->input('text', ['class' => 'form-control', 'id' => 'name'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Email</label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<?= $form->field($item, 'email')->input('text', ['class' => 'form-control', 'id' => 'email'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Số điện thoại <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<?= $form->field($item, 'phone')->input('text', ['class' => 'form-control', 'id' => 'phone'])->label(false); ?>
							</div>
						</div>
					</div>

					<label>Nội Dung <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-11 col-md-offset-0">
							<div>
								<?= $form->field($item, 'content')->textarea(['class' => 'form-control', 'id' => 'message', 'rows' => 8])->label(false) ?>
							</div>
						</div>
					</div>

					<p><?= Html::submitButton('Gửi Liên Hệ', ['class' => 'btn-u', 'name' => 'contact-button']) ?></p>
				</fieldset>
				<?php else: ?>
				<div class="sky-form contact-style submited">
					<div class="message">
						<i class="rounded-x fa fa-check"></i>
						<p><?= Yii::$app->session->getFlash('form_success') ?></p>
					</div>
				</div>
				<?php endif; ?>
			<?php ActiveForm::end(); ?>
		</div><!--/col-md-9-->

		<div class="col-md-3">
			<!-- Contacts -->
			<div class="headline"><h2>Liên Hệ</h2></div>
			<ul class="list-unstyled who margin-bottom-30">
				<li><i class="fa fa-home"></i>Số 51, đường Trung Yên 9, phường Yên Hòa, quận Cầu Giấy, Hà Nội</li>
				<li><a href="mailto:contact@findbank.vn"><i class="fa fa-envelope"></i>contact@findbank.vn</a></li>
				<li><i class="fa fa-phone"></i>0962 767 222 / 0968 715 558</li>
				<li><i class="fa fa-globe"></i>http://www.example.com</li>
			</ul>

			<!-- Business Hours -->
			<div class="headline"><h2>Thời gian làm việc</h2></div>
			<ul class="list-unstyled margin-bottom-30">
				<li><strong>Thứ 2 - Thứ 6:</strong> 10am to 8pm</li>
				<li><strong>Thứ 7:</strong> 11am to 3pm</li>
				<li><strong>Chủ nhật:</strong> Đóng cửa</li>
			</ul>
		</div><!--/col-md-3-->
	</div><!--/row-->

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
<!--=== End Content Part ===-->
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCDSb3wORiw36c9kGhpSVqjkTYtJpVp4l4&callback=initMap" async defer></script>
<?php
	$this->registerJs("
		OwlCarousel.initOwlCarousel();
		StyleSwitcher.initStyleSwitcher();
	", yii\web\View::POS_READY);

	$this->registerJs("
		// Google Map
		function initMap() {
			GoogleMap.initGoogleMap();
		}
	", yii\web\View::POS_END);
?>