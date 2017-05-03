<?php
use yii\helpers\Url;
?>
<input type="text" class="form-control" onkeyup="searchvalue(this);" value="<?= \Yii::$app->request->get('keyword') ?>" placeholder="Bạn cần tìm gì hôm nay?">
<span class="input-group-btn">
	<button class="btn-u" type="button" onclick="submitForm()"><i class="fa fa-search"></i></button>
</span>
<form action="<?= Url::to(['/dashboard/frontend/search/index']) ?>" method="get" class="search">
	<input type="hidden" name="keyword" class="search_text">
</form>
<?php
$this->registerJs("
	function searchvalue(element) {
		$('.search_text').val($(element).val());
	}

	function submitForm() {
		$('.search').submit();
	}
", yii\web\View::POS_END);
?>