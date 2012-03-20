
$.domLoaded(function() {

  // wm.Grid.data = {
  //   fields: [
  //     {'person':  'személy'},
  //     {'date':    'dátum'}
  //   ],
  //   items: [
  //     {'valaki':    1992},
  //     {'masValaki': 1540},
  //     {'bárki':     1386},
  //     {'netuddki':  1749}
  //   ]
  // }

  // wm.grid.initialize();

  // console.log(wm.Grid);

  

// var thisComponent = new wm.Component({
//   'valami': 'barmi',
//   'masValami': 'barmiMas'
// });

// console.log(thisComponent);


var instance = new wm.DataStore({
  'valami': 'barmi',
  'masValami': 'barmiMas'
});

// console.log(instance);

// wm.Grid.superclass({
//   'valami': 'barmi',
//   'masValami': 'barmiMas'
// });

console.log('instance xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

for(var i in instance) {

  console.log(i, instance[i]);

}

console.log('Component xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

for(var i in wm.Component) {

  console.log(i, wm.Component[i]);

}

console.log('Grid xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');


for(var i in wm.Grid) {

  console.log(i, wm.Grid[i]);

}

console.log('DataStore xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');


for(var i in wm.DataStore) {

  console.log(i, wm.DataStore[i]);

}
// instance.superclass();

// console.log(instance);

  // instance.init();
// {
//     'valami': 'barmi',
//     'masValami': 'barmiMas'
//   }


// console.log(instance);

  // instance.init();



  // for(var i in ttt) {
  //   console.log(i);
  // }

});
