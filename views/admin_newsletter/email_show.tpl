<?php
  //print_r($this->var['data']);
?>

<?php //print_r($this->var['data']); ?>

<div class=""> <!-- hero-unit -->
  <h1><?php echo $this->var['data']['title']; ?></h1>
  
<?php  if($this->var['data']['image'] != 0): ?>
  
  <div class="container">
    <label>hozzáadott kép</label>
    <img class="modalGalleryImg" rel="<?php echo $this->var['data']['gallery']; ?>" src="/upload/<?php echo $this->var['data']['gallery']; ?>/<?php echo $this->var['data']['name']; ?>">
  </div>
  
<?php endif; ?>

  
  <p class="body"><?php echo $this->var['data']['body']; ?></p>

</div>



<a class="btn btn-primary btn-large" href="/admin_newsletter/emails/<?php echo $this->var['data']['id']; ?>/edit">Szerkeszt</a>
<a class="btn btn-primary btn-large" href="/admin_newsletter/emails/<?php echo $this->var['data']['id']; ?>/test">Tesztküldés</a>
<a class="btn btn-primary btn-large" href="/admin_newsletter/emails/<?php echo $this->var['data']['id']; ?>/sendmail">Küldés</a>
