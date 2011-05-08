
jx.autoRefresh = {
	autoRefreshTime : 5000,
	threads : 0,
	init : function(){
		jx.autoRefresh.setRefreshButton();
		
		if($('.refresh').length > 0 && jx.autoRefresh.threads == 0){
			jx.autoRefresh.threads++;
			setTimeout('jx.autoRefresh.autoRefresh(null, true)', jx.autoRefresh.autoRefreshTime);
		}
	},
	setRefreshButton : function (){
		$('.refreshbutton').unbind('click.refreshbutton').bind('click.refreshbutton', function(){
			
			var modulid = $(this).parent().parent().parent().parent().attr('id');
			var string = modulid.split('__').pop();
			
			var id = string.split('_').pop();
			var name = string.split('_').shift();
			var params = window[modulid+'_params'];

			var request = [{id:id, name:name, params:params}];

			jx.autoRefresh.autoRefresh(request, false);

			return false;
		});
	},
	autoRefresh : function(request, autorefresh){
		if(typeof autorefresh == 'undefined' || autorefresh == null){
			autorefresh == true;
		}
		if(request == null){
			request = [];
			$('.refresh').each(function(){
				var modulid = $(this).attr('id');
				var string = modulid.split('__').pop();
				var id = string.split('_').pop();
				var name = string.split('_').shift();
				
				var params = window[modulid+'_params'];
				
				if(typeof params == 'undefined' || params == null){
					params = [];
				}
			
				request.push({id:id, name:name, params:params});
				
				
			});
		}
		
		if(request.length > 0){
			
			$.ajax({ 	
				url: 		jx.url+"/modules/",
				data: 		{request: request}, 
			 	dataType: 	'json',
				type: 		"POST",
				context: 	document.body, 
				success: 	function(json){
       				
					if(json.length > 0){
						var i;
						for (i = 0; i < json.length; i++){
							
							var item = json[i];
							
							if(item.content !== false){
								$('#modul__'+item.module.name+'_'+item.module.id+' div.content').html(''+item.content);
							}
							if(item.header !== false){
								$('#modul__'+item.module.name+'_'+item.module.id+' div.header').html(''+item.header);
							}
							if(item.footer !== false){
								$('#modul__'+item.module.name+'_'+item.module.id+' div.footer').html(''+item.footer);
							}
							
						}
						jx.autoRefresh.setRefreshButton();
					}
					if(autorefresh == true){
						setTimeout('jx.autoRefresh.autoRefresh(null, true)', jx.autoRefresh.autoRefreshTime);
					}
					
				
		     	}
			});
		}
	}
}

jQuery(document).ready(

	jx.autoRefresh.init
);