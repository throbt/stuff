var wm = {};

wm.Component = function(cfg) {
	this.cfg 	= cfg;
	this.type = cfg.type;
	this.init(this.cfg);
};

wm.Store = function(cfg) {
	this.type = cfg.type;
	this.init(cfg);
};

wm.Grid = $.componentExtend(wm.Component, {

  type: 'grid',

  datastore: {},

  init: function(cfg) {
  	this.datastore = cfg.datastore;
    this.build();
  },

  build: function() {

		var tr 			= {},
				self 		= this,
				items 	= this.datastore.items,
				fields 	= this.datastore.fields;

    this.table = $.createEl({
      type  : 'table',
      id    : this.cfg.id,
      cls   : this.cfg.cls,
      style : ''
		},(this.cfg.parent ? this.cfg.parent : document.body));

		for(var iter = 0, l = items.length; iter <= l; iter++) {

			tr = $.createEl({

				type  : 'tr',
	      id    : ['tr_',iter].join(''),
	      cls   : 'tr',
	      style : ''

			},this.table);

			for(var i = 0, len = fields.length; i < len; i++) {

				/*
					head
				*/
				if(iter == 0) {

					$.createEl({

						type  : 'td',
			      id    : ['td_',i].join(''),
			      rel 	: fields[i].field,
			      cls   : 'grid_head td',
			      style : '',
			      html 	: fields[i].name,
			      cmd   : ['click', function(e,obj) {
			      	if(thisTarget = $.getParent(e.currentTarget, 'TD')) {
			      			self.datastore.sort(thisTarget.getAttribute('rel'));
			      	}
			      }]

					},tr);

				/*
					body
				*/
				} else {

					$.createEl({

						type  : 'td',
			      id    : ['td_',i].join(''),
			      rel 	: [fields.field,'_',(iter-1),'_',i].join(''),
			      cls   : 'grid_body td',
			      style : '',
			      html 	: items[iter-1][fields[i].field]

					},tr);

				}
			}

		}
  }
});



wm.DataStore = $.componentExtend(wm.Store, {

  type: 'datastore',

  fields: [],
  cache: [],
  items: [],

  init: function(cfg) {
  	this.fields = cfg.fields;
  	this.items 	= cfg.items;
  	this.cache 	= cfg.items;
  },

  sort: function(field) {
  	alert(field);
  }
});




