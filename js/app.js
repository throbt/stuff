
$.domLoaded(function() {

  window.grid.data = {
    fields: [
      {'person':  'személy'},
      {'date':    'dátum'}
    ],
    items: [
      {'valaki':    1992},
      {'masValaki': 1540},
      {'bárki':     1386},
      {'netuddki':  1749}
    ]
  }

  window.grid.initialize();

});
