<?php
  //print_r($this->var['data']); //die();
?>
<style>
#node_update-wrapper {
  display:none;
}
#node_create-wrapper {
  display:none;
}
</style>
<script type="text/javascript">
var dataCache = {},
    dataSave  = [];
$(document).ready(function() {

  var id = window.location.href.split('/')[window.location.href.split('/').length-1];

  $.get(
    '/admin_ajax/getStuffForAction',
    {'action':'show'},
    function(resp) {
      dataCache = $.parseJSON(resp);
      addSelectContent();
    }
  );

  $('.updateSidebar').live('click',function() {
    var mainId  = $('#selectContentShow').val(),
        data    = dataSave;

    if(mainId == '') {
      alert('nincs kiválasztott cikk');
    } else if(data.length == 0) {
      alert('nincs hozzáadható cikk');
    } else {
      $.get(
        '/admin_ajax/updateSidebarItem',
        {'id':mainId,'data':dataSave},
        function(resp) {
          window.location.href = '/node/nodetype/sidebar';
        }
      );
    }
    return false;
  });

  $('.deleteEl').live('click',function() {
    var id        = $(this).attr('rel')
        selector  = ['element',id].join('');
    dataSave = delArr(dataSave,id);
    remove($('#siderElements')[0],selector);
    return false;
  });

  $('#addSelectContent').change(function() {
    var id    = $(this).val(),
        title = lookup(id);

    insertEl(id,title);
  });

  if(id != 'null') {

    $.get(
      '/admin_ajax/getSidebarMainArticle',
      {'id':id},
      function(resp) {
        $('#selectContentShow').val(parseInt(resp));
      }
    );

    $.get(
      '/admin_ajax/getSidebarItem',
      {'id':id},
      function(resp) {
        var nodes = $.parseJSON(resp), tmp;
        for(var i = 0,l = nodes.length; i < l; i++) {
          tmp = nodes[i];
          insertEl(tmp['nid'],tmp['title'], 'preload');
        }
      }
    );
  }

});
var insertEl = function(id,title,job) {
  if($.inArray(id,dataSave) == -1) {
    $('#siderElements').append(
      ['<div class="span12" id="element'+id+'" style="margin-top:4px;">',
        '<div class="span6">',
          '<h4><a>'+title+'</a></h4>',
        '</div>',
        '<div class="span2">',
          '<a id="" class="btn btn-danger deleteEl" rel="'+id+'" href="" type="submit">Töröl</a>',
        '</div>',
      '</div>'].join('')
    );
    dataSave.push(id);
  } else {
    if(typeof job != 'undefined')
      if(job != 'preload') {
        alert($.inArray(id,dataSave) + id);
        alert('ez a node már hozzá van adva');
      }
  }
}
var lookup = function(index) {
  var data = {};
  for(var i = 0,l = dataCache.length;i < l;i++) {
    data = dataCache[i];
    if(data['nid'] == index) {
      return data['title'];
    }
  }
}
var remove = function(element,selector) {
  var self        = this,
      thisEl,
      searchedEl  = $(['#',selector].join(''))[0];

  for(var i in element.childNodes) {
    thisEl = element.childNodes[i];
    if(thisEl == searchedEl) {
      element.removeChild(thisEl);
    }
  }
}

var delArr = function(arr, el) {
  var res = [];
  for(var i = 0,l = arr.length; i < l; i++) {
    if(arr[i] != el)
      res.push(arr[i]);
  }
  return res;
}
var addSelectContent = function() {
  var data = dataCache;
  $('#selectContentShow').append(['<option value="">Válasszon</option>'].join(''));
  $('#addSelectContent').append(['<option value="">Válasszon</option>'].join(''));
  $.each(data, function(i) {
    $('#selectContentShow').append(
      ['<option value="',data[i]['nid'],'">',data[i]['type'],' | ',data[i]['title'],'</option>'].join('')
    );
    $('#addSelectContent').append(
      ['<option value="',data[i]['nid'],'">',data[i]['type'],' | ',data[i]['title'],'</option>'].join('')
    );
  });
  $('#selectContentWrapperShow').css('display','block');
  $('#addSelectContentWrapper').css('display','block');
}
</script>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li>
    <a href="/node/nodetype/sidebar">Sidebar</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    <?php echo $this->var['type']; ?>
  </li>
</ul>

<div class="row show-grid">
  <div class="span12">
    <div class="span6">
      <div class="control-group input-xlarge" id="selectContentWrapperShow" style="display:none;">
        <label>Válasszon egy cikket</label>
        <div class="text">
          <select id="selectContentShow" class="input-xlarge contentSelect">
          </select>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row show-grid" id="siderElements">
</div>


<div class="row show-grid">
  <div class="span12">
    <div class="span6">
      <div class="control-group input-xlarge" id="addSelectContentWrapper" style="display:none;">
        <label>Adjon hozzá tartalmakat</label>
        <div class="text">
          <select id="addSelectContent" class="input-xlarge contentSelect">
          </select>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="row show-grid">
  <div class="span12">
    <div class="span6">
        <a id="" class="btn btn-primary updateSidebar" rel="" href="" type="submit">Ment</a>
    </div>
  </div>
</div>  
