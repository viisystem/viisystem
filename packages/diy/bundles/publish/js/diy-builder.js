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
			accept: ":not(.ui-sortable-helper)",
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
		var div = $('<div class="diy-row row">\
			<div class="col-md-12"><div class="diy-row-header">Delete</div></div>\
			<div class="diy-col col-md-4"><div class="diy-container" id="'+uuid.v4()+'"></div></div>\
			<div class="diy-col col-md-8"><div class="diy-container" id="'+uuid.v4()+'"></div></div>\
		</div>');
		DIYBuilder.createContainer(div.find(".diy-container"));
		$(parent).append(div);
	};
};

$(function(){
	DIYBuilder.createRowSource($('.diy-row'));
	DIYBuilder.createContainer($('.diy-container'));
});