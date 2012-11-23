/*
  class Stuff
*/
var Stuff = (function() {
  var arrayUnique = function(arr) {
    var cache = [],el;
    for(var i=arr.length-1,z=0;i>=z;--i) {
      el = arr[i];
      if($.inArray(el, cache) == -1 && el.match(/[a-zA-Z0-9]/)) {
        cache.unshift(el);
      }
    }
    return cache;
  };
  var getRndRGB = function() {
    var p = function() {
      var str = Math.ceil(Math.random()*256).toString(16);
      if(str.length == 1)
        str += '0';
      return str;
    };
    return ['#',p(),p(),p()].join('');
  };
  return {
    arrayUnique     : arrayUnique,
    getRndRGB       : getRndRGB
  };
})();
/*
  class Globals
*/
var Globals = (function() {
  /*
    @method add
    @param key string
    @param val
    @return no return
  */
  function add(key,val) {
    var key = key || 0,
      val = val || 0;
    if(key !== 0 && val !== 0) {
      window[key] = val;
    }
  }
  /*
    @method read
    @param key string
    @param val
    @return no return
  */
  function read(key) {
    var key = key || 0;
      if(window[key])
        return window[key];
  }
  return {
    add: add,
    read: read
  };
})();

/*
  class Dispatcher - handling events
*/
var Dispatcher = (function () {
  var listeners = {};
  /*
    @method on
    @param eventName  string
    @param fn         string
    @param scope      object
    @return no return
  */
  function on(eventName, fn, scope) {
    listeners[eventName] = listeners[eventName] || [];
    listeners[eventName].push({
      fn: fn,
      scope: scope
    });
  }
  /*
    @method on
    @param eventName  string
    @return no return
  */
  function fireEvent(eventName) {
    if (!listeners[eventName]) {
      return;
    }
    for (var i=0; i<listeners[eventName].length; ++i) {
      var t = listeners[eventName][i];
      t.fn.apply(t.scope || this, Array.prototype.slice.call(arguments, 1));
    }
  }
  return {
    on: on,
    fireEvent: fireEvent
  };
})();
