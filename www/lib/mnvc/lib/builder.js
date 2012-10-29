
/*
  Class DomBuilder, written by thRobt(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
var DomBuilder = (function () {
    var cache = {};
    /*
      @method create - create  a dom element under the given parent element
      (thisParent) by the cfg:

        - type  : html tag
        - id    : id of the element
        - cls   : classname of the element
        - style : inline style of the element
        - iType : input type if its an input element
        - arr   : child elements
        - html  : the innerhtml of the element
        - cmd   : bind an event to the callback ['click',callback]

        - all the other given attribute will be displayed

        - the created element will be stored if it has an
          id attribute - DomBuilder.cache.[id]

      @param cfg        object
      @param thisParent object - dom reference, $(selector)[0] (DomBuilder.cache.[id])
      @return object - dom reference
    */
    function create(cfg,thisParent) {
      var parent  = thisParent || document.body,
          self    = this,
          thisEl  = document.createElement(cfg.type);
      for(var i in cfg) {
        switch(i) {
          case 'id':
            $(thisEl).attr('id',cfg[i]);
          break;
          case 'cls':
            $(thisEl).addClass(cfg[i]);
          break;
          case 'style':
            $(thisEl).attr('style',cfg[i]);
          break;
          case 'iType':
            $(thisEl).attr('type',cfg[i]);
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
            $(thisEl).attr(i,cfg[i]);
          break;
        }
      }
      // if(typeof cfg.id != 'undefined')
      //   self.cache[cfg.id] = thisEl;
      parent.appendChild(thisEl);
      if(cfg.arr && cfg.arr.length !== 0) {
        for(var iter in cfg.arr) {
          self.create(cfg.arr[iter],thisEl);
        }
      }
      if(cfg.html) {
        $(thisEl).html(cfg.html);
      }
      if(cfg.cmd) {
        $(thisEl).bind(cfg.cmd[0],cfg.cmd[1]);
      }
      return thisEl;
    }
    /*
      @method remove

      @param element - dom reference, $(selector)[0] (DomBuilder.cache.[id])
      @param selector string
      @return no return
    */
    function remove(element,selector) {
      var self        = this,
          thisEl,
          searchedEl  = $(selector)[0];
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
    }
    /*
      @method getParent
    
      @param el             object  - element
      @param type           string  - tagName
      @param prop           string  - attribute
      @param name           string  - value
      @param stopCondition  integer - depth of the iteration
      @return object
    */
    function getParent(el,type,prop,name,stopCondition) {
      stopCondition = stopCondition || 10;
      var self          = this,
          current       = el;
      if(typeof DomBuilder.getAttrib == 'undefined')
        DomBuilder.getAttrib = function(el, prop) {
          if(typeof prop != 'undefined' && typeof el != 'undefined') {
            // if(prop == 'class')
            //   return DomBuilder.getClassName();
            // else
            //   return el.getAttribute(prop);
            return $(el)[0].attr(prop);
          }
          return null;
        };
      if(!type) return el.parentNode;
      for(var i = 0; i < stopCondition; i++) {
        if(current.tagName != 'HTML') {
          if(typeof prop == 'undefined' && type == current.tagName) {
            return current;
          } else if(DomBuilder.getAttrib(current,prop) !== null /*|| DomBuilder.getAttrib(current,prop) != 'null'*/) {
            if(DomBuilder.getAttrib(current,prop) == name) {
              return current;
            }
          }
        } else {
          return null;
        }
        current = current.parentNode;
      }
      return null;
    }
    return {
      cache     : cache,
      create    : create,
      remove    : remove,
      getParent : getParent
    };
})();
