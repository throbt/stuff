<?php //print_r( $this->var['data'] ); ?>


<div class="row show-grid">
      <div class="span12">
        <div class="span2">
          <h4>
          <strong>pozíció</strong>
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
        <div class="span2">
          <p>
          <strong>Telefon</strong>
          </p>
        </div>
        <div class="span1">
          <p>
          <strong>Üzenet</strong>
          </p>
        </div>

        <div class="span1">
          <p>
          <strong>cv</strong>
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


                    <?php if($user['position'] != 0): ?>

                    <strong><a href="/admin_positions/<?php echo $user['position'] ?>"><?php echo $user['title'] ?></a></strong>

                    <?php else: ?>

                    <strong><p>üres</p></strong>

                    <?php endif; ?>

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
                   <div class="span2">
                    <p class="editable">
                    <?php echo $user['phone'] ?>
                    </p>
                  </div>

                   <div class="span1">
                    <a class="editable" onclick='$("#dialog-message_<?php echo $user['id'] ?>").dialog({modal:true,buttons:{Ok:function(){$(this).dialog("close");}}})'>
                      megnéz
                    </a>
                    <div id="dialog-message_<?php echo $user['id'] ?>" title="felhasznalói üzenet" style="display:none" >
	                    <p>
		                    <?php echo $user['message'] ?>
	                    </p>
                    </div>

                  </div>

                  <div class="span1">
                    <p>
                    <strong><a target="_blank" href="/admin_candidates/dload/<?php echo $user['id'] ?>">download</a></strong>
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
