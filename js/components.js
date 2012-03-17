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
		$.createEl({
      type  : 'table',
      id    : 'test',
      cls   : 'anyClass',
      style : 'width:50px;height:50px;background:red;position:absolute;top:0px;left:0px;'
    });
	}
});


