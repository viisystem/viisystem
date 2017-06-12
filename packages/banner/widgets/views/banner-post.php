<?php
use vii\helpers\Html;
use vii\helpers\ImageHelper;
use vii\helpers\FileHelper;
use app\themes\inspinia\frontend\assets\FrontendAsset;
use yii\helpers\Url;

?>
<div class="ls-slide" data-ls="slidedelay:4500;transition2d:25;">
	<img src="<?= $this->theme->baseUrl ?>/assets/publish/img/bg-banner.png" class="ls-bg" alt=""/>

	<?= Yii::$app->imageCache->img(FileHelper::getUploadDir($item->image), '', ['class' => 'ls-s-1', 'style' => 'top:0; left: 50%', 'data-ls' => 'offsetxin:left; durationin:800; delayin:20; fadein:false; offsetxout:left; durationout:100; fadeout:false;']); ?>

    <!-- <span class="ls-s-1" style=" text-transform: uppercase; line-height: 45px; font-size:35px; color:#fff; top:130px; left: 650px; slidedirection : top; slideoutdirection : bottom; durationin : 3500; durationout : 3500; delayin : 1000;">
        Tư Vấn Vận Hành
        <br>Và Phát Triển Doanh Nghiệp
    </span> -->

    <!-- <a class="btn-u btn-u-orange ls-s-1" href="<?= Url::to(['/feedback/frontend/default/index']) ?>" style=" padding: 9px 20px; font-size:25px; top:300px; left: 650px; slidedirection : bottom; slideoutdirection : top; durationin : 3500; durationout : 2500; delayin : 1000; ">
        LIÊN HỆ VỚI CHÚNG TÔI
    </a> -->
</div>