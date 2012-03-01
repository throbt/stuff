Ext.define('MainView', {
  
  extend: 'View',

  getLang: function(options,e) {
    var self      = Globals.DEPO['MainController'].view,
        thisLang  = self.scope.model.languages[this.getText()];
        
    // TODO need refact
    if(thisLang == 'hu') {
      self.setLang('magyar', this);
    } else {
      self.setLang('english', this);
    }
  },
  
  setLang: function(lang, scope) {
    var self                  = this;
    self.scope.model.language = self.scope.model.languages[lang];
    
    Globals.DEPO['components']['viewport'].destroy();
    self.scope.model.getAjaxData();
  },

  render: function(data) {
    
    var self = this;
    
    // maybe, this time this stuff does not exists
    try {
      Globals.DEPO['components']['viewport'].destroy();
      Globals.DEPO['components'] = {};
    } catch(err) {}
    
    self.cfg = eval('('+data+')');
    self.build(self.cfg);
    self.setup();
  },
  
  setup: function() {
    var self            = this;
    self.lang_elements  = self.scope.model.toJson(Globals.DEPO['components']['lang_elements'].value);
    self.user           = Globals.profile.model.data.user;
    
    Globals.DEPO['components']['profileName'].setText([self.user.name,'<br /><font style="color: #888888;">(',self.user.email,')</font>'].join(''));
    Globals.DEPO['components']['languages'].setText(self.scope.model.languagesInv[self.scope.model.language]);
  },
  
  titleRenderer: function(str) {
    return ['<span style="font-weight:bold;font-size:12px;">',str,'</span>'].join('');
  },
  
  initGroupsGrid: function() {
    var self                                  = this;
    
    Globals.DEPO['components']['groupsGrid']  = Ext.create('Ext.grid.Panel', {
      xtype     : 'grid',
      id        : 'groupsGrid',
      store     : self.scope.model.group.groupsStore,
      flex      : 1,
      style     : 'text-align: center;',
      layout    : 'fit',
      columns   : [
        {header   : 'Id',                          dataIndex: 'group_id', width: 100},
        {header   : self.lang_elements['cim'],     dataIndex: 'realname', width: 350,  renderer : self.titleRenderer},
        {header   : self.lang_elements['nev'],     dataIndex: 'title'},
        {header   : self.lang_elements['tagsag'],  dataIndex: 'membership'},
        {header   : self.lang_elements['csoport'], dataIndex: 'group',    width: 350, renderer : self.titleRenderer}
      ]
    }).show();
    
    Globals.DEPO['components']['groupsGridContainer'].add(Globals.DEPO['components']['groupsGrid']);
    
    Globals.DEPO['components']['groupsGrid'].addListener({
      cellclick: function(grid,rowIndex,columnIndex,e) {
        Globals.DEPO['MainController'].model.group_id = rowIndex.parentNode.firstChild.firstChild.innerHTML; //console.log(Globals.DEPO['MainController']);
        Router.setRoute('Main/Messages');
      }  
    });   
  }
});

