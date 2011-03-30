

jx.modules.admin_reorderModules = {
	init : function(ref){
		
		$( '.slot' ).sortable({
			revert: 150,
			forcePlaceholderSize: true,
			items: '.modul:not(.is_admin_reorderModules)',
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
	}
};


jx.Listeners.addListener('is_admin_reorderModules', jx.modules.admin_reorderModules.init, 1);