<?php
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<!-- Begin Inner Results -->
<div class="inner-results">
	<h3><a href="<?= Url::to(['/article/frontend/default/view', 'slug' => $model->slug, 'id' => $model->_id]) ?>"><?= $model->title ?></a></h3>
	<?= StringHelper::truncateWords(strip_tags($model->content), 50); ?>
</div>
<!-- Begin Inner Results -->

<hr>