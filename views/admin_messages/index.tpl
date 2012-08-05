<?php //print_r( $this->var['data'] ); ?>


<div class="row show-grid">
      <div class="span12">
        <div class="span2">
          <h4>
          <strong>id</strong>
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
          <strong>Tárgy</strong>
          </p>
        </div>
        <div class="span1">
          <p>
          <strong>Üzenet</strong>
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
                    <strong><?php echo $user['id'] ?></strong>
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
                   <div class="span2">
                    <p class="editable">
                    <?php echo $user['subject'] ?>
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

              </div>
            </div>


<?php
      endforeach;
?>

<?php

  echo $this->var['paginator'];
?>
