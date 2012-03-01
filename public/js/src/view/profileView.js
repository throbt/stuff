Ext.define('ProfileView', {
  
  extend: 'View',

  render: function(data) {
    var self = this;
    
    if(!Globals.DEPO['components']) {
      Globals.DEPO['components'] = {};
      if(!Globals.DEPO['components']['LoginForm'])
        Globals.DEPO['components']['LoginForm'] = Ext.create('Ext.window.Window', {
          title     : 'Login',
          id        : 'LoginForm',
          renderTo  : Ext.getBody(),
          resizable : false,
          height    : 180,
          width     : 250,
          layout    : 'fit',
          layout    : 'column',
          items: {  
            xtype     : 'form',
            id        : 'loginForm',
            height    : 145,
            width     : 237,
            items     : data.items,
            url       : data.action,
            buttons: [{
              text      : 'clear cookies',
              handler   : self.scope.model.setCookie
            },{
              text      : 'login',
              handler   : self.scope.auth
            }]
          }
        }).show();
      else
        Globals.DEPO['components']['LoginForm'].show();
    }
    
  }
});
