<?php //print_r($this->var['data']); ?>

<div class=""> <!-- hero-unit -->
  <h1><?php echo $this->var['data']['title']; ?></h1>

  <p class="lead"><?php echo $this->var['data']['lead']; ?></p>


  <p class="body"><?php echo $this->var['data']['body']; ?></p>


  <p>
    <a href="/admin_articles/<?php echo $this->var['data']['id']; ?>/edit" class="btn btn-primary btn-large">Szerkeszt</a>

    <a href="" class="btn btn-primary btn-large">Megnéz</a>
  </p>
</div>
