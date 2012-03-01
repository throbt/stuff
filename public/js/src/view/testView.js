Ext.define('TestView', {

  extend: 'View',
  
  render: function(data){
    
    var self  = this;
    
    self.cfg = eval("("+data+")");
    self.build(self.cfg);
    //Globals.DEPO["viewport"] = Ext.create('Ext.container.Viewport', cfg);
    
    var thisStore  = Ext.create('Ext.data.Store', {
      storeId:'groups',
      fields:['group_id','title', 'realname', 'membership','group'],
      autoLoad: true,
//      data:{'items': self.group.data},
      proxy   : MaximaProxy.get('ajax',"group",'post',{
          'valami'          : 'sssss',
          'masvalami'       : 'gggggggg'
        },{
          type          : 'json',
          root          : 'rows',
          totalProperty : 'results'
      }),
     });
    
    var thisValami  = Ext.create('Ext.grid.Panel', {
      xtype     : 'grid',
      id        : 'valami',
      store     : thisStore,
      flex      : 1,
      style     : 'text-align: center;',
      layout    : 'fit',
      columns   : [
        {header   : 'Id',                         dataIndex: 'group_id', width: 100},
        {header   : 'cim',                        dataIndex: 'realname', width: 350,  renderer : self.titleRenderer},
        {header   : 'nev',                        dataIndex: 'title'},
        {header   : 'tagsag',                     dataIndex: 'membership'},
        {header   : 'csoport',                    dataIndex: 'group',    width: 350, renderer : self.titleRenderer}
      ]
    }).show();
    
  }
  
});
