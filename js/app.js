var Snake = {
  
  init: function() {
   // $.post(
   //   'test.php',
   //   { 'valami'    : 'masvalami',
   //     'masvalami' : 'tokmindegy',
   //     'barmi'     : 42 },
   //   Snake.test1
   // );

    timer.add({
      "method"    : Snake.test,
      "interval"  : 100
    });

    timer.remove(Snake.test);

  },

  test: function() {
    console.log("asdasdsad");
    console.log( timer.DEPO );
  },
  test1: function(resp) {
    console.log(resp);
    console.log( $.evalJSON( resp ) );
  }
};

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

$.domLoaded(function() { console.log(timer.prototype);
  Builder.build();
  Snake.init();

    // $.anim([
    //   'test',
    //   'left:1100px;top:200px;',
    //   600,
    //   function() {
    //       $.anim([
    //         'test',
    //         'top:300px;left:500px;',
    //         100,
    //         function() {
    //             $.anim([
    //               'test',
    //               'left:0px;top:150px;',
    //               100,
    //               function() {
    //                   $.anim([
    //                     'test',
    //                     'top:0px;left:0px;',
    //                     300,
    //                     function() { 
    //                     }
    //                   ]);
    //               }
    //             ]);
    //         }
    //       ]);
    //   }
    // ]);

});
