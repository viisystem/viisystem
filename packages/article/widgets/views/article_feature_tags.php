<?php
use yii\helpers\Url;
use vii\helpers\StringHelper;
use vii\helpers\Html;
?>
<li>
	<h3><a href="<?= Url::to(['/article/frontend/default/view', 'slug' => $item->slug, 'id' => $item->_id]) ?>"><?= StringHelper::truncateWords($item->title, 10) ?></a></h3>
	<p class="text-justify"><?= StringHelper::truncateWords(strip_tags($item->content), 30); ?></p>
</li>