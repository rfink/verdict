/**
 * Comparison module for the verdict decision engine, contains
 *   methods that perform boolean comparisons.
 * @author Ryan Fink <rfink@redventures.net>
 * @since  September 2, 2011
 */
var Comparison = (function() {
	
	return {
		equals: function(context, config) {
			return context == config;
		},
		notEquals: function(context, config) {
			return context != config;
		},
		identical: function(context, config) {
			return context === config;
		},
		lessThan: function(context, config) {
			return context < config;
		},
		greaterThan: function(context, config) {
			return context > config;
		},
		contains: function(context, config) {
			if (typeof config != 'object') {
				throw new Error('Configuration must be an array or object');
			}
			for (var i in config) {
				if (config[i] == context) return true;
			}
			return false;
		},
		notContains: function(context, config) {
			if (typeof config != 'object') {
				throw new Error('Configuration muts be an array or object');
			}
			for (var i in config) {
				if (config[i] == context) return false;
			}
			return true;
		},
		stringContains: function(context, config) {
			return context.indexOf(config) !== -1;
		},
		stringNotContains: function(context, config) {
			return context.indexOf(config) === -1;
		},
		or: function(context, config) {
			return context || config;
		},
		and: function(context, config) {
			return context || config;
		},
		not: function(context) {
			return !context;
		},
		xor: function(context, config) {
			return (context && !config) || (!context && config);
		}
	};
	
})();
