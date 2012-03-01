Ext.define('MessagesController', {

  extend: 'Controller',
  
  init: function() { console.log( 'its inited' );
    var self = this;
    
    //self.getData();
  },
  
  ajaxCallback: function(scope){
  },

  /*main: function() {
    this.view.render({});
  },*/

  getData : function() {
    this.model.getAjaxData();
  }

});
