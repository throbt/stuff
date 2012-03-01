Ext.define('MainController', {

  extend: 'Controller',
  
  init: function() {
    var self = this;
    
    if(!self.inited) {
      self.getData();
      self.inited = true;
    } else {
      if(Router.routeOrders[1])
        self.subPageInit(Router.routeOrders[1]);
    }
  },
  
  subPageInit: function(subPage) {
    try {
      if(typeof Globals.DEPO[[subPage,"Controller"].join("")] == "undefined")
        (new Function(['Globals.DEPO["',subPage,'Controller"] = new ',subPage,'Controller();'].join("")))();
      else
        Globals.DEPO[[subPage,"Controller"].join("")].init();
    } catch(err) { console.log(err);
        Message.alert('Routing error', 'There is no implemented class in the namespace', function() {
        Router.setRoute('Main');
    });
      
    }
  },
  
  ajaxCallback: function(scope){
    
    var self = this;
    
    if(self.profileCheck()) {
      this.view.render(self.model.data);
      this.model.postInit(self);
    }
  },
  
  groupCallback: function() {
    var self = this;
    self.view.initGroupsGrid();
  },

  /*main: function() {
    this.view.render({});
  },*/
 
  logout: function() {
    var self = this;
    AJAX.get(
      'login/logout',
      "",
      Router.reload,
      self
    );
  },

  getData : function() {
    this.model.getAjaxData();
  }

});
