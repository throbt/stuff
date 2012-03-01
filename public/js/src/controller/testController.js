Ext.define('TestController', {

  extend: 'Controller',

  init: function() { //alert('asdsads');
    
    var self = this;
    
    if(Ext.get("Iddqd") == null)
      this.getData();
    //this.view.render(scope.data);
    
    
    
    /*var object = {
      "valami": "dehatmi",
      "masvalami": "milehetmég",
      "egyeb": 42,
      'get': {
        'param1': 'valami',
        'param2': 'masvalami',
        'param3': 'egyeb'
      }
    };
    
    //{\"valami\":\"dehatmi?\",\"masvalami\":\"mi lehet meg\",\"egyeb\":42}
    
    Proxy.query(object,self.thisCallback);*/
    
  },
  
  thisCallback: function(resp) {
    console.log(resp);
  },

  ajaxCallback: function(scope){
    this.view.render(scope.data);
  },

  getData : function(){
  }

});
