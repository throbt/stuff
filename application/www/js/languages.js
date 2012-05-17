$(document).ready(function() {
  $('#lang').change(function() {
    if($(this).val() != '') {
      Lang.getElementsByType($(this).val());
    }
  });
  
  $('.editable').live("click", function() {
		Lang.edit(this);
	});
	$('.save').live("click", function() {
		Lang.save($(this).attr('rel'));
	});
	
	$(document).keyup(function(e) {
	  if(e.keyCode == 13) {
		  Lang.setInputDefault();
	  }
  });
});

var Lang = {

  cache: '',
  cacheVal: '',

  edit: function(obj) {
    if(Lang.cache != $(obj).attr('id')) {
      Lang.setInputDefault();
      Lang.cache    = $(obj).attr('id');
      Lang.cacheVal = $(obj).html();
      $(obj).html('<input class="thisEditor" type="text" id="editor" />');
      $('#editor').val(Lang.cacheVal);
      $('#editor').focus();
    } else {
      Lang.setInputDefault();
    }
  },
  
  save: function(id) {
    var pieces = ['hu','en','de'],
        result = {};
    for(var i in pieces) {
      result[pieces[i]] = Lang.getInputValue($(['#',pieces[i],id].join('')).get());
    }
    result['id'] = id;
    $.get(
      '/admin_ajax/saveLangElements',
      result,
      function(resp) {
        if(resp != 'false')
          Lang.getElementsByType(Lang.type);
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
  
  setInputDefault: function() { //console.log(Lang.cache,Lang.cacheVal);
    $(['#',Lang.cache].join('')).html(/*Lang.cacheVal*/$('#editor').val());
    Lang.cache    = '';
    Lang.cacheVal = '';
  },
  
  getElementsByType: function(type) {
    Lang.type = type;
    var self = this;
    $.get(
      '/admin_ajax/getLangElementsByType',
      {'type' : type},
      function(resp) {
        if(resp != 'false')
          self.displayElements(resp);
        else
          window.location.href = '/login'
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
        self    = this;
        
    body.push('<tbody>');
    for(var i = 0,l = arr.length; i < l; i++) {
      body.push('<tr>');
        body.push(['<td><h4>',arr[i]['id'],'</h4></td>'].join(''));
        body.push(['<td><h4>',arr[i]['orig'],'</h4></td>'].join(''));
        body.push(['<td class="editable" id="hu',arr[i]['id'],'">',arr[i]['hu'],'</h4>'].join(''));
        body.push(['<td class="editable" id="en',arr[i]['id'],'">',arr[i]['en'],'</h4>'].join(''));
        body.push(['<td class="editable" id="de',arr[i]['id'],'">',arr[i]['de'],'</h4>'].join(''));
        body.push(['<td><button id="sbm" class="btn btn-primary save" rel="',arr[i]['id'],'" type="submit">Ment</button></td>'].join(''));
      body.push('</tr>');
    }
    body.push('</tbody>');
    return body.join('');
  },
  
  displayElements: function(resp) {
    
    var header  = Lang.getHeader([
          'id',
          'kifejezés',
          'magyar',
          'angol',
          'német',
          'mentés'
        ]),
        body    = Lang.getBody($.parseJSON(resp));
    
    $('#contentWrapper').html([
      '<table class="table">',
      header,
      body,
      '</table>'
    ].join(''));
  }
}
