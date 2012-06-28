<div class="container">

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li>
    <a href="/node/types">Tartalom típusok</a>
    <span class="divider">/</span>
  </li>
  <li>
    <a href="/node/types/<?php echo $this->var['type']; ?>"><?php echo $this->var['type']; ?></a>
    <span class="divider">/</span>
    
  </li>
  <li class="active">
    <?php echo (isset($this->var['node'][0]['title']) ? $this->var['node'][0]['title'] : "Új {$this->var['type']}"); ?>
  </li>
</ul>

<?php
  echo $this->var['data'];
?>
</div>