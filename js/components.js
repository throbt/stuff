var window = {};

window.component = {

	type: 'component',

	value: '',

	initialize: function() {
		var self = this;
		self.render();
	},

	getter: function() {
		return  this.value;
	},

	setter: function(str) {
		this.value = str;
	}
};



window.grid = $.apply(window.component, {
	
	data: {
		fields: [],
		items: []
	},

	render: function() {
		var self = this;
		if(this.data.items.length > 1)
			self.build();
	},

	build: function() {
		
	}
});


