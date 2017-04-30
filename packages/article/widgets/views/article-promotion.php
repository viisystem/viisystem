<?php
use vii\helpers\StringHelper;
use vii\helpers\ImageHelper;
use vii\helpers\Html;
use yii\helpers\Url;
?>
<li>
	<a href="<?= Url::to(['/article/frontend/default/view', 'slug' => $item->slug, 'id' => $item->_id]) ?>"><?= StringHelper::truncateWords($item->title, 10); ?></a>
	<small><?= date('d-m-Y', $item->created_at->toDateTime()->format('U')) ?></small>
</li>