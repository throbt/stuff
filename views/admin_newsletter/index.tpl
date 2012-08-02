<?php ?>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <!-- <li>
    <a href="/node/nodetype/menu">Menüpontok</a>
    <span class="divider">/</span>
  </li> -->
  <li class="active">
    Feliratkozott userek
  </li>
</ul>

<script>
$(document).ready(function() {
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

<div class="row show-grid">
  <div class="span12">
    <a id="sbm" class="btn btn-primary save" type="submit" href="/admin_newsletter/emails">Hírlevél küldése</a>
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
          <strong>Név</strong>
          </p>
        </div>
        <div class="span2">
          <p>
          <strong>Email</strong>
          </p>
        </div>
        <div class="span1">
          <p>
          <strong>aktív</strong>
          </p>
        </div>
        <div class="span1">
          <p>
          <strong>reg date</strong>
          </p>
        </div>
        <div class="span1">
          <p>
          <strong>unreg date</strong>
          </p>
        </div>
    </div>
  </div>

<?php
      foreach($this->var['data'] as $user):
?>


              <div class="row show-grid">
                <div class="span12">
                  <div class="span2">
                    <h4>
                      <?php echo $user['id'] ?>
                    </h4>
                  </div>
                  <div class="span2">
                    <p class="editable">
                    <?php echo $user['name'] ?>
                    </p>
                  </div>
                  <div class="span2">
                    <p class="editable">
                    <?php echo $user['email'] ?>
                    </p>
                  </div>
                  <div class="span1">
                    <p>
                    <strong>aktív</strong>

                    <?php if($user['active'] == 'true') { $active = ' checked="true" '; } else { $active = ''; } ?>

                    <input id="active<?php echo $user['id'] ?>" class="active" type="checkbox" <?php echo $active; ?> rel="<?php echo $user['id'] ?>" model="Newsletter">

                    </p>
                  </div>
                  <div class="span1">
                    <p>
                    <?php echo $user['adate'] ?>
                    </p>
                  </div>
                  <div class="span1">
                    <p>
                    <?php echo $user['iadate'] ?>
                    </p>
                  </div>
              </div>
            </div>


<?php
      endforeach;
?>


<?php

  echo $this->var['paginator'];
?>
