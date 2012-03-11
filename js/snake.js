var Snake = {
  
  init: function() {
//    $.post(
//      'test.php',
//      { 'valami'    : 'masvalami',
//        'masvalami' : 'tokmindegy',
//        'barmi'     : 42 },
//      Snake.test1
//    );
//     timer.add({
//       "method"    : Snake.test,
//       "interval"  : 100
//     });
  },

  test: function() {
    console.log("asdasdsad");
    console.log( timer.DEPO );
  },
  test1: function(resp) {
    alert(resp);
  }
};

var Builder = {
  build: function() {
    $.createEl({
      tag: 'div',
      id: 'test',
      style: 'width:50px;height:50px;background:red;position:absolute;top:0px;left:0px;',
      command : ['click', function(e){
        (e ? e : window.event).stopProp();
      }]
    });
  }
}



window.$ = MainFrame;

$.domLoaded(function() {
  Builder.build();
  Snake.init();

  $.anim([
    'test',
    'left:600px;',
    400,
    function() {
      $.anim([
        'test',
        'top:300px;',
        1000,
        function() {
          $.anim([
            'test',
            'left:0px;',
            2000,
            function() {
              $.anim([
                'test',
                'top:0px;',
                600,
                ''
              ]);
            }
          ]);
        }
      ]);
    }
  ]);
  
});
