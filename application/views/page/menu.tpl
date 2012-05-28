	<?php //print_r($this->var['scope']); ?>
  <ul id="mainmenu">  
		<?php foreach($this->var['menu'] as $menu): ?>
      <?php if($menu['url'] == $this->scope->router->scope): ?>
        <li><a  class="active" href="/<?php echo $this->link($menu['url']); ?>"><?php echo $menu[$_SESSION['language']]; ?></a></li>
      <?php else: ?>
        <li><a href="/<?php echo $this->link($menu['url']); ?>"><?php echo $menu[$_SESSION['language']]; ?></a></li>
      <?php endif; ?>
    <?php endforeach; ?>
	</ul>
