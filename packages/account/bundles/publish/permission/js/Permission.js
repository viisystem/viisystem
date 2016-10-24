/* 
    Created on : Oct 24, 2016, 9:32:29 AM
    Author     : Minh Nguyen
*/

var Permission = new function() {
	this.settings = {
		targetObject:null,
		urlSetPermission:null,
		urlAddPermission:null,
		urlDeletePermission:null
	};
	this.SelectRow = function(sender) {
		
	};
	this.DeleteRow = function(sender) {
		var $row = $(sender).closest('.vii-row');
		$row.remove();
	};
	this.CheckRow = function(sender) {
		var $sender = $(sender);
		var $parent = $sender.parent();
		
		var permissionName = $parent.find('input.permission-checkbox').val();
		var checked = $parent.find('input.permission-checkbox').is(":checked");
		var roleName = null;
		$("table.role-table > tbody > tr").each(function(){
			if($(this).hasClass('active'))
			{
				roleName = $(this).find('input.role-name').val();
				return;
			}
		});
		
		$.ajax({
			url:this.settings.urlSetPermission,
			data:{
				roleName:roleName,
				permissionName:permissionName,
				checked:checked
			}
		}).done(function(response){
			
		});
	};
	
	this.DeleteRow = function(sender) {
		if(confirm('Are you sure you want to delete this permission?'))
		{
			var $row = $(sender).closest('.vii-row');
			
			var permissionName = $row.find('input.permission-checkbox').val();
			$.ajax({
				url:this.settings.urlDeletePermission,
				data:{
					permissionName:permissionName
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
					alert('Cannot delete this permission!');
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
			<td><input class="form-control input-permission-name" type="text"/></td>\
			<td><input class="form-control input-permission-desc" type="text"/></td>\
			<td>\
				<a class="vii-apply" href="javascript:void(0)" onclick="Permission.AddPermission(this);" style="color:#1ab394">\
					<i class="fa fa-fw fa-check"></i>\
				</a>\
			</td>\
		</tr>');
	};
	this.AddPermission = function(sender)
	{
		var $row = $(sender).closest('.vii-row');
		var permissionName = $row.find('input.input-permission-name').val();
		var permissionDesc = $row.find('input.input-permission-desc').val();
		$.ajax({
			url:this.settings.urlAddPermission,
			data:{
				permissionName:permissionName,
				permissionDesc:permissionDesc
			}
		}).done(function(response){
			if(response.success === true)
			{
				$row.replaceWith('<tr class="vii-row">\
					<td><input class="permission-checkbox" value="'+response.result.name+'" type="checkbox" onclick="Permission.CheckRow(this)"/></td>\
					<td>'+response.result.name+'</td>\
					<td>'+response.result.description+'</td>\
					<td>\
						<a class="vii-delete" href="javascript:void(0)" onclick="Permission.DeleteRow(this)">\
							<i class="fa fa-fw fa-times-circle"></i>\
						</a>\
					</td>\
				</tr>');
			}
			else
			{
				alert('Cannot add permission!');
				$row.fadeOut('1000', function(){
					$(this).remove();
				});
			}
		});
	};
};

$(function(){
	$("table.permission-table > tbody > tr input.permission-checkbox").click(function(){
		Permission.CheckRow(this);
	});
	
	$("table.permission-table > tbody > tr a.vii-delete").click(function(){
		Permission.DeleteRow(this);
	});
});