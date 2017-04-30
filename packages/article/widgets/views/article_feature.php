<?php
use vii\helpers\StringHelper;
use vii\helpers\ImageHelper;
use vii\helpers\FileHelper;
use vii\helpers\Html;
use yii\helpers\Url;

$arrCategory = [];
if (isset($categories[(string)$item->_id]) AND !empty($categories[(string)$item->_id])) {
	foreach ($categories[(string)$item->_id] as $category) {
		$arrCategory[] = '<a href="' . Url::to(['/article/frontend/category/index', 'slug' => $category->slug, 'id' => (string)$category->_id]) . '">' . $category->title . '</a>';
	}
}
?>
<div class="col-sm-6 sm-margin-bottom-30">
	<div class="news-v2-badge">
		<?= Yii::$app->imageCache->img(FileHelper::getUploadDir($item->image), '410x258', ['class' => 'img-responsive']); ?>
		<?php if (!empty($item->created_at)): ?>
		<p>
			<span><?= date('d', $item->created_at->toDateTime()->format('U')) ?></span>
			<small><?= date('m', $item->created_at->toDateTime()->format('U')) ?></small>
		</p>
		<?php endif ?>
	</div>
	<div class="news-v2-desc">
		<h3><a href="<?= Url::to(['/article/frontend/default/view', 'slug' => $item->slug, 'id' => $item->_id]) ?>"><?= StringHelper::truncateWords($item->title, 8); ?></a></h3>
		<p class="text-justify"><?= StringHelper::truncateWords(strip_tags($item->content), 30); ?></p>
	</div>
</div>