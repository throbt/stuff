Ext.define('LoginView', {

	extend: 'View',
	
	render: function(data){
	  
	  var self = this;
	  
	  Ext.create('Ext.window.Window', {
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
        //url       : data.action,
        buttons: [{
          text      : 'login',
          handler   : self.scope.auth
        }]
      }
    }).show();
	}
	/*submit: function(){
	  
	}*/
	
});

