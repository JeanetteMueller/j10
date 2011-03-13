var autoRefreshTim = 2500;

$(function(){
	
	setRefreshButton();
	
	setTimeout('autoRefresh()', autoRefreshTim);
});
function autoRefresh(){
	
	$('.refresh').each(function(){
		var string = $(this).attr('id').split('__').pop();

		var id = string.split('_').pop();
		var name = string.split('_').shift();
		getModule(id, name);
	});
	
	
	
	setTimeout('autoRefresh()', autoRefreshTim);
}
function setRefreshButton(){
	$('.refreshbutton').unbind('click.refreshbutton').bind('click.refreshbutton', setRefreshButtonFunction);
}
function setRefreshButtonFunction(){
	var string = $(this).parent().parent().attr('id').split('__').pop();
	
	var id = string.split('_').pop();
	var name = string.split('_').shift();
	getModule(id, name);
	
	return false;
}

function getModule(id, name){
	
	var url = window.location.href.split('.html').shift();
	
	
	$.ajax({ 	
		url: 		url+"/module/"+name,
	 	dataType: 	'json',
		context: 	document.body, 
		success: 	function(json){
       		
			$('#modul__'+name+'_'+id).children('div.content').html(''+json.result);
			
			setRefreshButton();
     	}
	});
	

	
}