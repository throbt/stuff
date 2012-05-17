<?php
	global $loader;
	$main = $loader->get('Admin','helper',$this->var['scope']);
?>
<!DOCTYPE html>
<html lang=<?php echo $_SESSION['language']; ?>>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<?php echo $main->getHeader(); ?>
		<script>
			$(document).ready(function() {
				
				$.extend($.fn.datepicker.defaults, {
	        parse: function (string) {
	          var matches;
	          if ((matches = string.match(/^(\d{2,2})\/(\d{2,2})\/(\d{4,4})$/))) {
	            return new Date(matches[3], matches[1] - 1, matches[2]);
	          } else {
	            return null;
	          }
	        }/*,
	        format: function (date) {
	          var
	            month = (date.getMonth() + 1).toString(),
	            dom = date.getDate().toString();
	          if (month.length === 1) {
	            month = "0" + month;
	          }
	          if (dom.length === 1) {
	            dom = "0" + dom;
	          }
	          return month + "/" + dom + "/" + date.getFullYear();
	        }*/
	      });  

				$(function() {
					//$.datepicker.setDefaults('yy-mm-dd');
					$(".datep").datepicker();
				});
				
				$('.active').change(function() {
				  var gets = {
				    'active': this.checked,
				    'model':  $(this).attr('model'),
				    'id':     $(this).attr('rel')
				  };
				  $.get(
				    '/admin_ajax/setActive',
				    gets,
				    function(resp) {
				      if(resp != 'false')
                window.location.reload();
				    }
				  );
				});
			});
		</script>
	</head>
	<body data-offset="50" data-target=".subnav" data-spy="scroll" data-twttr-rendered="true">
		
		
		<?php echo $main->getMenu(); ?>


		<div class="container">
			<?php echo $this->var['data']; ?>
		</div>
	</body>
</html>
