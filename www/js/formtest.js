$(document).ready(function() {


	$('#pageWrapper').html('');
	init();
  initControllers(); //controllers

	// $('.gridElement').each(function() {
	// 	$(this).grid();
	// });

	$('.gridElement').grid();

	// rTmatrix_row.setup();
	// rTmatrix_column.setup();
	// thischeckboxMatrix.setup();

});

var initControllers = function() {
  var thisFSET = new Fieldset({
    id: 'thisFiledset',
    cls: '',
    legendCls: '',
    legend: 'controllers',
    parent: $('#debugger')[0]
  });
  window.thisDebugger = new Text({
    id:'debugger',
    label: 'debugger',
    parent: thisFSET.body,
    change: function(obj) {
      //console.log('text this scope value:  '+obj.getValue());
    },
    value: 'debug'
  });

  var thisFSET1 = new Fieldset({
    id: 'thisFiledset1',
    cls: '',
    legendCls: '',
    legend: '',
    parent: $('#debugger')[0]
  });
  window.debText = new Textarea({
    id:'debugger1',
    label: 'debugger1',
    parent: thisFSET1.body,
    change: function(obj) {
      //console.log('text this scope value:  '+obj.getValue());
    },
    value: 'debug'
  });

  window.debText2 = new Textarea({
    id:'debugger10',
    label: 'debugger10',
    parent: thisFSET1.body,
    change: function(obj) {
      //console.log('text this scope value:  '+obj.getValue());
    },
    value: 'debug'
  });

  window.thisButton1 = new Button({
    id:'thisButton1',
    label: 'get order',
    cls: 'btn btn-large',
    parent: thisFSET1.body,
    pressed: function(obj) {
      window.debText.setValue( Grid.getOrder() );
    }
  });

  window.thisButton2 = new Button({
    id:'thisButton2',
    label: 'resort',
    cls: 'btn btn-large',
    parent: thisFSET1.body,
    pressed: function(obj) {
      Grid.reSort();
      window.debText.setValue( Grid.getOrder() );
    }
  });
};

var init = function() {


	var form = new Form({
    id: 'thisForm',
    method: 'post',
    multipart: true,
    cls: 'form-horizontal',
    parent: $('#pageWrapper').get()[0],
    action: 'valahova'
  });

  var fieldset = new Fieldset({
		id: 'fieldset',
		cls: 'gridElement',
		legendCls: 'anchor',
		legend: 'pos 0',
		parent: form.body
  });

	var custominput = new MultipleNumber({
		id:'cvalami',
		label: 'custom number input',
		parent: fieldset.body,
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
		}],
		value: ''
	});








	/*var dynamic_check_matrix = new Fieldset({
    id: 'fieldset10',
    cls: 'gridElement',
    legendCls: 'anchor',
    legend: 'dynamic checkboxMatrix',
    parent: form.body
  });

  window.rTmatrix_row = new Textarea({
    id:'rTmatrix_row',
    label: 'checkBoxmatrix_row for dynamic CheckboxMatrix',
    parent: dynamic_check_matrix.body,
    change: function(obj) { console.log(obj);
      var thisVal = obj.getValue();
      if(thisVal !== null) {
        thischeckboxMatrix.addRows(thisVal.split('\n'));
      }
      Grid.rerender();
    },
    value: 'terence trent D\'arby\nBruce Leeeee'
  });

  window.rTmatrix_column = new Textarea({
    id:'rTmatrix_column',
    label: 'checkBoxmatrix_column for dynamic CheckboxMatrix',
    parent: dynamic_check_matrix.body,
    change: function(obj) { 
      var thisVal = obj.getValue();
      if(thisVal !== null) {
        thischeckboxMatrix.addColumns(thisVal.split('\n'));
      }
      Grid.rerender();
    },
    value: 'barna\nzöld\nkék\nsárga'
  });


  window.thischeckboxMatrix = new CheckboxMatrix({
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
  });*/





	/*var checkboxes_legend = new Fieldset({
    id: 'fieldset4',
    cls: 'gridElement',
		legendCls: 'anchor',
    legend: 'pos 1',
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
  });*/







	var fieldset1 = new Fieldset({
		id: 'fieldset1',
		cls: 'gridElement',
		legendCls: 'anchor',
		legend: 'pos 2',
		parent: form.body
  });

	var custominput1 = new MultipleNumber({
		id:'cvalami1',
		label: 'custom number input',
		parent: fieldset1.body,
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
			selected: 2
		},{
			type: 'text',
			len: 'col2',
			value: '7654321'
		}],
		value: ''
	});

	var fieldset2 = new Fieldset({
		id: 'fieldset1',
		cls: 'gridElement',
		legendCls: 'anchor',
		legend: 'pos 3',
		parent: form.body
	});

	var custominput2 = new MultipleNumber({
		id:'cvalami2',
		label: 'custom number input',
		parent: fieldset2.body,
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
			selected: 0
		},{
			type: 'text',
			len: 'col2',
			value: '1111111'
		}],
		value: ''
	});

	var fieldset3 = new Fieldset({
		id: 'fieldset3',
		cls: 'gridElement',
		legendCls: 'anchor',
		legend: 'pos 4',
		parent: form.body
	});

	var custominput3 = new MultipleNumber({
		id:'cvalami3',
		label: 'custom number input',
		parent: fieldset3.body,
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
			selected: 0
		},{
			type: 'text',
			len: 'col2',
			value: '1111111'
		}],
		value: ''
	});

	var fieldset4 = new Fieldset({
		id: 'fieldset4',
		cls: 'gridElement',
		legendCls: 'anchor',
		legend: 'pos 5',
		parent: form.body
	});

	var custominput4 = new MultipleNumber({
		id:'cvalami4',
		label: 'custom number input',
		parent: fieldset4.body,
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
			selected: 0
		},{
			type: 'text',
			len: 'col2',
			value: '1111111'
		}],
		value: ''
	});
}