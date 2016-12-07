<div class="diy-draggable diy-widget"
	data-settings="<?=yii\helpers\Html::encode(\yii\helpers\Json::encode($settings))?>"
	data-page="<?=yii\helpers\Html::encode($page)?>">
	<div class="diy-header">
		<?=$settings['widget']['title']?>
	</div>
	<div class="diy-content">
		<?=(!empty($content)?$content:'')?>
	</div>
	<div class="setting-form" style="display:none"></div>
</div>