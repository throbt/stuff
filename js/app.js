var Builder = {
  build: function() {
    $.createEl({
      type  : 'div',
      id    : 'test',
      cls   : 'anyClass',
      style : 'width:50px;height:50px;background:red;position:absolute;top:0px;left:0px;',
      cmd   : ['click', function(e){
        (e ? e : window.event).stopProp();
      }]
    });
  }
}

$.domLoaded(function() {

  window.grid.data = {
    fields: ['person','date'],
    items: [
      {'személy':   'évszám'},
      {'valaki':    1992},
      {'masValaki': 1540},
      {'bárki':     1992},
      {'netuddki':  1992}
    ]
  }

  window.grid.initialize();

});
