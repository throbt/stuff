<link rel='stylesheet' type='text/css' href='/css/calendar.css' />
<script src="/js/calendar.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		Calendar.render('calendar_holder_sider'/*,'79,9,24'*/);
		$('.pick').live("click", function() {
			alert(this.innerHTML);
		}); 
		$('.picker_control').live("click", function() {
			Calendar.setDate($(this).attr('rel'));
		});
	});
</script>
<div id="calendar_center_header">
</div>
<div id="calendar_left_margin">
</div>
<div id="calendar_holder_sider">
</div>
<div id="calendar_right_margin">
</div>