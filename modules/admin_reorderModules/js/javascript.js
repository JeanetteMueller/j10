

jx.modules.admin_reorderModules = {
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
				var modul = $(this).val().split('___').pop();
				var modul_id = $(this).val().split('___').shift();
				var selector = this;
				
				console.debug('add modul "'+modul+'" here via AJAX call');
				
				$(this).val('');
				
				var data = {
					path: modul,
					id: modul_id
				};
				
				jQuery.ajax({ 	
					url: 		jx.root+"module/"+modul+'?render=modul',
				 	dataType: 	'html',
					data:  		{params: data},
					type: 		"POST",
					context: 	document.body, 
					success: 	function(html){

						if(html !== 'false' ){
							$(selector).parent().parent().parent().append(html);
							
							var site_id = $('meta[name=id]').attr('content');
							if( window.confirm('Für alle Webseiten oder nur diese eine? OK = Alle')){
								site_id = 'NULL';
							}
							
							var params = 'NULL';
							var newParams = window.prompt('Parametereingabe falls benötigt');
							if(newParams !== ''){
								params = newParams;
							}
							
							var insertdata = {
								modul_id: modul_id,
								site_id: site_id,
								slot_id: $(selector).parent().parent().parent().attr('id').split('_').pop(),
								sort: 999,
								params: params
							};
							
							jQuery.ajax({ 	
								url: 		jx.root+'ajax/admin_reorderModules/insertNewModuleInPlace',
							 	dataType: 	'json',
								data:  		{params: insertdata},
								type: 		"POST",
								context: 	document.body, 
								success: 	function(html){

									if(html !== 'false' ){
										
									}
								}
							});
							
							
							
							
						}
					}
				});
			});
		});
	}, 
	
	initRemove : function(ref){
		var self = this;
		
		ref.each(function(){
			
			$(this).unbind('click.removemodul').bind('click.removemodul', function(){
				
				var target = $(this).parent();
				var id = $(this).parent().attr('id').split('_').pop();
				
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
			});
		});
	}
};


jx.Listeners.addListener('is_admin_reorderModules', jx.modules.admin_reorderModules.initReorder, 1);
jx.Listeners.addListener('is_modulselector', function(ref){jx.modules.admin_reorderModules.initInsert(ref);}, 1);

jx.Listeners.addListener('is_removeModule', function(ref){jx.modules.admin_reorderModules.initRemove(ref);}, 1);