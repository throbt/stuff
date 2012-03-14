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

    initialise: function() {
      var self = this;
      if(navigator.appVersion.match(/MSIE/))
        self.ie = 1;
      (typeof Event != 'undefined' ? Event : window.event).prototype.stopProp = function() {
        if(window.event) {
          this.cancelBubble = true;
        } else {
          this.stopPropagation();
        }
      }

      try {
        console.log();
      } catch(e) {
        window.console      = {};
        window.console.log  = function() {}
      };

      MainFrame.domLoaded();
    },
    
    /*
      @fn {string} - not exactly the domloaded event, its just coming after the window onload
    */
    domLoaded: function(fn) {
      if(typeof fn != 'undefined')
        fn();
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
            case "id":
              return document.getElementById(matches[5]);
            break;
            case "class":
              var arr       = [],
                  elements  = document.getElementsByTagName(matches[1]);
              for(var i = 0,len = elements.length; i < len;i++) {
                if( (elements[i].className ? elements[i].className : elements[i].getAttribute("class") ) == matches[5])
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
          if(prop == 'class')
            return (el.className ? el.className : el.getAttribute(prop))
          else
            return el.getAttribute(prop)
        };
      
      if(!type) return el.parentNode;
      
      for(var i = 0; i < stopCondition; i++) {
        if(current.tagName != 'HTML') {
          if(!prop && type == current.tagName) {
            return current;
          } else if(typeof self.getAttrib(current,prop) != 'undefined') {
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
      @el   {object}
      @attr {string}
    */
    getCssProperty : function(el,attr) {
      return (window.getComputedStyle ? window.getComputedStyle(el,null)[attr] : el.currentStyle[attr]);
    },
    
    events  : {
      /*
        @e(event)     {string}
        @o(object)    {object}
        @f(function)  {string}
      */
      add: function(e,f,o) {
        if(o.addEventListener) {
          o.addEventListener(e,f,false);
        } else if(o.attachEvent) {
          o.attachEvent(["on",e].join(""), f);
        }
      },
      /*
        @e(event)     {string}
        @o(object)    {object}
        @f(function)  {string}
      */
      remove: function(e,f,o) {
        if(o.removeEventListener) {
          o.removeEventListener(e,f,false);
        } else if(o.detachEvent) {
          o.detachEvent(["on",e].join(""), f);
        }
      }
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
        @cmd      {array}  - command, use getParent to catch the current element
        @type     {string} - tagName
      }
    */
    createEl: function(cfg,thisParent) {

      var parent  = thisParent || document.body,
          self    = this,
          thisEl  = document.createElement(cfg.type); 

      for(var i in cfg) {
        switch(i) {
          case "id":
            thisEl.setAttribute("id",cfg[i]);
          break;
          case "cls":
            if(self.ie != undefined)
              thisEl.setAttribute("className",cfg[i]);
            else
              thisEl.setAttribute("class",cfg[i]);
          break;
          case "style":
            if(self.ie != undefined)
              thisEl.style.setAttribute("cssText",cfg[i]);
            else
              thisEl.setAttribute("style",cfg[i]);
          break;
          case "arr":
          break;
          case "html":
          break;
          case "cmd":
          break;
          case "type":
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
    remove: function(element,id) {
      var self        = this,
          thisEl,
          searchedEl  = self.getDom(["div[id=",id,"]"].join(""));

      for(var i in element.childNodes) {
        thisEl = element.childNodes[i];
        if(thisEl == searchedEl) {
          element.removeChild(thisEl);
          for(var c in o.cache) {
            if(o.cache[c] == searchedEl) {
              o.cache[c] = null;
              delete o.cache[c];
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
          el        = (this.cache[cfg[0]] ? this.cache[cfg[0]] : self.getDom(["div[id=",cfg[0],"]"].join(""))),
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
    counter: 0,
    intervalId: 0,

    counter: function(){
      timer.intervalId = setInterval(timer.listener, 1);
    },

    listener: function() {
      timer.counter == 999 ? timer.counter = 0 : timer.counter++;
      var thisRemainder, thisMethod, thisObject;
      for (var i = 0, l = timer.DEPO.length; i < l; i++) {
        thisRemainder = timer.counter % timer.DEPO[i]["interval"];
        if (thisRemainder == 0) {
          thisMethod = timer.DEPO[i]["method"];
          thisMethod()
        }
      }
    },

    stopListener: function() {
      clearInterval(timer.intervalId)
    },

    /*
      @arr (array) {
        @method       {string}
        @interval     {string}
      }
    */
    add: function(arr) {
      if (timer.DEPO.length == 0) {
        timer.counter()
      }
      var listener = 0;
      for (var i = 0, l = timer.DEPO.length; i < l; i++) {
        if (timer.DEPO[i]["method"] == arr["method"]) {
          listener++;
          break;
        }
      }
      if (listener == 0) {
        timer.DEPO[timer.DEPO.length] = {
          "method"  : arr['method'],
          "interval": arr['interval']
        }
      }
    },

    /*
      @method       {string}
    */
    remove: function(method) {
      for (var i = (timer.DEPO.length - 1); i >= 0; i--) {
        if (timer.DEPO[i]["method"] == method) {
            timer.DEPO.splice(i, 1)
        }
      }
      if (timer.DEPO.length == 0) {
        timer.stopListener()
      }
    }
  }
  
  window.$ = window.MainFrame;
  window.addEventListener("load",MainFrame.initialise,false);
  
})(window);

/*
  |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\
  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\
  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /
  |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/
*/

/*
  the most fuckin fastest tool

  emile.js (c) 2009 Thomas Fuchs
  Licensed under the terms of the MIT license.
*/

(function(emile, container) {
  var parseEl = document.createElement('div'),
    props = ('backgroundColor borderBottomColor borderBottomWidth borderLeftColor borderLeftWidth '+
    'borderRightColor borderRightWidth borderSpacing borderTopColor borderTopWidth bottom color fontSize '+
    'fontWeight height left letterSpacing lineHeight marginBottom margelement.onmousemoveinLeft marginRight marginTop maxHeight '+
    'maxWidth minHeight minWidth opacity outlineColor outlineOffset outlineWidth paddingBottom paddingLeft '+
    'paddingRight paddingTop right textIndent top width wordSpacing zIndex').split(' ');

  function interpolate(source,target,pos) { return (source+(target-source)*pos).toFixed(3); }
  function s(str, p, c) { return str.substr(p,c||1); }
  function color(source,target,pos) {
    var i = 2, j, c, tmp, v = [], r = [];
    while(j=3,c=arguments[i-1],i--)
      if(s(c,0)=='r') { c = c.match(/\d+/g); while(j--) v.push(~~c[j]); } else {
        if(c.length==4) c='#'+s(c,1)+s(c,1)+s(c,2)+s(c,2)+s(c,3)+s(c,3);
        while(j--) v.push(parseInt(s(c,1+j*2,2), 16)); }
    while(j--) { tmp = ~~(v[j+3]+(v[j]-v[j+3])*pos); r.push(tmp<0?0:tmelement.onmousemovep>255?255:tmp); }
    return 'rgb('+r.join(',')+')';
  }

  function parse(prop) {
    var p = parseFloat(prop), q = prop.replace(/^[\-\d\.]+/,'');
    return isNaN(p) ? { v: q, f: color, u: ''} : { v: p, f: interpolate, u: q };
  }

  function normalize(style) {
    var css, rules = {}, i = props.length, v;
    parseEl.innerHTML = '<div style="'+style+'"></div>';
    css = parseEl.childNodes[0].style;
    while(i--) if(v = css[props[i]]) rules[props[i]] = parse(v);
    return rules;
  }

  container[emile] = function(el, style, opts, after) {
    el = typeof el == 'string' ? document.getElementById(el) : el;
    opts = opts || {};
    var target = normalize(style), comp = el.currentStyle ? el.currentStyle : getComputedStyle(el, null),
      prop, current = {}, start = +new Date, dur = opts.duration||200, finish = start+dur, interval,
      easing = opts.easing || function(pos) { return (-Math.cos(pos*Math.PI)/2) + 0.5; };
    for(prop in target) current[prop] = parse(comp[prop]);
    interval = setInterval(function() {
      var time = +new Date, pos = time>finish ? 1 : (time-start)/dur;
      for(prop in target)
        el.style[prop] = target[prop].f(current[prop].v,target[prop].v,easing(pos)) + target[prop].u;
      if(time>finish) { clearInterval(interval); opts.after && opts.after(); after && setTimeout(after,1); }
    },10);
  }
})('emile', this);
