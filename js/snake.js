var Snake = {
  
  init: function() {
    window.$ = MainFrame;
    $.initialise();
    console.log($.getWindowSize());
    Builder.build();

    // timer.add({
    //   "method"    : Snake.test,
    //   "interval"  : 100
    // });
  },

  test: function() {
    console.log("asdasdsad");
    console.log( timer.DEPO );
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