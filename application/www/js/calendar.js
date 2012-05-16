var Calendar = {

	render: function(id,date) {
		this.id 	= id;
		this.date = {};
		this.getDate(typeof date != 'undefined' ? date : null);
		this.getHeader();

		var days 		= this.getDays(),
				header 	= this.getHeader();

		$(['#',id].join('')).html([
			'<div id="calendar_wrapper">',
				'<div id="calendar_header">',
					'<div id="left_control_month" rel="month-" class="picker_control">',
					'</div>',
					'<div id="left_control_year" rel="year-" class="picker_control">',
					'</div>',
					'<div id="display" class="picker_display">',
						'<p id="thisMonth">',
							this.getMonth()[this.date.month],
						'</p>',
						'<p id="thisYear">',
							this.date.year,
						'</p>',
					'</div>',
					'<div id="right_control_year" rel="year+" class="picker_control">',
					'</div>',
					'<div id="right_control_month" rel="month+" class="picker_control">',
					'</div>',
				'</div>',
				'<table>',
					'<thead>',
					/*header,*/
					'</thead>',
					'<tbody>',
					days,
					'</tbody>',
				'</table>',
			'</div>'
		].join(''));
	},

	setDate: function(newDate) {
		var thisDateHash = []; 
		switch(newDate) {
			case 'month+':
				if(this.date.month == 12) {
					thisDateHash[1] = 1;
					thisDateHash[0] = this.date.year + 1;
				} else {
					thisDateHash[1] = this.date.month + 1;
					thisDateHash[0] = this.date.year;
				}
			break;
			case 'month-':
				if(this.date.month == 1) {
					thisDateHash[1] = 12;
					thisDateHash[0] = this.date.year - 1;
				} else {
					thisDateHash[1] = this.date.month - 1;
					thisDateHash[0] = this.date.year;
				}
			break;
			case 'year+':
				thisDateHash[1] = this.date.month;
				thisDateHash[0] = this.date.year + 1;
			break;
			case 'year-':
				thisDateHash[1] = this.date.month;
				thisDateHash[0] = this.date.year - 1;
			break;
		}
		thisDateHash[2] = this.date.day;
		this.render(this.id,thisDateHash.join(','));
	},

	getMonth: function() {
		return {
			1 	: 'Január',
			2 	: 'Február',
			3 	: 'Március',
			4 	: 'Április',
			5 	: 'Május',
			6 	: 'Június',
			7 	: 'Július',
			8 	: 'Augusztus',
			9 	: 'Szeptember',
			10 	: 'Október',
			11 	: 'November',
			12 	: 'December'
		}
	},

	getDate: function(date) { //79,5,24
		if(date == null) {
			this.date.current 			= new Date();
			this.dateCurrent				= this.date.current;
			this.dateCurrent.month 	= (this.date.current.getMonth()+1);
			this.dateCurrent.year 	= this.date.current.getFullYear();
		} else {
			this.date.current 			= new Date(date);
			this.dateCurrent 				= new Date();
			this.dateCurrent.month 	= (this.dateCurrent.getMonth()+1);
			this.dateCurrent.year 	= this.dateCurrent.getFullYear();
		}

		this.date.year      = this.date.current.getFullYear();
		this.date.month     = (this.date.current.getMonth()+1);
		this.date.dayWeekly = this.date.current.getDay();
		this.date.dayFirst  = new Date(this.date.year,(this.date.month-1),1).getDay();
		this.date.day       = this.date.current.getDate();
	},

	getHeader: function() {
		var header 	= [],
				days 		= [
					'Va',
					'Hé',
					'Ke',
					'Sze',
					'Csü',
					'Pé',
					'Szo'
		];
		for(var i in days) {
			header.push(['<th class="weekly">',days[i],'</th>'].join(''));
		}
		return ['<tr>',header,'</tr>'].join('');
	},

	getDays: function() {

		var self					= this,
		    arr           = [],
		    days          = [],
		    day           = '',
		    bgColor       = '',
		    color         = '',
		    thisMonth     = null,
		    monthlengths  = [],
		    dayCounter		= 1,
		    cells 				= [];

		(this.date.year%4) > 0 ? monthlengths = [0,31,28,31,30,31,30,31,31,30,31,30,31] : monthlengths = [0,31,29,31,30,31,30,31,31,30,31,30,31];
		thisMonth = monthlengths[(this.date.month)];

		for(var i = 0;i <= thisMonth; i++){
		    days.push(i);
		}

		var currDay = 0;

		for(var i = -this.date.dayFirst; i <= thisMonth; i++) {
			currDay = $.inArray(i,days) != -1 ? i : '';

			if(i != 0) {
				if(dayCounter == 1) {
					cells.push('<tr>');
					if(i == this.date.day && this.dateCurrent.month == this.date.month && this.dateCurrent.year == this.date.year)
						cells.push(['<td class="current"><span class="pick currentday">',currDay,'</span></td>'].join(''));
					else
						cells.push(['<td><span class="pick day">',currDay,'</span></td>'].join(''));
				} else if(dayCounter == 7) {
					if(i == this.date.day && this.dateCurrent.month == this.date.month && this.dateCurrent.year == this.date.year)
						cells.push(['<td class="current"><span class="pick currentday">',currDay,'</span></td>'].join(''));
					else
						cells.push(['<td><span class="pick day">',currDay,'</span></td>'].join(''));
					cells.push('</tr>');
					dayCounter = 0;
				} else {
					if(i == this.date.day && this.dateCurrent.month == this.date.month && this.dateCurrent.year == this.date.year)
						cells.push(['<td class="current"><span class="pick currentday">',currDay,'</span></td>'].join(''))
					else
						cells.push(['<td><span class="pick day">',currDay,'</span></td>'].join(''))
				}
				dayCounter++;
			}
		}

		return cells.join('');
	}
};