/*
  @author    robThot (robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
(function(window) {

  /*
    class MainFrame - doing some needed stuff, a collection
  */

  window.MainFrame = {

    cache   : {},

    ie: (navigator.appVersion.match(/MSIE/) ? true : false),

    /*
      @el   {object}
      @attr {string}
    */
    getCssProperty: new Function(
      'el',
      'attr',
      window.getComputedStyle ?
        'return window.getComputedStyle(el,null)[attr];' : 'return el.currentStyle[attr];'
    ),

    getClassName: new Function(
      this.ie ?
        'return el.className;' : 'return el.getAttribute("class");'
    ),

    setClassName: new Function(
      'el',
      'value',
      this.ie ?
        'el.setAttribute("className",value);' : 'el.setAttribute("class",value);'
    ),

    setStyleAttr: new Function(
      'el',
      'value',
      this.ie ?
        'el.setAttribute("cssText",value);' : 'el.setAttribute("style",value);'
    ),

    initialize: function() {

      var self = this;

      (typeof Event != 'undefined' ? Event : window.event).prototype.stopProp = new Function(
        window.event ? 'this.cancelBubble = true;' : 'this.stopPropagation();'
      )

      if(!Array.indexOf) {
        Array.prototype.indexOf = function(obj) {
          for(var i = 0, l = this.length; i < l; i++) {
            if(this[i] == obj) {
              return i;
            }
          }
          return -1;
        }
      }

      Array.prototype.isEqual = function(arr) {
        if(this.length != arr.length)
          return false;
        for (var i = 0, l = this.length; i < l; i++) {
          if(this[i] != arr[i])
            return false;
        }
        return true;
      }

      try {
        console.log();
      } catch(e) {
        window.console      = {};
        window.console.log  = function() {}
      };

      MainFrame.outerInit();
      MainFrame.domLoaded();
    },

    /*
      @method apply - it clones an object to another one
      @dest   {object}
      @source {object}
    */
    apply: function(dest, source) { 
      for (var i in source) {
        dest[i] = source[i];
      }
    },

    /*
      @method extend
      @source {object}
      @dest   {object}
    */
    extend: function(source,dest) {
      var target = function () {
         return wm.Component.apply(this, arguments);  
      }

      this.apply(target,source);
      this.apply(target,dest);
      target.prototype = dest;
      return target;
    },

    debug: function (obj) {
      for(var i in obj) {
        console.log(i, obj[i]);
      }
    },

    events: {
      /*
        @e(event)     {string}
        @o(object)    {object}
        @f(function)  {string}
      */
      add: new Function(
        'e',
        'f',
        'o',
        window.addEventListener ?
          'o.addEventListener(e,f,false);' : (window.attachEvent ? 'o.attachEvent(["on",e].join(""),f);' : null)
      ),
      /*
        @e(event)     {string}
        @o(object)    {object}
        @f(function)  {string}
      */
      remove: new Function(
        'e',
        'f',
        'o',
        window.addEventListener ?
          'o.removeEventListener(e,f,false);' : (window.attachEvent ? 'o.detachEvent(["on",e].join(""),f);' : null)
      )
    },

    /*
      @fn {string} - not exactly the domloaded event, its just coming after the window onload
    */
    domLoaded: function(fn) {
      if(typeof fn != 'undefined')
        fn();
    },

    outerInit: function(fn) {
      if(typeof fn != 'undefined')
        fn();
    },

    evalJSON: function(str) {
      return (new Function(['return ',str].join('')))();
    },

    /*
      return the browser independent window size to set the viewport
    */
    getWindowSize: function() {
      var arr = [];
      if (document.body && document.body.offsetWidth) {
        arr = [document.body.offsetWidth,document.body.offsetHeight];
      }
      if (document.compatMode=='CSS1Compat' && document.documentElement && document.documentElement.offsetWidth) {
        arr = [document.documentElement.offsetWidth,document.documentElement.offsetHeight];
      }
      if (window.innerWidth && window.innerHeight) {
        arr = [window.innerWidth,window.innerHeight];
      }
      return arr;
    },

    /*
      @selectorStr {string}
    */
    getDom  : function(selectorStr) {
      if(document.querySelector) {
        return document.body.querySelector(selectorStr);
      } else {   
        /**
          TODO refact!
        */
        if(selectorStr.match(/\[.*\=.*\]/)) {
          var matches = selectorStr.match(/(.*)(\[)(.*)(\=)(.*)(\])/);
          switch(matches[3]) {
            case 'id':
              return document.getElementById(matches[5]);
            break;
            case 'class':
              var arr       = [],
                  elements  = document.getElementsByTagName(matches[1]);
              for(var i = 0,len = elements.length; i < len;i++) {
                if( (elements[i].className ? elements[i].className : elements[i].getAttribute('class') ) == matches[5])
                  arr.push(elements[i]);
              }
              return arr;
            break;
          }
        }
        /*
          TODO refact!
        */
        else {
          return document.getElementsByTagName(selectorStr);
        }
      }
    },
    
    /*
      getting a parent element
    
      @el             {object}  - element
      @type           {string}  - tagName
      @prop           {string}  - attribute
      @name           {string}  - value
      @stopCondition  {integer} - depth of the iteration
    */
    getParent: function(el,type,prop,name,stopCondition) {
    
      var self          = this,
          stopCondition = stopCondition || 10,
          current       = el;
      
      if(typeof self.getAttrib == 'undefined')
        self.getAttrib = function(el, prop) {
          if(typeof prop != 'undefined' && typeof el != 'undefined') {
            if(prop == 'class')
              return self.getClassName();
            else
              return el.getAttribute(prop);
          } else {
            return null;
          }
          
        };
      
      if(!type) return el.parentNode;
      
      for(var i = 0; i < stopCondition; i++) {
        if(current.tagName != 'HTML') {
          if(typeof prop == 'undefined' && type == current.tagName) {
            return current;
          } else if(self.getAttrib(current,prop) != null /*|| self.getAttrib(current,prop) != 'null'*/) {
            if(self.getAttrib(current,prop) == name) {
              return current;
            }
          }
        } else {
          return null;
        }
        var current = current.parentNode;
      }
      return null;
    },

    /*
      dom builder
      
      @thisParent {object}
      @cfg (hash) {
        @id       {string} - id
        @cls      {string} - claasName
        @style    {string} - style attrib
        @arr      {array}  - children
        @html     {string} - element.innerHtml
        @cmd      {array}  - command, use getParent to catch the right element
        @type     {string} - tagName
      }
    */
    createEl: function(cfg,thisParent) {

      var parent  = thisParent || document.body,
          self    = this,
          thisEl  = document.createElement(cfg.type); 

      for(var i in cfg) {
        switch(i) {
          case 'id':
            thisEl.setAttribute('id',cfg[i]);
          break;
          case 'cls':
            self.setClassName(thisEl,cfg[i]);
          break;
          case 'style':
            self.setStyleAttr(thisEl,cfg[i]);
          break;
          case 'arr':
          break;
          case 'html':
          break;
          case 'cmd':
          break;
          case 'type':
          break;
          default:
            thisEl.setAttribute(i,cfg[i]);
          break;
        }
      }
      if(typeof cfg.id != 'undefined')
        self.cache[cfg.id] = thisEl;

      parent.appendChild(thisEl);
      
      if(cfg.arr && cfg.arr.length != 0) {
        for(var i in cfg.arr) {
          self.createEl(cfg.arr[i],thisEl);
        }
      }

      if(cfg.html) {
        thisEl.innerHTML = cfg.html;
      }
      
      if(cfg.cmd) {
        self.events.add(cfg.cmd[0], cfg.cmd[1], this.cache[cfg.id]);
      }

      return thisEl;
    },

    /*
      delete a given element from the html and cache

      @element  {object}
      @id       {string}
    */
    remove: function(element,selector) {
      var self        = this,
          thisEl,
          searchedEl  = self.getDom(selector);

      for(var i in element.childNodes) {
        thisEl = element.childNodes[i];
        if(thisEl == searchedEl) {
          element.removeChild(thisEl);
          for(var c in self.cache) {
            if(self.cache[c] == searchedEl) {
              self.cache[c] = null;
              delete self.cache[c];
              return;
            }
          }
        }
      }
    },

    /*
      method get - wrapper for ajax.request
      @url          {string}
      @qstr         {hash|string}
      @callback     {string}
    */
    get         : function(url,qstr,callback) {
      var self = this;
      self.ajax.request(
        url,
        'get',
        true,
        qstr,
        callback,
        ''
      );
    },

    /*
      method post - wrapper for ajax.request
      @url          {string}
      @qstr         {hash|string}
      @callback     {string}
    */
    post        : function(url,qstr,callback) {
      var self = this;
      self.ajax.request(
        url,
        'post',
        true,
        qstr,
        callback,
        ''
      );
    },

    ajax        : {
      getXmlHttpObject  : function() {
        var obj = null;
        if(window.XMLHttpRequest) {
          try {
            obj = new XMLHttpRequest();
          } catch (e) {}
        } else if(window.ActiveXObject) {
          try {
            obj = new ActiveXObject('Msxml2.XMLHTTP');
          } catch (e) {
            try {
              obj = new ActiveXObject('Microsoft.XMLHTTP');
            } catch (e) {}
          }
        }
        return obj;
      },

      /*
        @hash {object/hash}
      */
      getQueryStringByHash: function(hash) {
        var qstr = '';
        for(var i in hash) {
          qstr = [qstr,'&',i,'=',[i]].join('');
        }
        return qstr.substring(1,qstr.length);
      },

      /*
        @url          {string}
        @method       {string}
        @asynch       {boolean}
        @queryString  {hash|string}
        @callback     {string}
        @charSet      {string}
      */
      request: function(url,method,asynch,queryString,callback,charSet) { 
        var queryString = queryString || '',
            charSet     = charSet     || 'utf8',
            asynch      = asynch      || 'true',
            self        = this,
            obj         = self.getXmlHttpObject();
        
        switch(method) {
          case 'get':
            if(typeof queryString == 'string' && queryString != '')
              url = [url,'?',queryString].join('');
            else if(typeof queryString == 'object')
              url = [url,'?',self.getQueryStringByHash(queryString)].join('');
          break;
          case 'post':
            if(typeof queryString == 'object')
              queryString = self.getQueryStringByHash(queryString);
          break;
        }

        obj.open(method,url,asynch);
        obj.setRequestHeader('Content-type','application/x-www-form-urlencoded',['charset=',charSet].join(''));            
        obj.send(queryString);
        obj.onreadystatechange = function(){
          if(obj.readyState == 4)
            if(obj.status == 200)
              callback(obj.responseText);
        }
      }
    },

    /*
      simple wrapper for the css effect library of Thomas Fuchs's emile
      
      @cfg (hash) {
        @el       {object}  - current element
        @css      {string}  - css property(s)
        @dur      {integer} - duration of the animation
        @callback {string}  - callback
      }
    */
    anim        : function(cfg) {
      var self      = this,
          el        = (this.cache[cfg[0]] ? this.cache[cfg[0]] : self.getDom(['div[id=',cfg[0],']'].join(''))),
          css       = cfg[1],
          dur       = (cfg[2] ? {duration: cfg[2]} : {duration: 800}),
          callback  = (cfg[3] ? cfg[3] : '');
          
      emile(el, css, dur, callback);
    }
  }
  
  /*
    |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\
    |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\
    | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /
    |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/
    */
  
  /*
    class timer - controlling multiple processes
  */
  window.timer = {

    DEPO: [],
    c: 0,
    intervalId: 0,

    counter: function(){
      var self = this;
      self.intervalId = setInterval(self.listener, 1);
    },

    listener: function() {
      timer.c == 999 ? timer.c = 0 : timer.c++;
      var thisRemainder, thisMethod, thisObject;
      for (var i = 0, l = timer.DEPO.length; i < l; i++) {
        thisRemainder = timer.c % timer.DEPO[i]['interval'];
        if (thisRemainder == 0) {
          thisMethod = timer.DEPO[i]['method'];
          thisMethod()
        }
      }
    },

    stopListener: function() {
      var self = this;
      clearInterval(self.intervalId)
    },

    /*
      @hash (hash) {
        @method       {string}
        @interval     {string}
      }
    */
    add: function(hash) {

      var self      = this,
          listener  = 0;

      if (self.DEPO.length == 0) {
        self.counter()
      }

      for (var i = 0, l = self.DEPO.length; i < l; i++) {
        if (self.DEPO[i]['method'] == hash['method']) {
          listener++;
          break;
        }
      }

      if (listener == 0) {
        self.DEPO[self.DEPO.length] = {
          'method'  : hash['method'],
          'interval': hash['interval']
        }
      }
    },

    /*
      @method       {string}
    */
    remove: function(method) {
      var self = this;

      for (var i = (self.DEPO.length - 1); i >= 0; i--) {
        if (self.DEPO[i]['method'] == method) {
            self.DEPO.splice(i, 1)
        }
      }

      if (self.DEPO.length == 0) {
        self.stopListener()
      }
    }
  }
  
  window.$ = window.MainFrame;
  window.addEventListener('load',MainFrame.initialize,false);
  
})(window);
