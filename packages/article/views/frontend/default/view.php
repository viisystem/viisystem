<?php
use yii\helpers\Url;
use vii\helpers\ImageHelper;
use vii\helpers\Html;
use vii\helpers\ArrayHelper;
use vii\helpers\FileHelper;
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
	<div class="container">
		<h1 class="col-md-10 text-ellipsis"><?= Html::encode($item->title) ?></h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::home(); ?>">Trang Chủ</a></li>
			<li class="active">Tin tức</li>
		</ul>
	</div>
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->

<!--=== Blog Posts ===-->
<div class="bg-color-light">
	<div class="container content-sm">
		<div class="row">
			<!-- Blog All Posts -->
			<div class="col-md-9">
				<!-- News v3 -->
				<div class="news-v3 bg-color-white margin-bottom-30">
					<div class="news-v3-in">
						<h2><a href="<?= Url::to(['/article/frontend/default/view', 'slug' => $item->slug, 'id' => $item->_id]) ?>"><?= $item->title ?></a></h2>
						<?= $item->excerpt ?>
						<?= Yii::$app->imageCache->img(FileHelper::getUploadDir($item->image), '848x536', ['class' => 'img-responsive full-width', 'style' => 'margin: 10px 0;']); ?>
						<?= $item->content ?>
					</div>
				</div>
				<!-- End News v3 -->

				<!-- News v2 -->
				<div class="row news-v2 margin-bottom-50">
					<?= \app\packages\article\widgets\FeatureArticle::widget([
						'settings' => [
							'params' => [
								[
									'name' => 'type',
									'value' => 'category',
								],
								[
									'name' => 'category_id',
									'value' => $item->category,
								],
								[
									'name' => 'post_id',
									'value' => $item->_id,
								],
								[
									'name' => 'number_of_post',
									'value' => 2,
								],
								[
									'name' => 'view',
									'value' => 'article_feature',
								],
							]
						]
					]); ?>
				</div>
				<!-- End News v2 -->
			</div>
			<!-- End Blog All Posts -->

			<!-- Blog Sidebar -->
			<div class="col-md-3">
				<div class="headline-v2"><h2>Tin tức liên quan</h2></div>
				<!-- Latest Links -->
				<ul class="list-unstyled blog-latest-posts margin-bottom-50">
					<?= \app\packages\article\widgets\FeatureArticle::widget([
						'settings' => [
							'params' => [
								[
									'name' => 'type',
									'value' => 'tags',
								],
								[
									'name' => 'tags_id',
									'value' => $item->tags,
								],
								[
									'name' => 'category_id',
									'value' => $item->category,
								],
								[
									'name' => 'post_id',
									'value' => $item->_id,
								],
								[
									'name' => 'number_of_post',
									'value' => 4,
								],
								[
									'name' => 'view',
									'value' => 'article_feature_tags',
								],
							]
						]
					]); ?>
				</ul>
				<!-- End Latest Links -->

				<?php if (!empty($item->tags)): ?>
				<div class="headline-v2"><h2>Tags</h2></div>
				<!-- Tags v2 -->
				<ul class="list-inline tags-v2 margin-bottom-50">
					<?php foreach ($item->tags as $tag): ?>
						<li><a href="#"><?= $tag ?></a></li>
					<?php endforeach; ?>
				</ul>
				<!-- End Tags v2 -->
				<?php endif; ?>
			</div>
			<!-- End Blog Sidebar -->
		</div>
	</div><!--/end container-->
</div>
<!--=== End Blog Posts ===-->