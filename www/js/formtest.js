$(document).ready(function() {

	init();

	// $('.gridElement').each(function() {
	// 	$(this).grid();
	// });

	$('.gridElement').grid();

});

var init = function() {
	var form = new Form({
    id: 'thisForm',
    method: 'post',
    multipart: true,
    cls: 'form-horizontal',
    parent: $('.container').get()[0],
    action: 'valahova'
  });

  var fieldset = new Fieldset({
		id: 'fieldset',
		cls: 'gridElement',
		legend: 'multiple text 0',
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

	var fieldset1 = new Fieldset({
		id: 'fieldset1',
		cls: 'gridElement',
		legend: 'multiple text 1',
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
		legend: 'multiple text 2',
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
}