
$(window).unbind('scroll').bind('scroll', function(){
	if  ($(window).scrollTop() == $(document).height() - $(window).height()){
		jx.Scrolldown.load();
	}
});

jx.Scrolldown = {
	
	objects : [],
	
    load: function (){
		var self = jx.Scrolldown;

		for (var j in self.objects) {
			var object = self.objects[j];
			
			object.functionObject($(object.targetObject));
		}
			
	},
	
	addScrollCallback : function (functionObject, targetObject){
		var self = jx.Scrolldown;
		self.objects.push({functionObject: functionObject, targetObject: targetObject});

	}
};