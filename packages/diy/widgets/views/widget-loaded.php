<?php $id_modal = str_replace('.', '_', uniqid('diy_modal_', true)); ?>
<?php $id_widget = str_replace('.', '_', uniqid('diy_widget_', true)); ?>
<div class="diy-sortable diy-style diy-widget" id="<?=$id_widget?>"
	data-settings="<?=yii\helpers\Html::encode(\yii\helpers\Json::encode($settings))?>"
	data-page="<?=yii\helpers\Html::encode($page)?>">
	<div class="diy-header" style="background:lightgray;margin:-8px -8px 0px -8px;padding:4px;">
		<?=$settings['widget']['title']?>
		<?php /*<a href="javascript:void(0)" style="float:right;margin-left:8px;padding-right:4px;font-size:15px">
			<i class="fa fa-trash-o"></i>
		</a>
		<a style="float:right;font-size:15px" data-toggle="modal" href="javascript:void(0)" data-target="#<?=$id_modal?>">
			<i class="fa fa-gear"></i>
		</a>*/ ?>
	</div>
	<div class="diy-content">
		<?=(!empty($content)?$content:'')?>
	</div>
	<div class="setting-form" style="display:none"></div>
	<?php /*
	<div class="modal fade" id="<?=$id_modal?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					 <h4 class="modal-title">Settings</h4>
				</div>
				<div class="modal-body"><div class="te">
					<div class="setting-form"></div>
				</div></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div> */ ?>
</div>
<?php $this->registerJs('DIY.createSettingForm($("#'.$id_widget.'"));'); ?>