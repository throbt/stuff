<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="/admin_content">Evoline - admin</a>
			<div class="nav-collapse">
				<ul class="nav">
					<?php foreach($this->var as $menu): ?>
						<?php if($menu['url'] == $this->scope->router->scope): ?>
							<!-- <li class="active"><a href="/<?php echo $menu['url'] ?>"><?php echo $menu['hu']; ?></a></li> -->
						<?php else: ?>
							<!-- <li><a href="/<?php echo $menu['url'] ?>"><?php echo $menu['hu']; ?></a></li> -->
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<ul class="nav pull-right">
					<li>
						<a href="/login/logout">kilépés</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>