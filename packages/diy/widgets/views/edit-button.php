<div class="diy-fixed">
	<?php
		$rparams = Yii::$app->request->get();
		$rparams['diy'] = app\packages\diy\widgets\Position::MODE_DRAG;
	?>
	<a class="btn btn-info btn-circle btn-lg" href="<?=yii\helpers\Url::to(array_merge([''], $rparams))?>">
		<i class="fa fa-pencil"></i>
	</a>
</div>