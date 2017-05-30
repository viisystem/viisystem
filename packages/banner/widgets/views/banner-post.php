<?php
use vii\helpers\Html;
use vii\helpers\ImageHelper;
use vii\helpers\FileHelper;

?>
<!-- SLIDE -->
<li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="<?= $item->title ?>">
	<!-- MAIN IMAGE -->
	<a href="<?= $item->link ?>" <?= $item->target == 1 ? 'target="_blank"' : null ?>><?= Yii::$app->imageCache->img(FileHelper::getUploadDir($item->image), '', ['class' => 'img-responsive', 'data-bgfit' => 'initial', 'data-bgposition' => 'center top', 'data-bgrepeat' => 'no-repeat']); ?></a>
</li>
<!-- END SLIDE -->