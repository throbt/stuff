Ext.define('IddqdTranslateModel', {

  extend: 'Model',
  
  reload: function() {
    var self              = this;
    self.router.view.modalWindow.destroy();
    self.cat              = self.variableStoreCat;
    self.store.proxy.url  = ['lang?lang=',self.language,'&cat=',self.cat].join('');
    self.store.load();
    self.langStore.load();
    self.catStore.load();
    self.variableStore.load();
    
    self.router.view.langCombo.setValue(self.language);
    self.router.view.catCombo.setValue(self.cat);
    self.router.view.varCombo.setValue(self.cat);
  },
  
  // its empty, because the model and view init must start together in the same time - IddqdTranslateController::ajaxCallbBack
  init: function() {
  },
  
  setup: function() {
    
    var self = this;
    
    /*if(Ext.get("Iddqd") == null)
      self.getAjaxData();*/
      
    self.loader           = new Ext.LoadMask(Ext.getBody(), {msg:"loading"});
    
    self.itemsPerPage     = 10;
    self.language         = 'hu';
    self.cat              = '8';
    self.variableStoreCat = '8';
    
    self.store          = Ext.create('Ext.data.Store', {
      storeId : 'translate',
      fields  : [
        'id',
        'category',
        'variable',
        'word',
        'foreign_word'
      ],
        
      proxy: MaximaProxy.get(
        'ajax',
        ['lang?lang=',self.language,'&cat=',self.cat].join(''),
        'get',
        {},
        {
          type          : 'json',
          root          : 'rows',
          totalProperty : 'results',
        }
      )
             
    });
    
    self.langStore      = Ext.create('Ext.data.Store', {
      fields: ['langval', 'lang'],
      autoLoad: true,
      proxy   : {
        type      : 'ajax',
        url       : 'lang/groups',
        reader    : {
          type          : 'json',
          root          : 'rows',
          totalProperty : 'results'
        }
      },
      listeners      : {
        load      : function(store,records,options) {
          Globals.DEPO['components']["langCombo"].setValue(/*self.langStore.getAt(0).data['langval']*/ self.language);
        }
      }
    });

    self.catStore      = Ext.create('Ext.data.Store', {
      fields: ['catval', 'cat'],
      autoLoad: true,
      value: 0,
      proxy   : {
        type      : 'ajax',
        url       : 'lang/cats',
        reader    : {
          type          : 'json',
          root          : 'rows',
          totalProperty : 'results'
          }
      },
      listeners      : {
        load      : function(store,records,options) {
          Globals.DEPO['components']["catCombo"].setValue(/*self.catStore.getAt(0).data['catval']*/ self.cat);
          Globals.DEPO['components']["varCombo"].setValue(/*self.catStore.getAt(0).data['catval']*/ self.cat);
        }
      }
    });
    
    self.variableStore = Ext.create('Ext.data.Store', {
      fields: ['varval', 'var'],
      autoLoad: true,
      value: 0,
      proxy   : {
        type      : 'ajax',
        url       : ['lang/vars?cat=',self.variableStoreCat].join(''),
        reader    : {
          type          : 'json',
          root          : 'rows',
          totalProperty : 'results'
          }
      },
      listeners      : {
        load      : function(store,records,options) {
          //self.router.view.catCombo.setValue(self.catStore.getAt(0).data['catval']);
        }
      }
    });
    
    self.store.on('beforeload', function() {
        this.pageSize = self.itemsPerPage;
        this.limit    = self.itemsPerPage;
      });
        
    self.store.load({
      start   : 0,
      limit   : self.itemsPerPage
    });
  
    self.rowEditing = Ext.create('Ext.grid.plugin.RowEditing',{
      clicksToEdit: 1
    });
          
    self.rowEditing.on({
      scope:this,
      afteredit: function(roweditor, changes, record, rowIndex){
        self.updateRow(roweditor,changes);
      }
    });
  },
  
  updateRow: function(roweditor, scope) {
    var self = this;
    self.roweditor = roweditor;
    self.scope = scope;
    this.loader.show();
    AJAX.post(
      "lang/update",
      ['field=',roweditor.field,'&id=',roweditor.record.get('id'),'&val=',roweditor.record.get(roweditor.field),'&lang=',self.language].join(''),
      function() {
        self.roweditor.record.commit();  
        self.store.load();
        self.loader.hide();
      },
      self
    );
  },
  
  addLanguage: function(newLang) {
    var self = this;
    AJAX.post(
      ['lang/addlanguage'].join(''),
      ['lang=',newLang].join(''),
      function(resp) {
        self.language = newLang.substring(0, 2);
        self.reload();
      },
      self
    );
  },
  
  deleteLanguage: function(id) {
    var self = this;
    AJAX.get(
      ['lang/deletelanguage?id=',id].join(''),
      '',
      function(resp) {
        self.reload();
      },
      self
    );
  },
  
  deleteCategory: function(id) {
    var self = this;
    AJAX.get(
      ['lang/deletecategory?id=',id].join(''),
      '',
      function(resp) {
        self.reload();
      },
      self
    );
  },
  
  addCategory: function(category) {
    var self = this;
    AJAX.post(
      ['lang/addcategory'].join(''),
      ['cat=',category].join(''),
      function(resp) {
        self.reload();
      },
      self
    );
  },
  
  addVariable: function(variable,expression) {
    var self = this;
    AJAX.post(
      ['lang/addvariable'].join(''),
      ['var=',variable,'&cat=',self.variableStoreCat,'&expr=',expression].join(''),
      function(resp) {
        self.reload();
      },
      self
    );
  },
  
  deleteVariable: function(id) {
    var self = this;
    AJAX.post(
      ['lang/deletevariable'].join(''),
      ['id=',id].join(''),
      function(resp) {
        self.reload();
      },
      self
    );
  }, 
  
  mapper: function(data){
    var self  = this;
    self.data = data.responseText;
    self.router.ajaxCallback(self);
  },
  
  getAjaxData: function(){
    var self = this;
    
    Ext.Ajax.request({
	    url		  : "ext-template/translate",
	    method	: 'get',
	    scope   : self,
	    params	: "",
	    success	: self.mapper
  	});
  }
  
});
