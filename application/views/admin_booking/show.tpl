<?php //print_r($this->var['data']); ?>

<div class=""> <!-- hero-unit -->
  <h1><?php echo $this->var['data']['title']; ?></h1>
  
  <label><strong>telefon:</strong></label>
  <p class="body"><?php echo $this->var['data']['phone']; ?></p>
  


  <label><strong>email:</strong></label>
  <p class="body"><?php echo $this->var['data']['email']; ?></p>

  <label><strong>személyek száma:</strong></label>
  <p class="body"><?php echo $this->var['data']['persons']; ?></p>


  <label><strong>időpont:</strong></label>
  <p class="body"><?php echo $this->var['data']['booking_time']; ?></p> 


  <label><strong>megjegyzés:</strong></label>
  <p class="body"><?php echo $this->var['data']['body']; ?></p>

  <?php if($this->var['data']['title'] == 'index_action'): ?>

    <a href="/admin_booking/<?php echo $this->var['data']['id']; ?>/edit" class="btn btn-primary btn-large">Szerkeszt</a>

  <?php endif; ?>

</div>
