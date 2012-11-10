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
      obj.create    = DomBuilder.create;
      obj.getParent = DomBuilder.getParent;
    }
    if(typeof Stuff !== 'undefined') {
      obj.arrayUnique = Stuff.arrayUnique;
    }
    $.extend(obj);
    if(typeof Grid !== 'undefined') {
      $.fn.extend({
        grid: Grid
      });
    }
  };
  if(typeof $ == 'undefined' || typeof jQuery == 'undefined') {
    alert('jquery is missing');
  } else {
    if(typeof emile == 'undefined') {
      alert('emile is missing');
    } else {
      $(document).ready(_construct);
    }
  }
})();