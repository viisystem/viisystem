<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	 <h4 class="modal-title">Assignment</h4>
</div>
<div class="modal-body"><div class="te">
	<?php
		$auth = Yii::$app->authManager;
		$roles = $auth->getRoles();
	?>
	<table class="table table-striped table-bordered role-table">
		<thead>
			<tr>
				<th style="width:30px;">#</th>
				<th style="width:150px;">Role</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			<script type="text/javascript">Role.settings.urlAssignment = '<?=  yii\helpers\Url::to(['/account/backend/assignment/set-role'])?>';</script>
			<?php $i = 1; foreach($roles as $role) { ?>
			<tr class="vii-row">
				<td><input type="checkbox" onchange="Role.SetRole(this, '<?=$user?>', '<?=$role->name?>')"/></td>
				<td><input class="role-name" type="hidden" value="<?=$role->name?>" /><?=$role->name?></td>
				<td><?=$role->description?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<?php //<button type="button" class="btn btn-primary">Save changes</button> ?>
</div>