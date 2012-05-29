<?php
  //print_r($this->var['data']);
?>
<div class="row show-grid">
  <label>Aktív userek:</label>
  <p class="lead"><?php echo $this->var['data']['active']; ?></p>
</div>

<div class="row show-grid">
  <label>Inaktív userek:</label>
  <p class="lead"><?php echo $this->var['data']['inactive']; ?></p>
</div>

<div class="row show-grid">
  <a id="sbm" class="btn btn-primary save" type="submit" href="/admin_newsletter/emails/<?php echo $this->var['data']['index']; ?>/send">Emailek elküldése</a>
</div>
