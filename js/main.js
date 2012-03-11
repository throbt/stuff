/*
  @author    robThot
  @Copyright (c) robThot
*/
(function(window) {
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
      MainFrame.domLoaded();
    },
    
    
    
    
    
    domLoaded: function(fn) {
      if(typeof fn != 'undefined')
        fn();
    },





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





    getDom  : function(selectorStr) {
      if(document.querySelector) {
        return document.body.querySelector(selectorStr);
      } else {   
        /**
          working only with the (\[id\=)(.*)(\]) formula

          TODO refact! - use the iglue fallback, btw we dont need that stuff
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
          in this case hopefully its a simple tag ... TODO refact!
        */
        else {
          return document.getElementsByTagName(selectorStr);
        }
      }
    },
    




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
            return current
          } else if(typeof self.getAttrib(current,prop) != 'undefined') {
            if(self.getAttrib(current,prop) == name) {
              return current
            }
          }
        } else {
          return null;
        }
        var current = current.parentNode;
      }
      return null;
    },
    



    
    getCssProperty : function(el,attr) {
      return (window.getComputedStyle ? window.getComputedStyle(el,null)[attr] : el.currentStyle[attr]);
    },
    




    events  : {
      add: function(e,f,o) {
        if(o.addEventListener) {
          o.addEventListener(e,f,false);
        } else if(o.attachEvent) {
          o.attachEvent(["on",e].join(""), f);
        }
      },
      remove: function(e,f,o) {
        if(o.removeEventListener) {
          o.removeEventListener(e,f,false);
        } else if(o.detachEvent) {
          o.detachEvent(["on",e].join(""), f);
        }
      }
    },





    createEl: function(cfg,thisParent) {

      var parent  = thisParent || document.body,
          self    = this,
          thisEl  = document.createElement(cfg.tag); 

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
          case "command":
          break;
          case "tag":
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
      
      if(cfg.command) {
        self.events.add(cfg.command[0], cfg.command[1], this.cache[cfg.id]);
      }

      return thisEl;
    },





    remove: function(element,id) {
      var thisEl, searchedEl = o.getDom(["div[id=",id,"]"].join(""));
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
      method get - wrapper for ajax.ajaxRequest
      @url          {string}
      @qstr         {hash/object|string}
      @callback     {string}
    */
    get         : function(url,qstr,callback) {
      var self = this;
      self.ajax.ajaxRequest(
        url,
        'get',
        true,
        qstr,
        callback,
        ''
      );
    },




    /*
      method get - wrapper for ajax.ajaxRequest
      @url          {string}
      @qstr         {hash/object|string}
      @callback     {string}
    */
    post        : function(url,qstr,callback) {
      var self = this;
      self.ajax.ajaxRequest(
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
      getQueryStringByHash: function(hash) {
        var qstr = '';
        for(var i in hash) {
          qstr = [qstr,'&',i,'=',[i]].join('');
        }
        return qstr.substring(1,qstr.length);
      },
      ajaxRequest: function(url,method,asynch,queryString,callback,charSet) { 
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
    */
    anim        : function(cfg) {
      var el, css, dur, callback, self = this;
      this.cache[cfg[0]] ? el = this.cache[cfg[0]] : el = self.getDom(["div[id=",cfg[0],"]"].join(""));
      css = cfg[1];
      cfg[2].duration ? dur = cfg[2] : dur = {duration: 800};
      typeof cfg[3] != "undefined" ? callback = cfg[3] : callback = "";
      emile(el, css, dur, callback);
    }
  }
  
  /*
    |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\
    |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\
    | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /
    |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/
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
  
  
  window.addEventListener("load",MainFrame.initialise,false);
  
})(window);

/*
  |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\
  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\
  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /
  |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/
*/

/*
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
