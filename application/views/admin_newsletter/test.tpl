<script>
  $(document).ready(function() {
    $('#thisSubmit').click(function() {
      arr = {};
      $('.emails').each(function() {
        if($(this).val() != '') {
          arr[this.id] = $(this).val();
        }
      });
      $.get(
        '/admin_ajax/test_mail?id='+$('#id').val(),
        arr,
        function(resp) {
          console.log(resp);
        }
      );
      
      return false;
    });
  });
</script>
<?php
  echo $this->var['data'];
?>
