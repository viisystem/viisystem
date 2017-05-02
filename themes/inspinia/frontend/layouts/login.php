<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\packages\account\bundles\LoginAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use vii\components\MobileDetect;

LoginAsset::register($this);
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

	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Web Fonts -->
</head>

<body>
<?php $this->beginBody() ?>

<?= $content ?>

<?php
	$this->registerJs("
		App.init();
	", yii\web\View::POS_READY);

	$this->registerJs("
		$.backstretch([
			'" . $this->theme->baseUrl . "/assets/publish/img/bg/19.jpg',
			'" . $this->theme->baseUrl . "/assets/publish/img/bg/18.jpg',
			], {
				fade: 1000,
				duration: 7000
		});
	", yii\web\View::POS_END);
?>

<!--[if lt IE 9]>
<script src="<?= $this->theme->baseUrl ?>/assets/publish/plugins/respond.js"></script>
<script src="<?= $this->theme->baseUrl ?>/assets/publish/plugins/html5shiv.js"></script>
<script src="<?= $this->theme->baseUrl ?>/assets/publish/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
