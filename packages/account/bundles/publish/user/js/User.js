/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var User = new function()
{
	this.BatchDelete = function(sender, url)
	{
		var keys = $(sender).yiiGridView('getSelectedRows');
		$.post({
			url: url, // your controller action
			dataType: 'json',
			data: {keylist: keys},
			success: function(data) {
			   alert('I did it! Processed checked rows.');
			},
		});
	}
}