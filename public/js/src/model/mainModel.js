Ext.define('MainModel', {

  extend: 'Model',
  
  language: 'hu',
  
  languages: {
    'english'  : 'hu',
    'magyar'   : 'en'
  },
  
  languagesInv: {
    'hu'  : 'english',
    'en'  : 'magyar'
  },
  
  init: function() {
    //this.getAjaxData();
  },
  
  mapper: function(data){
    var self            = this;
    self.data           = data.responseText;
    //self.lang_elements  =
    self.router.ajaxCallback(self);
  },
  
  getAjaxData: function(){
    var self = this;
    /*AJAX.get(
      ["ext-template?lang=",self.language].join(''),
      "",
      self.mapper,
      self
    );*/
    
    Ext.Ajax.request({
	    url		  : ["ext-template?lang=",self.language].join(''),
	    method	: 'get',
	    scope   : self,
	    params	: "",
	    success	: self.mapper
  	});
  },
  
  groupMapper: function(response) {
    var self                = Globals.DEPO['MainController'].model;
    self.group.data         = self.toJson(response.responseText);
    
    // group_id must be an integer(number) to be sortable in the grid
    for(var i in self.group.data) { ///group_id
      self.group.data[i].group_id = parseInt(self.group.data[i].group_id,10);
    }
    self.group.groupsStore  = Ext.create('Ext.data.Store', {
      storeId:'groups',
      fields:['group_id','title', 'realname', 'membership','group'],
      data:{'items': self.group.data},
      proxy: {
        type: 'memory',
        reader: {
          type: 'json',
          root: 'items'
        }
      }
    });
    
    Globals.DEPO['MainController'].groupCallback();
  },
  
  postInit: function() {
    var self   = this;
    self.group = new GroupModel();
    self.group.getGroups(self);
  }
  
});
