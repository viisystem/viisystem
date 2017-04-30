<?php
use vii\helpers\StringHelper;
use vii\helpers\ImageHelper;
use vii\helpers\FileHelper;
use vii\helpers\Html;
use yii\helpers\Url;
?>
<?php if ($index != 0): ?>
<div class="clearfix margin-bottom-20"><hr></div>
<?php endif; ?>
<!-- News v3 -->
<div class="row margin-bottom-20">
	<div class="col-sm-5 sm-margin-bottom-20">
		<?= Yii::$app->imageCache->img(FileHelper::getUploadDir($model->image), '458x289', ['class' => 'img-responsive']); ?>
	</div>
	<div class="col-sm-7">
		<div class="news-v3">
			<h2><a href="<?= Url::to(['/article/frontend/default/view', 'slug' => $model->slug, 'id' => $model->_id]) ?>"><?= StringHelper::truncateWords($model->title, 8); ?></a></h2>
			<p class="text-justify"><?= StringHelper::truncateWords(strip_tags($model->content), 50); ?></p>
		</div>
	</div>
</div><!--/end row-->
<!-- End News v3 -->