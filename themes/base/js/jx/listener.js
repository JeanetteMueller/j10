jx.Listeners = {

	listeners:	{},

	init: function(selector) {

		// Check selector
		if (typeof selector === 'undefined') {
			selector = $(document);
		}

		// Check jQuery instance
		if (!selector instanceof jQuery) {
			selector = jQuery(selector);
		}

		// List priorities
		for (var i = 1; i <= 9; i++) {

			// Check existence
			if (!jx.Listeners.listeners[i]) {
				continue;
			}

			// List listeners
			for (var j in jx.Listeners.listeners[i]) {

				// Get listener
				var listener = jx.Listeners.listeners[i][j];

				// Debug
				if (jx.debug) console.log('Processing listener:', listener.name);

				// Get elements
				var elements = selector.find('.' + listener.name);

                if(elements.length > 0){
                    // Execute callback
                    listener.callback(jQuery(elements));
                }

				// Debug
				if (jx.debug) console.log('Executed listener:', listener.name, elements);

			}

		}

	},

	addListener: function(name, callback, priority) {

		// Check callback
		if (!jQuery.isFunction(callback)) {
			return false;
		}

		// Check priority
		priority = (typeof priority === 'undefined' || priority > 9) ? 9 : priority;

		// Check priority existence
		if (!jx.Listeners.listeners[priority]) {
			jx.Listeners.listeners[priority] = [];
		}

		// Add listener
		jx.Listeners.listeners[priority].push({
			priority:	priority,
			name:		name,
			callback:	callback
		});

		// Debug
		if (jx.debug) console.debug('Added listener:', name, callback, priority);

		return true;

	}

};

// Register ready handler
jQuery(document).ready(
	jx.Listeners.init
);