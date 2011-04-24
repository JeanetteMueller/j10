

jx.modules.admin_reorderModules = {
	initUpdateParams : function(ref){
		var self = this;
		
		ref.each(function(){

			$(this).unbind('change.updateParams').bind('change.updateParams', function(){
				

				
				var target = $(this).parentsUntil('.modul');
				var id = target.attr('id').split('_').pop();
				var site_id = $('meta[name=id]').attr('content');
				var data = {modulslot_id: id, site_id: site_id, newParams: {} };
				var key = '';
				$(this).parentsUntil('.admin').find('input, textarea, select').each(function(index, object){
					
					key = $(object).attr('id').split('__').pop();
					
					data.newParams[key] = $(object).val();
					
					if ($(object).attr('type') == 'checkbox'){
						if($(object).attr('checked')){
							data.newParams[key] = 1;
						}else{
							data.newParams[key] = 0;
						}
					}
					
					
				});
				
				
				jQuery.ajax({ 	
					url: 		jx.root+"ajax/admin_reorderModules/updateModulParams",
				 	dataType: 	'json',
					data:  		{params: data},
					type: 		"POST",
					context: 	document.body, 
					success: 	function(json){
						
						if(json == "true" ){
							
							var modulid = $(target).attr('id');
							var string = modulid.split('__').pop();
							var id = string.split('_').pop();
							var name = string.split('_').shift();
							
							var request = [];
							request.push({id:id, name:name, params:data.newParams});
													
							window[modulid+'_params'] = data.newParams;
							
							//modul__<@ $modul->path @>_<@ $modul->id @>_params
							
							jx.autoRefresh.autoRefresh(request);
							
						}
					}
				});
				
			});
		});
		
	},
	initReorder : function(ref){
		
		$( '.slot' ).sortable({
			revert: 150,
			forcePlaceholderSize: true,
			items: '.modul',
			connectWith: ".slot",
			dropOnEmpty: true,
			start: function(event, ui){

			},
			stop: function(event, ui){
				
				jx.modules.admin_reorderModules.updateModuleOrder();
				
			}
		}).disableSelection();

		$( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
			.find( ".portlet-header" )
				.addClass( "ui-widget-header ui-corner-all" )
				.prepend( "<span class='ui-icon ui-icon-minusthick'></span>")
				.end()
			.find( ".portlet-content" );

		$( ".portlet-header .ui-icon" ).click(function() {
			$( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
			$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
		});
		
	},
	
	updateModuleOrder : function(){
		
		var data = {};
		$('.slot').each(function(slotindex, slotobject){
			
			var slot_id = $(slotobject).attr('id').split('_').pop();
			var modules = [];
			$('.modul',slotobject).each(function(modulindex, modulobject){
				
				if( ! $(modulobject).hasClass('is_admin_reorderModules')){
					
					var id = $(modulobject).attr('id').split('_').pop();
					modules.push(id);
				}
			});
			
			data[slot_id] = modules;
		});
		
		
		jQuery.ajax({ 	
			url: 		jx.root+"ajax/admin_reorderModules/saveModulePlace",
		 	dataType: 	'json',
			data:  		{params: data},
			type: 		"POST",
			context: 	document.body, 
			success: 	function(json){
				
				if(json !== false ){
				
					
				}
			}
		});
	},
	
	initInsert : function(ref){
		var self = this;
		
		ref.each(function(){
			
			$(this).unbind('change.selectmodul').bind('change.selectmodul', function(){
				if($(this).val() !== ''){
					var modul = $(this).val().split('___').pop();
					var modul_id = $(this).val().split('___').shift();
					var selector = this;				
					var site_id = $('meta[name=id]').attr('content');
					var params = 'NULL';
				
					var data = {
						modul: modul,
						modul_id: modul_id,
						site_id: site_id,
						slot_id: $(selector).parentsUntil('.slot').attr('id').split('_').pop(),
						sort: 999,
						params: params
					};
				
					$(selector).val('');
				
					jQuery.ajax({ 	
						url: 		jx.root+'ajax/admin_reorderModules/insertNewModuleInPlace',
					 	dataType: 	'html',
						data:  		{params: data},
						type: 		"POST",
						context: 	document.body, 
						success: 	function(html){
							$(selector).parentsUntil('.slot').append(html);
						
							
						
							jx.Listeners.init();
						}
					});
				}
			});
		});
	}, 
	
	initRemove : function(ref){
		var self = this;
		
		ref.each(function(){
			
			$(this).unbind('click.removemodul').bind('click.removemodul', function(){
				
				if( window.confirm('Wollen Sie das modul wirklich entfernen?')){
					
					var target = $(this).parentsUntil('.modul');
					var id = target.attr('id').split('_').pop();
				
					var data = {modulslot_id: id};
				
					jQuery.ajax({ 	
						url: 		jx.root+'ajax/admin_reorderModules/removeModuleFromPlace',
					 	dataType: 	'json',
						data:  		{params: data},
						type: 		"POST",
						context: 	document.body, 
						success: 	function(json){

							if(json !== 'false' ){
							
							
								target.remove();
							}
						}
					});
				}
			});
		});
	},
	initShowAdminOptionsOnModul : function(ref){
		var self = this;
		
		ref.each(function(){
			
			$(this).unbind('click.showAdminOptions').bind('click.showAdminOptions', function(){
				
				var target = $(this).parentsUntil('.modul').find('.admin');
				if(target.hasClass('hide')){
					target.removeClass('hide');
				}else{
					target.addClass('hide');
				}
			});
		});
	}
};


jx.Listeners.addListener('is_admin_reorderModules', jx.modules.admin_reorderModules.initReorder, 1);
jx.Listeners.addListener('is_modulselector', function(ref){jx.modules.admin_reorderModules.initInsert(ref);}, 1);

jx.Listeners.addListener('is_removeModule', function(ref){jx.modules.admin_reorderModules.initRemove(ref);}, 1);
jx.Listeners.addListener('is_updateModulParams', function(ref){jx.modules.admin_reorderModules.initUpdateParams(ref);}, 1);

jx.Listeners.addListener('is_showAdminOptionsOnModul', function(ref){jx.modules.admin_reorderModules.initShowAdminOptionsOnModul(ref);}, 1);