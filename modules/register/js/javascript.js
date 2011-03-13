jx.modules.register = {
	
	init : function(ref){
		var self = this;
		ref.each(function(){
			self.checkIfExists('username');
			self.checkIfExists('email');
			self.checkIfPasswordIsOk();
		});
		
	},
	checkIfPasswordIsOk : function(){
		jQuery('input[name="module_register_password"], input[name="module_register_password2"]').unbind('keyup').bind('keyup', function(){


			if(jQuery('input[name="module_register_password"]').val() != jQuery('input[name="module_register_password2"]').val() || jQuery(this).val().length < 6){
				jQuery('input[name="module_register_password"]').addClass('error');
				jQuery('input[name="module_register_password2"]').addClass('error');
			}else{
				jQuery('input[name="module_register_password"]').removeClass('error');
				jQuery('input[name="module_register_password2"]').removeClass('error');
			}

		});
	},
	checkIfExists : function(type){
		
		jQuery('input[name="module_register_'+type+'"]').unbind('keyup').bind('keyup', function(){
			var value = jQuery(this).val();
						
			if(value.length > 3){
				//nachprüfen ob der username oder andere felder so schon vergeben sind
				
				var target = jQuery(this).parentsUntil('.modul');
				var formdata = {};
				
				jQuery('input, select', target).each(function(){

					var name = jQuery(this).attr('name');
					var value = jQuery(this).val();

					formdata[name] = value;
					
				});
				
				jQuery.ajax({ 	
					url: 		jx.root+"ajax/register/isRegistered",
					data: 		{params: formdata}, 
				 	dataType: 	'json',
					type: 		"POST",
					context: 	document.body, 
					success: 	function(json){
						
						jQuery('input, select', target).each(function(){
							jQuery(this).removeClass('error'); 
						});
						if(json != false ){
							for(var key in json){
								
								jQuery('input[name="module_register_'+json[key]+'"]').addClass('error'); 
								
							}
							
						}
					}
				});
			}else{
				jQuery(this).addClass('error');
			}
		});
	}
};

jx.Listeners.addListener('is_register', function(ref){jx.modules.register.init(ref);}, 1);