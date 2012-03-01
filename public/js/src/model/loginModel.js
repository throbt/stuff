Ext.define('LoginModel', {

	extend: 'Model',
	
	init: function() {
	  this.getAjaxData();
	},
	
	mapper: function(data){
		var self 	= this;
		self.data = self.toJson(data.responseText);
		self.router.ajaxCallback(self);
	},
	
	authentication : function(scope) {
	  AJAX.post(
      scope.data.action,
      Ext.getCmp("loginForm").getValues(),
      scope.authCallback,
      self
    );
	},
	
	getAjaxData: function(){
		var self = this;
		AJAX.get(
			"login/",
			"",
			this.mapper,
			self
		);
	}
	
});