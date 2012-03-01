Ext.define('IddqdController', {

  extend: 'Controller',

  init: function() {
    
    try {
      if(typeof Globals.DEPO[[this.fullNameSpace,"Controller"].join("")] == "undefined")
        (new Function(['Globals.DEPO["',this.fullNameSpace,'Controller"] = new ',this.fullNameSpace,'Controller();'].join("")))();
      else
        Globals.DEPO[[this.fullNameSpace,"Controller"].join("")].init();
    } catch(err) { console.log(err);
      Message.alert('Routing error', 'There is no implemented class in the namespace', function() {
        Router.setRoute(Router.frontPage);
      });
      
    }
  },

  ajaxCallback: function(scope){
    //this.view.render(scope.data);
  },

  /*main: function() {
    this.view.render({});
  },*/

  getData : function(){
  }

});
