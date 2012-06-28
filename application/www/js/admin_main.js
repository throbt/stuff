$(document).ready(function() {
  ThisModal.init();
  $('.imager').live('click', function() {
    if(!Galleries.galleries) {
      Galleries.loadGalleries();
    }
    ThisModal.up();
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
      select.push(['<option value="',Galleries.galleries[i].id,'">',Galleries.galleries[i].title,'</option>'].join(''));
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
