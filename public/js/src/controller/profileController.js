Ext.define('ProfileController', {

  extend: 'Controller',
  
  cache: {},
  
  auth: function() {
    var self = Globals.profile;
    self.model.authentication(self);
  },
  
  authCallback : function(response, req) {
    var self      = Globals.profile;
        
    self.model.data = self.model.toJson(response.responseText);
    
    if(!self.model.data.user || !self.model.data.user.id) {
      Ext.Msg.alert('Login failed', 'Try again!');
      Ext.getCmp('loginForm').getForm().setValues({
        username: "", 
        password: "" 
      })
      return;
    }
    
    Router.reload();
  },
  
  init: function() {
    if(typeof this.session == 'undefined')
      this.getData();
  },
  
  ajaxCallback: function(){
    //console.log( this );
  },

  getData : function(){
    this.model.getAjaxData();
  }

});
