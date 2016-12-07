<div class="diy-sortable diy-style"
	data-settings="<?=yii\helpers\Html::encode(\yii\helpers\Json::encode($settings))?>"
	data-page="<?=yii\helpers\Html::encode($page)?>">
	<div class="diy-header" style="background:lightgray;margin:-8px -8px 0px -8px;padding:4px">
		<?=$settings['widget']['title']?>
		<a href="javascript:void" style="float:right;margin-left:5px">
			<i class="fa fa-trash-o"></i>
		</a>
		<a href="javascript:void" style="float:right">
			<i class="fa fa-gear"></i>
		</a>
	</div>
	<div class="diy-content">
		<?=(!empty($content)?$content:'')?>
	</div>
	<div class="setting-form" style="display:none"></div>
</div>