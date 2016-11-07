/* 
    Created on : Oct 24, 2016, 9:32:29 AM
    Author     : Minh Nguyen
*/

var Role = new function() {
	this.settings = {
		targetObject:null,
		urlPermission:null,
		urlAddRole:null,
		urlDeleteRole:null,
		urlAssignment:null
	};
	this.SelectRow = function(sender) {
		var $sender = $(sender);
		var $parent = $sender.parent();
		
		$parent.children().each(function(){
			$(this).removeClass('active');
		});
		
		$sender.addClass('active');
		
		//Get role name
		var roleName = $sender.find('input.role-name').val();
		$.ajax({
			url:this.settings.urlPermission,
			data:{roleName:roleName}
		}).done(function(response){
			$("table.permission-table > tbody > tr").each(function(){
				var $checkbox = $(this).find('input.permission-checkbox');
				if(response.hasOwnProperty($checkbox.val()))
					$checkbox.prop('checked', true);
				else
					$checkbox.prop('checked', false);
			});
		});
	};
	this.DeleteRow = function(sender) {
		if(confirm('Are you sure you want to delete this role?'))
		{
			var $row = $(sender).closest('.vii-row');
			
			var roleName = $row.find('input.role-name').val();
			$.ajax({
				url:this.settings.urlDeleteRole,
				data:{
					roleName:roleName
				}
			}).done(function(response){
				if(response.success === true)
				{
					$row.fadeOut('1000', function(){
						$(this).remove();
					});
				}
				else
				{
					alert('Cannot delete this role!');
				}
			});
		}
	};
	this.AddRow = function()
	{
		var $table = $(this.settings.targetObject);
		var $tbody = $table.find('tbody');
		$tbody.append('<tr class="vii-row">\
			<td>?</td>\
			<td><input class="form-control input-role-name" type="text"/></td>\
			<td><input class="form-control input-role-desc" type="text"/></td>\
			<td>\
				<a class="vii-apply" href="javascript:void(0)" onclick="Role.AddRole(this);" style="color:#1ab394">\
					<i class="fa fa-fw fa-check"></i>\
				</a>\
			</td>\
		</tr>');
	};
	this.AddRole = function(sender)
	{
		var $row = $(sender).closest('.vii-row');
		var roleName = $row.find('input.input-role-name').val();
		var roleDesc = $row.find('input.input-role-desc').val();
		$.ajax({
			url:this.settings.urlAddRole,
			data:{
				roleName:roleName,
				roleDesc:roleDesc
			}
		}).done(function(response){
			if(response.success === true)
			{
				$row.replaceWith('<tr class="vii-row" onclick="Role.SelectRow(this)">\
					<td>'+($row.parent().children().length+1)+'</td>\
					<td><input class="role-name" type="hidden" value="'+response.result.name+'" />'+response.result.name+'</td>\
					<td>'+response.result.description+'</td>\
					<td>\
						<a class="vii-delete" href="javascript:void(0)" onclick="Role.DeleteRow(this)">\
							<i class="fa fa-fw fa-times-circle"></i>\
						</a>\
					</td>\
				</tr>');
			}
			else
			{
				alert('Cannot add role!');
				$row.fadeOut('1000', function(){
					$(this).remove();
				});
			}
		});
	};
	
	this.SetRole = function(sender, user, role) {
		var checked = $(sender).is(":checked");
		$.ajax({
			url:this.settings.urlAssignment,
			data:{
				user:user,
				role:role,
				checked:checked
			}
		}).done(function(response){

		});
	};
};

$(function(){
	$("table.role-table > tbody > tr").click(function(){
		Role.SelectRow(this);
	});
	
	$("table.role-table > tbody > tr a.vii-delete").click(function(){
		Role.DeleteRow(this);
	});
});