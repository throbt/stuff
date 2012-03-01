Ext.define('ProfileModel', {

  extend: 'Model',
  
  init: function() {
    var self      = this,
        arr       = [],
        usernames = self.getCookie();
    
    for(var i = 0, l = usernames.length;i < l;i++) {
      arr.push({"username":usernames[i]});
    }
    
    self.usernameStore = Ext.create('Ext.data.Store', {
      fields: ['username'],
      data : arr
    });
  },
  
  getCookie: function() {
    var arr     = [],
        i       = 0,
        cookies = Ext.decode(Ext.util.Cookies.get('usernames'));
        
    for(var i in cookies) {
      if(cookies[i]['email']) {
        arr.push(cookies[i]['email'])
      }
  }
    return arr;
  },
  
  setCookie: function(arr) {console.log(arr);
    var obj = {}
        arr = arr || [];
    
    for(var i = 0, l = arr.length;i < l;i++) {
      obj[i] = {'email' : arr[i]};
    }
    Ext.util.Cookies.set('usernames', Ext.encode(obj));
  },
  
  /*
   * @scope {Object} the relevant controller - (ProfileController)
   */
  authentication : function(scope) {
    
    var usernames     = scope.model.getCookie(),
        thisUserName  = Ext.getCmp("loginForm").getValues()['username'];
    
    // handling cookies
    if(usernames.indexOf(thisUserName) == -1) {
      usernames.push(thisUserName);
      scope.model.setCookie(usernames);
    }
    
    Ext.Ajax.request({
	    url		  : scope.model.data.action,
	    method	: 'post',
	    scope   : scope,
	    params	: Ext.getCmp("loginForm").getValues(),
	    success	: scope.authCallback
  	});
  },
  
  mapper: function(data){
    var self  = this;
    self.data = eval("("+data.responseText+")");
    self.router.ajaxCallback();
  },
  
  getAjaxData: function(){
    var self = this;
    
    Ext.Ajax.request({
	    url		  : "login/",
	    method	: 'get',
	    scope   : self,
	    params	: "",
	    success	: self.mapper
  	});
  }
  
});
