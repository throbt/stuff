<script type="text/javascript">
var dataCache = {
  'index':  [],
  'show':   []
};
$(document).ready(function() {
  window.thisCfg = ($('#action').val() != '' ? {action:$('#action').val(),content:$('#content').val()} : {action:'',content:''});
  console.log(window.thisCfg);
  $('#selectContentAction').val(thisCfg.action);
  $.get(
    '/admin_ajax/getStuffForAction',
    {'action':'index'},
    function(resp) {
      dataCache['index'] = $.parseJSON(resp);
      addSelectContent('index');
    }
  );
  $.get(
    '/admin_ajax/getStuffForAction',
    {'action':'show'},
    function(resp) {
      dataCache['show'] = $.parseJSON(resp);
      addSelectContent('show');
    }
  );

  switch($('#selectContentAction').val()) {
    case 'index':
      $('#selectContentWrapperShow').css('display','none');
      $('#selectContentWrapperIndex').css('display','block');
    break;
    case 'show':
      $('#selectContentWrapperShow').css('display','block');
      $('#selectContentWrapperIndex').css('display','none');
    break;
  }

  $('#selectContentAction').change(function() {
    var action = $('#selectContentAction').val();
    switch(action) {
      case 'index':
        $('#selectContentWrapperShow').css('display','none');
        $('#selectContentWrapperIndex').css('display','block');
        //$('#selectContentIndex').val(thisCfg.content);
      break;
      case 'show':
        $('#selectContentWrapperShow').css('display','block');
        $('#selectContentWrapperIndex').css('display','none');
        //$('#selectContentShow').val(thisCfg.content);
      break;
    }
  });

  $('.contentSelect').change(function() {
    if($(this).val() != '') {
      var cfg = '';
      switch($(this).attr('id')) {
        case 'selectContentIndex':
          cfg = ["{'action':'",$('#selectContentAction').val(),"','content':'",$(this).val(),"'}"].join('');
          $('#action').val('index');
          $('#content').val($(this).val());
        break;
        case 'selectContentShow':
          cfg = ["{'action':'",$('#selectContentAction').val(),"','content':'",$(this).val(),"'}"].join('');
          $('#action').val('show');
          $('#content').val($(this).val());
        break;
      }
    }
  });
});

var addSelectContent = function(action) {
  switch(action) {
    case 'show':
      var data = dataCache['show'];
      $('#selectContentShow').append(['<option value="">Válasszon</option>'].join(''));
      $.each(data, function(i) {
        $('#selectContentShow').append(
          ['<option value="',data[i]['nid'],'">',data[i]['type'],' | ',data[i]['title'],'</option>'].join('')
        );
      });

      if($('#selectContentAction').val() == 'index')
        $('#selectContentIndex').val(thisCfg.content);
      else
        $('#selectContentShow').val(thisCfg.content);
    break;
    case 'index':
      var data = dataCache['index'];
      $('#selectContentIndex').append(['<option value="">Válasszon</option>'].join(''));
      $.each(data, function(i) {
        $('#selectContentIndex').append(
          ['<option value="',data[i],'">',data[i],'</option>'].join('')
        );
      });

      if($('#selectContentAction').val() == 'index')
        $('#selectContentIndex').val(thisCfg.content);
      else
        $('#selectContentShow').val(thisCfg.content);
    break;
  }
}
</script>
<div class="control-group input-xlarge">
  <div class="text">
    <label>Action</label>
      <select id="selectContentAction" class="input-xlarge">
        <option value="index">index - tartalom listázás</option>
        <option value="show">show - egy konkrét tartalom</option>
      </select>
  </div>
</div>
<div class="control-group input-xlarge" id="selectContentWrapperIndex" style="display:none;">
  <label>Tartalom típusok</label>
  <div class="text">
    <select id="selectContentIndex" class="input-xlarge contentSelect">
    </select>
  </div>
</div>
<div class="control-group input-xlarge" id="selectContentWrapperShow" style="display:none;">
  <label>Tartalmak</label>
  <div class="text">
    <select id="selectContentShow" class="input-xlarge contentSelect">
    </select>
  </div>
</div>
