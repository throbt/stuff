var wm = {};

wm.Component = function(config){
	this.config = config;
	this.init.call(this, this.config);
};

wm.Grid = $.extend(wm.Component, {

	type: 'grid',

	dataStore: {},

	render: function() {
		var self = this;
		if(this.data.items.length > 1)
		self.build();
	},

	initialize: function() {
		console.log(arguments);
	},

	init: function(config) { console.log(arguments);
		// this.init();
		// wm.Grid.superclass.init.call(this, config);

		this.build();
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

// vm.DataStore = $.extend(wm.Component, {

// 	type: 'datastore',

// 	fields: [],

// 	items: []

// 	init: function(cfg) {
// 		this.initialize.call(this, cfg);
// 	}
// });




