<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

app\themes\inspinia\backend\assets\LoginAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= Html::csrfMetaTags() ?>
    <title>VII System | Login</title>
	<?php $this->head() ?>
</head>
<body class="gray-bg">
	<?php $this->beginBody() ?>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
			<?=$content?>
        </div>
    </div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>