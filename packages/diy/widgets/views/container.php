<div <?=(($mode == app\packages\diy\widgets\Position::MODE_DRAG) ? 'class="diy-container"' : '')?> id="super-container" data-page="<?=yii\helpers\Html::encode(\Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id)?>">
	<?=$content?>
</div>