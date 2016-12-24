/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var DIYBuilder = new function(){
	this.createRowSource = function(obj) {
		$(obj).draggable({
			revert: "invalid",
			stack: ".diy-row",
			helper: 'clone'
		});
	};
	
	this.createContainer = function(obj) {
		$(obj).droppable({
			accept:function(ele) { 
				if(ele.hasClass("diy-row")&&!ele.hasClass("ui-sortable-helper")){ 
					return true;
				}
				return false;
			},
			greedy:true,
			drop: function(event, ui) {
				var parent = $(this);
				var dragSource = ui.draggable;
				var child = dragSource.clone();
				DIYBuilder.createChildContainer(parent, child);
				$(this).css('background-color', 'white');
				console.log(parent.attr('id'));
			},
			over: function(event, ui) {
				$(this).css('background-color', '#b2ebf2');
			},
			out: function(event, ui) {
				$(this).css('background-color', 'white');
			}
		});
	};
	
	this.createChildContainer = function(parent, child) {
		var cols = prompt("Please input columns following the bootstrap format", "6 6");
		var i;
		if(cols !== null)
		{
			cols = cols.trim().split(' ');
			var str_cols = '';
			for(i=0; i<cols.length; i++)
			{
				if(cols[i].trim() != '')
				{
					str_cols += ('<div class="diy-col col-md-'+cols[i]+'"><div class="diy-container" id="'+uuid.v4()+'"><div class="diy-dropable" id="'+uuid.v4()+'"></div></div></div>');
				}
			}
			
			var div = $('<div class="diy-row row">\
				<div class="col-md-12"><div class="diy-row-header clearfix">Container<a onclick="DIYBuilder.removeContainer(this)" href="javascript:void(0)" style="float:right;margin-left:8px;padding-right:4px;font-size:15px;color:white">\
					<i class="fa fa-trash-o"></i>\
				</a></div></div>\
				'+str_cols+'\
			</div>');
			DIYBuilder.createContainer(div.find(".diy-container"));
			DIY.createWidgetContainer(div.find(".diy-dropable"))
			$(parent).append(div);
		}
	};
	
	this.removeContainer = function(sender){
		if(confirm('Are you sure you want to remove this container?'))
		{
			$(sender).closest('.diy-row').fadeOut(500, function() {
				$(this).remove();
				DIY.saveAllWidgets(0,0);
			});
		}
	};
};

$(function(){
	DIYBuilder.createRowSource($('.diy-tool-bar').find('.diy-row'));
	DIYBuilder.createContainer($('.diy-container'));
});