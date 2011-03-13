
jx.modules.login = {
	init : function(ref){
		var self = this;
		ref.each(function(){
			$('a.module_login_register', this).unbind('click.module_login_register').bind('click.module_login_register', function(){
				jx.overlay.init('register/form');
			});
		});
		
	}
};


jx.Listeners.addListener('is_login', function(ref){jx.modules.login.init(ref);}, 1);