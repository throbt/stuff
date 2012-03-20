var wm = {};

wm.Component = function(config){
	this.config = config;
	this.init(this.config);
};

$.extend(wm.Component, {

	init: function(config) { //alert('asdasd');
		
	}
});

// console.log(wm.Component);

wm.Grid = $.extend(wm.Component, {

	type: 'grid',

	dataStore: {},


	init: function(config) {

		// if(typeof config != 'undefined') {
		// 	console.log(config);
		// }

		alert('asdasd');
		console.log(config);

		//this.superclass.call(this,arguments);

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




