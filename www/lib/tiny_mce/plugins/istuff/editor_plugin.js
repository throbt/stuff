(function() {
tinymce.create('tinymce.plugins.IStuffPlugin', {
  init : function(ed, url) {

    ed.addCommand('mceIStuff', function() {

      ed.windowManager.open({
        width   : 600 + parseInt(ed.getLang('advimage.delta_width', 0)),
        height  : 400 + parseInt(ed.getLang('advimage.delta_height', 0)),
        inline  : 1
      }, {
      //plugin_url : '/admin_ajax/getGalleries'
      });
      $.get(
        '/ajax/getAllGalleries',
        {},
        function(resp) {
          iStuff.init(resp);
        }
      );
		});

    ed.addButton('istuff', {
      title : 'istuff',
      cmd   : 'mceIStuff',
      image : '/lib/tiny_mce/plugins/istuff/img/sample.gif',
    });
	},

  getInfo : function() {
    return {
      longname  : 'iStuff',
      author    : 'thRobt',
      authorurl : 'net.net',
      infourl   : 'net.net/info',
      version   : '1.0'
    };
  }
});

tinymce.PluginManager.add('istuff', tinymce.plugins.IStuffPlugin);
})();

var iStuff = {
  init: function(resp) {
    iStuff.galleries  = resp; //$.parseJSON(resp);
    $('#thisSelect').live('change',function() {
      iStuff.loadGallery(this.value);
    });
    $('.istuffImage').live('click',function() {
      tinymce.execCommand('mceInsertContent',false, iStuff.getHtml($(this).attr('rel')));
    });
    iStuff.getFuckinCurrentWindow();
    iStuff.getSelect();
  },

  getFuckinCurrentWindow: function() {
    var current;
    for(var i = 0,l = 100; i < l; i++) {
      if(typeof $(['#mce_',i].join('')).get(0) != 'undefined') {
        current = ['#mce_',i].join('');
//        break;
      }
    }
    iStuff.fuckinCurrentWindow = current;
  },

  getHtml: function(link) {
    return ['<div class="imageWrapper"><img src="',link,'" /></div>'].join('');
  },

  getSelect: function() {
    var select = [];
    select.push('<select id="thisSelect">');
    select.push(['<option value="">Válasszon</option>'].join(''));
    for(var i = 0,l = iStuff.galleries.length; i < l; i++) {
      select.push(['<option value="',iStuff.galleries[i].nid,'">',iStuff.galleries[i].title,'</option>'].join(''));
    }
    select.push('</select>');
    select.push('<div id="imageWrapperMce"></div>');
    $([iStuff.fuckinCurrentWindow,'_content'].join('')).html(select.join(''));
  },

  loadGallery: function(id) {
    $.get(
      '/ajax/getGalleries',
      {'gallery' : id},
      function(resp) {
        iStuff.display(/*$.parseJSON(resp)*/ resp);
      }
    );
  },

  display: function(arr) {
    var body    = [],
        link    = '',
        self    = this;

    for(var i = 0,l = arr.length; i < l; i++) {
      link = [arr[i]['image_link'],arr[i]['name']].join('');
      body.push(['<img class="istuffImage" src="',link,'" rel="',link,'" />'].join(''));
    }
    $('#imageWrapperMce').html(body.join(''));
  },
};
