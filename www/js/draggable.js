$(document).ready(function() {
  
  var form = new Form({
    id: 'thisForm',
    method: 'post',
    multipart: true,
    cls: 'form-horizontal',
    parent: $('.container').get()[0],
    action: 'valahova'
  });

  var text = new Text({
    id:'valami',
    label: 'testValami',
    parent: form.body,
    change: function(obj) {
      console.log('text this scope value:  '+obj.getValue());
    },
    value: 'Bajnai Gordon'
  });

  var thattext = new Text({
    id:'thattext',
    label: 'thattext',
    parent: form.body,
    disabled: true,
    change: function(obj) {
      console.log('thattext this scope value:  '+obj.getValue());
    },
    value: 'Barack Obama'
  });

  var password = new Password({
    id:'password',
    label: 'Password',
    parent: form.body,
    change: function(obj) {
      console.log('password this scope value:  '+obj.getValue());
    },
    value: 'Bajnai Gordon'
  });

  var textarea = new Textarea({
    id:'masvalami',
    label: 'masvalami',
    parent: form.body,
    change: function(obj) {
      console.log('textarea this scope value:  '+obj.getValue());
    },
    value: 'orbán viktor'
  });

  var checkbox = new Checkbox({
    id:'thisCheck',
    label: 'thisCheckBox',
    parent: form.body,
    value: 'orbán viktor',
    change: function(obj) {
      alert('checkbox clicked:  '+obj.getValue());
    },
    checked: false
  });

  var otherCsheckbox = new Checkbox({
    id:'othercheckbox',
    label: 'othercheckbox',
    parent: form.body,
    value: 'bla bla bla',
    change: function(obj) {
      alert('checkbox:  '+obj.getValue());
    },
    checked: true
  });

  var anothercheckbox = new Checkbox({
    id:'anothercheckbox',
    label: 'anothercheckbox',
    parent: form.body,
    value: 'bajnai gordon',
    change: function(obj) {
      alert('checkbox:  '+obj.getValue()+'  :  '+obj.getLabel()+'  :  '+obj.isChecked());
    },
    checked: true
  });

  var thisSelect = new Select({
    id:'selectBox',
    label: 'selectBox',
    parent: form.body,
    options: ['orban viktor','terence trent D\'arby','bajnai gordon','dalai lama'],
    change: function(obj) {
      alert('thisSelect  scope:  '+obj.getValue());
    },
    selected: 'terence trent D\'arby'
  });

  var thisRadio = new Radio({
    id:'radios',
    label: 'radios',
    parent: form.body,
    options: ['orban viktor','terence trent D\'arby','bajnai gordon','dalai lama','martin heidegger','kurt Cobain','Gyurcsány Ferenc'],
    change: function(obj) {
      alert('Radio scoped:  '+obj.getValue());
    },
    selected: 0
  });

  var newesttextarea = new Textarea({
    id:'testTextArea',
    label: 'testTextArea for dynamic select',
    parent: form.body,
    change: function(obj) {
      //AnotherSelect.addOptions( obj.getValue().split('\n') );
    },
    value: 'ez mar dinamikusan epiti a select boxot alabb'
  });

  var AnotherSelect = new Select({
    id:'selectBox2',
    label: 'selectBox2',
    parent: form.body,
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

  var newestesttextarea = new Textarea({
    id:'testTextAreasss',
    label: 'testTextArea for dynamic radio',
    parent: form.body,
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


  var rmatrix_row = new Textarea({
    id:'rmatrix_row',
    label: 'rmatrix_row for dynamic radiomatrix',
    parent: form.body,
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
    parent: form.body,
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
    parent: form.body,
    cls: 'table table-condensed table-hover',
    rows: ['terence trent D\'arby','Bruce Leeeee'],
    columns : ['nagyon kedvelem','kicsit kedvelem','nem kedvelem','nagyon nem kedvelem'],
    change: function(obj) {

      console.log(obj.getValue());
      //console.log('RadioMatrix:  '+obj.getValue());
    }
  });




  var custominput = new MultipleNumber({
    id:'cvalami',
    label: 'custom number input',
    parent: form.body,
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




   var thisButton = new Button({
    id:'thisButton',
    label: 'thisButton',
    cls: 'btn btn-large btn-success',
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
