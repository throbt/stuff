Ext.define('TestModel', {

  extend: 'Model',
  
  init: function() {
    
    var self = this;
    
    if(Ext.get("Iddqd") == null) {}
      self.getAjaxData();
  },
  
  mapper: function(data){
    var self  = this;
    self.data = data.responseText;
    self.router.ajaxCallback(self);
  },
  
  getAjaxData: function(){
    var self = this;
    
    /*AJAX.get(
      "ext-template/test",
      "",
      this.mapper,
      self
    );*/
    
    Ext.Ajax.request({
	    url		  : "ext-template/test",
	    method	: 'get',
	    scope   : self,
	    params	: "",
	    success	: self.mapper
  	});
    
  }
  
});
