/*
  main js for evoline, written by robThot(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
$(document).ready(function() {
  window.$$ = builder;

  $('#searchThis').live('click',function() {
    $(this).val('');
  });

  $('#searchBtn').live('click',function() {
    window.location.href = ['/content/menu/search?key=',encodeURIComponent($('#searchThis').val())].join('');
  });

  $(document).live('keypress', function(e) {
    if(e.keyCode==13){
      window.location.href = ['/content/menu/search?key=',encodeURIComponent($('#searchThis').val())].join('');
    }
  });

  evoline.cfg = $.parseJSON($('#cfg').html()); //console.log(evoline.cfg);

  evoline.viewport();
  evoline.setBgSliderUp();
  evoline.slideCounter = 0;

  $('.langLink').live('click',function() {
    var link = window.location.href;
    if(link.match(/\?/)) {
      if(link.match("lang")) {
        window.location.href = window.location.href.replace(/lang=(hu|en|de)/, ["lang=",this.id].join(""));
      } else {
        window.location.href = [link,'&lang=',this.id].join('');
      }
    } else {
      window.location.href = [link,'?lang=',this.id].join('');
    }
    return false;
  });
});

$.extend({
  valami: function(){}
});

var evoline = {

  maxViewPortWidth  : 10000,
  animationLock     : true,
  imageCounter      : 0,

  viewport: function() {

    var pWidth  = ($(window).width() > evoline.maxViewPortWidth ? (evoline.maxViewPortWidth - 16) : ($(window).width()-16)),
        pHeight = $(window).height();


    evoline.dimensions = {
      'width'   : (pWidth < 1016 ? 1016 : pWidth),
      'height'  : (pHeight <= 870 ? 870 : pHeight)
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
//    $$.create({
//      type  : 'div',
//      id    : 'splicing',
//      arr   : [{
//        type  : 'div',
//        id    : 'splicing_inner'
//      }]
//    });
  },

  setBgSliderUp: function() {
    var imgs = evoline.cfg.happeningImages,
		thisImage;
    for(var i = 0, l = imgs.length; i < l; i++) {
      /*var thisImage = $$.create({
        type    : 'img',
        src     : imgs[i]['src'],
        onload  : 'evoline.setImageUp(this)'
      },$$.cache.happening);*/
	  thisImage = $(['<img src="',imgs[i]['src'],'" />'].join(''));
	  $(thisImage).on('load', function() {
		evoline.setImageUp(this);
	  });
	  $($$.cache.happening).append(thisImage);
    }
  },

  setBgText: function() {

    thisText = evoline.cfg.happeningImages[evoline.slideCounter]['text'].split('|');

    $('#main_label').animate({
      opacity: 0
    }, 150, function() {
      $('#main_label').html(
        [
          ['<span>',thisText[0],'</span><span>',thisText[1],'</span>'].join(''),
          ['<p style="float:right;"><span id="arrow">&nbsp;>&nbsp;</span><span id="possible">',evoline.cfg.sys.slogan,'</span><p><p style="clear:both;"></p>'].join('')
        ].join('')
      );
      $('#main_label').animate({
        opacity: 1
      }, 1000, function() {});
    });

    if(evoline.slideCounter == evoline.cfg.happeningImages.length - 1) {
      evoline.slideCounter = 0;
    } else {
      evoline.slideCounter++;
    }
  },

  setHappening: function() {
    sliderCfg.slider.beforeChange = evoline.setBgText;
    sliderCfg.slider.animSpeed    = parseInt(sliderCfg.slider.animSpeed);
    evoGallery.init('#happening',sliderCfg.slider);

    $("#overlay").css({
      'background'  : ['url(/img/overlay/',sliderCfg.layout.layout,'.png) repeat'].join(''),
      'opacity'     : sliderCfg.layout.opacity
    });

    evoline.buildPage();
    //evoline.setBgText();
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
    evoline.imageCounter += 1; //alert(evoline.cfg.happeningImages.length);

    if(evoline.imageCounter == evoline.cfg.happeningImages.length) {
      evoline.setHappening();
    }
  },

  buildPage: function() {
    evoline.menubuilder();
    $$.create({
      type  : 'div',
      id    : 'page-wrapper',
      cls   : 'wrapper',
			style	: ['position:absolute;top:44px;left:',(evoline.dimensions['width'] > 1016 ? (evoline.dimensions['width'] - 1016)/2 : 0),'px'].join(''),
      arr   : [{
        type  : 'div',
        id    : 'page-container',
        cls   : 'page-container',
        arr   : [{
          type  : 'div',
          id    : 'loginbox',
          html  : '<a href="/email" style="">Email</a>  <a href="/cv" style="">Cv feltöltés</a>'
        }]
      },{
        type  : 'div',
        id    : 'logo_holder',
        cls   : 'page-container',
        arr   : [{
          type    : 'div',
          id      : 'page_logo',
          cls     : 'page_logo_box',
          cmd     : ['click',function() {window.location.href = '/home';}]
        }/*,{
          type  : 'div',
          id    : 'logo_title_anime',
          cls   : 'page_logo_box',
          html  : ''
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
        }*/]
      },{
        type  : 'div',
        id    : 'main_label_holder',
        cls   : 'page-container',
        arr   : [{
          type  : 'div',
          id    : 'main_label',
          html  : ''
        }]
      },{
        type  : 'div',
        id    : 'content_wrapper_top_margin',
        cls   : 'page-container'
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
            style : 'background:url(/img/kiemelton.png) no-repeat',
            cls   : 'sider_label on'
          },{
            type  : 'div',
            id    : 'sider_label2',
            style : 'background:url(/img/ref.png) no-repeat',
            cls   : 'sider_label'
          }]
        }]
      }]
    });

    var menuItem, pageTitle = evoline.cfg.pageMenu['pageTitle'];
    for(var i in evoline.cfg.pageMenu) {
      if(i != 'pageTitle') {
        menuItem = evoline.cfg.pageMenu[i];
        $$.create({
          type  : 'div',
          id    : 'logo_box1',
          cls   : 'page_logo_box',
          html  : ['<a href="',menuItem,'">',i,'</a>'].join('')
        },$$.cache.logo_holder);
      }
    };

//    var neededWith = (pageTitle.length)*7 + 20;
//    $('#logo_title_anime').animate({
//      width: neededWith,
//    }, 750, function() {
//      $("#logo_title_anime").html(['<a style="color:black;">',pageTitle,'</a>'].join(''));
//    });


    evoline.fillContent();
    evoline.setEventsUp();
//    evoline.finishLayoutSetup();
    evoline.createFooter();
    //evoline.manageBreadCrumb();
    evoline.finishSetup();
  },

  manageBreadCrumb: function() {
    if(evoline.cfg['breadcrumb'] && evoline.cfg['breadcrumb'].length > 0) {
      var breadCrumb = evoline.cfg['breadcrumb'],
          crumb;

      $$.create({
        type  : 'div',
        cls   : 'breadeCrumb',
        id    : 'breadeCrumb_id'
      },$$.cache.content_wrapper_top_margin);

      $$.create({
          type  : 'span',
          cls   : 'Bc_span',
          html  : 'ön itt áll: ',
        },$$.cache.breadeCrumb_id);

      for(var i = 0, l = breadCrumb.length; i < l; i++) {
        crumb = breadCrumb[i];

        $$.create({
          type  : 'span',
          cls   : 'Bc_span',
          html  : ['&nbsp;&nbsp;>&nbsp;&nbsp;<a href="/',crumb.link,'">',crumb.title,'</a>'].join('')
        },$$.cache.breadeCrumb_id);

//        if(i == 0) {
//          $$.create({
//            type  : 'div',
//            cls   : 'breadeCrumb',
//  //          style : ['width:',(crumb.title.length < 10 ? crumb.title.length * 10 : crumb.title.length * 8),'px;'].join(''),
//            html  : ['<span>ön itt áll: &nbsp;&nbsp;</span><a href="/',crumb.link,'">',crumb.title,'</a>'].join('')
//          },$$.cache.content_wrapper_top_margin);
//        } else {
//          $$.create({
//            type  : 'div',
//            cls   : 'breadeCrumb',
//  //          style : ['width:',(crumb.title.length < 10 ? crumb.title.length * 10 : crumb.title.length * 8),'px;'].join(''),
//            html  : ['<a href="/',crumb.link,'">',crumb.title,'</a>'].join('')
//          },$$.cache.content_wrapper_top_margin);
//        }
      }
    }
  },

  createFooter: function() {
    $$.create({
      type  : 'div',
      cls   : 'navbar navbar-fixed-top',
      id    : 'footer_menu_wrapper',
	  style : 'background: #eeeeee;',
      arr   : [{
        type  : 'div',
        cls   : 'navbar-inner-menu',
		style : 'background: #eeeeee;min-height:40px;',
        arr   : [{
          type  : 'div',
          cls   : 'wrapper',
		  style : 'background: #eeeeee;',
          arr   : [{
            type  : 'div',
            id    : 'main_menu_wrapper_footer',
            cls   : 'nav-collapse',
			style : 'background: #eeeeee;',
            arr   : [{
              type  : 'ul',
              id    : 'main_menu_footer',
              cls   : 'nav'
            }]
          }]
        }]
      }]
    });

    $$.create({
      type  : 'li',
      id    : 'microsoft'
    },$$.cache.main_menu_footer);
    $$.create({
      type  : 'li',
      id    : 'oracle_gold'
    },$$.cache.main_menu_footer);
    $$.create({
      type  : 'li',
      id    : 'oracle_certified_expert'
    },$$.cache.main_menu_footer);
    $$.create({
      type  : 'li',
      id    : 'sap'
    },$$.cache.main_menu_footer);
    $$.create({
      type  : 'li',
      id    : 'iso'
    },$$.cache.main_menu_footer);
//    $$.create({
//      type  : 'li',
//      id    : 'salt'
//    },$$.cache.main_menu_footer);

    $$.create({
      type  : 'ul',
      cls   : 'nav pull-right',
      arr   : [{
        type  : 'li',
        arr   : [{
          type  : 'a',
          id    : 'menuitem_copy',
          cls   : 'menuitem_footer',
          html  : 'evoline Kft. &copy; Minden jog fenntartva.'
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'a',
          cls   : 'menuborder',
          html  : '|'
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'a',
          id    : 'menuitem_imprint',
          cls   : 'menuitem_footer',
          href  : '/content/menu/imprint',
          html  : 'Impresszum'
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'a',
          cls   : 'menuborder',
          html  : '|'
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'a',
          id    : 'menuitem_contact',
          cls   : 'menuitem_footer',
          href  : '/content/menu/contact',
          html  : 'Kapcsolat'
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'a',
          cls   : 'menuborder',
          html  : '|'
        }]
      },{
        type  : 'li',
        id    : 'salt'
      }]
    },$$.cache.main_menu_wrapper_footer);

    $($$.cache.footer_menu_wrapper).css({
      top        :  evoline.dimensions['height']-40
    });

    $($$.cache.overlay).css({
      height        :  evoline.dimensions['height']-40
    });

    $($$.cache.happening).css({
      height        :  evoline.dimensions['height'] - 40
    });

    $($$.cache.viewport).css({
      height        :  evoline.dimensions['height'] - 40
    });
  },

  finishSetup: function() {
    $('#header_menu_wrapper').width(evoline.dimensions['width']);
    $('#footer_menu_wrapper').width(evoline.dimensions['width']);
    $('#main_menu_wrapper_footer').width(978);
    $('#main_menu_wrapper').width(978);

    $(['#',evoline.cfg.language].join('')).attr('class',['langLink_active'].join(''));

    $('#wrapper_boxes1').width(60 + (evoline.cfg.pageInfo['pageTitle'].length*8));
  },

  finishLayoutSetup: function() {

    var topDistance   = 600,
        innerPadding  = 250;

    $($$.cache.splicing).css({
      top         : topDistance,  //evoline.dimensions['height']-450,
      left        : 0,
      width       : evoline.dimensions['width'],
      height      : evoline.dimensions['height']-(topDistance+innerPadding),
      paddingTop  : innerPadding
    });

    $($$.cache.splicing_inner).css({
      width       : evoline.dimensions['width'],
      height      : evoline.dimensions['height']-(topDistance+innerPadding),
      background  : 'black'
    });
  },











  fillContent: function() {

    var ct          = $.parseJSON($('#content').html()),
        thisContent = {},
        result      = {},
        stuff,
        thisType;

		thisContent     = ct['news'];
		result.images   = [];
		result.articles = [];

		for(var i = 0, l = thisContent.length; i < l; i++) {

		  stuff     = thisContent[i];
		  thisType  = stuff.type.replace(/\+/g, '');

		  switch(thisType) {
		    case 'images':
		      result.images.push(stuff);
		    break;
		    default:
		      result.articles.push(stuff);
		    break
		  }
		}  console.log(result.articles);

		$$.create({
			type  : 'div',
      cls   : ['content_box_box'].join(''),
			arr		: [{
				type	: 'div',
				cls		: 'content_box_kiemelt',
				html	: (typeof result.articles[0] != 'undefined' ? ['<a href="',decodeThis(result.articles[0]['link']),'" class="headline">',decodeThis(result.articles[0]['title']),'</a>','<p class="lead">',decodeThis(result.articles[0]['lead']),'</p>'].join('') : '')
			},{
				type	: 'div',
				cls		: 'content_box_kiemelt',
				html	: (typeof result.articles[1] != 'undefined' ? ['<a href="',decodeThis(result.articles[1]['link']),'" class="headline">',decodeThis(result.articles[1]['title']),'</a>','<p class="lead">',decodeThis(result.articles[1]['lead']),'</p>'].join('') : '')
			}]
		},$$.cache.content_box_wrapper);

		$$.create({
			type  : 'div',
      cls   : ['content_box_box_image'].join(''),
			arr		: [{
				type	: 'div',
				cls		: 'content_box_kiemelt_image',
				html	: (typeof result.images[0] != 'undefined' ? ['<img src="/upload/266/',decodeURIComponent(result.images[0]['name']).replace(/\+/g, ''),'" class="index_image" /><p class="imageText">',decodeThis(result.images[0]['title']),'<p class="lead">',decodeThis(result.images[0]['lead']),'</p>'].join('') : '')
			},{
				type	: 'div',
				cls		: 'content_box_kiemelt',
				html	: (typeof result.articles[2] != 'undefined' ? ['<a href="',decodeThis(result.articles[2]['link']),'" class="headline">',decodeThis(result.articles[2]['title']),'</a>','<p class="lead">',decodeThis(result.articles[2]['lead']).replace(/\+/g, ' '),'</p>'].join('') : '')
			}]
		},$$.cache.content_box_wrapper);

		$$.create({
			type  : 'div',
      cls   : ['content_box_box_last_image'].join(''),
			arr		: [{
				type	: 'div',
				cls		: 'content_box_kiemelt_image',
				html	: (typeof result.images[1] != 'undefined' ? ['<img src="/upload/266/',decodeURIComponent(result.images[1]['name']).replace(/\+/g, ''),'" class="index_image" /><p class="imageText">',decodeThis(result.images[1]['title']),'<p class="lead">',decodeThis(result.images[1]['lead']),'</p>'].join('') : '')
			},{
				type	: 'div',
				cls		: 'content_box_kiemelt',
				html	: (typeof result.articles[3] != 'undefined' ? ['<a href="',decodeURIComponent(result.articles[3]['link']).replace(/\+/g, ''),'" class="headline">',decodeThis(result.articles[3]['title']),'</a>','<p class="lead">',decodeThis(result.articles[3]['lead']),'</p>'].join('') : '')
			}]
		},$$.cache.content_box_wrapper);


    thisContent = ct['kiemelt'];

    for(var i = 0,l = 6; i < l; i += 2) {
      $$.create({
				type  : 'div',
        cls   : ['content_box_box',(i == 4 ? '_last' : '')].join(''),
				arr		: [{
					type	: 'div',
					cls		: 'content_box_kiemelt',
					html	: (typeof thisContent[i] != 'undefined' ? ['<a href="',decodeURIComponent(thisContent[i]['link']).replace(/\+/g, ''),'" class="headline">',decodeThis(thisContent[i]['title']),'</a>','<p class="lead">',decodeThis(thisContent[i]['lead']),'</p>'].join('') : '')
				},{
					type	: 'div',
					cls		: 'content_box_kiemelt',
					html	: (typeof thisContent[i+1] != 'undefined' ? ['<a href="',decodeURIComponent(thisContent[i+1]['link']).replace(/\+/g, ''),'" class="headline">',decodeThis(thisContent[i+1]['title']),'</a>','<p class="lead">',decodeThis(thisContent[i+1]['lead']),'</p>'].join('') : '')
				}]
			},$$.cache.content_box_wrapper);
    }
  },









  setEventsUp: function() {

    var counter = 0;
    $('.content_box_box > .content_box').each(function(item) {
      counter = item;
    });

    $('.sider_label').css('display','block');
    $('.sider_label').click(function() {
      if(evoline.animationLock) {
        var obj = this;
        $('.sider_label').each(function() {
          if(this.id == obj.id) {
            if(!$(this).attr('style').match(/on\.png/)) {
              $(this).attr('style',$(this).attr('style').replace('.png','on.png'));
            }
            $(this).addClass('sider_label on');
          } else {
            $(this).removeClass();
            if($(this).attr('style').match(/on\.png/)) {
              $(this).attr('style',$(this).attr('style').replace('on.png','.png'));
            }
            $(this).addClass('sider_label');
          }
        });

        switch(obj.id) {
          case 'sider_label1':
            if(evoline.animationLock) {
              if($('#content_box_wrapper').css('left') == '-978px')
                evoline.animateContent('0px');
            }
          break;
          case 'sider_label2':
            if(evoline.animationLock) {
              if($('#content_box_wrapper').css('left') == '0px')
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
        left: parseInt(thisLeft)
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
      id    : 'header_menu_wrapper',
      arr   : [{
        type  : 'div',
        cls   : 'navbar-inner',
        arr   : [{
          type  : 'div',
          cls   : 'wrapper',
          arr   : [{
            type  : 'div',
            id    : 'main_menu_wrapper',
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

    var iter = 0;
    for(var i in menuObj) {

      if(iter == 0) {
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
      } else {
        if(i != 'active') {

          $$.create({
            type  : 'li',
            style : 'width:2px;height:40px;background:url(/img/menu_m_bg.png);'
          },$$.cache.main_menu);

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


      iter++;
    }

    $$.create({
      type  : 'ul',
      id    : 'langmenu',
      cls   : "nav pull-right",
      arr   : [{
        type  : 'li',
        arr   : [{
          type  : 'a',
          id    : 'hu',
          cls   : 'langLink',
          html  : 'hu'
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'p',
          cls   : 'pipe',
          html  : ' | '
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'a',
          id    : 'en',
          cls   : 'langLink',
          html  : 'en'
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'p',
          cls   : 'pipe',
          html  : ' | '
        }]
      },{
        type  : 'li',
        arr   : [{
          type  : 'a',
          id    : 'de',
          cls   : 'langLink',
          html  : 'de'
        }]
      }]
    },$$.cache.main_menu_wrapper);

    $$.create({
      type  : 'ul',
      cls   : "nav pull-right",
      arr   : [{
        type  : 'li',
        arr   : [{
          type  : 'div',
          id    : 'search',
          style : 'width:175px; height:15px;margin-top:11px;background:url(/img/search_bg.png);',
          html  : [
            '<input id="searchThis" type="text" value="Keresés.." style="width:160px; height:15px;float:left;" />',
            '<input id="searchBtn" type="button" value="" style="width:15px; height:15px;float:left;" />'
          ].join('')
        }]
      }]
    },$$.cache.main_menu_wrapper);
  }
}
