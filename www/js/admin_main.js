$(document).ready(function() {

  $.extend($.fn.datepicker.defaults, {
    parse: function (string) {
      var matches;
      if ((matches = string.match(/^(\d{2,2})\/(\d{2,2})\/(\d{4,4})$/))) {
        return new Date(matches[3], matches[1] - 1, matches[2]);
      } else {
        return null;
      }
    }/*,
    format: function (date) {
      var
        month = (date.getMonth() + 1).toString(),
        dom = date.getDate().toString();
      if (month.length === 1) {
        month = "0" + month;
      }
      if (dom.length === 1) {
        dom = "0" + dom;
      }
      return month + "/" + dom + "/" + date.getFullYear();
    }*/
  });

	$(function() {
		//$.datepicker.setDefaults('yy-mm-dd');
		$(".datep").datepicker();
	});

  $('.dropdown-toggle').dropdown();

  /*
    for nodes
  */
	$('.active').change(function() {
	  $.get(
	    '/admin_ajax/setActive',
	    {
        'active': this.checked,
        'model':  $(this).attr('model'),
        'id':     $(this).attr('rel')
      },
	    function(resp) {
	    }
	  );
	});

  /*
    for spec models, outside of the node system
  */
	$('.activespec').change(function() {
    $.get(
      '/admin_ajax/setActiveSpec',
      {
        'active': this.checked,
        'model':  $(this).attr('model'),
        'id':     $(this).attr('rel')
      },
      function(resp) {
      }
    );
  });

  ThisModal.init();

  $('.imager').live('click', function() {
    if(!Galleries.galleries) {
      Galleries.loadGalleries();
    }
    ThisModal.up();
  });

  $("#sortable_list").sortable({
    handle : '.handle',
    update : function () {
      if(typeof sortable_hook != "undefined") {
        sortable_hook();
      }
    }
  });


  $('.delete').click(function() {
    $.get(
      '/admin_ajax/delNode',
      {id: $(this).attr('rel')},
      function(resp) {
         window.location.reload()
      }
    );
    return false;
  });

  $('.deleteType').click(function() {
    $.get(
      '/admin_ajax/deleteType',
      {id: $(this).attr('rel')},
      function(resp) { console.log(resp);
         window.location.reload()
      }
    );
    return false;
  });

});

var Galleries = {

  init: function() {

  },

  loadGalleries: function() {
    $.get(
      '/admin_ajax/getGalleries',
      {},
      function(resp) {
        Galleries.galleries = $.parseJSON(resp);
         Galleries.getSelect();
      }
    );
  },

  loadGalleriyImages: function(id) {
    $.get(
      '/admin_ajax/getGalleriesByGallery',
      {'gallery' : id},
      function(resp) {
        Galleries.display($.parseJSON(resp));
      }
    );
  },

  replaceImage: function(obj) {
    $('.imager').each(function() {
      $('#node_image').val($(obj).attr('rel'));
      $(this.parentNode).html(['<label>Lista nézet kép:</label><img class="modalGalleryImg imager" src=',$(obj).attr('src'),' rel="',$(obj).attr('rel'),'" />'].join(''));
    });
  },

  display: function(arr) {
    var body    = [],
        link    = '',
        self    = this;

    for(var i = 0,l = arr.length; i < l; i++) {
      link = ['/upload/',arr[i]['gallery'],'/',arr[i]['name']].join('');
      body.push(['<img class="modalGalleryImg" src="',link,'" rel="',arr[i]['id'],'" />'].join(''));
    }
    $('.modalGalleryImg').live('click',function() {
      Galleries.replaceImage(this);
    });
    $('#imageWrapperModal').html(body.join(''));
  },

  getSelect: function() {
    var select = [];
    select.push('<select id="gallerySelect">');
    select.push(['<option value="">Válasszon</option>'].join(''));
    for(var i = 0,l = Galleries.galleries.length; i < l; i++) {
      select.push(['<option value="',Galleries.galleries[i].nid,'">',Galleries.galleries[i].title,'</option>'].join(''));
    }
    select.push('</select>');
    select.push('<div id="imageWrapperModal"></div>');

    ThisModal.setContent(select.join(''));

    $('#gallerySelect').live('change',function() {
      Galleries.loadGalleriyImages($(this).val());
    });
  }
};

var ThisModal = {
  init: function() {
    ThisModal.getHtml();
    $('#modalHeaderClose').click(function() {
      ThisModal.down();
    });
  },

  up: function() {
    $('#modalFrame').css('display','block');
  },

  down: function() {
    $('#modalFrame').css('display','none');
  },

  getHtml: function() {

    var content = [
      '<div id="modalFrame">',
        '<h3 id="modalHeader">',
          '<span id="modalHeaderClose">X</span>',
        '</h3>',
        '<div id="modalFrameContent"></div>',
      '</div>'
    ];

    $('body').append(content.join(''));

    $('#modalFrame').css({
      'position'  : 'absolute',
      'display'   : 'none',
      'background': 'white',
      'top'       : '200px',
      'left'      : '400px',
      'width'     : '400px',
      'height'    : '300px',
      'overflow'  : 'hidden',
      'border'    : '1px solid #333'
    });
    $('#modalHeaderClose').css({
      'color'       : 'white',
      'margin-right': '3px',
      'cursor'      : 'pointer'
    });
    $('#modalHeader').css({
      'background'  : '#0063CC',
      'cursor'      : 'crosshair',
      'margin'      : '0',
      'text-align'  : 'right',
      'padding'     : '0 0 9px',
      'width'       : '100%',
      'float'       : 'left'
    });
    $('#modalFrameContent').css({
      'margin'      : '3px',
      'padding-top' : '5px',
      'width'       : '100%',
      'display'     : 'block',
      'overflow'    : 'auto'
    });
    $('#modalFrame').resizable();
    $('#modalFrame').draggable();
  },

  getContent: function() {
    return $('#modalFrameContent').html();
  },

  setContent: function(stuff) {
    $('#modalFrameContent').html(stuff)
  }
}
