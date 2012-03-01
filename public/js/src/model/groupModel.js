Ext.define('GroupModel', {

	extend: 'Model',
	
	init: function() {
    //this.getAjaxData();
  },
	
	mapper: function(data){
		
		var self 	= this;
		// store the data
		
		self.data 	= self.toJson(data.responseText);
		// call the callback method of the relevant controller
		self.router.ajaxCallback(self);
	},
	
	getAjaxData: function(){
		var self = this;
		AJAX.get(
			"group/",
			'',
			this.mapper,
			self
		);
	},
	
	getGroups: function(scope) {
	
	  AJAX.get(
      "group/",
      '',
      scope.groupMapper,
      scope
    );
	}
	
});
