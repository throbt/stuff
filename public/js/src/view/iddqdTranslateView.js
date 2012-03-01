Ext.define('IddqdTranslateView', {
  
  extend: 'View',
  
  modal: function(job) {
    var self          = this;
    
    self.modalWindow  = Ext.create('Ext.window.Window', {
      title: '',
      id: 'modal',
      modal: true,
      items: [{
        xtype:'container',
        height: 100,
        width: 300,
        id: 'manager',
        layout: 'fit'
      }]
    }).show();
    
    switch(job) {
      case 'langComboAdd':
        self.addLangField = Ext.create('Ext.container.Container', {
          layout: 'fit',
          renderTo: Ext.get('manager'),
          layout: 'fit',
          margin:0,
          items: [{
            fieldLabel: 'new language',
            xtype: 'field',
            id: 'addLang',
          },{
            xtype: 'button',
            text: 'add',
            handler: function() {
              self.scope.model.addLanguage(self.addLangField.items.items[0].value);
            }
          }]
        });
      break;
      case 'langComboDel':
        self.delLangCombobox = Ext.create('Ext.form.ComboBox', {
          id: 'delLang',
          fieldLabel: 'Choose language',
          store: self.scope.model.langStore,
          queryMode: 'local',
          height: 200,
          margin:0,
          displayField: 'lang',
          valueField: 'langval',
          triggerAction : 'all',
          layout: 'fit',
          renderTo: Ext.get('manager'),
          listeners: {
            select: function() {
              self.scope.model.deleteLanguage(this.getValue());
            }
          }
        });
      break;
      case 'catComboAdd':
        self.addCatField = Ext.create('Ext.container.Container', {
          layout: 'fit',
          fieldLabel: 'Add new cat',
          renderTo: Ext.get('manager'),
          margin:0,
          items: [{
            fieldLabel: 'new category',
            xtype: 'field',
            id: 'addLang',
          },{
            xtype: 'button',
            text: 'add',
            handler: function() {
              self.scope.model.addCategory(self.addCatField.items.items[0].value);
            }
          }]
        });
      break;
      case 'catComboDel':
        self.delCatField = Ext.create('Ext.form.ComboBox', {
          id: 'delCat',
          xtype: 'combo',
          fieldLabel: 'Choose category',
          store: self.scope.model.catStore,
          queryMode: 'local',
          displayField: 'cat',
          valueField: 'catval',
          triggerAction : 'all', 
          renderTo: Ext.get('manager'),
          listeners: {
            select: function() {
              self.scope.model.deleteCategory(this.getValue());
            }
          }
        });
      break;
      case 'varComboAdd':
        self.addVarField = Ext.create('Ext.container.Container', {
          layout: 'fit',
          fieldLabel: 'Add new variable',
          renderTo: Ext.get('manager'),
          layout: 'fit',
          margin:0,
          items: [{
            fieldLabel: 'new variable',
            xtype: 'field',
            id: 'addVarnew',
          },{
            fieldLabel: 'orig expression',
            xtype: 'field',
            id: 'addVarExp',
          },{
            xtype: 'button',
            text: 'add',
            handler: function() {
              self.scope.model.addVariable(self.addVarField.items.items[0].value,self.addVarField.items.items[1].value);
            }
          }]
        });
      break;
      case 'varComboDel':
        self.delVarField = Ext.create('Ext.form.ComboBox', {
          id: 'delVar',
          xtype: 'combo',
          fieldLabel: 'Choose variable',
          store: self.scope.model.variableStore,
          queryMode: 'local',
          displayField: 'var',
          valueField: 'varval',
          triggerAction : 'all',
          renderTo: Ext.get('manager'),
          listeners: {
            select: function() {
              self.scope.model.deleteVariable(this.getValue());
            }
          }
        });
        self.scope.model.variableStore.proxy.url = ['lang/vars?cat=',self.scope.model.variableStoreCat].join('');
        self.scope.model.variableStore.load();
      break;
    }
  },
  
  renderer: function(str) {
    return ['<span style="font-weight:bold;">',str,'</span>'].join('');
  },
  
  render: function(data) {
    
    if(!Ext.get("Iddqd")) {
      
      try {
        Globals.DEPO['components']['viewport'].destroy();
        Globals.DEPO['components'] = {};
      } catch(err) {}
      
      var self          = this,
          cfg           = eval("("+data+")");
      
      self.build(cfg);
      
      self.langCombo    = Globals.DEPO['components']["langCombo"];
      self.langComboAdd = Globals.DEPO['components']["langComboAdd"];
      self.langComboDel = Globals.DEPO['components']["langComboDel"];
      
      self.catCombo     = Globals.DEPO['components']["catCombo"];
      self.catComboAdd  = Globals.DEPO['components']["catComboAdd"];
      self.catComboDel  = Globals.DEPO['components']["catComboDel"];
      
      self.varCombo     = Globals.DEPO['components']["varCombo"];
      self.varComboAdd  = Globals.DEPO['components']["varComboAdd"];
      self.varComboDel  = Globals.DEPO['components']["varComboDel"];
      
      self.varComboAdd.addListener({
        click: function() {
          self.modal('varComboAdd');
        }
      });
      self.varComboDel.addListener({
        click: function() {
          self.modal('varComboDel');
        }
      });
      
      self.langComboAdd.addListener({
        click: function() {
          self.modal('langComboAdd');
        }
      });
      self.langComboDel.addListener({
        click: function() {
          self.modal('langComboDel');
        }
      });
      self.catComboAdd.addListener({
        click: function() {
          self.modal('catComboAdd');
        }
      });
      self.catComboDel.addListener({
        click: function() {
          self.modal('catComboDel');
        }
      });
      
      self.langCombo.addListener({
        select: function() {
          self.scope.model.language         = this.getValue();
          self.scope.model.store.proxy.url  = ['lang?lang=',self.scope.model.language,'&cat=',self.scope.model.cat].join('');
          self.scope.model.store.load();
        }
      });
      self.catCombo.addListener({
        select: function() {
          self.scope.model.cat              = this.getValue();
          self.scope.model.store.proxy.url  = ['lang?lang=',self.scope.model.language,'&cat=',self.scope.model.cat].join('');
          self.scope.model.store.load();
        }
      });
      self.varCombo.addListener({
        select: function() {
          self.scope.model.variableStoreCat = this.getValue();
        }
      });
    }
  }
});
