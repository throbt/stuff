<?php //print_r($this->var['data']); ?>

<div class=""> <!-- hero-unit -->
  <h1><?php echo $this->var['data']['title']; ?></h1>
  
<?php  if($this->var['data']['image'] != 0): ?>
  
  <div class="container">
    <label>Listanézet kép</label>
    <img class="modalGalleryImg" rel="<?php echo $this->var['data']['gallery']; ?>" src="/upload/<?php echo $this->var['data']['gallery']; ?>/<?php echo $this->var['data']['name']; ?>">
  </div>
  
<?php endif; ?>

  <p class="lead"><?php echo $this->var['data']['lead']; ?></p>

  <p class="body"><?php echo $this->var['data']['date_from']; ?> - tól</p>
  
  <p class="body"><?php echo $this->var['data']['date_to']; ?> - ig</p>
  
  <label><strong>aktív:</strong></label>
  <p class="body"><?php echo $this->var['data']['active']; ?></p>
  <label><strong>meta - cím:</strong></label>
  <p class="body"><?php echo $this->var['data']['meta_title']; ?></p>
  <label><strong>meta - kulcsszavak:</strong></label>
  <p class="body"><?php echo $this->var['data']['meta_keywords']; ?></p>
  <label><strong>meta - megjegyzés:</strong></label>
  <p class="body"><?php echo $this->var['data']['meta_desc']; ?></p>

  <p class="body"><?php echo $this->var['data']['body']; ?></p>


  <p>
    <a href="/admin_programmes/<?php echo $this->var['data']['id']; ?>/edit" class="btn btn-primary btn-large">Szerkeszt</a>

    <a href="" class="btn btn-primary btn-large">Megnéz</a>
  </p>
</div>
