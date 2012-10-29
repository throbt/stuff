/*
  main admin javascript for M N V C, written by robThot(robthot@gmail.com)
  licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)
*/
$(document).ready(function() {
  window.$$ = DomBuilder;
  $('.delete').live('click',function() {
    Main.delete(this);
    return false;
  });
  $('#choose_vocabularies').change(function() {
    Main.load_term(this);
    return false;
  });

  $('#new_node_type').live('click',function() {
    Fielder.step1();
    return false;
  });
  $('#node_type_save').live('click',function() {
    Fielder.save();
    return false;
  });

  $('.active').live('change',function() {
    Main.node_active(this);
    return false;
  });

  $('.disabled').attr('disabled','');

  $('.hidden_input').css({'display':'none'});

  $('.blind').live('click',function() {
    return false;
  });
});

var Fielder = {

  cfg: [],

  default: function() {
    $('#add_new_field').html('');
    $$.create({
      type  : 'button',
      id    : 'new_node_type', 
      cls   : 'btn btn-toggle',
      html  : 'Add new field'
    },$('#add_new_field')[0]);
  },

  step1: function() {
    var fields  = Fielder.getFieldTypes(),
        options = [],
        field;
    for(var i = 0, l = fields.length; i < l;i++) {
      field = fields[i];
      options.push({
        type  : 'option',
        value : field,
        html  : field
      });
    }
    options.unshift({
      type  : 'option',
      value : '',
      html  : 'Choose'
    });
    $('#add_new_field').html('');
    $$.create({
      type  : 'div',
      cls   : 'text',
      style : 'float:left;',
      arr   : [{
        type  : 'select',
        cls   : 'input-xlarge',
        id    : 'step1',
        arr   : options,
        cmd   : ['change',function() {
          if($(this).val() != '')
            Fielder.step2(this);
        }]
      }]
    },$('#add_new_field')[0]);
    $$.create({
      type  : 'button',
      id    : 'cancel', 
      cls   : 'btn btn-success',
      style : 'float:left;margin-left:10px;',
      html  : 'Cancel',
      cmd   : ['click',function() {
        Fielder.default();
      }]
    },$('#add_new_field')[0]);
  },

  step2: function(obj) {
    Fielder.setStep2Field($(obj).val());
  },

  setStep2Field: function(fieldType) {
    $('#add_new_field').html('');
    switch(fieldType) {
      case 'select':
        $$.create({
          type  : 'div',
          cls   : 'text',
          style : 'float:left;',
          arr   : [{
            type  : 'input',
            iType : 'text',
            cls   : 'input-xlarge',
            id    : 'fieldName',
            value : 'name...',
            cmd   : ['click',function() {$(this).val('');}]
          }]
        },$('#add_new_field')[0]);
        $$.create({
          type  : 'select',
          cls   : 'input-xlarge',
          id    : 'taxonomy_groups',
          style : 'float:left;margin-left:10px;',
          cmd   : ['change',function() {
            Fielder.getSelectGroup(this);
          }],
          arr   : [{
            type  : 'option',
            value : '',
            html  : 'Choose group'
          },{
            type  : 'option',
            value : 'vocabulary',
            html  : 'vocabulary'
          },{
            type  : 'option',
            value : 'term',
            html  : 'term'
          }]
        },$('#add_new_field')[0]);
      break;
      case 'checkbox':
        $$.create({
          type  : 'div',
          cls   : 'text',
          style : 'float:left;',
          arr   : [{
            type  : 'input',
            iType : 'text',
            cls   : 'input-xlarge',
            id    : 'fieldName',
            value : 'name...',
            cmd   : ['click',function() {$(this).val('');}]
          }]
        },$('#add_new_field')[0]);
        $$.create({
          type  : 'div',
          cls   : 'text',
          style : 'float:left;margin-left:10px;',
          arr   : [{
            type  : 'input',
            iType : 'text',
            cls   : 'input-xlarge',
            id    : 'fieldValue',
            value : 'value...',
            cmd   : ['click',function() {$(this).val('');}]
          }]
        },$('#add_new_field')[0]);
        $$.create({
          type  : 'button',
          id    : 'add', 
          cls   : 'btn btn-primary',
          style : 'float:left;margin-left:10px;',
          html  : 'Add',
          rel   : fieldType,
          cmd   : ['click',function() {
            if($('#fieldName').val() == 'name...' || $('#fieldName').val() == '') {
              alert('name is empty');
              return null;
            }

            if($('#fieldValue').val() == 'name...' || $('#fieldValue').val() == '') {
              alert('name is empty');
              return null;
            }

            Fielder.addField(this);
          }]
        },$('#add_new_field')[0]);
      break;
      default:
        $$.create({
          type  : 'div',
          cls   : 'text',
          style : 'float:left;',
          arr   : [{
            type  : 'input',
            iType : 'text',
            cls   : 'input-xlarge',
            id    : 'fieldName',
            value : 'name...',
            cmd   : ['click',function() {$(this).val('');}]
          }]
        },$('#add_new_field')[0]);
        $$.create({
          type  : 'button',
          id    : 'add', 
          cls   : 'btn btn-primary',
          style : 'float:left;margin-left:10px;',
          html  : 'Add',
          rel   : fieldType,
          cmd   : ['click',function() {
            if($('#fieldName').val() == 'name...' || $('#fieldName').val() == '') {
              alert('name is empty');
              return null;
            }
            Fielder.addField(this);
          }]
        },$('#add_new_field')[0]);
      break;
    }
    $$.create({
      type  : 'button',
      id    : 'cancel', 
      cls   : 'btn btn-success',
      style : 'float:left;margin-left:10px;',
      html  : 'Cancel',
      cmd   : ['click',function() {
        Fielder.default();
      }]
    },$('#add_new_field')[0]);
  },

  addField: function(obj) {
    var fieldType = (typeof obj == 'string' ? obj : $(obj).attr('rel')),
        fieldName = $('#fieldName').val();
    switch(fieldType) {
      case 'select':
        var group       = $('#taxonomy_groups').val(),
            name        = $('#fieldName').val(),
            vocabulary  = $('#vocabularies').val(),
            term = '';
        switch(group) {
          case 'vocabulary':
          break;
          case 'term':
            term = $('#terms').val();
          break;
        }

        $$.create({
          type  : 'tr',
          id    : fieldName,
          arr   : [{
            type  : 'td',
            html  : fieldName
          },{
            type  : 'td',
            html  : fieldType
          },{
            type  : 'td',
            html  : 'none'
          },{
            type  : 'td',
            html  : ['<p>group:',group,'</p>','<p>vocabulary:',vocabulary,'</p>','<p>term:',(term == '' ? 'none' : term),'</p>'].join('')
          },{
            type  : 'td',
            arr   : [{
              type  : 'button',
              id    : '', 
              cls   : 'btn btn-danger',
              html  : 'Delete',
              rel   : fieldName,
              cmd   : ['click',function() {
                Fielder.deleteField(this);
              }]
            }]
          }]
        },$('#extraFields')[0]);

        Fielder.cfg.push({
          name        : fieldName,
          type        : fieldType,
          group       : group,
          vocabulary  : vocabulary,
          term        : term
        });
        Fielder.default();
      break;
      case 'checkbox':
        $$.create({
          type  : 'tr',
          id    : fieldName,
          arr   : [{
            type  : 'td',
            html  : fieldName
          },{
            type  : 'td',
            html  : fieldType
          },{
            type  : 'td',
            html  : $('#fieldValue').val()
          },{
            type  : 'td',
            html  : 'none'
          },{
            type  : 'td',
            arr   : [{
              type  : 'button',
              id    : '', 
              cls   : 'btn btn-danger',
              html  : 'Delete',
              rel   : fieldName,
              cmd   : ['click',function() {
                Fielder.deleteField(this);
              }]
            }]
          }]
        },$('#extraFields')[0]);
        Fielder.cfg.push({
          name : fieldName,
          type : fieldType,
          value: $('#fieldValue').val()
        });
        Fielder.default();
      break;
      default:
        $$.create({
          type  : 'tr',
          id    : fieldName,
          arr   : [{
            type  : 'td',
            html  : fieldName
          },{
            type  : 'td',
            html  : fieldType
          },{
            type  : 'td',
            html  : 'none'
          },{
            type  : 'td',
            html  : 'none'
          },{
            type  : 'td',
            arr   : [{
              type  : 'button',
              id    : '', 
              cls   : 'btn btn-danger',
              html  : 'Delete',
              rel   : fieldName,
              cmd   : ['click',function() {
                Fielder.deleteField(this);
              }]
            }]
          }]
        },$('#extraFields')[0]);
        Fielder.cfg.push({
          name: fieldName,
          type: fieldType
        });
        Fielder.default();
      break;
    }

    $('#fieldName').val('');
    $('#extraFieldsWrapper').css({'display':'block'});
  },

  addFieldVocabularySelect: function(obj) {
    $('#cancel').remove();
    $('#add').remove();
    $('#vocabularies').remove();
    $('#terms').remove();
    var options = [], option;
    for(var i in obj) {
      option = obj[i];
      options.push({
        type  : 'option',
        value : option,
        html  : option
      });
    }
    options.unshift({
      type  : 'option',
      value : '',
      html  : 'Choose vocabulary'
    });
    $$.create({
      type  : 'select',
      cls   : 'input-xlarge',
      id    : 'vocabularies',
      style : 'float:left;margin-left:10px;',
      cmd   : ['change',function() {
        var choosed = $('#taxonomy_groups').val();
        if(choosed == 'vocabulary') {

          $('#add').remove();

          $$.create({
            type  : 'button',
            id    : 'add', 
            cls   : 'btn btn-primary',
            style : 'float:left;margin-left:10px;',
            html  : 'Add',
            rel   : 'select',
            cmd   : ['click',function() {
              if($('#fieldName').val() == 'name...' || $('#fieldName').val() == '') {
                alert('name is empty');
                return null;
              }
              Fielder.addField('select');
            }]
          },$('#add_new_field')[0]);

        } else if(choosed == 'term') {
          if($(this).val() != '')
            Fielder.getSelectTerm(this);
        }
      }],
      arr   : options
    },$('#add_new_field')[0]);
    $$.create({
      type  : 'button',
      id    : 'cancel', 
      cls   : 'btn btn-success',
      style : 'float:left;margin-left:10px;',
      html  : 'Cancel',
      cmd   : ['click',function() {
        Fielder.default();
      }]
    },$('#add_new_field')[0]);
  },

  addFieldTermSelect: function(obj) {
    $('#cancel').remove();
    $('#terms').remove();
    $('#add').remove();
    var options = [], option;
    for(var i in obj) {
      option = obj[i];
      options.push({
        type  : 'option',
        value : option,
        html  : option
      });
    }
    options.unshift({
      type  : 'option',
      value : '',
      html  : 'Choose term'
    });
    $$.create({
      type  : 'select',
      cls   : 'input-xlarge',
      id    : 'terms',
      style : 'float:left;margin-left:10px;',
      cmd   : ['change',function() {

        $('#add').remove();

        $$.create({
          type  : 'button',
          id    : 'add', 
          cls   : 'btn btn-primary',
          style : 'float:left;margin-left:10px;',
          html  : 'Add',
          rel   : 'select',
          cmd   : ['click',function() {
            if($('#fieldName').val() == 'name...' || $('#fieldName').val() == '') {
              alert('name is empty');
              return null;
            }
            Fielder.addField('select');
          }]
        },$('#add_new_field')[0]);

      }],
      arr   : options
    },$('#add_new_field')[0]);
    $$.create({
      type  : 'button',
      id    : 'cancel', 
      cls   : 'btn btn-success',
      style : 'float:left;margin-left:10px;',
      html  : 'Cancel',
      cmd   : ['click',function() {
        Fielder.default();
      }]
    },$('#add_new_field')[0]);
  },

  getSelectTerm: function(obj) {
    Main.ajax_post(
      ['/admin/node_term'].join(''),
      {vid: $(obj).val()},
      function(resp) {Fielder.addFieldTermSelect($.parseJSON(resp));}
    );
  },

  getSelectGroup: function(obj) {
    Main.ajax_post(
      ['/admin/node_vocabulary'].join(''),
      {},
      function(resp) {Fielder.addFieldVocabularySelect($.parseJSON(resp));}
    );
  },

  save: function() {
    if($('#name').val() == '') {
      alert('the name is empty');
    } else {
      if(Fielder.cfg.length > 0) {
        Main.ajax_post(
          ['/admin/save_new_node_type'].join(''),

          {
            name  : $('#name').val(),
            cfg   : Fielder.cfg
          },

          function(resp) {
            if(resp == 1)
              window.location.href = '/admin/node';
            else
              Main.message('Something went wrong, the item is not deleted!');
          }
        );
      } else {
        alert('There is no field!');
      }
    }
  },

  deleteField: function(obj) {
    var cfg       = Fielder.cfg,
        thisName  = $(obj).attr('rel'),
        thisCfg,
        result = [];
    for(var i in cfg) {
      thisCfg = cfg[i];
      if(thisName != thisCfg.name) {
        result.push(thisCfg);
      }
        
    }
    Fielder.cfg = result;
    $(['#',thisName].join('')).remove();
  },

  getFieldTypes: function() {
    return ['text','textarea','checkbox','file','select'];
  }
};

var Main = {
  message: function(message) {
    $('#message').html(message);
    $('#message_holder').css('display','block');
  },

  messageOff: function(message) {
    $('#message').html('');
    $('#message_holder').css('display','none');
  },

  ajax_post: function(url,vars,callback) {
    vars['token'] = $('#token').val();
    $.post(
      url,
      vars,
      callback
    );
  },
  ajax_get: function(url,vars,callback) {
    vars['token'] = $('#token').val();
    $.get(
      url,
      vars,
      callback
    );
  },
  delete: function(obj) {
    var params      = $(obj).attr('rel').split('|'),
        thisMethod  = '';

    if(parseInt(params[1]) > 0) {
      thisMethod = ['delete_',params[0]].join('');
      Main[thisMethod](params[1]);
    }
  },

  delete_node_type: function(id) {
    Main.ajax_post(
      '/admin/delete_node_type',
      {'id': id},
      function(resp) {
        if(resp == 1)
          window.location.reload();
        else
          Main.message('Something went wrong, the item is not deleted!');
      }
    );
  },

  delete_term: function(tid) {
    Main.ajax_post(
      '/admin/delete_term',
      {'tid': tid},
      function(resp) {
        if(resp == 1)
          window.location.reload();
        else
          Main.message('Something went wrong, the item is not deleted!');
      }
    );
  },

  delete_node: function(id) {
    Main.ajax_post(
      '/admin/node_delete',
      {'id': id},
      function(resp) {
        if(resp == 1)
          window.location.reload();
        else
          Main.message('Something went wrong, the item is not deleted!');
      }
    );
  },

  delete_vocabulary: function(vid) {
    Main.ajax_post(
      '/admin/delete_vocabulary',
      {'vid': vid},
      function(resp) {
        if(resp == 1)
          window.location.reload();
        else
          Main.message('Something went wrong, the item is not deleted!');
      }
    );
  },

  node_active: function(obj) {
    Main.ajax_post(
      '/admin/node_active',
      {'id': $(obj).attr('rel'),'active' : ($(obj).attr('checked') != undefined ? 1 : 0)},
      function(resp) {
        if(resp == 1) 
          window.location.reload();
        else
          Main.message('Something went wrong, the item is not deleted!');
      }
    );
  },

  load_term: function(obj) {
    Main.ajax_post(
      '/admin/load_term/',
      {'vid': $(obj).val()},
      function(resp) {
        if(resp != false && resp != 0) {
          var terms = $.parseJSON(resp),
              term,
              html;
          for(var i = 0,l = terms.length; i < l; i++) {
            term = terms[i];
            html = [html,['<tr>',
                ['<td>',term.tid,'</td>'].join(''),
                ['<td><a href="/admin/term/',term.tid,'">',term.name,'</a></td>'].join(''),
                ['<td>',term.voc,'</td>'].join(''),
                ['<td><button id="sbm" class="btn btn-danger delete" rel="term|',term.tid,'" type="submit">Delete</button></td>'].join('')
            ,'</tr>'].join('')].join('');
          }
          $('#inner_terms_wrapper').html(html);
          $('#term-container').css({display:'block'});
          Main.messageOff();
        } else if(resp == false) {
          $('#inner_terms_wrapper').html('');
          Main.message('There is no result!');
        } else {
          $('#inner_terms_wrapper').html('');
          Main.message('Something went wrong!');
        }
      }
    );
  }
};