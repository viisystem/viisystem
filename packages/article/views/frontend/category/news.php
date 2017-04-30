<!--=== Breadcrumbs v1 ===-->
<div class="breadcrumbs-v1">
	<div class="container">
	<h1>Tin tức</h1>
	</div>
</div>
<!--=== End Breadcrumbs v1 ===-->

<!--=== Blog Posts ===-->
<div class="container content-md">
	<?= yii\widgets\ListView::widget([
        'dataProvider' => $articles,
        'itemView' => '_item_view_news',
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
		<!--=== End Blog Posts ===-->