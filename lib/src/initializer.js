/*
  Class Initializer
*/
var Initializer = (function() {
  var _construct = function() {
    if(typeof console == 'undefined') {
      var console = {
        log: function() {}
      };
    }
    var obj = {};
    if(typeof DomBuilder !== 'undefined') {
      obj.create          = DomBuilder.create;
      obj.getParent       = DomBuilder.getParent;
      $.fn.extend({
        addClassName: DomBuilder.addClassName
      });
      $.fn.extend({
        removeClassName: DomBuilder.removeClassName
      });
      $.fn.extend({
        hasClassName: DomBuilder.hasClassName
      });
    }
    $.extend(obj);
    Snake.init();
  };
  if(typeof $ == 'undefined' || typeof jQuery == 'undefined') {
    alert('jquery is missing');
  } else {
    $(document).ready(_construct);
  }
})();