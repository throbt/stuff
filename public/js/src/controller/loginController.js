Ext.define('LoginController', {

	extend: 'Controller',
	
	init: function() {
	  this.getData();
	},
	
	auth: function() {
    var self = Globals.DEPO["LoginController"];
    self.model.authentication(self);
	},
	
	authCallback : function(response, req) {
    var self      = Globals.DEPO["LoginController"],
        res       = self.model.toJson(response.responseText);
	  
	  if(res.username == null) {
	    Ext.getCmp('loginForm').getForm().setValues({
        username: "", 
        password: "" 
      })
      Ext.Msg.alert('Login failed', 'Try again!');
	  } else {
	    Ext.getCmp("LoginForm").hide();
	    Router.setRoute(Router.frontPage);
	  }
	},
	
	ajaxCallback: function(scope){
	  
	  Globals.DEPO["LogoutController"] = null;
	  
	  this.data = scope.data;
	  
	  if(this.data.username) {
	    Router.setRoute(Router.frontPage);
	  } else {
	    if(Ext.get("LoginForm") == null) {
	     this.view.render(this.data);
      }
	  }
	},
	
	getData : function(){
	  if(this.data.username)
      Router.setRoute(Router.frontPage);
	}
	
});