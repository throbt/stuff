<?php //print_r($this->var['data']); ?>

<script>
$(document).ready(function() {
  $('.del').click(function() {
    $.get(
      '/admin_ajax/delNewsLetEmail',
      {'id': $(this).attr('rel')},
      function(resp) {
        if(resp == 'true') {
          window.location.reload()
        } else {
          alert('nem sikerult törölni az emailt');
        }
      }
    );
  });
});
</script>

<div class="row show-grid">
  <div class="span12">
    <a id="sbm" class="btn btn-primary save" type="submit" href="/admin_newsletter/email_add">Új email</a>
  </div>
</div>


<div class="row show-grid">
  &nbsp;
</div>

<div class="row show-grid">
      <div class="span12">
        <div class="span2">
          <h4>
          <a class="" href="">Id</a>
          </h4>
        </div>
        <div class="span2">
          <p>
          <strong>Cím</strong>
          </p>
        </div>
        <div class="span2">
          <p>
          <strong>created date</strong>
          </p>
        </div>

        <div class="span2">
          <p>
          <strong>opció</strong>
          </p>
        </div>

        <div class="span2">
          <p>
          <strong>opció</strong>
          </p>
        </div>


    </div>
  </div>

<?php
      foreach($this->var['data'] as $email):
?>

  <div class="row show-grid" style="margin-top:5px;">
                <div class="span12">
                  <div class="span2">
                    <h4>
                      <?php echo $email['id'] ?>
                    </h4>
                  </div>
                  <div class="span2">
                    <p class="editable">
                    <a href="/admin_newsletter/emails/<?php echo $email['id'] ?>"><?php echo $email['title'] ?></a>
                    </p>
                  </div>
                  <div class="span2">
                    <p class="editable">
                    <?php echo $email['created'] ?>
                    </p>
                  </div>

                  <div class="span2">
                    
                    <a class="btn btn-primary" rel="<?php echo $email['id'] ?>" href="/admin_newsletter/emails/<?php echo $email['id'] ?>/edit">szerkeszt</a>
                    
                  </div>

                  <div class="span2">
                    
                    <a class="btn btn-primary del" rel="<?php echo $email['id'] ?>" href="">töröl</a>
                    
                  </div>
                  
              </div>
            </div>


<?php
      endforeach;
?>

<?php echo $this->var['paginator']; ?>