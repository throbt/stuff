Ext.define('IddqdTranslateController', {

  extend: 'Controller',

  init: function() {
    
    var self = this;
    
    if(!self.inited) {
      this.getData();
      self.inited = true;
    }
  },

  ajaxCallback: function(scope){
    
    var self = this;
    
    if(self.profileCheck()) {
      self.model.setup();
      self.view.render(self.model.data);
    }
    
    //this.view.render(scope.data);
  },

  getData : function(){
    this.model.getAjaxData();
  }

});
