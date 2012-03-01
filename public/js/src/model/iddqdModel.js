Ext.define('IddqdModel', {

  extend: 'Model',
  
  init: function() {
  },
  
  mapper: function(data){
    var self  = this;
    self.data = self.toJson(data.responseText);
    self.router.ajaxCallback(self);
  },
  
  getAjaxData: function(){
    /*var self = this;
    AJAX.get(
      "lang/",
      "",
      this.mapper,
      self
    );*/
  }
  
});