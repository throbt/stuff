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

  evoline.cfg = $.parseJSON($('#cfg').html());

  evoline.viewport();
  evoline.setBgSliderUp();
  evoline.slideCounter = 0;
  //evoline.setGmapUp();

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

    /*
      var anims = new Array('sliceDownRight','sliceDownLeft','sliceUpRight','sliceUpLeft','sliceUpDown','sliceUpDownLeft','fold','fade',
      'boxRandom','boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse');
    */

    sliderCfg.slider.beforeChange = evoline.setBgText;

    sliderCfg.slider.animSpeed = parseInt(sliderCfg.slider.animSpeed);

    evoGallery.init('#happening',sliderCfg.slider);

    //$('#happening').nivoSlider( sliderCfg.slider );

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
        }/*,{
          type  : 'div',
          id    : 'logo_box2',
          cls   : 'page_logo_box',
          html  : '<a href="/cikkek/21">TECHNOLOGIA</a>'
        },{
          type  : 'div',
          id    : 'logo_box3',
          cls   : 'page_logo_box',
          html  : '<a href="/cikkek/21">NEARSHORING</a>'
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
          id    : 'subpage_content_wrapper_container',
          cls   : 'page-container',
          style : 'position:relative;',
          arr   : [{
            type  : 'div',
            style : '', //height:526px;float:left;
            id    : 'subpage_content_wrapper'
          },{
            type  : 'div',
            style : '', //height:526px;float:left;
            id    : 'subpage_sider_wrapper',
            cls   : 'contact_sider',
            html  : [

              ['<p>'].join(''),
              ['<a class="sidebarLink" href="/content/menu/newsletter">HÍRLEVÉL</a>'].join(''),
              ['</p>'].join(''),

              ['<p>'].join(''),
              ['<a class="sidebarLink" href="/content/menu/contact">KAPCSOLAT</a>'].join(''),
              ['</p>'].join('')

            ].join('')
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
//    evoline.finishLayoutSetup();
    evoline.createFooter();
    evoline.manageBreadCrumb();
    evoline.finishSetup();
  },

	translate: function() {
		/*$$.create({
			type  : 'div',
			cls   : 'contact_address_box',
			html  : [
				['<p class="" style="">- ',evoline.cfg['translate']['news'],'</p>'].join(''),
				['<p class="" style="">- ',evoline.cfg['translate']['conferences'],'</p>'].join(''),
				['<p class="" style="">- ',evoline.cfg['translate']['career'],'</p>'].join('')
			].join('')
		},$$.cache.contact_body);

		$$.create({
			type  : 'div',
			cls   : 'contact_address_box',
			html  : [
				['<p class="" style="">- ',evoline.cfg['translate']['projects'],'</p>'].join(''),
				['<p class="" style="">- ',evoline.cfg['translate']['education'],'</p>'].join(''),
				['<p class="" style="">- ',evoline.cfg['translate']['research'],'</p>'].join('')
			].join('')
		},$$.cache.contact_body);

		$$.create({
			type  : 'div',
			cls   : 'contact_address_box',
			html  : [
				['<p class="" style="">- ',evoline.cfg['translate']['guidance'],'</p>'].join('')
			].join('')
		},$$.cache.contact_body);;*/

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

    var absHeight   = evoline.dimensions['height'],
        relHeight   = $('#page-wrapper').height() + 44,
        thisHeight  = 0;

    if(relHeight < absHeight) {
      thisHeight = evoline.dimensions['height'];
    } else {
      thisHeight = $('#page-wrapper').height() + 46;
    }

    $($$.cache.footer_menu_wrapper).css({
      top        :  thisHeight
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

//    $($$.cache.footer_menu_wrapper).css({
//      top        :  evoline.dimensions['height'] + 40
//    });

//    $($$.cache.overlay).css({
//      height        :  evoline.dimensions['height'] + 40
//    });

//    $($$.cache.happening).css({
//      height        :  evoline.dimensions['height'] + 40
//    });

//    $($$.cache.viewport).css({
//      height        :  evoline.dimensions['height'] + 40
//    });
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
      top         : 450,  //evoline.dimensions['height']-450,
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
      html  : ['<span class="headline contact">',decodeURIComponent(thisContent[0]['title']).replace(/\+/g, ' '),'</span><p class="">',decodeURIComponent(thisContent[0]['body']).replace(/\+/g, ' '),'</p><h2 id="sysMess"></h2><span class="inner_headline" id="postTitle" style="padding-top:0px;"></span>'].join('')
    },$$.cache.subpage_content_wrapper);


    /*
      messages
    */
    if(evoline.cfg.messages) {
      $('#sysMess').html(evoline.cfg.messages.cv);
    }

    /*
      the position
    */
    if(thisContent[0].postitle) {
      $('#postTitle').html(['Ön a következő állásra jelentkezik: ',decodeThis(thisContent[0].postitle)].join(''));
    }


    /*$$.create({
      type  : 'div',
      id    : 'contact_body',
      arr   : [{
        type  : 'div',
        cls   : 'contact_address_box',
        html  : [
          ['<p class="" style="">- szakamai újdonságok</p>'].join(''),
          ['<p class="" style="">- konferenciák</p>'].join(''),
          ['<p class="" style="">- karrier hírek</p>'].join('')
        ].join('')
      },{
        type  : 'div',
        cls   : 'contact_address_box',
        html  : [
          ['<p class="" style="">- új projectek</p>'].join(''),
          ['<p class="" style="">- oktatás</p>'].join(''),
          ['<p class="" style="">- kutatás</p>'].join('')
        ].join('')
      },{
        type  : 'div',
        cls   : 'contact_address_box',
        html  : [
          ['<p class="" style="">- tanácsadás</p>'].join('')
        ].join('')
      }]
    },$$.cache.subpage_content_wrapper);*/

    $$.create({
      type  : 'div',
      id    : 'form_wrapper',
      style : 'position:relative;height:400px;margin-top:10px;',
      arr   : [{
        type      : 'div',
        id        : 'cv_form',
        style     : 'position:absolute;width:100%;height:420px;left:0px;top:10px;',
        arr       : [{
          type      : 'form',
          id        : 'cv',
          enctype   : 'multipart/form-data',
          action    : ['/content/menu/cv_add',(thisContent[0].postitle ? '?pos=' + thisContent[0].posid : '')].join(''),
          method    : 'post',
          arr       : [{
            type  : 'div',
            id    : 'field_name_wrapper',
            cls   : 'field_wrapper_cv',
            html  : [
              ['<div class="label_wr"><label id="name"></label></div>'].join(''),
              ['<input type="text" style="margin-left:20px;" name="name" id="name" class="newsl_inp" /></div>'].join('')
            ].join('')
          },{
            type  : 'div',
            id    : 'field_mail_wrapper',
            cls   : 'field_wrapper_cv',
            html  : [
              ['<div class="label_wr"><label id="mail"></label></div>'].join(''),
              ['<input type="text" style="margin-left:20px;" name="mail" id="mail" class="newsl_inp" />'].join('')
            ].join('')
          },{
            type  : 'div',
            id    : 'field_phone_wrapper',
            style : 'height:36px;',
            cls   : 'field_wrapper_cv',
            html  : [
              ['<div class="label_wr"><label id="phone"></label></div>'].join(''),
              ['<input type="text" style="margin-left:20px;" name="phone" id="phone" class="newsl_inp" />'].join('')
            ].join('')
          },{
            type  : 'div',
            id    : 'field_message_wrapper',
            cls   : 'field_wrapper_cv',
            style : 'height:176px;',
            html  : [
              ['<div class="label_wr"><label id="message"></label></div>'].join(''),
              ['<textarea name="message" style="resize:none;margin-left:20px;width:400px;height:150px" id="message"  class="newsl_inp" ></textarea>'].join('')
            ].join('')
          },{
            type  : 'div',
            id    : 'field_file_wrapper',
            style : 'height:36px;position:relative;',
            cls   : 'field_wrapper_cv',
            html  : [
              ['<div class="label_wr" style="width:120px;"><label style="width:120px;" id="file"></label></div>'].join(''),
              ['<input id="fileInput" onchange="evoline.inputChange();" type="file" size="55" style="" name="file" id="file" class="newsl_inp" />'].join(''),

              ['<input id="fakeInput" style="" value=""></div>'].join('')/*

              ['<div style="z-index:1;position:absolute;top:0px;left:150px;width:270px;" class="fakefile">'].join(''),
              ['<input style="width:400px;z-index:1;opacity:0;filter:alpha(opacity = 30);"></div>'].join('')*/
            ].join('')
          },{
            type  : 'div',
            id    : 'submit_wrapper',
            style : 'height:36px;margin-top:14px;padding-top:0px',
            cls   : 'field_wrapper_cv',
            html  : [
              ['<div class="label_wr"><label id="send"></label></div>'].join(''),
              ['<input type="submit" style="margin-left:5px;" name="sbm" id="news_subm" class="newsl_subm" value=""  />'].join('')
            ].join('')
          }]
        }]
      }]
    },$$.cache.subpage_content_wrapper);
  },

  inputChange: function() {
    $('#fakeInput').val($('#fileInput').val());
  },

  buildSideBar: function() {
    var cfg         = evoline.cfg.sidebar,
        thisContent = $.parseJSON($('#content').html()),
        thisTitle   = decodeURIComponent(thisContent[0]['title']).replace(/\+/g, ' ');

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

var animator = {

}
