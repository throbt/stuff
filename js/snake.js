var Snake = {
  
  init: function() {
    window.$ = MainFrame;
    $.initialise();
//    console.log($.getWindowSize());
    Builder.build();
    
    /*
      @url {string}
      @queryString {hash/object|string}
      @callback {string}
    */
    $.post(
      'test.php',
      { 'valami'    : 'masvalami',
        'masvalami' : 'tokmindegy',
        'barmi'     : 42 },
      Snake.test1
    );
    // timer.add({
    //   "method"    : Snake.test,
    //   "interval"  : 100
    // });
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
      style: 'width:200px;height:50px;background:red;',
      command : ['click', function(e){
        (e ? e : window.event).stopProp();
      }]
    });
  }
}

window.onload = Snake.init;