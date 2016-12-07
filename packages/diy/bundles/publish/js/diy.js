/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var DIY = new function(){
	this.saveAllWidgets = function(container, pageid){
		// Lưu widget
		var arr = [];
		container = $(container);
		container.children().each(function(){
			arr.push($(this).data('settings'));
		});
		$.ajax({
			url:'/viisystem/users/default/admin.php/diy/process/save-widget',
			method:"POST",
			data:{
				page:encodeURIComponent(pageid),
				position:encodeURIComponent(container.attr('id')),
				widgets:encodeURIComponent(JSON.stringify(arr))
			},
			success:function(response) {
				// Xử lý kết quả
			}
		});
	};
	
	this.loadContent = function(clone){
		DIY.createSettingForm(clone);
		$.ajax({
			url:'/viisystem/users/default/admin.php/diy/process/get-content',
			data:{data:encodeURIComponent(JSON.stringify(clone.data('settings')))},
			success:function(response) {
				clone.find('.diy-content').html(response);
			}
		});
	};
	
	this.createSettingForm = function(widget){
		var settings = $(widget).data('settings');
		var params = settings.params;
		var str_form = '<div>';
		$.each(params, function(i, item){
			str_form += '<input type="text" />';
		});
		$(widget).find('.setting-form').html(str_form);
	};
};

$(document).ready(function(){
	$('.diy-draggable').draggable({
		revert: "invalid",
		stack: ".diy-draggable",
		helper: 'clone'
	});
	$('.diy-dropable').droppable({
		accept: ":not(.ui-sortable-helper)",
		drop: function(event, ui) {
			var droppable = $(this);
			var draggable = ui.draggable;
			var clone = draggable.clone();
			clone.addClass('diy-sortable');
			clone.appendTo(droppable);
			
			// Lưu widget
			DIY.saveAllWidgets(droppable, clone.data('page'));
			
			// Load nội dung
			DIY.loadContent(clone);
		}
	}).sortable({
		items: ".diy-sortable",
		sort: function () {
			// gets added unintentionally by droppable interacting with sortable
			// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
			//$(this).removeClass("ui-state-default");
			console.log('sort');
			console.log($(this));
		}
     });
});