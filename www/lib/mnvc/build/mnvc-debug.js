/*!
 * mnvc javascript framework, written by thRobt(robthot@gmail.com)
 * licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
 */

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
  return {
    arrayUnique: arrayUnique
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
/*
  Class Effect
*/
var Effect = (function() {
  function bounce(pos) {
    if (pos < (1 / 2.75)) {
      return (7.5625 * pos * pos);
    } else if (pos < (2 / 2.75)) {
      return (7.5625 * (pos -= (1.5 / 2.75)) * pos + 0.75);
    } else if (pos < (2.5 / 2.75)) {
      return (7.5625 * (pos -= (2.25 / 2.75)) * pos + 0.9375);
    } else {
      return (7.5625 * (pos -= (2.625 / 2.75)) * pos + 0.984375);
    }
  }
  return {
    bounce  : bounce
  };
})();/*
  Class Component, written by thRobt(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
var Component = (function() {
  /*
    @method merge
    @param  dest      object
    @param  source    object
    @return no return
  */
  var merge = function(source,dest) {
    if(typeof source == 'function') {
      for(var i in dest) {
        source.prototype[i] = dest[i];
      }
    } else if(typeof source == 'object' && typeof dest == 'object') {
      for(var iter in dest) {
        source[iter] = dest[iter];
      }
    }
  };
  /*
    @method extend
    @param  source  object
    @param  dest    object
    @return target  object
  */
  function extend(source, dest) {
    var target = function() {
      return dest._construct.call(this, arguments);
    };
    target.prototype = new source();
    for(var i in dest) {
      if(i != '_construct')
        target.prototype[i] = dest[i];
    }
    return target;
  }
  return {
    merge       : merge,
    extend      : extend
  };
})();

/*
  function _construct -  basic function as constuctor for components
*/
var _construct = function(cfg) {
  this.cfg = cfg || {};
};

/*
  Component Form
*/
var Form = Component.extend(_construct,{
  /*
    @method build
    @return no return
  */
  build: function() {
    this.reference = $.create({
      type: 'div',
      cls: this.cls,
      arr: [{
        type: 'form',
        action: this.action,
        method: this.method,
        enctype: (this.multipart ? 'multipart/form-data' : ''),
        id: this.id
      }]
    },this.parent);
    this.body = $.create({
      type: 'fieldset',
      id: [this.id,'_fieldset'].join('')
    },$(['#',this.id].join(''))[0]);
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct: function(cfg) {
    this.cfg       = cfg[0] || {};
    this.id        = (this.cfg.id         ? this.cfg.id : '');
    this.method    = (this.cfg.method     ? this.cfg.method : '');
    this.action    = (this.cfg.action     ? this.cfg.action : '');
    this.parent    = (this.cfg.parent     ? this.cfg.parent : '');
    this.cls       = (this.cfg.cls        ? this.cfg.cls : '');
    this.multipart = (this.cfg.multipart  ? this.cfg.multipart : false);
    this.build();
  }
});

/*
  Component FormEl - an abstract form element
*/
var FormEl = Component.extend(_construct,{
  /*
    @method wrapper
    @return no return
  */
  wrapper: function() {
    this.parent = (this.cfg.parent  ? this.cfg.parent : '');
    this.label  = (this.cfg.label   ? this.cfg.label : '');
    this.id     = (this.cfg.id      ? this.cfg.id : '');
    this.value  = (this.cfg.value   ? this.cfg.value : '');
    this.reference = $.create({
      type  : 'div',
      cls   : 'control-group',
      arr   : [{
        type  : 'label',
        'for' : [this.id,'_input'].join(''),
        id    : [this.id,'_label'].join(''),
        cls   : 'control-label',
        html  : this.label
      },{
        type  : 'div',
        id    : (this.id !== '' ? [this.id,'_wrap'].join('') : ''),
        cls   : 'controls'
      }]
    },this.parent);
  },
  /*
    @method setValue
    @param val string
    @return no return
  */
  setValue:        function(val) {
    this.value = val || '';
    switch(this.type) {
      case 'textarea':
        $(['#',this.id,'_input'].join('')).html(this.value);
      break;
      case 'select':
        if(typeof this.value == 'number') {
          $(['#',this.id,'_input'].join('')).val(this.options[this.value]);
        } else {
          $(['#',this.id,'_input'].join('')).val(this.value);
        }
      break;
      default:
        $(['#',this.id,'_input'].join('')).val(this.value);
      break;
    }
  },
  /*
    @method getValue
    @return no return
  */
  getValue:        function() {
    return (this.value ? this.value : null);
  },
  /*
    @method setLabel
    @param val string
    @return no return
  */
  setLabel:   function(val) {
    this.label = val || '';
    $(['#',this.id,'_label'].join('')).html(this.label);
  },
  /*
    @method getLabel
    @return no return
  */
  getLabel:   function() {
    return (this.label ? this.label : null);
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct: function(cfg) {
    this.cfg    = cfg[0] || {};
  }
});

/*
  Component Textfield
*/
var Text = Component.extend(FormEl,{
  type        : 'text',
  /*
    @method build
    @return no return
  */
  build       : function() {
    var obj = {
      type  : 'input',
      iType : 'text',
      cls   : 'input  input-xlarge',
      id    : [this.id,'_input'].join(''),
      name  : [this.id,'_input'].join('')
    };
    if(this.disabled)
      obj['disabled'] = 'disabled';
    $.create(obj,$(['#',this.id,'_wrap'].join(''))[0]);
  },
  /*
    @method setup
    @return no return
  */
  setup: function() {
    var self = this;
    $(['#',this.id,'_input'].join('')).keyup(function() { 
      self.setValue($(this).val());
      self.change(self);
    });
  },
  /*
    @method build
    @param cfg object
    @return no return
  */
  _construct  : function(cfg) {
    this.cfg    = cfg[0] || {};
    if(this.cfg.id && this.cfg.parent && this.cfg.label) {
      this.disabled = (this.cfg.disabled ? this.cfg.disabled : false);
      this.change   = (this.cfg.change ? this.cfg.change : function() {});
      this.wrapper();
      this.build();
      this.setup();
      if(this.cfg.value !== '') {
        this.setValue(this.cfg.value);
      }
    }
  }
});

/*
  Component Password
*/
var Password = Component.extend(FormEl,{
  type        : 'password',
  /*
    @method build
    @return no return
  */
  build       : function() {
    var obj = {
      type  : 'input',
      iType : 'password',
      cls   : 'input  input-xlarge',
      id    : [this.id,'_input'].join(''),
      name  : [this.id,'_input'].join('')
    };
    if(this.disabled)
      obj['disabled'] = 'disabled';
    $.create(obj,$(['#',this.id,'_wrap'].join(''))[0]);
  },
  /*
    @method setup
    @return no return
  */
  setup: function() {
    var self = this;
    $(['#',this.id,'_input'].join('')).keyup(function() { 
      self.setValue($(this).val());
      self.change(self);
    });
  },
  /*
    @method build
    @param cfg object
    @return no return
  */
  _construct  : function(cfg) {
    this.cfg    = cfg[0] || {};
    if(this.cfg.id && this.cfg.parent && this.cfg.label) {
      this.change = (this.cfg.change ? this.cfg.change : function() {});
      this.disabled = (this.cfg.disabled ? this.cfg.disabled : false);
      this.wrapper();
      this.build();
      this.setup();
      if(this.cfg.value !== '') {
        this.setValue(this.cfg.value);
      }
    }
  }
});

/*
  Component Textarea
*/
var Textarea = Component.extend(FormEl,{
  type        : 'textarea',
  /*
    @method build
    @return no return
  */
  build       : function() {
    $.create({
      type  : 'textarea',
      cls   : 'input  input-xlarge',
      id    : [this.id,'_input'].join(''),
      name  : [this.id,'_input'].join('')
    },$(['#',this.id,'_wrap'].join(''))[0]);
  },
  /*
    @method setup
    @return no return
  */
  setup: function() {
    var self = this;
    $(['#',this.id,'_input'].join('')).keyup(function() { 
      self.setValue($(this).val());
      self.change(self);
    });
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct  : function(cfg) {
    this.cfg    = cfg[0] || {};
    if(this.cfg.id && this.cfg.parent && this.cfg.label) {
      this.change = (this.cfg.change ? this.cfg.change : function() {});
      this.wrapper();
      this.build();
      this.setup();
      if(this.cfg.value !== '') {
        this.setValue(this.cfg.value);
      }
    }
  }
});

/*
  Component Checkbox
*/
var Checkbox = Component.extend(FormEl,{
  type        : 'checkbox',
  /*
    @method wrapper
    @return no return
  */
  wrapper: function() {
    this.parent = (this.cfg.parent  ? this.cfg.parent : '');
    this.label  = (this.cfg.label   ? this.cfg.label : '');
    this.id     = (this.cfg.id      ? this.cfg.id : '');
    this.value  = (this.cfg.value   ? this.cfg.value : '');
    this.reference = $.create({
      type  : 'div',
      cls   : 'control-group',
      arr   : [{
        type  : 'div',
        id    : (this.id !== '' ? [this.id,'_wrap'].join('') : ''),
        cls   : 'controls',
        arr   : [{
          type  : 'label',
          'for' : [this.id,'_input'].join(''),
          id    : [this.id,'_label'].join(''),
          cls   : 'checkbox',
          html  : this.label
        }]
      }]
    },this.parent);
  },
  /*
    @method build
    @return no return
  */
  build       : function() {
    var obj = {
      type  : 'input',
      iType : 'checkbox',
      cls   : 'input  input-xlarge',
      id    : [this.id,'_input'].join(''),
      name  : [this.id,'_input'].join(''),
      value : this.value
    };
    if(this.disabled)
      obj['disabled'] = 'disabled';
    this.body = $.create(obj,$(['#',this.id,'_label'].join(''))[0]);
  },
  /*
    @method check
    @return no return
  */
  check: function() {
    $(['#',this.id,'_input'].join('')).attr('checked','checked');
  },
  /*
    @method isChecked
    @return boolean
  */
  isChecked: function() {
    return $(['#',this.id,'_input'].join('')).is(':checked');
  },
  /*
    @method setLabel
    @param val string
    @return no return
  */
  setLabel:   function(val) {
    this.label = val || '';
    $(['#',this.id,'_label'].join('')).html(this.label);
    this.build();
    this.setup();
  },
  /*
    @method getLabel
    @return no return
  */
  getLabel:   function() {
    return (this.label ? this.label : null);
  },
  /*
    @method setup
    @return no return
  */
  setup: function() {
    var self = this;
    $(['#',this.id,'_input'].join('')).click(function() {
      self.change(self);
    });
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct  : function(cfg) {
    this.cfg      = cfg[0] || {};
    this.change = (this.cfg.change ? this.cfg.change : function() {});
    if(this.cfg.id && this.cfg.parent && this.cfg.label) {
      this.disabled = (this.cfg.disabled ? this.cfg.disabled : false);
      this.wrapper();
      this.build();
      this.setup();
      if(this.cfg.checked) {
        this.check();
      }
    }
  }
});

/*
  Component Select
*/
var Select = Component.extend(FormEl,{
  type        : 'select',
  build       : function() {
    var obj = {
      type  : 'select',
      cls   : 'input  input-xlarge',
      id    : [this.id,'_input'].join(''),
      name  : [this.id,'_input'].join('')
    };
    if(this.disabled)
      obj['disabled'] = 'disabled';
    this.body = $.create(obj,$(['#',this.id,'_wrap'].join(''))[0]);
  },
  /*
    @method setOptions
    @return no return
  */
  setOptions: function() {
    var options = this.options, option='';
    for(var i=0,l=options.length;i<l;++i) {
      option = options[i];
      $.create({
        type: 'option',
        value: option,
        html: option
      },$(['#',this.id,'_input'].join(''))[0]);
    }
  },
  /*
    @method addOption
    @param val  string or number
    @return no return
  */
  addOption: function(val) {
    this.options.push(val);
    this.removeOptions();
    this.setOptions();
  },
  /*
    @method addOptions
    @param val  array
    @return no return
  */
  addOptions: function(arr) {
    this.options = $.arrayUnique(arr);
    this.removeOptions();
    this.setOptions();
  },
  /*
    @method deleteOption
    @param val  string or number
    @return no return
  */
  deleteOption: function(val) {
    var iter,
        self = this;
    if(typeof val == 'number') {
      val = this.options[val];
    }
    $(['#',this.id,'_input > option'].join('')).each(function() {
      if($(this).val() == val) {
        $(this).remove();
        self.options.splice(iter,1);
      }
      iter++;
    });
  },
  /*
    @method removeOptions
    @return no return
  */
  removeOptions: function() {
    $(['#',this.id,'_input > option'].join('')).each(function() {
      $(this).remove();
    });
  },
  /*
    @method setup
    @return no return
  */
  setup: function() {
    var self = this;
    $(this.body).change(function() {
      self.setValue($(this).val());
      self.change(self);
    });
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct  : function(cfg) {
    this.cfg      = cfg[0] || {};
    this.selected = (this.cfg.selected ? this.cfg.selected : this.options[0]);
    this.change   = (this.cfg.change ? this.cfg.change : function() {});
    this.disabled = (this.cfg.disabled ? this.cfg.disabled : false);
    if(this.cfg.id && this.cfg.parent && this.cfg.label) {
      this.wrapper();
      this.build();
      this.options = (this.cfg.options ? this.cfg.options : []);
      this.setOptions();
    }
    if(this.selected) {
      this.setValue(this.selected);
    }
    this.setup();
  }
});

/*
  Component Button
*/
var Button = Component.extend(FormEl,{
  type : 'button',
  /*
    @method wrapper
    @return no return
  */
  wrapper: function() {
    this.parent = (this.cfg.parent  ? this.cfg.parent : '');
    this.label  = (this.cfg.label   ? this.cfg.label : '');
    this.id     = (this.cfg.id      ? this.cfg.id : '');
    this.reference = $.create({
      type  : 'div',
      cls   : 'control-group',
      arr   : [{
        type  : 'div',
        id    : (this.id !== '' ? [this.id,'_wrap'].join('') : ''),
        cls   : 'controls'
      }]
    },this.parent);
  },
  /*
    @method build
    @return no return
  */
  build: function() {
    var obj = {
      type    : (this.href && this.href != '' ? 'a' : 'button'),
      cls     : this.cls,
      id      : [this.id,'_input'].join(''),
      name    : [this.id,'_input'].join(''),
      html    : this.label
    };
    if(this.target != '') {
      obj.target = this.target;
    }
    if(this.href && this.href != '') {
      obj.href = this.href;
    }
    this.body = $.create(obj,$(['#',this.id,'_wrap'].join(''))[0]);
  },
  /*
    @method setUp
    @return no return
  */
  setUp: function() {
    var self = this;
    $(this.body).click(function() { alert("clicked");
      self.pressed(self);
      return false;
    });
  },

  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct: function(cfg) {
    this.cfg      = cfg[0] || {};
    this.pressed  = (this.cfg.pressed ? this.cfg.pressed : function() {});
    this.href     = (this.cfg.href    ? this.cfg.href : '');
    this.cls      = (this.cfg.cls     ? this.cfg.cls : '');
    this.label    = (this.cfg.label   ? this.cfg.label : '');
    this.target   = (this.cfg.target  ? this.cfg.target : '');
    this.wrapper();
    this.build();
    this.setUp();
  }
});

/*
  Component MultipleNumber
*/
var MultipleNumber = Component.extend(FormEl,{
  type : 'custominput',
  /*
    @method getValue
    @return string
  */
  getValue: function() {
    var str = '';
    for(var i in this.value) {
      str += ' ' + this.value[i];
    }
    return str.substring(1,str.length-1);
  },
  /*
    @method build
    @param key string
    @param val string
    @return no return
  */
  setValue: function(key,val) {
    var key = key || '',
        val = val || '';
    if(key != '' && val != '') {
      if(this.value[key]) {
        this.value[key] = val;
        $(['#',key].join('')).val(val);
      }
    }
  },
  /*
    @method build
    @return no return
  */
  build: function() {
    var el = {}, obj = {},option = {}, thisOption = {};
    this.value = {};
    for(var i=0,l=this.elements.length;i<l;i++) {
      el  = this.elements[i];
      obj = {};
      switch(el.type) {
        case 'text':
          obj = {
            type  : 'input',
            iType : 'text',
            cls   : ['input input-xlarge pull-left multiple ',(el.len ? el.len : ''),' ',this.id].join(''),
            id    : [this.id,'_input_',i].join(''),
            value : (el.value ? el.value : ''),
            name  : [this.id,'_input_',i].join('')
          };
          if(el.disabled) {
            obj['disabled'] = 'disabled';
          }
          $.create(obj,$(['#',this.id,'_wrap'].join(''))[0]);
          this.value[[this.id,'_input_',i].join('')] = (el.value ? el.value : '');
        break;
        case 'select':
          $.create({
            type  : 'select',
            cls   : ['input input-xlarge pull-left multiple ',(el.len ? el.len : ''),' ',this.id].join(''),
            id    : [this.id,'_input_',i].join(''),
            name  : [this.id,'_input_',i].join('')
          },$(['#',this.id,'_wrap'].join(''))[0]);
          for(var iter=0,len=el.options.length;iter<len;iter++) {
            option = el.options[iter];
            thisOption = {
              type: 'option',
              value: option,
              html: option
            };
            if(iter == el.selected) {
              thisOption['selected'] = 'selected';
            }
            $.create(thisOption,$(['#',this.id,'_input_',i].join(''))[0]);
          }
          this.value[[this.id,'_input_',i].join('')] = (el.selected ? el.options[el.selected] : el.options[0]);
        break;
      };
    };
  },
  /*
    @method setUp
    @return no return
  */
  setUp: function() {
    var self = this;
    $(['.',this.id].join('')).change(function() {
      self.setValue($(this).attr('id'),$(this).val());
      self.change(self);
    });
  },
  /*
    @method _construct
    @return no return
  */
  _construct: function(cfg) {
    this.cfg      = cfg[0] || {};
    this.id       = (this.cfg.id   ? this.cfg.id : '');
    this.label    = (this.cfg.label   ? this.cfg.label : '');
    this.change   = (this.cfg.change ? this.cfg.change : function() {});
    this.elements = (this.cfg.elements   ? this.cfg.elements : []);
    this.value    = {};
    this.wrapper();
    this.build();
    this.setUp();
  }
});

/*
  Component Radio
*/
var Radio = Component.extend(FormEl,{
  type        : 'radio',
  /*
    @method wrapper
    @return no return
  */
  wrapper: function() {
    this.parent = (this.cfg.parent  ? this.cfg.parent : '');
    this.label  = (this.cfg.label   ? this.cfg.label : '');
    this.id     = (this.cfg.id      ? this.cfg.id : '');
    this.value  = (this.cfg.value   ? this.cfg.value : '');
    this.listener_class = [this.id,'_r_listener'].join('');
    this.reference = $.create({
      type  : 'div',
      cls   : 'control-group',
      id    : (this.id !== '' ? [this.id,'_wrap'].join('') : ''),
      arr   : [{
        type  : 'label',
        id    : [this.id,'_radio_label'].join(''),
        cls   : 'control-label',
        html  : this.label
      },{
        type  : 'div',
        cls   : 'controls',
        id    : [this.id,'_radio_wrapper'].join('')
      }]
    },this.parent);
  },
  /*
    @method build
    @return no return
  */
  build       : function() {
    var options = this.options, option='';
    for(var i=0,l=options.length;i<l;++i) {
      option = options[i];
      $.create({
        type  : 'label',
        id    : [i,'_radio_label_',this.id].join(''),
        'for' : [i,'_input_',this.id].join(''),
        cls   : 'radio',
        html  : option
      },$(['#',this.id,'_radio_wrapper'].join(''))[0]);
      $.create({
        type    : 'input',
        iType   : 'radio',
        cls     : ['input  input-xlarge ',this.listener_class].join(''),
        id      : [i,'_input_',this.id].join(''),
        name    : [this.id,'_name'].join(''),
        value   : option
      },$(['#',i,'_radio_label_',this.id].join(''))[0]);
    }
  },
  /*
    @method setValue
    @param val  string or number
    @return no return
  */
  setValue: function(val) {
    var thisVal = '';
    if(typeof val == 'number')
      thisVal = this.options[val];
    else
      thisVal = val;
    $(['.',this.listener_class].join('')).each(function() {
      if($(this).val() == thisVal) {
        $(this).attr('checked','checked');
      }
    });
    this.value = thisVal;
  },
  /*
    @method addOption
    @param val string
    @return no return
  */
  addOption: function(val) {
    this.removeOptions();
    this.options.push(val);
    this.build();
    this.setUp();
  },
  /*
    @method addOptions
    @param val  array
    @return no return
  */
  addOptions: function(arr) {
    this.options = $.arrayUnique(arr);
    if(this.options.length === 0)
      this.removeOptions();
    else {
      this.removeOptions();
      this.build();
      this.setUp();
    }
  },
  /*
    @method removeOptions
    @return no return
  */
  removeOptions: function() {
    $(['#',this.id,'_radio_wrapper > label'].join('')).each(function() {
      $(this).children().unbind();
      $(this).remove();
    });
  },
  /*
    @method deleteOption
    @param val  string or number
    @return no return
  */
  deleteOption: function(val) {
    var iter,
        self = this;
    if(typeof val == 'number') {
      val = this.options[val];
    }
    $(['#',this.id,'_radio_wrapper > label'].join('')).each(function() {
      if($(this).children().val() == val) {
        $(this).children().unbind();
        $(this).remove();
        self.options.splice(iter,1);
      }
      iter++;
    });
  },
  /*
    @method setUp
    @return no return
  */
  setUp: function() {
    var self = this;
    $(['.',this.listener_class].join('')).click(function() {
      self.setValue($(this).val());
      self.change(self);
    });
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct  : function(cfg) {
    this.cfg      = cfg[0] || {};
    this.change = (this.cfg.change ? this.cfg.change : function() {});
    this.options  = (this.cfg.options ? this.cfg.options : []);
    this.selected = (this.cfg.selected ? this.cfg.selected : this.options[0]);
    if(this.cfg.id && this.cfg.parent && this.cfg.label) {
      this.wrapper();
      this.build();
      this.setUp();
    }
    if(this.selected) {
      this.setValue(this.selected);
    }
  }
});

/*
  Component RadioMatrix
*/
var RadioMatrix = Component.extend(FormEl,{
  type : 'radiomatrix',
  /*
    @method getValue
    @return object
  */
  getValue: function() {
    var self = this, row = '',column = '', selector = '', thisObj = {};
    for(var i=0,l=this.rows.length;i<l;++i) {
      row               = this.rows[i];
      thisObj[row]  = '';
      for(var c=0,len=this.columns.length;c<len;++c) {
        column    = this.columns[c];
        selector  = ['#',i,'_input_',self.id,'_',c].join('');
        if($(selector).is(':checked')) {
          thisObj[row] = column;
        }
      }
    }
    this.values = thisObj;
    return this.values;
  },
  /*
    @method addRows
    @return no return
  */
  addRows: function(rows) {
    this.values = {};
    this.rows   = $.arrayUnique(rows);
    this.cleanUp();
    //this.wrapper();
    this.build();
    this.setUp();
  },
  /*
    @method addColumns
    @return no return
  */
  addColumns: function(columns) {
    this.values   = {};
    this.columns  = $.arrayUnique(columns);
    this.cleanUp();
    //this.wrapper();
    this.build();
    this.setUp();
  },
  /*
    @method wrapper
    @return no return
  */
  wrapper: function() {
    this.parent = (this.cfg.parent  ? this.cfg.parent : '');
    this.label  = (this.cfg.label   ? this.cfg.label : '');
    this.id     = (this.cfg.id      ? this.cfg.id : '');
    this.value  = (this.cfg.value   ? this.cfg.value : '');
    this.reference = $.create({
      type  : 'div',
      cls   : 'control-group',
      id    : [this.id,'_group'].join('')
    },this.parent);
  },
  /*
    @method build
    @return no return
  */
  build: function() {
    $.create({
      type: 'table',
      cls: this.cls,
      id: [this.id,'_table'].join('')
    },$(['#',this.id,'_group'].join(''))[0]);
    var thisRow = '';
    $.create({
      type: 'tr',
      id: ['tr_head'].join(''),
      arr: this.getTableHead()
    },$(['#',this.id,'_table'].join(''))[0]);
    for(var i=0,l=this.rows.length;i<l;++i) {
      thisRow = this.rows[i];
      $.create({
        type: 'tr',
        id: ['tr_',i].join(''),
        arr: this.buildRow(i,thisRow)
      },$(['#',this.id,'_table'].join(''))[0]);
    }
  },
  /*
    @method getTableHead
    @return object
  */
  getTableHead: function() {
    var column = '', thisArr = [];
    thisArr.push({
      type: 'td',
      id: ['td_head_',i].join(''),
      cls: 'td_label',
      html: ''
    });
    for(var i=0,l=this.columns.length;i<l;++i) {
      column = this.columns[i];
      thisArr.push({
        type: 'td',
        id: ['td_head_',i].join(''),
        arr: [{
          type: 'span',
          cls: 'head_label',
          html: column
        }]
      });
    }
    return thisArr;
  },
  /*
    @method buildRow
    @param iter     number
    @param thisRow  string
    @return object
  */
  buildRow: function(iter,thisRow) {
    var column = '', thisArr = [];
    thisArr.push({
      type: 'td',
      id: ['td_',iter,'_label'].join(''),
      cls: 'td_label',
      arr: [{
        type: 'label',
        cls: 'control-label',
        html: thisRow
      }]
    });
    for(var i=0,l=this.columns.length;i<l;++i) {
      column = this.columns[i];
      thisArr.push({
        type: 'td',
        cls: 'cell',
        id: ['td_',iter,'_',i].join(''),
        arr: [{
          type: 'input',
          iType: 'radio',
          rel: [iter,'|',i].join(''),
          id: [iter,'_input_',this.id,'_',i].join(''),
          cls: ['input input-xlarge ',this.id,'_r_listener'].join(''),
          name: [this.id,'_name_',iter].join(''),
          value: column
        }]
      });
    }
    return thisArr;
  },
  /*
    @method cleanUp
    @return no return
  */
  cleanUp: function() {
    $(['#',this.id,'_table'].join('')).remove();
  },
  /*
    @method setUp
    @return no return
  */
  setUp: function() {
    var self = this;
    $(['.',this.id,'_r_listener'].join('')).unbind();
    $(['.',this.id,'_r_listener'].join('')).click(function() {
      self.change(self);
    });
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct: function(cfg) {
    this.cfg      = cfg[0] || {};
    this.change   = (this.cfg.change  ? this.cfg.change   : function() {});
    this.columns  = (this.cfg.columns ? this.cfg.columns  : []);
    this.rows     = (this.cfg.rows    ? this.cfg.rows     : []);
    this.cls      = (this.cfg.cls     ? this.cfg.cls      : '');
    this.values   = {};
    this.wrapper();
    this.build();
    this.setUp();
  }
});/*
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