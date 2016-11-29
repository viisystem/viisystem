/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
		}
	}).sortable({
		items: ".diy-sortable",
		sort: function () {
			// gets added unintentionally by droppable interacting with sortable
			// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
			$(this).removeClass("ui-state-default");
		}
     });
});