<!--=== Breadcrumbs v1 ===-->
<div class="breadcrumbs-v1">
	<div class="container">
	<h1><?= $item->title ?></h1>
	</div>
</div>
<!--=== End Breadcrumbs v1 ===-->

<!--=== Blog Posts ===-->
<div class="container content-md">
	<div class="row">
		<!-- Blog All Posts -->
		<div class="col-md-9">
			<?= yii\widgets\ListView::widget([
                'dataProvider' => $articles,
                'viewParams' => ['category' => $item],
                'itemView' => '_item_view',
                'emptyText' => 'Không có tin tức nào trong danh mục này.',
                'summary' => '',
                'layout' => '{items}{pager}',
                'pager' => array(
			        'maxButtonCount' => 1,
			        'nextPageLabel' => 'Trang tiếp theo &rarr;',
			        'prevPageLabel' => '&larr; Trang trước',
			        'class' => 'vii\grid\MyLinkPager',
			        'prevPageCssClass' => 'previous',
			        'pageCssClass' => 'page-amount',
			        'options' => [
			        	'class' => 'pager pager-v3 pager-sm no-margin-bottom'
			        ]
			    ),
            ]); ?>
		</div>
		<!-- End Blog All Posts -->

		<!-- Blog Sidebar -->
		<div class="col-md-3">
			<div class="headline-v2 bg-color-light"><h2>Bài Viết Liên Quan</h2></div>
			<!-- Latest Links -->
			<ul class="list-unstyled blog-latest-posts margin-bottom-50">
				<?= \app\packages\article\widgets\FeatureArticle::widget([
					'settings' => [
						'params' => [
							[
								'name' => 'type',
								'value' => 'category',
							],
							[
								'name' => 'category_id',
								'value' => (string)$item->_id,
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
		</div>
		<!-- End Blog Sidebar -->
	</div>
</div>
		<!--=== End Blog Posts ===-->