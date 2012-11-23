/*
  Class Grid
*/
var Grid = (function() {
	var init = function(arr) {
		if(arr.length > 1) {
			rebuild(arr);
			}
	};
	var _construct = function(cfg) {
		this.cfg = cfg || {};
	};
	var grid			= {},
			dragLock	= 0,
			action		= '',
			placer		= {
				empty: 0,
				target: 0,
				current : {}
	};
	var rerender = function() {
		var height = 0, grid = {}, iter = 0;
		$('.gridEl').each(function() {
			$(this).css({top:[height,'px'].join('')});
			height += $(this).height();
		});
	};
	var rebuild = function(arr) {
		var el,els = [],thisParent = $(arr[0]).parent();
		for(var i=0,l=arr.length;i<l;++i) {
			els.push(arr[i]);
			$(arr[i]).remove();
		}
		this.body = $.create({
			type	: 'ul',
			id		: 'gridWrapper_0',
			cls		: 'gridWrapper'
		},$(thisParent)[0]);

		var thisTop;
		var elements = {};
		for(var c=0,len=els.length;c<len;++c) {
			thisTop = (c === 0 ? 0 : ($(['#draggable_',c-1].join('')).height()+parseInt($(['#draggable_',c-1].join('')).css('top'),10)));

			elements[c] = new GridElement({
				'top'			: thisTop,
				'id'			: ['#draggable_',c].join(''),
				'data'		:	c,
				'display'	: 'block',
				'parent'	: this.body,
				'content'	: els[c]
			});
		}

		elements[len] = new GridElement({
			'top'			: $(['#draggable_',c-1].join('')).height()+parseInt($(['#draggable_',c-1].join('')).css('top'),10),
			'id'			: 'empty_frame',
			'data'		:	-1,
			'display'	: 'none',
			'parent'	: this.body,
			'content'	: ''
		});

		el = $.create({
			type	: 'li',
			id		: 'empty_frame'
		},this.body);
		setup();
		$('.draggable').draggable({'move':'vertical'});
	};
	var frameOn = function() {
		if($('.dragged').length === 0) {
			frameOff();
		} else {
			$('#empty_frame').css({
				height	: parseInt($(Grid.placer.orig).height(),10),
				width		: parseInt($(Grid.placer.orig).width(),10),
				top			:	Grid.placer.target,
				display	: 'block'
			});
		}
	};
	var frameOff = function() {
		$('#empty_frame').css({
			display: 'none'
		});
	};
	var setNewPosition = function() {

		var draggedHeight	= parseInt($(Grid.placer.orig).height(),10),
				touchedHeight	= parseInt($(Grid.placer.touched).height(),10),
				newPos				= 0;

		if(draggedHeight < touchedHeight) { console.log('kisebb');
			newPos	= Grid.placer.target + touchedHeight;
		} else { console.log('nagyobb');
			newPos	=	Grid.placer.target /*- (draggedHeight-touchedHeight)*/;
		}

		console.log( draggedHeight, touchedHeight );

		Grid.placer.target	= newPos /*Grid.placer.empty*/;
		Grid.dragLock				= 1/*(Grid.action == 'mousedown' ? 1 : 0)*/;
		Grid.frameOn();
	};
	var gravity = function() {
		if(Grid.dragLock == 1) {
			var draggedPos	= parseInt($(Grid.placer.orig).css('top'),10),
					touchedPos	= parseInt($(Grid.placer.touched).css('top'),10);

			Grid.placer.direction = '';
			if(draggedPos < touchedPos) {
				Grid.placer.direction = 'down';
			} else if(draggedPos > touchedPos) {
				Grid.placer.direction = 'up';
			}
			switch(Grid.placer.direction) {
				case 'up':
					Grid.placer.empty		=	parseInt($(Grid.placer.touched).css('top'),10);
					Grid.placer.target	=	Grid.placer.empty + parseInt($(Grid.placer.orig).height(),10);
				break;
				case 'down':
					Grid.placer.empty		=	parseInt($(Grid.placer.touched).css('top'),10);
					Grid.placer.target	=	Grid.placer.empty - parseInt($(Grid.placer.orig).height(),10);
				break;
			}
			console.log( Grid.placer.direction,draggedPos,touchedPos,Grid.placer.empty , Grid.placer.target);
			Grid.dragLock						= 0;
	 		emile(Grid.placer.touched,['top:',Grid.placer.target,'px;left:0px;'].join(''),{
	 			duration: 50,
	 			after: function() {
	 				Grid.setNewPosition();
	 			}
	 		});
		}
	};
	var setup = function() {
		Dragger.mouseover_hook = function(obj) {
			if(Grid.dragLock === 1 && !$(obj).attr('class').match(/dragged/)) {
				Grid.placer.touched = obj;
				Grid.gravity();
			}
		};
		Dragger.mousedown_hook = function(obj) {
			Grid.action					= 'mousedown';
			Grid.placer.orig		= obj;
			Grid.placer.empty		= parseInt($(obj).css('top'),10);
			Grid.placer.target	= Grid.placer.empty;
			Grid.dragLock				= 1;
			Grid.frameOn();
		};
		Dragger.mouseup_hook = function(obj) {
			Grid.action		= 'mouseup';
			Grid.dragLock = 0;
			emile(Grid.placer.orig,['top:',Grid.placer.target,'px;left:0px;'].join(''),{
				duration: 50,
				after: function(obj) {
					Grid.placer.target	= Grid.placer.empty;
					Grid.dragLock				= (Grid.action == 'mousedown' ? 1 : 0);
					Grid.frameOn();
				}
			});
		};
	};
	return {
		_construct			: _construct,
		setNewPosition	: setNewPosition,
		action					:	action,
		placer					: placer,
		rerender				: rerender,
		frameOff				: frameOff,
		frameOn					: frameOn,
		grid						: grid,
		gravity					: gravity,
		init						: function() {return init(this);}
	};
})();


// el = $.create({
// 				type	: 'li',
// 				id		: ['draggable_',c].join(''),
// 				style	: ['top:',thisTop,'px;left:0px;background:',$.getRndRGB()].join(''),
// 				data	: c,
// 				cls		: 'draggable gridEl'
// 			},this.parent);
// 			$(el).append(els[c]);


/*
  Component Fieldset
*/
var GridElement = Component.extend(Grid._construct,{
  /*
    @method build
    @return no return
  */
  build: function() {
  	this.body = $.create({
			type	: 'li',
			id		: this.id,
			style	: ['top:',this.top,'px;left:0px;background:',$.getRndRGB()].join(''),
			data	: this.data,
			cls		: 'draggable gridEl',
			style	:	['display:',this.display,';top:',this.top,'px;
			'].join('')
		},this.parent);
		$(this.body).append(this.content);
  },
  /*
    @method getData
    @return no return
  */
  getData: function() {
  	return this.data;
  },
  /*
    @method setData
    @param data number
    @return no return
  */
  setData: function(data) {
  	if(data != null && typeof data != 'undefined')
  		this.data = data;
  },
  /*
    @method _construct
    @param cfg object
    @return no return
  */
  _construct: function(cfg) {
    this.cfg      = cfg[0] || {};
    this.top   		= (this.cfg.top     ? this.cfg.top 			: 0);
    this.id      	= (this.cfg.id      ? this.cfg.id 			: '');
    this.data			= (this.cfg.data    ? this.cfg.data 		: 0);
    this.display	= (this.cfg.display ? this.cfg.display 	: 'none');
    this.content	= (this.cfg.content ? this.cfg.content 	: {});
    this.parent		= (this.cfg.parent  ? this.cfg.parent 	: '');
    this.build();
  }
});