<?php
  //print_r($this->menu); die();
?>

<ul id="navigation">
  <?php foreach($this->menu as $menu): ?>
    <?php if($menu['route'] == $this->thisRoute): ?>
      <li><a class="active" href="/<?php echo $menu['route'] ?>"><?php echo $menu['name'] ?></a></li>
    <?php else: ?>
      <li><a href="/<?php echo $menu['route'] ?>"><?php echo $menu['name'] ?></a></li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>
<!--li><span class="active"><?php echo $menu['name'] ?></span></li-->
