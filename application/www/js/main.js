/*
  main js for evoline, written by robThot(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
$(document).ready(function() {
  window.$$ = builder;

  evoline.cfg = $.parseJSON($('#cfg').val());

  evoline.viewport();
  evoline.setBgSliderUp();
});

var evoline = {

  animationLock: true,
  imageCounter: 0,

  viewport: function() {

    var pWidth  = $(window).width()-16,
        pHeight = $(window).height();

    evoline.dimensions = {
      'width'   : (pWidth < 1016 ? 1016 : pWidth),
      'height'  : (pHeight <= 920 ? 920 : pHeight)
    }

    //$(['<style type="text/css"> .nivoSlider{ background-size:',evoline.dimensions['width'],'px ',evoline.dimensions['height'],'px; }</style>'].join('')).appendTo("head");

    $$.create({
      type  : 'div',
      id    : 'viewport',
      cls   : 'viewport',
      style : ['width:',evoline.dimensions['width'],'px;height:',evoline.dimensions['height'],'px;'].join(''),
      arr   : [{
        type  : 'div',
        id    : 'happening',
        style : ['width:',evoline.dimensions['width'],'px;height:',evoline.dimensions['height'],'px;'].join('')
      },{
        type  : 'div',
        id    : 'overlay',
        style : ['width:',evoline.dimensions['width'],'px;height:',evoline.dimensions['height'],'px;'].join('')
      }]
    });
  },

  setBgSliderUp: function() {
    var imgs = evoline.cfg.happeningImages;
    for(var i = 0, l = imgs.length; i < l; i++) {
      $$.create({
        type    : 'img',
        src     : imgs[i],
        onload  : 'evoline.setImageUp(this)'
      },$$.cache.happening);
    }
  },

  setHappening: function() {

    /*
      var anims = new Array('sliceDownRight','sliceDownLeft','sliceUpRight','sliceUpLeft','sliceUpDown','sliceUpDownLeft','fold','fade',
      'boxRandom','boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse');
    */
    //console.log(sliderCfg);
    $('#happening').nivoSlider( sliderCfg.slider /*{
      effect:'fold',
      boxCols: 3,
      boxRows: 2,
      slices: 5,
      directionNav: false,
      controlNav: false,
      animSpeed: 1500,
      pauseTime: 2500,
      keyboardNav: true
    }*/);

    $("#overlay").css({
      'background'  : ['url(/img/overlay/',sliderCfg.layout.layout,'.png) repeat'].join(''),
      'opacity'     : sliderCfg.layout.opacity
    });

    evoline.buildPage();
  },

  setImageUp: function(obj) {
    var thisRate  = $(obj).width()/$(obj).height(),
        wRate     = evoline.dimensions['width']/evoline.dimensions['height'];
    if(thisRate < wRate)
      //$(obj).attr('width',evoline.dimensions['width']);
      $(obj).attr('style','width: ' + evoline.dimensions['width'] + 'px');
    else
      //$(obj).attr('height',evoline.dimensions['height']);
      $(obj).attr('style','height: ' + evoline.dimensions['height'] + 'px');
    evoline.imageCounter += 1;
    if(evoline.imageCounter == 6) {
      evoline.setHappening();
    }
  },

  buildPage: function() {
    evoline.menubuilder();
    $$.create({
      type  : 'div',
      id    : 'page-wrapper',
      cls   : 'wrapper',
      arr   : [{
        type  : 'div',
        id    : 'page-container',
        cls   : 'page-container',
        arr   : [{
          type  : 'div',
          id    : 'loginbox',
          html  : '<span>Karrier</span><span>Kapcsolat</span><a href="#">Login or register</a>'
        }]
      },{
        type  : 'div',
        id    : 'logo_holder',
        cls   : 'page-container',
        arr   : [{
          type  : 'div',
          id    : 'page_logo',
          cls   : 'page_logo_box'
        },{
          type  : 'div',
          id    : 'logo_box1',
          cls   : 'page_logo_box',
          html  : '<span>TANÁCSADÁS</span>'
        },{
          type  : 'div',
          id    : 'logo_box2',
          cls   : 'page_logo_box',
          html  : '<span>TECHNOLOGIA</span>'
        },{
          type  : 'div',
          id    : 'logo_box3',
          cls   : 'page_logo_box',
          html  : '<span>NEARSHORING</span>'
        }]
      },{
        type  : 'div',
        id    : 'main_label_holder',
        cls   : 'page-container',
        arr   : [{
          type  : 'div',
          id    : 'main_label',
          html  : '<p>Siemens Support támogatás: napi 100.000 user kiszolgálása</p><span>Informatikai megoldások - üzleti problémákra</span>'
        }]
      },{
        type  : 'div',
        id    : 'content_wrapper_top_margin',
        cls   : 'page-container',
        arr   : [{
          type  : 'div',
          id    : 'wrapper_boxes1'
        },{
          type  : 'div',
          id    : 'wrapper_boxes2'
        }]
      },{
        type  : 'div',
        id    : 'content_wrapper',
        arr   : [{
          type  : 'div',
          id    : 'content_box_wrapper_container',
					arr		: [{
						type  : 'div',
	          id    : 'content_box_wrapper'
					}]
        },{
          type  : 'div',
          id    : 'right_margin',
          arr   : [{
            type  : 'div',
            id    : 'sider_label1',
            cls   : 'sider_label'
          },{
            type  : 'div',
            id    : 'sider_label2',
            cls   : 'sider_label'
          }]
        }]
      }]
    });

    evoline.fillContent();
  },

  fillContent: function() {
    
		var thisContent = $.parseJSON($('#content').html()); 

		for(var i = 0,l = thisContent.length; i < l; i += 2) {
			$$.create({
				type  : 'div',
        cls   : 'content_box_box',
				arr		: [{
					type	: 'div',
					cls		: 'content_box',
					html	: ['<span class="headline">',unescape(thisContent[i]['title']).replace(/\+/g, ' '),'</span><p class="">',unescape(thisContent[i]['body']).replace(/\+/g, ' '),'</p>'].join('')
				},{
					type	: 'div',
					cls		: 'content_box',
					html	: (typeof thisContent[i+1] != 'undefined' ? ['<span class="headline">',unescape(thisContent[i+1]['title']).replace(/\+/g, ' '),'</span><p class="">',unescape(thisContent[i+1]['body']).replace(/\+/g, ' '),'</p>'].join('') : '')
				}]
			},$$.cache.content_box_wrapper);
		}
  },

  menubuilder: function() {
    var menuObj = evoline.cfg['menubar'],
        hash    = {};

    $$.create({
      type  : 'div',
      cls   : 'navbar navbar-fixed-top',
      arr   : [{
        type  : 'div',
        cls   : 'navbar-inner',
        arr   : [{
          type  : 'div',
          cls   : 'wrapper',
          arr   : [{
            type  : 'div',
            cls   : 'nav-collapse',
            arr   : [{
              type  : 'ul',
              id    : 'main_menu',
              cls   : 'nav'
            }]
          }]
        }]
      }]
    });

    for(var i in menuObj) {
      if(i != 'active') {
        $$.create({
          type  : 'li',
          cls   : (menuObj['active'] == menuObj[i] ? 'active' : ''),
          arr   : [{
            type  : 'a',
            href  : ['/',menuObj[i]].join(''),
            cls   : 'menuitem',
            html  : i
          }]
        },$$.cache.main_menu);
      }
    }
  }
}

var animator = {
  
}
