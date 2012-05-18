$(document).ready(function() {
  $('#galleries').change(function() {
    if($(this).val() != '') {
      Galleries.getElementsByType($(this).val());
    }
  });
  
  $('.editable').live("click", function() {
    Galleries.edit(this);
  });
  $('.save').live("click", function() {
    Galleries.save($(this).attr('rel'));
  });
  $('.del').live("click", function() {
    Galleries.del($(this).attr('rel'));
  });
  
  $(document).keyup(function(e) {
    if(e.keyCode == 13) {
      Galleries.setInputDefault();
    }
  });
});

var Galleries = {

  cache: '',
  cacheVal: '',

  edit: function(obj) {
    if(Galleries.cache != $(obj).attr('id')) {
      Galleries.setInputDefault();
      Galleries.cache    = $(obj).attr('id');
      Galleries.cacheVal = $(obj).html();
      $(obj).html('<input class="thisEditor" type="text" id="editor" />');
      $('#editor').val(Galleries.cacheVal);
      $('#editor').focus();
    } else {
      Galleries.setInputDefault();
    }
  },
  
  del: function(id) {
    $.get(
      '/admin_ajax/delImage',
      {'id' : id},
      function(resp) {
        if(resp != 'false')
          Galleries.getElementsByType(Galleries.gallery);
        else
          window.location.href = '/login'
      }
    );
  },

  save: function(id) {
    var pieces = ['title','lead'],
        result = {};
    for(var i in pieces) {
      result[pieces[i]] = Galleries.getInputValue($(['#',pieces[i],id].join('')).get());
    }
    result['id'] = id; console.log(result);
    $.get(
      '/admin_ajax/saveImage',
      result,
      function(resp) {
        if(resp != 'false')
          Galleries.getElementsByType(Galleries.gallery);
        else
          window.location.href = '/login'
      }
    );
  },
  
  getInputValue: function(el) {
    var thisContent = $(el).html();
    if(thisContent.match(/input/))
      return $('#editor').val();
    else
      return thisContent;
  },
  
  setInputDefault: function() {
    $(['#',Galleries.cache].join('')).html(/*Lang.cacheVal*/$('#editor').val());
    Galleries.cache    = '';
    Galleries.cacheVal = '';
  },
  
  getElementsByType: function(gallery) {
    Galleries.gallery = gallery;
    var self = this;
    $.get(
      '/admin_ajax/getGalleriesByGallery',
      {'gallery' : gallery},
      function(resp) {
        if(resp != 'false')
          self.displayElements(resp);
        else
          alert('ebben a galériában még nincsenek képek');
      }
    );
  },
  
  getHeader: function(arr) {
    var header  = [],
        self    = this;
    
    header.push('<thead><tr>');
    for(var i = 0,l = arr.length; i < l; i++) {
      header.push(['<th><h4>',arr[i],'</h4></th>'].join(''));
    }
    header.push('</tr></thead>');
    return header.join('');
  },
  
  getBody: function(arr) {
    var body    = [],
        link    = '',
        self    = this;
        
    body.push('<tbody>');
    for(var i = 0,l = arr.length; i < l; i++) {
      link = ['/upload/',arr[i]['gallery'],'/',arr[i]['name']].join('');
      body.push('<tr>');
        body.push(['<td><img src="',link,'" height="35" />'].join(''));
        body.push(['<td class="editable" id="title',arr[i]['id'],'">',arr[i]['title'],'</h4>'].join(''));
        body.push(['<td class="editable" id="lead',arr[i]['id'],'">',arr[i]['lead'],'</h4>'].join(''));
        // body.push(['<td><a href="/admin_images/',arr[i]['id'],'/edit" id="sbm" class="btn btn-primary" rel="',arr[i]['id'],'" type="submit">Szerkeszt</a></td>'].join(''));
        body.push(['<td><button id="sbm" class="btn btn-primary save" rel="',arr[i]['id'],'" type="submit">Ment</button></td>'].join(''));
        body.push(['<td><button id="sbm" class="btn btn-primary  del" rel="',arr[i]['id'],'" type="submit">Töröl</button></td>'].join(''));
      body.push('</tr>');
    }
    body.push('</tbody>');
    return body.join('');
  },
  
  displayElements: function(resp) {
    
    var header  = Galleries.getHeader([
          'kép',
          'cím',
          'lead',
          // 'szerkeszt',
          'ment',
          'töröl'
        ]),
        body    = Galleries.getBody($.parseJSON(resp));
    
    $('#contentWrapper').html([
      '<table class="table">',
      header,
      body,
      '</table>'
    ].join(''));
  }
}
