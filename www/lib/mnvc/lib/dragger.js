/*
  Class Dragger
*/
var Dragger = (function() {
  var mouseListener = false,
      callback      = '',
      cfg           = {},
      mousePos;
  var mouseCoords = function(ev) {
    if(ev.pageX || ev.pageY){
      return {
        x:  ev.pageX,
        y:  ev.pageY
      };
    }
    return {
      x:  ev.clientX+document.body.scrollLeft-document.body.clientLeft,
      y:  ev.clientY+document.body.scrollTop-document.body.clientTop
    };
  };
  var mouseMove = function(ev) {
    ev                = ev || window.event;
    Dragger.mousePos  = mouseCoords(ev);
    if(typeof Dragger.callback == 'function') {
      Dragger.callback(ev);
    }
  };
  var drag = function(arr,cfg) {
    Dragger.cfg = cfg || {};
    if(arr.length > 0) {
      Dragger.selector = $(arr[0]).attr('class');
      if(!mouseListener) {
        $(document).mousemove(mouseMove);
        mouseListener = true;
      }
      for(var i=0,l=arr.length;i<l;++i) {
        draggable(arr[i]);
        $(arr[i]).mouseover(function(event) {
          if(Dragger.mouseover_hook) {
            Dragger.mouseover_hook(this,event);
          }
        });
        $(arr[i]).mouseout(function(event) {
          if(Dragger.mouseout_hook) {
            Dragger.mouseout_hook(this,event);
          }
        });
      }
    }
  };
  var draggable = function(el) {
    var self    = this,
        anchor  = $(el).find('.anchor');
    $(anchor).mouseover(function(event) {
      if(Dragger.anchor_mouseover_hook) {
        Dragger.anchor_mouseover_hook(this,event);
      }
    });
    $(anchor).mouseover(function(event) {
      if(Dragger.anchor_mouseout_hook) {
        Dragger.anchor_mouseout_hook(this,event);
      }
    });
    $(anchor).mousedown(function(event) {
      Dragger.el          = $.getParent(this,'LI','class',Dragger.selector);
      if(!$(Dragger.el).hasClassName('dragged')) {
        Dragger.leftDis   = (Number(Dragger.mousePos.x)-parseInt($(Dragger.el).css('left'),10));
        Dragger.topDis    = (Number(Dragger.mousePos.y)-parseInt($(Dragger.el).css('top'),10));
        $(Dragger.el).addClassName('dragged');
        Dragger.callback  = Dragger.dragThis;
        if(Dragger.mousedown_hook) {
          Dragger.mousedown_hook(Dragger.el,event);
        }
      }
      return false;
    });
    $(anchor).mouseup(function(event) {
      Dragger.callback = '';
      $(Dragger.el).removeClassName('dragged');
      if(Dragger.mouseup_hook) {
        Dragger.mouseup_hook(Dragger.el,event);
      }
      return false;
    });
  };
  var dragThis = function() {
    if(Dragger.mousemove_listener) {
      Dragger.mousemove_listener(this);
    }
    if(Dragger.cfg.move) {
      switch(Dragger.cfg.move) {
        case 'vertical':
          $(Dragger.el).css({
            'top'   : Dragger.mousePos.y-Dragger.topDis
          });
        break;
        case 'horizontal':
          $(Dragger.el).css({
            'left'  : Dragger.mousePos.x-Dragger.leftDis
          });
        break;
        case 'both':
          $(Dragger.el).css({
            'top'   : Dragger.mousePos.y-Dragger.topDis,
            'left'  : Dragger.mousePos.x-Dragger.leftDis
          });
        break;
      }
    } else {
      $(Dragger.el).css({
        'top'   : Dragger.mousePos.y-Dragger.topDis,
        'left'  : Dragger.mousePos.x-Dragger.leftDis
      });
    }
  };
  return {
    selector    : '',
    cfg         : cfg,
    callback    : callback,
    dragThis    : dragThis,
    drag        : function(cfg) {drag(this,cfg);}
  };
})();