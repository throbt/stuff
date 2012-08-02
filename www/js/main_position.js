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

  $('#location').live('change',function() {
    if($(this).val() == '') {
      window.filter_location = 0;
    }
  });

  $('#type').live('change',function() {
    if($(this).val() == '') {
      window.filter_type = 0;
    }
  });

  $(document).live('keypress', function(e) {
    if(e.keyCode==13){
      window.location.href = ['/content/menu/search?key=',encodeURIComponent($('#searchThis').val())].join('');
    }
  });

  $(document).click(function() {
    $('#location_dropdown').css('display','none');
    $('#filter_location').attr('rel','off');
    $('#type_dropdown').css('display','none');
    $('#filter_type').attr('rel','off');
  });

  $('#filter_location').live('click',function(e) {
    if($(this).attr('rel') == 'off') {
      $(this).attr('rel','on');
      $('#location_dropdown').css('display','block');

      $('#type_dropdown').css('display','none');
      $('#filter_type').attr('rel','off');
    } else if($(this).attr('rel') == 'on') {
      $(this).attr('rel','off');
      $('#location_dropdown').css('display','none');
    }
    e.stopPropagation();
  });

  $('#filter_type').live('click',function(e) {
    if($(this).attr('rel') == 'off') {
      $(this).attr('rel','on');
      $('#type_dropdown').css('display','block');

      $('#location_dropdown').css('display','none');
      $('#filter_location').attr('rel','off');
    } else if($(this).attr('rel') == 'on') {
      $(this).attr('rel','off');
      $('#type_dropdown').css('display','none');
    }
    e.stopPropagation();
  });

  $('.location_dropdown_link').live('click',function() {
    window.filter_location = $(this).attr('rel');
    $('#location').val($(this).html());
    $('#location_dropdown').css('display','none');
    $('#filter_location').attr('rel','off');
    return false;
  });

  $('.type_dropdown_link').live('click',function() {
    window.filter_location = $(this).attr('rel');
    $('#type').val($(this).html());
    $('#type_dropdown').css('display','none');
    $('#filter_type').attr('rel','off');
    return false;
  });

  evoline.cfg = $.parseJSON($('#cfg').html());

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

var evoline = {

  maxViewPortWidth  : 10000,
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
  },

  setBgSliderUp: function() {
    var imgs = evoline.cfg.happeningImages,
		thisImage;
    for(var i = 0, l = imgs.length; i < l; i++) {
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
    sliderCfg.slider.animSpeed = parseInt(sliderCfg.slider.animSpeed);
    evoGallery.init('#happening',sliderCfg.slider);

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
      $(obj).attr('style','width: ' + evoline.dimensions['width'] + 'px');
    else
      $(obj).attr('style','height: ' + evoline.dimensions['height'] + 'px');

    evoline.imageCounter += 1;
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
      style : ['position:absolute;top:44px;left:',(evoline.dimensions['width'] > 1016 ? (evoline.dimensions['width'] - 1016)/2 : 0),'px'].join(''),
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
          type  : 'div',
          id    : 'page_logo',
          cls   : 'page_logo_box',
          cmd     : ['click',function() {window.location.href = '/home';}]
        },{
          type  : 'div',
          id    : 'logo_title_anime',
          cls   : '',
          html  : ''
        }]
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
          id    : 'subpage_content_wrapper_container',
          cls   : 'page-container',
          style : 'position:relative;',
          arr   : [{
            type  : 'div',
            style : '',
            id    : 'subpage_content_wrapper'
          },{
            type  : 'div',
            style : '',
            id    : 'subpage_sider_wrapper',
            cls   : 'contact_sider'
          },{
            type  : 'div',
            style : 'clear:both;'
          }]
        },{
          type  : 'div',
          style : 'clear:both;'
        }]
      },{
          type  : 'div',
          style : 'clear:both;'
        }	]
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

    var neededWith = (pageTitle.length)*7 + 20;
    $('#logo_title_anime').animate({
      width: neededWith
    }, 750, function() {
      $("#logo_title_anime").html(['<a style="color:black;">',pageTitle,'</a>'].join(''));
    });

    evoline.fillContent();
		evoline.translate();
    evoline.buildSideBar();
    evoline.setEventsUp();
    evoline.createFooter();
    evoline.manageBreadCrumb();
    evoline.finishSetup();
  },

	translate: function() {
		$('#name').html(evoline.cfg['translate']['name']);
		$('#mail').html(evoline.cfg['translate']['email']);
		$('#send').html(evoline.cfg['translate']['send']);
		$('#phone').html(evoline.cfg['translate']['phone']);
		$('#message').html(evoline.cfg['translate']['message']);
		$('#file').html(evoline.cfg['translate']['file']);
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
          html  : 'ön itt áll ',
        },$$.cache.breadeCrumb_id);

      for(var i = 0, l = breadCrumb.length; i < l; i++) {
        crumb = breadCrumb[i];

        $$.create({
          type  : 'span',
          cls   : 'Bc_span',
          html  : ['&nbsp;&nbsp;>&nbsp;&nbsp;<a href="/',crumb.link,'">',crumb.title,'</a>'].join('')
        },$$.cache.breadeCrumb_id);
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

    var thisHeight;
    if($('#page-wrapper').height() + 46 < evoline.dimensions['height'] + 40) {
      thisHeight = evoline.dimensions['height'] + 40;
    } else {
      thisHeight = $('#page-wrapper').height() + 46;
    }

    $($$.cache.footer_menu_wrapper).css({
      top           :  thisHeight
    });

    $($$.cache.overlay).css({
      height        :  thisHeight
    });

    $($$.cache.happening).css({
      height        :  thisHeight
    });

    $($$.cache.viewport).css({
      height        :  thisHeight
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

    $($$.cache.splicing).css({
      top         : 450,
      left        : 0,
      width       : evoline.dimensions['width'],
      height      : evoline.dimensions['height']-640,
      paddingTop  : 250
    });

    $($$.cache.splicing_inner).css({
      width       : evoline.dimensions['width'],
      height      : evoline.dimensions['height']-640,
      background  : 'black'
    });
  },

  fillContent: function() {

    var thisContent = $.parseJSON($('#content').html());

    $$.create({
      type  : 'div',
      cls   : 'subpage_content_box_box',
      html  : ['<span class="headline contact">',decodeThis(thisContent[0]['title']),'</span>'].join('')
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      cls   : 'subpage_content_box_box bordered',
      html  : ['<span class="inner_headline spec_i_h">',decodeThis(thisContent[0]['type']),'<span>'].join('')
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      id    : 'subpage_content_title',
      cls   : 'bordered bged',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        arr   : [{
          type  : 'label',
          id    : 'title_label',
          cls   : 'thisLabel',
          html  : 'POZÍCIÓ MEGNEVEZÉSE'
        }]
      },{
        type  : 'div',
        id    : 'title_c',
        cls   : 'pos_right  pos_content',
        html  : decodeThis(thisContent[0]['title'])
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      id    : 'subpage_content_type',
      cls   : 'bordered',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        arr   : [{
          type  : 'label',
          id    : 'type_label',
          cls   : 'thisLabel',
          html  : 'PROJECT TÍPUSA'
        }]
      },{
        type  : 'div',
        id    : 'type_c',
        cls   : 'pos_right  pos_content',
        html  : decodeThis(thisContent[0]['type'])
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      id    : 'subpage_content_description',
      cls   : 'bordered bged',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        arr   : [{
          type  : 'label',
          id    : 'description_label',
          cls   : 'thisLabel',
          html  : 'LEÍRÁS'
        }]
      },{
        type  : 'div',
        id    : 'description_c',
        cls   : 'pos_right  pos_content',
        html  : decodeThis(thisContent[0]['description'])
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      id    : 'subpage_content_commitment',
      cls   : 'bordered',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        arr   : [{
          type  : 'label',
          id    : 'commitment_label',
          cls   : 'thisLabel',
          html  : 'FELADATOK'
        }]
      },{
        type  : 'div',
        id    : 'commitment_c',
        cls   : 'pos_right  pos_content',
        html  : decodeThis(thisContent[0]['commitment'])
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      id    : 'subpage_content_start',
      cls   : 'bordered bged',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        arr   : [{
          type  : 'label',
          id    : 'start_label',
          cls   : 'thisLabel',
          html  : 'KEZDÉS'
        }]
      },{
        type  : 'div',
        id    : 'start_c',
        cls   : 'pos_right  pos_content',
        html  : decodeThis(thisContent[0]['date_from'])
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      id    : 'subpage_content_end',
      cls   : 'bordered',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        arr   : [{
          type  : 'label',
          id    : 'end_label',
          cls   : 'thisLabel',
          html  : 'BEFEJEZÉS'
        }]
      },{
        type  : 'div',
        id    : 'end_c',
        cls   : 'pos_right  pos_content',
        html  : decodeThis(thisContent[0]['date_to'])
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);

    $$.create({
      type  : 'div',
      id    : 'subpage_content_expectations',
      cls   : 'bordered bged',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        arr   : [{
          type  : 'label',
          id    : 'expectations_label',
          cls   : 'thisLabel',
          html  : 'ELVÁRÁSOK'
        }]
      },{
        type  : 'div',
        id    : 'expectations_c',
        cls   : 'pos_right  pos_content',
        html  : decodeThis(thisContent[0]['expectations'])
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);




    $$.create({
      type  : 'div',
      id    : 'subpage_content_submit',
      cls   : '',
      arr   : [{
        type  : 'div',
        cls   : 'pos_left pos_content',
        id    : 'submit_c',
        arr   : [{
          type  : 'label',
          id    : 'submit_label',
          cls   : 'thisLabel',
          html  : 'JELENTKEZEM'
        }]
      },{
        type  : 'div',
        rel   : thisContent[0]['id'],
        cmd   : ['click',function() {
          evoline.candidate(this);
        }],
        id    : 'pos_submit'
      },{
        type  : 'div',
        cls   : 'clear:both'
      }]
    },$$.cache.subpage_content_wrapper);


    $('#subpage_content_title').height( $('#title_c').height() + 10 );
    $('#subpage_content_type').height( $('#type_c').height() + 10 );
    $('#subpage_content_description').height( $('#description_c').height() + 20 );
    $('#subpage_content_commitment').height( $('#commitment_c').height() + 20 );
    $('#subpage_content_start').height( $('#start_c').height() + 20 );
    $('#subpage_content_end').height( $('#end_c').height() + 20 );
    $('#subpage_content_expectations').height( $('#expectations_c').height() + 20 );

  },

  candidate: function(obj) {
    window.location.href = ['/cv?pos=',$(obj).attr('rel')].join('');
  },

  buildSideBar: function() {
    var cfg         = evoline.cfg.sidebar,
        thisContent = $.parseJSON($('#content').html()),
        thisTitle   = decodeThis(thisContent[0]['title']);

    for(var i in cfg) {

      if(i != thisTitle) {
        $$.create({
          type  : 'p',
          arr   : [{
            type  : 'a',
            cls   : 'sidebarLink',
            href  : cfg[i],
            html  : i
          }]
        },$$.cache.subpage_sider_wrapper);
      }

      else {
        $$.create({
          type  : 'p',
          arr   : [{
            type  : 'a',
            cls   : 'sidebarLink_active',
            href  : cfg[i],
            html  : i
          }]
        },$$.cache.subpage_sider_wrapper);
      }
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
