<?php
use app\themes\inspinia\frontend\assets\FrontendAsset;
use yii\helpers\Url;
use vii\helpers\Html;

$this->registerCssFile($this->theme->baseUrl . '/assets/publish/css/pages/page_search_inner.css', ['depends' => FrontendAsset::className()]);
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs breadcrumbs-dark">
	<div class="container">
		<h1 class="pull-left"><?= $this->title ?></h1>
		<ul class="pull-right breadcrumb">
			<li><a href="<?= Url::home(); ?>">Trang chủ</a></li>
			<li class="active">Tìm kiếm</li>
		</ul>
	</div>
</div>
<!--=== End Breadcrumbs ===-->

<!--=== Search Block Version 2 ===-->
<div class="search-block-v2">
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<h2>Tiếp tục tìm kiếm</h2>
			<div class="input-group">
				<?= \app\packages\dashboard\widgets\Search::widget([
					'_params' => [
						'view' => 'search'
					]
				]); ?>
			</div>
		</div>
	</div>
</div><!--/container-->
<!--=== End Search Block Version 2 ===-->

<?= \app\packages\article\widgets\ArticlesSearch::widget(['keyword' => $keyword]) ?>