jx = {
	debug : false,
	
	root : '/',
	url : window.location.href.split('.html').shift(),
	
	loading : '<div class="loadingBlock">Loading...</div>',
	modules : {},
	Debug : {

		debug:		jQuery.noop,
		info:		jQuery.noop,
		warn:		jQuery.noop,
		error:		jQuery.noop,
		log:		jQuery.noop,
		time:		jQuery.noop,
		timeEnd:	jQuery.noop,
		profile:	jQuery.noop,
		profileEnd:	jQuery.noop,
		trace:		jQuery.noop,
		group:		jQuery.noop,
		groupEnd:	jQuery.noop,
		dir:		jQuery.noop,
		dirxml:		jQuery.noop,
		assert:		jQuery.noop,
		clear:		jQuery.noop,
		count:		jQuery.noop

	},
	
	each : function(array, fn, scope){
	    for(var i = 0, len = array.length; i < len; i++){
	        if(fn.call(scope || array[i], array[i], i, array) === false){
	            return i;
	        }
	    }
	    return false;
	},
	
	namespace : function(){
		var o, d;
	    jx.each(arguments, function(v) {
	        d = v.split(".");
	        o = window[d[0]] = window[d[0]] || {};
	        jx.each(d.slice(1), function(v2){
	            o = o[v2] = o[v2] || {};
	        });
	    });
	    return o;
	},
	
	
	
	parseParameter : function(target){
		
		var parts = location.href.split('#');
		if(parts.length > 1){
		
			var paramString = location.href.split('#').pop();
			var params = paramString.split('&');
		
			target.config = {};
			for(var i=0; i < params.length; i++){
				var param = params[i];
			
				var parts = param.split('=');
			
				var name = parts.shift();
				var value = parts.pop();
			
				target.config[name] = value;
			}
			console.log(['parseParameter', target.config]);
		}
	},
};
jx.ns = jx.namespace;


// Check firebug enabled
if (typeof console === 'undefined') {
	var console = jx.Debug;
}


$.fn.parentsUntil = function(selector){
    var target = jQuery(this);
    selector = selector + ',document';
    while(!target.is(selector) && target.length > 0){
        target = target.parent();
    }
    return target;
};

Function.prototype.forEach = function(object, block, context) {
  for (var key in object) {
    if (typeof this.prototype[key] == "undefined") {
      block.call(context, object[key], key, object);
    }
  }
};

// globally resolve forEach enumeration
var forEach = function(object, block, context) {
  if (object) {
    var resolve = Object; // default
    if (object instanceof Function) {
      // functions have a "length" property
      resolve = Function;
    } else if (object.forEach instanceof Function) {
      // the object implements a custom forEach method so use that
      object.forEach(block, context);
      return;
    } else if (typeof object.length == "number") {
      // the object is array-like
      resolve = Array;
    }
    resolve.forEach(object, block, context);
  }
};

