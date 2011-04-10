jx.overlay = {
	
	overlay : '<div id="overlayBackground"></div><div id="overlay"><a id="overlay_closeButton" href="javaScript:;">Close</a></div>',
	
	init : function(modul, params, callback){
		if(jQuery('#overlay').length == 0){
			jQuery('body').append(this.overlay);
		}
		jx.overlay.setBindings();
		
		jQuery('#overlay').children('.modul').remove().end().append('<div class="modul"><div class="outerHeader"><div class="header">Loading</div></div><div class="outerContent"><div class="content">' + jx.loading + '</div></div></div>');
		
		jQuery(document).keyup(function(e) { 
		    if (e.which == 27) {
				jx.overlay.hide();
			}
		});
		
		if(typeof params == 'undefined'){
			params = {};
		}
		
		if(typeof modul != 'undefined'){
			jx.overlay.loadModuleContent(modul, params, callback);
		}
		
	},
	hide : function(){
		$('#overlay_closeButton').click();
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
						
						if(result === 'false'){
							jx.overlay.remove();
							return;
						}
						
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
	loadModuleContent : function(modul, params, callback){
				
		jQuery.ajax({ 	
			url: 		jx.root+"overlay/"+modul,
			data: 		{params: params}, 
		 	dataType: 	'html',
			type: 		"POST",
			context: 	document.body, 
			success: 	function(result){
				
				if(result === 'false'){
					
					jx.overlay.remove();
					return;
				}
				
				jQuery('#overlay').children('.modul').remove().end().append(result);
				
				
				if(typeof callback !== 'undefined'){
					console.log('callback start');
					callback();
					console.log('callback end');
				}
				
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