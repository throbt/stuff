var wm = {};

wm.Component = function(config){
	console.log('elso');
  this.init(config);
};

wm.Grid = $.componentExtend(wm.Component, {

  type: 'grid',

  dataStore: {},

  init: function(config) {
    console.log('masodik');
    console.log(config);
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

wm.DataStore = $.componentExtend(wm.Grid, {

  type: 'datastore',

  fields: [],

  items: [],

  init: function(config) {
    console.log('harmadik');

    console.log(this.build);

    console.log(config);
  }
});




