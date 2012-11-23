/*
  Class Grid
*/
var Grid = (function() {
	var init = function(arr) {
		if(arr.length > 1) {
			rebuild(arr);
			setup();
		}
	};
	var _construct = function(cfg) {
		this.cfg = cfg || {};
	};
	var elements	= [],
			action		=	'',
			dragged		=	'',
			touched		=	'',
			frame			= '',
      elCounter = 0,
      duration  = 10,
      leftPos;
	var rerender = function() {
		var height = 0, grid = {}, iter = 0;
		$('.gridEl').each(function() {
			$(this).css({top:[height,'px'].join('')});
			height += $(this).height();
		});
	};
	var rebuild = function(arr) {
		var el,els = [],thisParent = $(arr[0]).parent(),thisTop;
		for(var i=0,l=arr.length;i<l;++i) {
			els.push(arr[i]);
			$(arr[i]).remove();
		}
		this.body = $.create({
			type	: 'ul',
			id		: 'gridWrapper',
			cls		: 'gridWrapper'
		},$(thisParent)[0]);
    Grid.elCounter = els.length;

    var thisEl;
		for(var c=0,len=els.length;c<len;++c) {
			thisTop  = (c === 0 ? 0 : ($(['#draggable_',c-1].join('')).height()+parseInt($(['#draggable_',c-1].join('')).css('top'),10)));
			thisEl   = new GridElement({
				'top'			: thisTop,
				'id'			: ['draggable_',c].join(''),
				'data'		:	c,
				'rel'			:	c,
				'display'	: 'block',
				'parent'	: this.body,
				'content'	: els[c]
			});
      Grid.elements.push(thisEl);
		}
		Grid.frame = new EmptyFrame({
			'top'			: $(['#draggable_',c-1].join('')).height()+parseInt($(['#draggable_',c-1].join('')).css('top'),10),
			'id'			: 'empty_frame',
			'data'		:	-1,
			'rel'			:	-1,
			'display'	: 'none',
			'state'		:	'hidden',
			'parent'	: this.body,
			'content'	: ''
		});
		$('.draggable').draggable({'move':'both'});
	};
	var identity = function(obj) {
		return Grid.elements[$(obj).attr('rel')];
	};
  var getOrder = function() {
    var arr = [];
    $('.gridEl').each(function() {
      if($(this).attr('id') != 'empty_frame') {
        arr.push(Grid.identity(this).getData());
      }
    });
    return arr;
  };
  var debugOrder = function() {
    var order, orig,thinked,str = '';
    $('.gridEl').each(function() {
      if($(this).attr('id') != 'empty_frame') {
        order = $(this).attr('data');
        orig  = $(this).attr('rel');
        str += "order:  "+ ',' + order+ ',' + "  orig:  "+ ',' + orig+  '\n ';
      }
    });

    debText.setValue(str);
  };
  var reSort = function() {
    var sort=[],resorted=[],elements=[],el,top, debug = {};
    $('.gridEl').each(function() {
      if($(this).attr('id') != 'empty_frame' /*&& !$(this).attr('class').match(/dragged/)*/) {
        el  = Grid.identity(this);
        top = (el == Grid.dragged ? parseInt($(Grid.dragged.body).css('top'),10) : parseInt(el.getTop(),10));
        sort.push(top);
        resorted.push(top);
        elements.push(el);
      }
    });


    resorted.sort(function(a,b){return (a-b);});

    debText2.setValue(sort+' \n '+resorted);


    for(var i=0,l=resorted.length;i<l;++i) {
      elements[i].setData($.inArray(resorted[i],sort));
    }

    sort=null;resorted=null;elements=null;el=null;top=null;
  };
	var setLayout = function() {
    $('.sensor').css('z-index','12000');
    $(Grid.dragged.sensor).css('z-index','100');
    $(Grid.touched.sensor).css('z-index','100');
    Grid.touched.overlapped();
	};
	var setup = function() {
    $('.sensor').mouseover(function(event) {
      if(Grid.action == 'mousedown') {
        Grid.touched = Grid.identity(this);
        Grid.touched.touched();
        Grid.reSort();
        Grid.setLayout();
      }
    });
    $('.touched').live('mouseout',function() {
      Grid.identity(this).detouched();
    });
		Dragger.mousedown_hook = function(obj,event) {
			Grid.action		= 'mousedown';
			Grid.dragged	= Grid.identity(obj);
      Grid.leftPos  = Grid.dragged.getLeft();
      Grid.topPos   = Grid.dragged.getTop();
      $('.sensor').css('z-index','12000');
      $(Grid.dragged.sensor).css('z-index','100');
      Grid.dragged.dragStarted();
		};
		Dragger.mouseup_hook = function(obj,event) {
			Grid.action		= 'mouseup';
      $('.sensor').css('z-index','100');
      Grid.dragged.dragStopped();
		};
	};

	return {
    getOrder        : getOrder,
    debugOrder      : debugOrder,
    leftPos         : leftPos,
    duration        : duration,
    reSort          : reSort,
    elCounter       : elCounter,
		identity				:	identity,
		dragged					:	dragged,
		touched					:	touched,
		frame						:	frame,
		setLayout				:	setLayout,
		elements				: elements,
		_construct			: _construct,
		action					:	action,
		rerender				: rerender,
		init						: function() {return init(this);}
	};
})();

/*
  Component GridElement
*/
var GridElement = Component.extend(Grid._construct,{
  /*
    @method build
    @return no return
  */
  build: function() {
    var rgb = $.getRndRGB();
		this.body = $.create({
			type	: 'li',
			id		: this.id,
			style	: ['top:',this.top,'px;left:0px;background:',rgb,';display:',this.display].join(''),
			data	: this.data,
      rel   : this.data,
			cls		: 'draggable gridEl'
		},this.parent);
		$(this.body).append(this.content);

    var thisWidth   = this.getWidth()+20,
        thisHeight  = this.getHeight();
    this.sensor = $.create({
      type  : 'li',
      id    : ['sensor_',this.data].join(''),
      style : ['top:',this.top,'px;left:0px;width:',thisWidth,'px;background:',rgb,';height:',thisHeight,'px;'].join(''),
      data  : this.data,
      rel   : this.data,
      cls   : 'draggable sensor'
    },this.parent);
  },
  /*
    @method touched
    @return no return
  */
  touched: function() {
    //$(this.body).addClassName('touched');
    $(this.sensor).addClassName('touched');
  },
  /*
    @method detouched
    @return no return
  */
  detouched: function() {
    $(this.sensor).css('z-index','12000');
    $(this.sensor).removeClassName('touched');
  },
  /*
    @method getTop
    @return no return
  */
  getTop: function() {
    var top = parseInt($(this.body).css('top'),10);
    this.setTop(top);
    return this.top;
  },
  /*
    @method setTop
    @param top number
    @return no return
  */
  setTop: function(top) {
    if(top !== null && typeof top != 'undefined') {
      this.top = top;
    }
  },
  /*
    @method getLeft
    @return no return
  */
  getLeft: function() {
    var left = parseInt($(this.body).css('left'),10);
    this.setLeft(left);
    return this.left;
  },
  /*
    @method setLeft
    @param top number
    @return no return
  */
  setLeft: function(left) {
    if(left !== null && typeof left != 'undefined') {
      this.left = left;
    }
  },
  /*
    @method getHeight
    @return no return
  */
  getHeight: function() {
    return $(this.body).height();
  },
  /*
    @method setHeight
    @param height number
    @return no return
  */
  setHeight: function(height) {
		if(height	!== null && typeof height != 'undefined')
			this.height = height;
  },
  /*
    @method getData
    @return no return
  */
  getData: function() {
    return $(this.body).attr('data');
  },
  /*
    @method setData
    @param data number
    @return no return
  */
  setData: function(data) {
		if(data	!== null && typeof data != 'undefined') {
      this.data = data;
      $(this.body).attr('data',this.data);
      $(this.sensor).attr('data',this.data);
    }
  },
  /*
    @method getWidth
    @return no return
  */
  getWidth: function() {
    return parseInt($(this.body).css('width'),10);
  },
  /*
    @method setWidth
    @return no return
  */
  setWidth: function(width) {
    if(typeof width == 'number') {
      $(this.body).css('width',width);
    }
  },
  /*
    @method gravity
    @param y number
    @param x number
    @return no return
  */
  gravity: function(y,x,callback) {
		var self  = this,
        y     = (y == 'auto' ? 0 : y),
        x     = (x == 'auto' ? 0 : x);
    self.top = y;
		self.callback = callback || (typeof callback == 'function' ? function() {callback(self);} : function() {});
		emile(this.body,['top:',y,'px;left:',x,'px;'].join(''),{
			duration: Grid.duration,
			after: function() {
        $(self.sensor).css('top',self.getTop());
        $(self.sensor).css('left',self.getLeft());
				if(typeof callback == 'function')
          self.callback(self);
			}
		});
  },
  overlapped: function() {
    var dragged       = Grid.dragged,
        touched       = Grid.touched,
        touchedTop    = touched.getTop(),
        draggedTop    = dragged.getTop(),
        touchedData   = touched.getData(),
        draggedData   = dragged.getData(),
        draggedHeight = dragged.getHeight(),
        touchedHeight = touched.getHeight(),
        touchedWidth  = touched.getWidth(),
        touchedLeft   = Grid.leftPos;

    console.log("touchedTop:  " + touchedTop,"draggedTop:  " + draggedTop);

    //dragged.setData( touched.getData() );

    $('.sensor').css('z-index','12000');
    $(Grid.dragged.sensor).css('z-index','100');
    $(Grid.touched.sensor).css('z-index','100');

    Grid.debugOrder();

    //thisDebugger.setValue(touchedData + ',' + draggedData);

    if(touchedTop < draggedTop) { thisDebugger.setValue('felfele' + ' : dragged: ' + draggedTop + ' , touched: ' + touchedTop); //Grid.debugOrder();
      this.gravity(
        this.getTop()+draggedHeight,
        touchedLeft,
        function() {
          Grid.frame.on(
            touchedTop,
            touchedLeft,
            draggedHeight,
            touchedWidth,
            function(obj) {
              Grid.reSort();
            }
          );
        }
      );
    } else if(touchedTop > draggedTop) { thisDebugger.setValue('lefele' + ' : dragged: ' + draggedTop + ' , touched: ' + touchedTop); //Grid.debugOrder();
      this.gravity(
        Grid.frame.getTop(),
        touchedLeft,
        function() {
          Grid.frame.on(
            touchedTop+(touchedHeight-draggedHeight),
            touchedLeft,
            draggedHeight,
            touchedWidth,
            function(obj) {
              Grid.reSort();
            }
          );
        }
      );
    }
  },
  dragStarted: function() {
    var startTop    = this.getTop(),
        startLeft   = this.getLeft(),
        startHeight = this.getHeight(),
        startWidth = this.getWidth();
    Grid.frame.on(
      startTop,
      startLeft,
      startHeight,
      startWidth,
      function(obj) {
      }
    );
  },

  dragStopped: function() {
    this.gravity(
      Grid.frame.getTop(),
      Grid.leftPos,
      function() {
        Grid.reSort();
        Grid.frame.off();
      }
    );
  },

  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct: function(cfg) {
    this.cfg      = cfg[0] || {};
		this.top			= (this.cfg.top			?	this.cfg.top			:	0);
    this.id				= (this.cfg.id			?	this.cfg.id				:	'');
    this.data			= (this.cfg.data		?	this.cfg.data			: 0);
    this.rel			= (this.cfg.rel			?	this.cfg.rel			: 0);
    this.display	=	(this.cfg.display	?	this.cfg.display	: 'none');
    this.content	= (this.cfg.content ? this.cfg.content	: {});
    this.parent		= (this.cfg.parent  ? this.cfg.parent		: '');
    this.build();
    this.setHeight(parseInt($(this.body).height(),10));
  }
});

/*
  Component EmptyFrame
*/
var EmptyFrame = Component.extend(Grid._construct,{
  /*
    @method build
    @return no return
  */
  build: function() {
		this.body = $.create({
			type	: 'li',
			id		: this.id,
			style	: ['top:',this.top,'px;left:0px;display:',this.display].join(''),
			data	: this.data,
			cls		: 'draggable gridEl'
		},this.parent);
		$(this.body).append(this.content);
  },
  /*
    @method getTop
    @return no return
  */
  getTop: function() {
    var top = parseInt($(this.body).css('top'),10);
    this.setTop(top);
    return this.top;
  },
  /*
    @method setTop
    @param top number
    @return no return
  */
  setTop: function(top) {
    if(top !== null && typeof top != 'undefined') {
      this.top = top;
    }
  },
  /*
    @method getLeft
    @return no return
  */
  getLeft: function() {
    var left = parseInt($(this.body).css('left'),10);
    this.setLeft(left);
    return this.left;
  },
  /*
    @method setLeft
    @param top number
    @return no return
  */
  setLeft: function(left) {
    if(left !== null && typeof left != 'undefined') {
      this.left = left;
    }
  },
  /*
    @method getState
    @return no return
  */
  getState: function() {
		return this.state;
  },
  /*
    @method setState
		@param state string
    @return no return
  */
  setState: function(state) {
		if(state	!== null && typeof state != 'undefined') {
			this.state = state;
			switch(this.state) {
				case 'hidden':
          this.display = 'none';
					$(this.body).css('display','none');
				break;
				case 'visible':
          this.display = 'block';
					$(this.body).css('display','block');
				break;
			}
		}
  },
  /*
    @method getHeight
    @return no return
  */
  getHeight: function() {
    var height = parseInt($(this.body).height(),10);
    this.setHeight(height);
		return this.height;
  },
  /*
    @method setHeight
    @param height number
    @return no return
  */
  setHeight: function(height) {
		if(height	!== null && typeof height != 'undefined') {
			this.height = height;
			//$(this.body).height(this.height);
		}
  },
  /*
    @method getData
    @return no return
  */
  getData: function() {
		this.data =	$(this.body).attr('data');
    return this.data;
  },
  /*
    @method setData
    @param data number
    @return no return
  */
  setData: function(data) {
    if(data !== null && typeof data != 'undefined') {
      this.data = data;
      $(this.body).attr('data',this.data);
    }
  },
  /*
    @method on
    @param y number
    @param x number
    @param height number
    @param callback function
    @return no return
  */
  on: function(y,x,height,width,callback) {
    this.setState('visible');
    this.gravity(y,x,height,width,callback);
  },
  /*
    @method off
    @return no return
  */
  off: function() {
    this.setState('hidden');
  },
  /*
    @method getWidth
    @return no return
  */
  getWidth: function() {
    return parseInt($(this.body).css('width'),10);
  },
  /*
    @method setWidth
    @return no return
  */
  setWidth: function(width) {
    if(typeof width == 'number')
      $(this.body).css('width',width);
  },
  /*
    @method getRel
    @return no return
  */
  getRel: function() {
    return parseInt($(this.body).attr('rel'),10);
  },
  /*
    @method setRel
    @param data number
    @return no return
  */
  setRel: function(data) {
    if(typeof data == 'number')
      $(this.body).attr('rel',data);
  },
  /*
    @method gravity
    @param y number
    @param x number
    @param height number
    @param callback function
    @return no return
  */
  gravity: function(y,x,height,width,callback) {
		var self  = this,
        y       = (y == 'auto' ? 0 : y),
        x       = (x == 'auto' ? 0 : x),
        height  = (height == 'auto' ? 0 : height),
        width   = (width == 'auto' ? 0 : width);
    self.top = y;
		self.callback = callback || (typeof callback == 'function' ? function() {callback(self);} : function() {});
		emile(this.body,['top: ',y,'px;left: ',x,'px;height: ',height,'px;width: ',width,'px;display: block;'].join(''),{
			duration: Grid.duration,
			after: function() {
				if(typeof callback == 'function')
          self.callback(self);
			}
		});
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct: function(cfg) {
    this.cfg      = cfg[0] || {};
		this.top			= (this.cfg.top			?	this.cfg.top			:	0);
    this.id				= (this.cfg.id			?	this.cfg.id				:	'');
    this.data			= (this.cfg.data		?	this.cfg.data			: 0);
    this.rel			= (this.cfg.rel			?	this.cfg.rel			: 0);
    this.display	=	(this.cfg.display	?	this.cfg.display	: 'none');
    this.content	= (this.cfg.content ? this.cfg.content	: {});
    this.parent		= (this.cfg.parent  ? this.cfg.parent		: '');
    this.state		= (this.cfg.state		?	this.cfg.state		: '');
    this.build();
    this.setHeight(parseInt($(this.body).height(),10));
    this.setState(this.state);
  }
});
