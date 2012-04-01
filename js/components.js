$.outerInit(function() {

  window.wm = {};

  window.wm.Component = function (cfg) {
    this.cfg  = cfg;
    this.type = cfg.type;
    this.init(this.cfg);
  };

  window.wm.Store = function (cfg) {
    this.type = cfg.type;
    this.init(cfg);
  };

  window.wm.Grid = $.extend(wm.Component, {

    type: 'grid',

    datastore: {},

    init: function (cfg) {
      this.datastore = cfg.datastore;
      this.build(this.datastore.items);
    },

    build: function (items) {

      $.remove($.getDom('div[id=gridContainer]'),['table[id=',this.cfg.id,']'].join(''));

      var tr    = {},
        self    = this,
        items   = items || [] /*this.datastore.items*/,
        fields  = this.datastore.fields;

      this.table = $.createEl({
        type: 'table',
        id: this.cfg.id,
        cls: this.cfg.cls,
        style: ''
      }, (this.cfg.parent ? this.cfg.parent : document.body));

      for (var iter = 0, l = items.length; iter <= l; iter++) {

        tr = $.createEl({

          type: 'tr',
          id: ['tr_', iter].join(''),
          cls: 'tr',
          style: ''

        }, this.table);

        for (var i = 0, len = fields.length; i < len; i++) {

          /*
            head
          */
          if (iter == 0) {

            $.createEl({

              type: 'td',
              id: ['td_', i].join(''),
              rel: fields[i].field,
              cls: 'grid_head td',
              style: '',
              html: fields[i].name,
              cmd: ['click', function (e, obj) {
                if (thisTarget = $.getParent(e.currentTarget, 'TD')) {
                  self.build(self.datastore.sort(thisTarget.getAttribute('rel')));
                }
              }]

            }, tr);

          /*
            body
          */
          } else {

            $.createEl({

              type: 'td',
              id: ['td_', i].join(''),
              rel: [fields.field, '_', (iter - 1), '_', i].join(''),
              cls: 'grid_body td',
              style: '',
              html: items[iter - 1][fields[i].field]

            }, tr);
          }
        }
      }
    }
  });



  window.wm.DataStore = $.extend(wm.Store, {

    type: 'datastore',

    fields      : [],
    cache       : [],
    items       : [],

    init: function (cfg) {
      this.fields = cfg.fields;
      this.items  = cfg.items;
      this.cache  = cfg.items;
    },

    sort: function (field) {
      this.currentField = field;
      if(!this[field]) {
        this[field] = [];
        for(var i = 0, l = this.items.length; i < l; i++) {
          this[field].push(this.items[i][field]);
        }
        this[field].sort();
      } else {
        this[field].reverse();
      }
      return this.sortObject(this[field], this.items);
    },

    sortObject: function(arr, obj) {
      var res = [],field = this.currentField;
      for(var i = 0, l = arr.length; i < l; i++) {
        res.push(this.getCurrentHashEl(field,arr[i]));
      }
      return res;
    },

    getCurrentHashEl: function(field, val) {
      var hash = this.items;
      for(var i in hash) {
        if(hash[i][field] === val) {
          return hash[i];
          break;
        }
      }
    }
  });
});
