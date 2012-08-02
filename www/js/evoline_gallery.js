/*
  evoline background fader, written by robThot(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
var evoGallery = {

  iter: 0,

//  cfg: {
//    beforeChange: '',
//    animSpeed:    '',
//    pauseTime:    ''
//  },

  init: function(selector,cfg) {
    evoGallery.cfg      = cfg;
    evoGallery.selector = selector;
    evoGallery.images   = evoline.cfg.happeningImages;

    evoGallery.start();

//    $.each(evoGallery.images,function(i) {
//      //$$.remove($(selector)[0],evoGallery.images[i]);
//    });

  },

  start: function() {
    setTimeout(function() {
      $$.create({
        type  : 'img',
        id    : 'current',
        src   : evoGallery.images[0].src,
        style : ['display:block;opacity:0;'].join('')
      },$$.cache.happening);
      evoGallery.slide(evoGallery.images[evoGallery.iter]);
      $(evoGallery.images[0]).css('display',"block");
      evoGallery.cfg.beforeChange();
      //evoGallery.iter++;
      evoGallery.intervalRef = setInterval(evoGallery.job,evoGallery.cfg.pauseTime);
    }, 150);
  },

  stop: function() {
  },

  job: function() {
    if(evoGallery.iter == evoGallery.images.length-1) {
      evoGallery.iter = 0;
    } else {
      evoGallery.iter++;
    }

    if(evoGallery.images.length > 1)
      evoGallery.cfg.beforeChange();

    evoGallery.slide(evoGallery.images[evoGallery.iter]);
  },

  slide: function(current) {
    $($$.cache.current).attr('id','notCurrent');
    $$.create({
      type  : 'img',
      id    : 'current',
      src   : current.src,
      style : ['display:block;opacity:0;'].join('')
    },$$.cache.happening);

    $($$.cache.current).width(evoline.dimensions['width']);
	
    $($$.cache.current).animate({
      opacity: 1
    }, evoGallery.cfg.animSpeed, function() {
      $$.remove($(evoGallery.selector)[0],$('#notCurrent').get());
    });
  }
};
