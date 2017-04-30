<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
\app\packages\article\bundles\ContactAsset::register($this); 
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
			<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas feugiat. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit landitiis.</p><br />

			<?php $form = ActiveForm::begin(['id' => 'sky-form3', 'options' => ['class' => 'sky-form contact-style']]); ?>
				<fieldset class="no-padding">
					<label>Họ Tên <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<input type="text" name="name" id="name" class="form-control">
							</div>
						</div>
					</div>

					<label>Email <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-7 col-md-offset-0">
							<div>
								<input type="text" name="email" id="email" class="form-control">
							</div>
						</div>
					</div>

					<label>Nội Dung <span class="color-red">*</span></label>
					<div class="row sky-space-20">
						<div class="col-md-11 col-md-offset-0">
							<div>
								<textarea rows="8" name="message" id="message" class="form-control"></textarea>
							</div>
						</div>
					</div>

					<p><?= Html::submitButton('Gửi Liên Hệ', ['class' => 'btn-u', 'name' => 'contact-button']) ?></p>
				</fieldset>

				<div class="message">
					<i class="rounded-x fa fa-check"></i>
					<p>Your message was successfully sent!</p>
				</div>
			<?php ActiveForm::end(); ?>
		</div><!--/col-md-9-->

		<div class="col-md-3">
			<!-- Contacts -->
			<div class="headline"><h2>Liên Hệ</h2></div>
			<ul class="list-unstyled who margin-bottom-30">
				<li><a href="#"><i class="fa fa-home"></i>5B Streat, City 50987 New Town US</a></li>
				<li><a href="#"><i class="fa fa-envelope"></i>info@example.com</a></li>
				<li><a href="#"><i class="fa fa-phone"></i>1(222) 5x86 x97x</a></li>
				<li><a href="#"><i class="fa fa-globe"></i>http://www.example.com</a></li>
			</ul>

			<!-- Business Hours -->
			<div class="headline"><h2>Thời gian làm việc</h2></div>
			<ul class="list-unstyled margin-bottom-30">
				<li><strong>Monday-Friday:</strong> 10am to 8pm</li>
				<li><strong>Saturday:</strong> 11am to 3pm</li>
				<li><strong>Sunday:</strong> Closed</li>
			</ul>

			<!-- Why we are? -->
			<div class="headline"><h2>Why we are?</h2></div>
			<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
			<ul class="list-unstyled">
				<li><i class="fa fa-check color-green"></i> Odio dignissimos ducimus</li>
				<li><i class="fa fa-check color-green"></i> Blanditiis praesentium volup</li>
				<li><i class="fa fa-check color-green"></i> Eos et accusamus</li>
			</ul>
		</div><!--/col-md-3-->
	</div><!--/row-->

	<!-- Owl Clients v1 -->
	<div class="headline"><h2>ĐỐI TÁC TÀI CHÍNH</h2></div>
	<div class="owl-clients-v1">
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/1.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/2.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/3.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/4.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/5.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/6.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/7.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/8.png" alt="">
		</div>
		<div class="item">
			<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/clients4/9.png" alt="">
		</div>
	</div>
	<!-- End Owl Clients v1 -->
</div><!--/container-->
<!--=== End Content Part ===-->
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCDSb3wORiw36c9kGhpSVqjkTYtJpVp4l4&callback=initMap" async defer></script>
<?php
	$this->registerJs("
		App.init();
			ContactForm.initContactForm();
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