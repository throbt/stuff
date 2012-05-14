	<ul id="mainmenu">
		<?php foreach($this->var as $menu): ?>
			<li><a href="/<?php echo $menu['url'] ?>"><?php echo $menu[$_SESSION['language']]; ?></a></li>
		<?php endforeach; ?>
	</ul>
