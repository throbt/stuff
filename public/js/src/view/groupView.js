Ext.define('GroupView', {

	extend: 'View',
	
	render: function(data){ console.log("sadasdasda");
	  
	  Ext.create('Ext.data.Store', {
      storeId:'groups',
      fields:['title', 'realname'],
      data:{'items': data},
      proxy: {
        type: 'memory',
        reader: {
          type: 'json',
          root: 'items'
        }
      }
    });
    
    
    /*Ext.create('Ext.Component', {
        storeId:'groups',
        fields:['title', 'realname'],
        data:{'items': data},
    });*/
	  
	  Ext.create('Ext.window.Window', {
      title     : 'Csoportok:',
      id        : '',
      renderTo  : Ext.getBody(),
      resizable : true,
      height    : 600,
      width     : 420,
      layout    : 'fit',
      layout    : 'column',
      items: {
        xtype     : 'grid',
        store: Ext.data.StoreManager.lookup('groups'),
        columns: [
          {header: 'Title',  dataIndex: 'realname'},
          {header: 'Realname', dataIndex: 'title'}
        ],
        id        : '',
        layout    : 'fit',
        //layout    : 'column',
        height    : 550,
        width     : 400
      }
    }).show();
    
	  
		/*Ext.create('Ext.grid.Panel', {
      title: 'Csoportok: ',
      store: Ext.data.StoreManager.lookup('groups'),
      columns: [
        {header: 'Title',  dataIndex: 'realname'},
        {header: 'Realname', dataIndex: 'title'}
      ],
      layout    : 'fit',
      layout    : 'column',
      height    : 400,
      width     : 400,
      renderTo: Ext.getBody() //Ext.get("groupBody")
    });*/
	}
	
});
