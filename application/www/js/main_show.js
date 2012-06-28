
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

  maxViewPortWidth  : 1920,
  animationLock     : true,
  imageCounter      : 0,

  viewport: function() {

    var pWidth  = ($(window).width() > evoline.maxViewPortWidth ? (evoline.maxViewPortWidth - 16) : ($(window).width()-16)),
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
    $$.create({
      type  : 'div',
      id    : 'splicing',
      arr   : [{
        type  : 'div',
        id    : 'splicing_inner'
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
			style	: ['position:absolute;top:53px;left:',(evoline.dimensions['width'] > 1016 ? (evoline.dimensions['width'] - 1016)/2 : 0),'px'].join(''),
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
          html  : '<a href="/cikkek/21">TANÁCSADÁS</a>'
        },{
          type  : 'div',
          id    : 'logo_box2',
          cls   : 'page_logo_box',
          html  : '<a href="/cikkek/21">TECHNOLOGIA</a>'
        },{
          type  : 'div',
          id    : 'logo_box3',
          cls   : 'page_logo_box',
          html  : '<a href="/cikkek/21">NEARSHORING</a>'
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
        arr   : []
      },{
        type  : 'div',
        id    : 'content_wrapper',
        arr   : [{
          type  : 'div',
          id    : 'subpage_content_wrapper_container',
          cls   : 'page-container',
          arr   : [{
            type  : 'div',
            id    : 'subpage_content_wrapper'
          },{
            type  : 'div',
            id    : 'subpage_sider_wrapper'
          }]
        }]
      }]
    });

    evoline.fillContent();
    evoline.buildSideBar();
    evoline.setEventsUp();

    evoline.finishLayoutSetup();
  },

  finishLayoutSetup: function() {
    if($('#subpage_content_wrapper').height() > 400) {
      var thisHeight = $('#subpage_content_wrapper').height() - 310;
      
      $($$.cache.splicing).css({
        top         : evoline.dimensions['height']-100,
        left        : 0,
        width       : evoline.dimensions['width'],
        height      : thisHeight-100,
        paddingTop  : 100
        // background  : 'black'
      });

      $($$.cache.splicing_inner).css({
        width       : evoline.dimensions['width'],
        height      : thisHeight-100,
        background  : 'black'
      });

    }  //[].join('')
  },

  fillContent: function() {
    var thisContent = $.parseJSON($('#content').html());
    $$.create({
      type  : 'div',
      cls   : 'subpage_content_box_box',
      html  : ['<span class="headline">',unescape(thisContent[0]['title']).replace(/\+/g, ' '),'</span><p class="">',unescape(thisContent[0]['body']).replace(/\+/g, ' '),'</p>'].join('')
    },$$.cache.subpage_content_wrapper);
  },

  buildSideBar: function() {
    var cfg = evoline.cfg.sidebar;
    for(var i in cfg) {
      if(i != 'active')
        $$.create({
          type  : 'p',
          arr   : [{
            type  : 'a',
            cls   : 'sidebarLink' + (cfg['active'] == cfg[i] ? '_active' : ''),
            href  : cfg[i],
            html  : i
          }]
        },$$.cache.subpage_sider_wrapper);
    }
  },

  setEventsUp: function() {
    $('.sider_label').click(function() {
      if(evoline.animationLock) {
        var obj = this;
        $('.sider_label').each(function() {
          if(this.id == obj.id) {
            $(this).addClass('sider_label on');
          } else {
            $(this).removeClass();
            $(this).addClass('sider_label');
          }
        });

        switch(obj.id) {
          case 'sider_label1':
            if(evoline.animationLock) {
              evoline.animateContent('0px');
            }
          break;
          case 'sider_label2':
            if(evoline.animationLock) {
              evoline.animateContent('-978px');
            }
          break;
        }
      }
    });
  },

  animateContent: function(thisLeft) {
    evoline.animationLock = false;
    if($('#content_box_wrapper').css('left') != thisLeft) {
      $('#content_box_wrapper').animate({
        left: parseInt(thisLeft),
      }, 1100, function() {
        evoline.animationLock = true;
      });
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
