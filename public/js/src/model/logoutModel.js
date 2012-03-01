Ext.define('LogoutModel', {

  extend: 'Model',
  
  init: function() {
    this.getAjaxData();
  },
  
  mapper: function(data){
    
    var self  = this;
    // store the data
    this.data = Ext.JSON.decode(data.responseText);
    // run the callback method of the relevant controller
    this.router.ajaxCallback(this);
  },
  
  getAjaxData: function(){
    
    var self = this;
    
    AJAX.get(
      "login/logout/",
      "",
      this.mapper,
      self
    );
  }
  
});