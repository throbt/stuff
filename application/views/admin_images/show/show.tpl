<?php ?>

<div class=""> <!-- hero-unit -->
  <h1><?php echo $this->var['data']['title']; ?></h1>

  <p class="lead"><?php echo $this->var['data']['lead']; ?></p>

  <p class="lead">galéria:  <?php echo $this->var['data']['thisGallery']; ?></p>

  <?php
    $link = "/upload/{$this->var['data']['gallery']}/{$this->var['data']['name']}";
  ?>

  <!-- <div class="span4"> -->
    <a href="<?php echo $link; ?>" class="thumbnail">
      <img src="<?php echo $link; ?>" />
    </a>
  <!-- <div> -->

  <p>&nbsp;</p>
  <p>

    <a href="/admin_images/<?php echo $this->var['data']['id']; ?>/edit" class="btn btn-primary btn-large">Szerkeszt</a>

    <!--a href="" class="btn btn-primary btn-large">Megnéz</a-->
  </p>
</div>