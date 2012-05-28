	<?php //print_r($this->var); ?>
  <ul id="mainmenu">  
		<?php foreach($this->var as $menu): ?>
      <?php if($menu['url'] == $this->scope->router->scope): ?>
        <li><a  class="active" href="/<?php echo $menu['url'] ?>"><?php echo $menu[$_SESSION['language']]; ?></a></li>
      <?php else: ?>
        <li><a href="/<?php echo $menu['url'] ?>"><?php echo $menu[$_SESSION['language']]; ?></a></li>
      <?php endif; ?>
    <?php endforeach; ?>
	</ul>
