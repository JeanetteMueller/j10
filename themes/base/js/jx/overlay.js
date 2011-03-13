jx.overlay = {
	
	overlay : '<div id="overlayBackground"></div><div id="overlay"><a id="overlay_closeButton" href="javaScript:;">Close</a></div>',
	
	init : function(modul, callback){
		if(jQuery('#overlay').length == 0){
			jQuery('body').append(this.overlay);
		}
		jx.overlay.setBindings();
		
		jQuery('#overlay').children('.modul').remove().end().append('<div class="modul"><div class="outerHeader"><div class="header">Loading</div></div><div class="content">' + jx.loading + '</div></div>');
		
		jQuery(document).keyup(function(e) { 
		    if (e.which == 27) {
				jx.overlay.remove();
			}
		});
		
		if(typeof modul != 'undefined'){
			jx.overlay.loadModuleContent(modul, callback);
		}
		
	},
	initWithData : function(data){
		if(jQuery('#overlay').length == 0){
			jQuery('body').append(this.overlay);
		}
		jQuery('#overlay').children('.modul').remove().end().append(data);
		
		jx.overlay.setBindings();
	},
	setBindings : function(){

		var source = jQuery('#overlay');

		$('#overlay_closeButton', source).unbind('click.overlay_closeButton').bind('click.overlay_closeButton', function(){
			jx.overlay.remove();
		});
		
		jQuery('.is_submit', source).unbind('click.is_submit').bind('click.is_submit', function(){
			
			var error = false;
			var target = $(this).parentsUntil('.modul');
			var modul = target.attr('title');
			var formdata = {};
			var action = $(this).parentsUntil('form').attr('action');

			jQuery('input, select, textarea', target).each(function(){
				
				var name = jQuery(this).attr('name');
				var value = jQuery(this).val();
				
				formdata[name] = value;
				
				if(jQuery(this).hasClass('error')){
					error = true;
				}
			});
			if(!error){
				jQuery.ajax({ 	
					url: 		jx.root+'overlay/'+modul+'/'+action,
					data: 		{params: formdata}, 
				 	dataType: 	'html',
					type: 		"POST",
					context: 	document.body, 
					success: 	function(result){

						jQuery('#overlay').children('.modul').remove().end().append(result);

						jx.overlay.setBindings();
					}
				});
			}else{
				alert('Bitte korrigieren Sie Ihre Eingaben');
			}
			return false;
		});
		
		jx.Listeners.init(source);
	},
	loadModuleContent : function(modul, callback){
		
		var config = {};
		
		jx.parseParameter(config);
		
		
		jQuery.ajax({ 	
			url: 		jx.root+"overlay/"+modul,
			//data: 		{params: config.config}, 
		 	dataType: 	'html',
			type: 		"GET",
			context: 	document.body, 
			success: 	function(result){
				
				
				
				
				jQuery('#overlay').children('.modul').remove().end().append(result);
				
				
				console.log('callback start');
				if(typeof callback !== 'undefined'){
					callback();
				}
				console.log('callback end');
				
				jx.overlay.setBindings();
				
				
					
				
			}
		});
		
	},
	remove : function(){
		
		jQuery('#overlay').remove();
		jQuery('#overlayBackground').fadeOut('normal', function(){
			$(this).remove();
		});
	}
}