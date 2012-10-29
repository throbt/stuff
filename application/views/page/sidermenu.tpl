<?php
?>
<ul class="nav nav-tabs nav-stacked">
  <?php foreach($this->var['nodes'] as $node): ?>
    <?php
      $current = '';
      if((int)$node['id'] == (int)$this->var['current']) {
        $current = 'active';
      }
    ?>
    <li class="<?php echo $current; ?>">
      <a href="/<?php echo $this->var['scope']->scope->router->link("{$this->var['route']}/{$node['id']}"); ?>">
        <?php echo $node['short_name']; ?>
        <i class="icon-chevron-right"></i>
      </a>
    </li>
  <?php endforeach; ?>
</ul>