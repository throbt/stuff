<?php
  //echo $this->var['data'];
?>

<div class="page_title">
  <h3 class="first_article_title"><?php echo $this->var['scope']->title; ?></h3>
</div>

<div id="booking_header_padding">
</div>
<div id="booking__content_wrapper">

  <div id="booking_content_left">
    <script src="/js/datepicker.js" type="text/javascript"></script>
    <div id="booking_datepicker_wrapper">
      <script>

        $(document).ready(function() {
          Datepicker.render('booking_datepicker'/*,'79,9,24'*/);
            $('.picker').live("click", function() {
              $('#bookin_day').val(getDate(this.innerHTML));
            });
            $('.picker_control_date').live("click", function() {
              Datepicker.setDate($(this).attr('rel'));
            });
        });

        var getDate = function(day) {
          var day       = (parseInt(day) < 10 ? '0'+ day : day),
              thisMonth = Datepicker.date.month,
              month     = (parseInt(thisMonth) < 10 ? '0'+ thisMonth : thisMonth),
              year      = Datepicker.date.year;
              
          return [
            year,
            '-',
            month,
            '-',
            day
          ].join('');
        }
      </script>
      <div id="booking_datepicker">
        <!-- <div id="booking_datepicker_header">

        </div> -->
      </div>

    </div>

  </div>
  <div id="booking_content_right">
    <div id="booking_form_wrapper">

        <h3 style="margin-left:10px;">A foglalás adatai:</h3>

        <?php echo $this->var['form']; ?>
    </div>
  </div>

</div>
<div style="margin-left:32px;">
  <img src="/img/booking_decor.png" />
</div>