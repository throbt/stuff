
$.domLoaded(function() {

  window.grid.data = {
    fields: [
      {'person':  'személy'},
      {'date':    'dátum'}
    ],
    items: [
      {'valaki':    1992},
      {'masValaki': 1540},
      {'bárki':     1992},
      {'netuddki':  1992}
    ]
  }

  window.grid.initialize();

});
