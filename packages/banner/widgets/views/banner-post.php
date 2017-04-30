<?php
use vii\helpers\Html;
use vii\helpers\ImageHelper;
use vii\helpers\FileHelper;

?>
<!-- SLIDE -->
<li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="<?= $item->title ?>">
	<!-- MAIN IMAGE -->
	<?= Yii::$app->imageCache->img(FileHelper::getUploadDir($item->image), '1920x720', ['class' => 'img-responsive', 'data-bgfit' => 'cover', 'data-bgposition' => 'left top', 'data-bgrepeat' => 'no-repeat']); ?>

	<div class="tp-caption revolution-ch1 sft start"
		data-x="center"
		data-hoffset="0"
		data-y="100"
		data-speed="1500"
		data-start="500"
		data-easing="Back.easeInOut"
		data-endeasing="Power1.easeIn"
		data-endspeed="300">
		<?= $item->title ?>
	</div>

	<!-- LAYER -->
	<div class="tp-caption sft"
	data-x="center"
	data-hoffset="0"
	data-y="370"
	data-speed="1600"
	data-start="2800"
	data-easing="Power4.easeOut"
	data-endspeed="300"
	data-endeasing="Power1.easeIn"
	data-captionhidden="off"
	style="z-index: 6">
	<a href="<?= $item->link ?>" <?= $item->target == 1 ? 'target="_blank"' : null ?> class="btn-u btn-brd btn-brd-hover btn-u-light">Xem Thêm</a>
	</div>
</li>
<!-- END SLIDE -->