<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\themes\inspinia\frontend\assets\FrontendAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use vii\components\MobileDetect;
use app\packages\account\models\User;

$detect = new MobileDetect;
FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Web Fonts -->
	<?php $this->registerCssFile('//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin', ['depends' => FrontendAsset::className()]); ?>
</head>

<body>
<?php $this->beginBody() ?>
	<div class="wrapper">
		<!--=== Header ===-->
		<div class="header">
			<div class="container">
				<!-- Logo -->
				<a class="logo" href="<?= Url::home(); ?>">
					<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/findbank.vn.png" alt="Logo">
				</a>
				<!-- End Logo -->

				<!-- Topbar -->
				<div class="topbar">
					<ul class="loginbar pull-right">
						<?php if(!Yii::$app->user->isGuest) { ?>
							<li class="hoverSelector hidden-xs hidden-sm"><a><?= User::getDisplayNames(); ?></a>
								<ul class="languages hoverSelectorBlock">
									<li><a href="<?= Url::to(['/account/frontend/default/infomation']); ?>">Thông tin cá nhân</a></li>
									<li><a href="<?= Url::to(['/account/frontend/default/logout']); ?>">Đăng xuất</a></li>
								</ul>
							</li>
						<?php } else { ?>
							<li class="hidden-xs hidden-sm"><a href="<?= Url::to(['/account/frontend/default/login']); ?>">Đăng nhập</a></li>
						<?php } ?>
						<li class="topbar-devider hidden-xs hidden-sm"></li>
						<li class="hidden-xs hidden-sm">
							<?php if ($detect->isMobile()): ?>
								<a href="tel:0988 631 988">Hot Line:  0988 631 988</a>
							<?php else: ?>
								<span style="color: #7c8082; font-size: 11px; text-transform: uppercase;">Hot Line:  0988 631 988</span>
							<?php endif; ?>
						</li>
					</ul>
				</div>
				<!-- End Topbar -->

				<!-- Toggle get grouped for better mobile display -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>
				<!-- End Toggle -->
			</div><!--/end container-->

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
				<div class="container">
					<ul class="nav navbar-nav">
						<!-- Home -->
						<li class="active">
							<a href="<?= Url::home(); ?>">
								Trang Chủ
							</a>
						</li>
						<!-- End Home -->

						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
								Dịch vụ
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'vay-mua-nha']); ?>">Vay mua nhà</a></li>
								<li><a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'vay-mua-o-to']); ?>">Vay mua ô tô</a></li>
								<li><a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'vay-tin-chap-tieu-dung']); ?>">Vay tín chấp tiêu dùng</a></li>
								<li><a href="<?= Url::to(['/services/frontend/default/index', 'slug' => 'the-tin-dung']); ?>">Thẻ tín dụng</a></li>
							</ul>
						</li>
						
						<!-- Pages -->
						<li>
							<a href="#">
								Về Chúng Tôi
							</a>
						</li>
						<!-- End Pages -->

						<!-- Blog -->
						<li>
							<a href="<?= Url::to(['/article/frontend/category/news']); ?>">
								Tin Tức
							</a>
						</li>
						<!-- End Blog -->

						<!-- Portfolio -->
						<li>
							<a href="<?= Url::to(['/contact/frontend/default/index']); ?>">
								Liên Hệ
							</a>
						</li>
						<!-- End Portfolio -->

						<!-- Search Block -->
						<li>
							<i class="search fa fa-search search-btn"></i>
							<div class="search-open">
								<div class="input-group animated fadeInDown">
									<?= \app\packages\dashboard\widgets\Search::widget([
										'_params' => [
											'view' => 'search_head'
										]
									]); ?>
								</div>
							</div>
						</li>
						<!-- End Search Block -->
					</ul>
				</div><!--/end container-->
			</div><!--/navbar-collapse-->
		</div>
		<!--=== End Header ===-->

		<?= $content ?>

		<!--=== Footer Version 1 ===-->
		<div class="footer-v1">
			<div class="footer">
				<div class="container">
					<div class="row">
						<!-- About -->
						<div class="col-md-3 md-margin-bottom-40">
							<a href="index.html"><img id="logo-footer" class="footer-logo" src="<?= $this->theme->baseUrl ?>/assets/publish/img/findbank.vn2.png" alt=""></a>
							<p class="text-justify">FindBank là 1 công ty thuộc lĩnh vực tài chính công nghệ, cung cấp thông tin và so sánh tài chính, lãi suất chi tiết các khoản vay của tất cả các ngân hàng tại Việt Nam. </p>
							<p class="text-justify">Chúng tôi mang đến cho các khách hàng dịch vụ vay với lãi suất ưu đãi nhất, thời gian nhanh nhất, thủ tục đơn giản nhất.</p>
						</div><!--/col-md-3-->
						<!-- End About -->

						<!-- Latest -->
						<div class="col-md-3 md-margin-bottom-40 hidden-xs hidden-sm">
							<div class="posts">
								<div class="headline"><h2>Tin mới nhất</h2></div>
								<ul class="list-unstyled latest-list">
									<?= \app\packages\article\widgets\Articles::widget([
										'settings' => [
											'params' => [
												[
													'name' => 'view',
													'value' => 'article-promotion',
												],
												[
													'name' => 'number_of_post',
													'value' => 3,
												],
											]
										]
									]); ?>
								</ul>
							</div>
						</div><!--/col-md-3-->
						<!-- End Latest -->

						<!-- Link List -->
						<div class="col-md-3 md-margin-bottom-40">
							<div class="headline"><h2><?php if (!Yii::$app->user->isGuest) { 
								echo User::getDisplayNames();
							} else {
								echo 'Thông tin khách hàng';
							}
							?></h2></div>
							<ul class="list-unstyled link-list">
								<?php if (!Yii::$app->user->isGuest) { ?>
									<li><a href="<?= Url::to(['/account/frontend/default/infomation']); ?>">Thông tin cá nhân</a><i class="fa fa-angle-right"></i></li>
									<li><a href="<?= Url::to(['/account/frontend/default/logout']); ?>">Đăng xuất</a><i class="fa fa-angle-right"></i></li>
								<?php } else { ?>
									<li><a href="<?= Url::to(['/account/frontend/default/login']); ?>">Đăng nhập</a><i class="fa fa-angle-right"></i></li>
								<?php } ?>
								<li>
									<a href="tel:0988 631 988">Hot Line:  0988 631 988</a><i class="fa fa-angle-right"></i>
								</li>
						</li>
							</ul>
						</div><!--/col-md-3-->
						<!-- End Link List -->

						<!-- Address -->
						<div class="col-md-3 map-img md-margin-bottom-40">
							<div class="headline"><h2>Liên hệ</h2></div>
							<address class="md-margin-bottom-40 text-justify">
								Số 51, đường Trung Yên 9, phường Yên Hòa <br />
								Quận Cầu Giấy, Hà Nội <br />
								Phone: 0988 631 988 <br />
								Fax: 0437833187 <br />
								Email: <a href="mailto:contact@findbank.vn" class="">contact@findbank.vn</a>
							</address>
						</div><!--/col-md-3-->
						<!-- End Address -->
					</div>
				</div>
			</div><!--/footer-->

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<p>
								2016 &copy; All Rights Reserved.
								<a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
							</p>
						</div>

						<!-- Social Links -->
						<div class="col-md-6">
							<ul class="footer-socials list-inline">
								<li>
									<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<li>
									<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Skype">
										<i class="fa fa-skype"></i>
									</a>
								</li>
								<li>
									<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Plus">
										<i class="fa fa-google-plus"></i>
									</a>
								</li>
								<li>
									<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>
								<li>
									<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest">
										<i class="fa fa-pinterest"></i>
									</a>
								</li>
								<li>
									<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li>
									<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribbble">
										<i class="fa fa-dribbble"></i>
									</a>
								</li>
							</ul>
						</div>
						<!-- End Social Links -->
					</div>
				</div>
			</div><!--/copyright-->
		</div>
		<!--=== End Footer Version 1 ===-->
	</div><!--/wrapper-->

	<!-- Sidebar: More Articles Box -->
	<div class="outside-more-articles outside-more-articles--right outside-more-articles--show hidden-md hidden-lg" data-scrollTop="400">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-6 text-center custom_infomation">
				<?php if(!Yii::$app->user->isGuest) { ?>
					<a href="<?= Url::to(['/account/frontend/default/infomation']); ?>"><i class="fa fa-user-circle" style="font-size: 25px;"></i><p>Thông tin cá nhân</p></a>
			 	<?php } else { ?>
			 		<a href="<?= Url::to(['/account/frontend/default/login']); ?>"><i class="fa fa-user-circle" style="font-size: 25px;"></i><p>Đăng nhập</p></a>
			 	<?php } ?>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6 text-center custom_infomation hotline">
				<a href="tel:0988 631 988"><i class="fa fa-phone" style="font-size: 25px;"></i><p>Hotline: 0988 631 988</p></a>
			</div>
		</div>
	</div>
	<!-- End More Articles Box -->
	<?php
		$this->registerJs("
			App.init();
			OwlCarousel.initOwlCarousel();
			StyleSwitcher.initStyleSwitcher();
		", yii\web\View::POS_READY);
	?>
	<!--[if lt IE 9]>
		<script src="<?= $this->theme->baseUrl ?>/assets/publish/plugins/respond.js"></script>
		<script src="<?= $this->theme->baseUrl ?>/assets/publish/plugins/html5shiv.js"></script>
		<script src="<?= $this->theme->baseUrl ?>/assets/publish/plugins/placeholder-IE-fixes.js"></script>
		<script src="<?= $this->theme->baseUrl ?>/assets/publish/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
	<![endif]-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
