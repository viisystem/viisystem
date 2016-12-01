<?php
	$rparams = Yii::$app->request->get();
	$rparams['diy'] = null;
?>
<div class="diy-tool-bar">
	<div class="diy-tool-bar-title">
		Widgets
		<a style="float:right;color:white;" href="<?=yii\helpers\Url::to(array_merge([''], $rparams))?>">
			<i class="fa fa-save"></i>
		</a>
	</div>
	<div style="padding: 4px;">
		<?php
		$widgets = \app\packages\diy\DIYManagement::AllDIYWidgets();
		foreach($widgets as $widget) {
			echo (new $widget())->getDraggableIcon();
		}
		?>
	</div>
</div>