
$.domLoaded(function() {
  var thisStore = new wm.DataStore({

    type: 'datastore',

    fields: [
      {'field':'person','name':'személy','sortable':true,'editable':true},
      {'field':'date','name':'dátum','sortable':true,'editable':true},
      {'field':'desc','name':'megjegyzés','sortable':true,'editable':true}
    ],

    items: [
      { 'person':'valaki',
        'date':1992,
        'desc':'hmmm' },
      { 'person':'masValaki',
        'date':1540,
        'desc':'nemáá' },
      { 'person':'bárki',
        'date':1386,
        'desc':'azta' },
      { 'person':'netuddki',
        'date':1749,
        'desc':'pfuj' }
    ]

  });

  var thisGrid = new wm.Grid({
    type: 'grid',
    id: 'thisGrid',
    cls: 'anyGrid',
    datastore: thisStore,
    parent: $.createEl({
              type  : 'div',
              id    : 'gridContainer',
              cls   : 'anyClass',
              style : ''
            })
  });
});
