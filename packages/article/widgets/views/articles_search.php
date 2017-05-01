<!--=== Search Results ===-->
<div class="container s-results margin-bottom-50">
	<span class="results-number">Có <?= $dataProvider->totalCount ?> kết quả</span>
	<?= yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item_view',
        'emptyText' => 'Không tìm thấy kết quả nào.',
        'summary' => '',
        'layout' => '{items}<div class="margin-bottom-30"></div>{pager}'
    ]); ?>
</div><!--/container-->
<!--=== End Search Results ===-->