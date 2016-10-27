<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
\app\packages\account\bundles\PermissionAsset::register($this);
?>
<div class="permission-form">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?=Yii::t('account', 'Permission')?></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<?php $form = ActiveForm::begin(); ?>
					<div class="row">
						<div class="col-md-6">
							<table class="table table-striped table-bordered role-table">
								<thead>
									<tr>
										<th style="width:30px;">#</th>
										<th style="width:150px;">Role</th>
										<th>Description</th>
										<th style="width:30px;"></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; foreach($roles as $role) { ?>
									<tr class="vii-row">
										<td><?=$i++?></td>
										<td><input class="role-name" type="hidden" value="<?=$role->name?>" /><?=$role->name?></td>
										<td><?=$role->description?></td>
										<td>
											<a class="vii-delete" href="javascript:void(0)">
												<i class="fa fa-fw fa-times-circle"></i>
											</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<p style="text-align:right">
								<?=Html::button('Add Role',['class'=>'btn btn-primary', 'onclick'=>new yii\web\JsExpression('Role.AddRow()')])?>
							</p>
						</div>
						<div class="col-md-6">
							<table class="table table-striped table-bordered permission-table">
								<thead>
									<tr>
										<th style="width:30px;">#</th>
										<th style="width:150px;">Permission</th>
										<th>Description</th>
										<th style="width:30px;"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($permissions as $i=>$permission) { ?>
									<tr class="vii-row">
										<td><input class="permission-checkbox" value="<?=$permission->name?>" type="checkbox"/></td>
										<td><?=$permission->name?></td>
										<td><?=$permission->description?></td>
										<td>
											<a class="vii-delete" href="javascript:void(0)">
												<i class="fa fa-fw fa-times-circle"></i>
											</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<p style="text-align:right">
								<?=Html::a('Generate All Permissions', ['/account/backend/permission/generate-permissions'], ['class'=>'btn btn-success'])?>
								<?=Html::button('Add Permission',['class'=>'btn btn-primary', 'onclick'=>new yii\web\JsExpression('Permission.AddRow()')])?>
							</p>
						</div>
					</div>
					<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	Role.settings.urlPermission='<?=vii\helpers\Url::to(['/account/backend/permission/get-permissions'])?>';
	Role.settings.urlAddRole='<?=vii\helpers\Url::to(['/account/backend/permission/add-role'])?>';
	Role.settings.urlDeleteRole='<?=vii\helpers\Url::to(['/account/backend/permission/delete-role'])?>';
	Role.settings.targetObject=$('table.role-table');
	
	Permission.settings.urlSetPermission='<?=vii\helpers\Url::to(['/account/backend/permission/set-permission'])?>';
	Permission.settings.urlAddPermission='<?=vii\helpers\Url::to(['/account/backend/permission/add-permission'])?>';
	Permission.settings.urlDeletePermission='<?=vii\helpers\Url::to(['/account/backend/permission/delete-permission'])?>';
	Permission.settings.targetObject=$('table.permission-table');
</script>