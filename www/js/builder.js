/*
  simple dom builder written by robThot(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
var builder = {

   cache   : {},

  create: function(cfg,thisParent) {

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
      if(typeof cfg.id != 'undefined')
        self.cache[cfg.id] = thisEl;

      parent.appendChild(thisEl);

      if(cfg.arr && cfg.arr.length != 0) {
        for(var i in cfg.arr) {
          self.create(cfg.arr[i],thisEl);
        }
      }

      if(cfg.html) {
        $(thisEl).html(cfg.html);
      }

      if(cfg.cmd) {
        $(thisEl).bind(cfg.cmd[0],cfg.cmd[1]);
      }

      return thisEl;
    },

    remove: function(element,selector) {
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
};
