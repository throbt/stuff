$(document).ready(function() {
  
  var form = new Form({
    id: 'thisForm',
    method: 'post',
    multipart: true,
    cls: 'form-inline',
    parent: $('.container').get()[0],
    action: 'valahova'
  });

  var layout_text = new Fieldset({
    id: 'fieldset',
    cls: '',
    legend: 'layout',
    parent: form.body
  });

  var layout_switcher = new Select({
    id:'layout_switcher',
    label: 'layout switcher',
    parent: layout_text.body,
    options: ['inline','horizontal'],
    change: function(obj) {
      var cls = '';
      switch(obj.getValue()) {
        case 'horizontal':
          cls = 'form-horizontal';
        break;
        case 'inline':
          cls = 'form-inline';
        break;
      }
      $(form.reference).attr('class',cls);
    },
    selected: 'terence trent D\'arby'
  });

  var fieldset_text = new Fieldset({
    id: 'fieldset',
    cls: '',
    legend: 'simple text',
    parent: form.body
  });

  var text = new Text({
    id:'valami',
    label: 'testValami',
    parent: fieldset_text.body,
    change: function(obj) {
      console.log('text this scope value:  '+obj.getValue());
    },
    value: 'Bajnai Gordon'
  });

  var disabled_text = new Fieldset({
    id: 'fieldset1',
    cls: '',
    legend: 'disabled text',
    parent: form.body
  });

  var thattext = new Text({
    id:'thattext',
    label: 'thattext',
    parent: disabled_text.body,
    disabled: true,
    change: function(obj) {
      console.log('thattext this scope value:  '+obj.getValue());
    },
    value: 'Barack Obama'
  });

   var multiple_text = new Fieldset({
    id: 'fieldset11',
    cls: '',
    legend: 'multiple text',
    parent: form.body
  });

  var custominput = new MultipleNumber({
    id:'cvalami',
    label: 'custom number input',
    parent: multiple_text.body,
    change: function(obj) {
      console.log('CustomInput this scope value:  '+obj.getValue());
    },
    elements: [{
      type: 'text',
      len: 'col1',
      disabled: true,
      value: '+36'
    },{
      type: 'select',
      options: ['20','30','70'],
      len: 'col2',
      selected: 1
    },{
      type: 'text',
      len: 'col2',
      value: '1234567'
    }/*,{
      type: 'text',
      len: 'col5',
      value: 'Budapest, világváros'
    }*/],
    value: ''
  });

  var password_text = new Fieldset({
    id: 'fieldset2',
    cls: '',
    legend: 'password text',
    parent: form.body
  });

  var password = new Password({
    id:'password',
    label: 'Password',
    parent: password_text.body,
    change: function(obj) {
      console.log('password this scope value:  '+obj.getValue());
    },
    value: 'Bajnai Gordon'
  });

  var textarea_legend = new Fieldset({
    id: 'fieldset3',
    cls: '',
    legend: 'textarea',
    parent: form.body
  });

  var textarea = new Textarea({
    id:'masvalami',
    label: 'masvalami',
    parent: textarea_legend.body,
    change: function(obj) {
      console.log('textarea this scope value:  '+obj.getValue());
    },
    value: 'orbán viktor'
  });

  var checkboxes_legend = new Fieldset({
    id: 'fieldset4',
    cls: '',
    legend: 'checkboxes',
    parent: form.body
  });

  var checkbox = new Checkbox({
    id:'thisCheck',
    label: 'thisCheckBox',
    parent: checkboxes_legend.body,
    value: 'orbán viktor',
    change: function(obj) {
      alert('checkbox clicked:  '+obj.getValue());
    },
    checked: false
  });

  var otherCsheckbox = new Checkbox({
    id:'othercheckbox',
    label: 'othercheckbox',
    parent: checkboxes_legend.body,
    value: 'bla bla bla',
    change: function(obj) {
      alert('checkbox:  '+obj.getValue());
    },
    checked: true
  });

  var anothercheckbox = new Checkbox({
    id:'anothercheckbox',
    label: 'anothercheckbox',
    parent: checkboxes_legend.body,
    value: 'bajnai gordon',
    change: function(obj) {
      alert('checkbox:  '+obj.getValue()+'  :  '+obj.getLabel()+'  :  '+obj.isChecked());
    },
    checked: true
  });

  var select_legend = new Fieldset({
    id: 'fieldset5',
    cls: '',
    legend: 'select',
    parent: form.body
  });

  var thisSelect = new Select({
    id:'selectBox',
    label: 'selectBox',
    parent: select_legend.body,
    options: ['orban viktor','terence trent D\'arby','bajnai gordon','dalai lama'],
    change: function(obj) {
      alert('thisSelect  scope:  '+obj.getValue());
    },
    selected: 'terence trent D\'arby'
  });

  var radio_legend = new Fieldset({
    id: 'fieldset6',
    cls: '',
    legend: 'radio',
    parent: form.body
  });

  var thisRadio = new Radio({
    id:'radios',
    label: 'radios',
    parent: radio_legend.body,
    options: ['orban viktor','terence trent D\'arby','bajnai gordon','dalai lama','martin heidegger','kurt Cobain','Gyurcsány Ferenc'],
    change: function(obj) {
      alert('Radio scoped:  '+obj.getValue());
    },
    selected: 0
  });

  var dynamic_legend = new Fieldset({
    id: 'fieldset7',
    cls: '',
    legend: 'dynamic select',
    parent: form.body
  });

  var newesttextarea = new Textarea({
    id:'testTextArea',
    label: 'testTextArea for dynamic select',
    parent: dynamic_legend.body,
    change: function(obj) {
      //AnotherSelect.addOptions( obj.getValue().split('\n') );
    },
    value: 'ez mar dinamikusan epiti a select boxot alabb'
  });

  var AnotherSelect = new Select({
    id:'selectBox2',
    label: 'selectBox2',
    parent: dynamic_legend.body,
    options: ['jamaikai legelő','valős élethelyzet','kéretlen feltámadás','keserű lemondás'],
    change: function(obj) {
      alert('AnotherSelect:  '+obj.getValue());
    },
    selected: 'keserű lemondás'
  });

  newesttextarea.change = function(obj) {
    AnotherSelect.addOptions( obj.getValue().split('\n') );
  };

  AnotherSelect.setLabel('AnotherSelect');
  AnotherSelect.addOption('Bajnai Gordon');
  AnotherSelect.deleteOption(0);

  var dynamic_radio_legend = new Fieldset({
    id: 'fieldset8',
    cls: '',
    legend: 'dynamic radio',
    parent: form.body
  });

  var newestesttextarea = new Textarea({
    id:'testTextAreasss',
    label: 'testTextArea for dynamic radio',
    parent: dynamic_radio_legend.body,
    change: function(obj) {
      var thisVal = obj.getValue(); //console.log(thisVal);
      if(thisVal !== null) {
        newestRadio.addOptions(thisVal.split('\n'));
      }
    },
    value: 'ez mar dinamikusan epiti a radio boxot alabb'
  });

  var newestRadio = new Radio({
    id:'newestRadio',
    label: 'newestRadio',
    parent: form.body,
    options: ['orban viktor','terence trent D\'arby'],
    change: function(obj) {
      alert('newestRadio:  '+obj.getValue());
    },
    selected: 1
  });

  var dynamic_check_matrix = new Fieldset({
    id: 'fieldset9',
    cls: '',
    legend: 'dynamic checkboxMatrix',
    parent: form.body
  });

  var rTmatrix_row = new Textarea({
    id:'rTmatrix_row',
    label: 'checkBoxmatrix_row for dynamic CheckboxMatrix',
    parent: dynamic_check_matrix.body,
    change: function(obj) {
      var thisVal = obj.getValue();
      if(thisVal !== null) {
        thischeckboxMatrix.addRows(thisVal.split('\n'));
      }
    },
    value: 'terence trent D\'arby\nBruce Leeeee'
  });

  var rTmatrix_column = new Textarea({
    id:'rTmatrix_column',
    label: 'checkBoxmatrix_column for dynamic CheckboxMatrix',
    parent: dynamic_check_matrix.body,
    change: function(obj) {
      var thisVal = obj.getValue();
      if(thisVal !== null) {
        thischeckboxMatrix.addColumns(thisVal.split('\n'));
      }
    },
    value: 'barna\nzöld\nkék\nsárga'
  });


  var thischeckboxMatrix = new CheckboxMatrix({
    id:'checkboxMatrix',
    label: 'CheckboxMatrix',
    parent: dynamic_check_matrix.body,
    cls: 'table table-condensed table-hover',
    rows: ['terence trent D\'arby','Bruce Leeeee'],
    columns : ['barna','zöld','kék','sárga'],
    change: function(obj) {

      console.log(obj.getValue());
      //console.log('RadioMatrix:  '+obj.getValue());
    }
  });

  var dynamic_radio_matrix = new Fieldset({
    id: 'fieldset10',
    cls: '',
    legend: 'dynamic radioMatrix',
    parent: form.body
  });

  var rmatrix_row = new Textarea({
    id:'rmatrix_row',
    label: 'rmatrix_row for dynamic radiomatrix',
    parent: dynamic_radio_matrix.body,
    change: function(obj) {
      var thisVal = obj.getValue();
      if(thisVal !== null) {
        thisradiomatrix.addRows(thisVal.split('\n'));
      }
    },
    value: 'terence trent D\'arby\nBruce Leeeee'
  });

  var rmatrix_column = new Textarea({
    id:'rmatrix_column',
    label: 'rmatrix_column for dynamic radiomatrix',
    parent: dynamic_radio_matrix.body,
    change: function(obj) {
      var thisVal = obj.getValue();
      if(thisVal !== null) {
        thisradiomatrix.addColumns(thisVal.split('\n'));
      }
    },
    value: 'nagyon kedvelem\nkicsit kedvelem\nnem kedvelem\nnagyon nem kedvelem'
  });

  
  var thisradiomatrix = new RadioMatrix({
    id:'RadioMatrix',
    label: 'RadioMatrix',
    parent: dynamic_radio_matrix.body,
    cls: 'table table-condensed table-hover',
    rows: ['terence trent D\'arby','Bruce Leeeee'],
    columns : ['nagyon kedvelem','kicsit kedvelem','nem kedvelem','nagyon nem kedvelem'],
    change: function(obj) {

      console.log(obj.getValue());
      //console.log('RadioMatrix:  '+obj.getValue());
    }
  });


   var thisButton = new Button({
    id:'thisButton',
    label: 'thisButton',
    cls: 'btn btn-large',
    parent: form.body,
    target: '_blank',
    href: 'http://index.hu',
    pressed: function(obj) {
      alert('scoped button pressed' + obj); console.log( obj );
    }
  });

  newestRadio.addOption('bajnai gordon');
  newestRadio.deleteOption('orban viktor');
  text.setValue( 'Terence Trent D\'Arby' );
  text.setLabel( 'Terence Trent D\'Arby' );
  textarea.setValue( 'dalai lama' );
  anothercheckbox.setLabel( 'Bármimás' );
  otherCsheckbox.setLabel( 'jajj, ne már' );
  thisSelect.setValue( 'terence trent D\'arby' );
  thisSelect.setValue( 0 );
  thisRadio.setValue(5);

});
