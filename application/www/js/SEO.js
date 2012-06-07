$(document).ready(function() {
  $('.editable').live("click", function() {
    SEO.edit(this);
  });
  $('.save').live("click", function() {
    SEO.save($(this).attr('rel'));
  });
  
  $(document).keyup(function(e) {
    if(e.keyCode == 13) {
      SEO.setInputDefault();
    }
  });
  $('.savenew').live("click", function() {
    SEO.saveNew();
  });
  $('.del').live("click", function() {
    SEO.del(this);
  });
});

var SEO = {
  cache: '',
  cacheVal: '',

  saveNew: function() {
    $.get(
      '/admin_ajax/saveNewSEO',

      {
        'order'    : $('#ordernew').val(),
        'params'  : $('#paramsnew').val()
      },

      function(resp) {
        if(resp != 'false') {
          window.location.reload()
        } else
          window.location.href = '/login'
      }
    );
  },

  del: function(obj) {
    $.get(
      '/admin_ajax/delSEO',

      {'id'    : $(obj).attr('rel')},

      function(resp) {
        if(resp != 'false') {
          window.location.reload()
        } else
          window.location.href = '/login'
      }
    );
  },

  edit: function(obj) {
    if(SEO.cache != $(obj).attr('id')) {
      SEO.setInputDefault();
      SEO.cache    = $(obj).attr('id');
      SEO.cacheVal = $(obj).html();
      $(obj).html('<input class="thisEditor" type="text" id="editor" style="width:200px;" />');
      $('#editor').val(SEO.cacheVal);
      $('#editor').focus();
    } else {
      SEO.setInputDefault();
    }
  },
  
  setInputDefault: function() {
    $(['#',SEO.cache].join('')).html(/*SEO.cacheVal*/$('#editor').val());
    SEO.cache    = '';
    SEO.cacheVal = '';
  },

  getInputValue: function(el) {
    var thisContent = $(el).html();
    if(thisContent.match(/input/))
      return $('#editor').val();
    else
      return thisContent;
  },

  save: function(id) {
    var pieces = ['order','params'],
        result = {};
        
    for(var i in pieces) {
      result[pieces[i]] = SEO.getInputValue($(['#',pieces[i],id].join('')).get());
    }
    result['id'] = id;
    $.get(
      '/admin_ajax/saveSEO',
      result,
      function(resp) {
        if(resp != 'false') {
          window.location.reload()
        } else
          window.location.href = '/login'
      }
    );
  }
};