var Form = (function() {
  var mustHaves = ['name','firm','email','object'],
      messages  = {
        'name'    : 'Nincs megadva név',
        'firm'    : 'Nincs megadva a cég neve',
        'email'   : 'Hibás az emailcím',
        'object'  : 'Nincs megadva tárgy'
      },
      errors    = 0,
      init      = function init() {
        $('#object').val('');
        $('#sbm_order').click(function() {
          validate();
          return false;
        });
        $('#order input, #order textarea').keydown( function(e) {
          if($.inArray($(this).attr('id'), mustHaves) != -1) {
            var thisVal = $(this).val();
            switch($(this).attr('id')) {
              case 'email':
                if(emailValidate(this)) {
                  if($(this).attr('class').match(/warn/)) {
                    $(this).attr('class',[$(this).attr('class').split(' warn')[0]].join(''));
                    $('#email_').remove();
                  }
                } else {
                  if(!$(this).attr('class').match(/warn/))
                    $(this).attr('class',[$(this).attr('class'),' warn'].join(''));
                }
              break;
              default:
                if(thisVal == '') {
                  if(!$(this).attr('class').match(/warn/))
                    $(this).attr('class',[$(this).attr('class'),' warn'].join(''));
                } else {
                  $(this).attr('class',[$(this).attr('class').split(' warn')[0]].join(''));
                  $(['#',$(this).attr('id'),'_'].join('')).remove();
                } 
              break;
            }
          }
        });
      },
      validate  = function() {
        var thisVal = '',thisId = '';
        $('#mHolder').html('');
        errors = 0;
        $('#order input, #order textarea').each(function() {
          thisVal = $(this).val();
          thisId  = $(this).attr('id');
          if($.inArray($(this).attr('id'), mustHaves) != -1 && $(this).attr('id') != 'email' && thisVal == '') {
            messageHandler(thisId,this);
          } else if($(this).attr('id') == 'email') {
            if(!emailValidate(this)) {
              messageHandler(thisId,this);
            }
          }
        });
        if(errors == 0) {
          $('#order').submit();
        }
      },
      emailValidate = function(obj) {
        var thisVal = $(obj).val(),
            reg     = /\S+@\S+\.\S+/;
        if(reg.test(thisVal)) {
          return true;
        }
        return false;
      },
      messageHandler = function(id,obj) {
        if(!$(obj).attr('class').match(/warn/))
          $(obj).attr('class',[$(obj).attr('class'),' warn'].join(''));

        errors ++;
        $('#mHolder').append(['<h4 id="',id,'_" class="warn_">',messages[id],'<h4>'].join(''));
      };

  $(document).ready(function() {
    init();
  });

  return {
    init: init
  };
})();