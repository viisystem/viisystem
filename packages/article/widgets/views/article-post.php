<?php
use vii\helpers\StringHelper;
use vii\helpers\ImageHelper;
use vii\helpers\FileHelper;
use vii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-md-3 col-sm-6">
	<div class="thumbnails thumbnail-style thumbnail-kenburn">
		<div class="thumbnail-img">
			<div class="overflow-hidden">
				<?= Yii::$app->imageCache->img(FileHelper::getUploadDir($item->image), '973x615', ['class' => 'img-responsive']); ?>
			</div>
			<a class="btn-more hover-effect" href="<?= Url::to(['/article/frontend/default/view', 'slug' => $item->slug, 'id' => $item->_id]) ?>">xem thêm +</a>
		</div>
		<div class="caption">
			<h3><a class="hover-effect text-justify" href="<?= Url::to(['/article/frontend/default/view', 'slug' => $item->slug, 'id' => $item->_id]) ?>"><?= StringHelper::truncateWords($item->title, 10); ?></a></h3>
			<p class="text-justify"><?= StringHelper::truncateWords(strip_tags($item->content), 16); ?></p>
		</div>
	</div>
</div>