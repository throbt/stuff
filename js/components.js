var wm = {};

wm.Component = function(config){

	this.config = config;

	//  this.init.call(this, config);

console.log(this);


		// this.init = true;
  //   this.config = config;
  //   this.initComponent.call(this, config);



  //this.prototype.init.call(this, config);



	//  this.type 	= 'component';
	//  this.value = '';
	//  this.cfg 	= cfg;

	// this.getter = function() {
	// 	return this.value;
	// }

	// this.setter = function(str) {
	// 	this.value = str;
	// }

	// this.initialize = function(cfg) {
	// 	// this.init.call(this, this.cfg);
	// }

	// this.initialize.call(this, this.cfg);

	// console.log(this.render);
	// this.initialize(cfg);
};

// vm.DataStore = $.extend(wm.Component, {

// 	type: 'datastore',

// 	fields: [],

// 	items: []

// 	init: function(cfg) {
// 		this.initialize.call(this, cfg);
// 	}
// });

wm.Grid = $.extend(wm.Component, {

	type: 'grid',

	dataStore: {},

	render: function() {
		var self = this;
		if(this.data.items.length > 1)
		self.build();
	},

	init: function(config) { alert("asdasd"); console.log(config);
		// this.init();


		wm.Grid.superclass.init.call(this, config);
	},

	// init: function(cfg) { alert("asdasd");
	// 	// this.initialize.call(this, cfg);
		
	// },

	build: function() {
		$.createEl({
			type  : 'table',
			id    : 'test',
			cls   : 'anyClass',
			style : 'width:50px;height:50px;background:red;position:absolute;top:0px;left:0px;'
		});
	}
});


