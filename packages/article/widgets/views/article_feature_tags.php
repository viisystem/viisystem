<?php
use yii\helpers\Url;
use vii\helpers\StringHelper;
use vii\helpers\Html;

$arrCategory = [];
if (isset($categories[(string)$item->_id]) AND !empty($categories[(string)$item->_id])) {
	foreach ($categories[(string)$item->_id] as $category) {
		$arrCategory[] = '<a href="' . Url::to(['/article/frontend/category/index', 'slug' => $category->slug, 'id' => (string)$category->_id]) . '">' . $category->title . '</a>';
	}
}
?>
<li>
	<h3><a href="<?= Url::to(['/article/frontend/default/view', 'slug' => $item->slug, 'id' => $item->_id]) ?>"><?= StringHelper::truncateWords($item->title, 10) ?></a></h3>
	<p class="text-justify"><?= StringHelper::truncateWords(strip_tags($item->content), 30); ?></p>
</li>