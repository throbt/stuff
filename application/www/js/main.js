/*
  main js for evoline, written by robThot(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
$(document).ready(function() {
  window.$$ = builder;

  evoline.cfg = jQuery.parseJSON($('#cfg').val());

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

    $("#overlay").css('background',['url(/img/overlay/',sliderCfg.layout,'.png) repeat'].join(''));

    evoline.buildPage();
  },

  setImageUp: function(obj) {
    var thisRate  = $(obj).width()/$(obj).height(),
        wRate     = evoline.dimensions['width']/evoline.dimensions['height'];
    if(thisRate < wRate)
      $(obj).attr('width',evoline.dimensions['width']);
    else
      $(obj).attr('height',evoline.dimensions['height']);
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
          html  : 'hello, im the loginbox'
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
          cls   : 'page_logo_box'
        },{
          type  : 'div',
          id    : 'logo_box2',
          cls   : 'page_logo_box'
        },{
          type  : 'div',
          id    : 'logo_box3',
          cls   : 'page_logo_box'
        }]
      },{
        type  : 'div',
        id    : 'main_label_holder',
        cls   : 'page-container',
        arr   : [{
          type  : 'div',
          id    : 'main_label'
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
          id    : 'content_box1',
          cls   : 'content_box'
        },{
          type  : 'div',
          id    : 'content_box2',
          cls   : 'content_box'
        },{
          type  : 'div',
          id    : 'content_box3',
          cls   : 'content_box'
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
    $('#content_box1').html($('#content_box1_content').html());
    $('#content_box2').html($('#content_box2_content').html());
    $('#content_box3').html($('#content_box3_content').html());
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
          cls   : (menuObj['active'] == i ? 'active' : ''),
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
