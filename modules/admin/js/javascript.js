$(document).ready(function(){
	
	var params = {};
	
	jQuery.ajax({ 	
		url: 		jx.root+"ajax/admin/getBar",
		data: 		{params: params}, 
	 	dataType: 	'json',
		type: 		"POST",
		context: 	document.body, 
		success: 	function(json){
			
			if(json != false ){

				$('body').prepend(json.content);
				
				jx.modules.admin.adminBar = '#adminbar';
				
				jx.modules.admin.init($('#adminbar'));
			}
		}
	});
});

jx.modules.admin = {
	
	adminBar : false,
	
	init : function(ref){
		
		var self = jx.modules.admin;
		ref.each(function(){
			
			$('.close', this).toggle(self.closeAdminBar, self.openAdminBar);
			//$('.close', this).unbind('click.closeAdminBar').bind('click.closeAdminBar', self.closeAdminBar);
			
			$(this).animate({top:0});
		});
		
		
	},
	closeAdminBar : function(){
		var self = jx.modules.admin;
		
		var width = parseInt($(self.adminBar+' .title').width());
		width += parseInt($(self.adminBar+' .title').css('padding-left'));
		width += parseInt($(self.adminBar+' .title').css('padding-right'));
		width += parseInt($(self.adminBar+' .title').css('margin-left'));
		width += parseInt($(self.adminBar+' .title').css('margin-right'));
		
		width += parseInt($(this).width());
		width += parseInt($(this).css('padding-left'));
		width += parseInt($(this).css('padding-right'));
		width += parseInt($(this).css('margin-left'));
		width += parseInt($(this).css('margin-right'));
		
		$(this).html('>');
		$(self.adminBar).animate({width:width+'px'});
	},
	openAdminBar : function(){
		var self = jx.modules.admin;
		
		$(this).html('<');
		$(self.adminBar).animate({width:'100%'});
	}
};