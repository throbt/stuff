var component = {

	type: 'component',

	value: '',

	initialize: function() {
		var self = this;
	},

	getter: function() {
		return  this.value;
	},
	
	setter: function(str) {
		this.value = str;
	}
}