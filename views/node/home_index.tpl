<?php  //print_r($this->var['data']); //die();
  $form       = $this->var['scope']->router->loader->get('Form');
  $paginator  = $this->var['paginator'];
?>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <!-- <li>
    <a href="/node/types">Tartalom típusok</a>
    <span class="divider">/</span>
  </li> -->
  <li class="active">
    <?php echo $this->var['type']; ?>
  </li>
</ul>

<div class="row show-grid">
  <div class="span12">
    <div class="span2">
      <a id="sbm" class="btn btn-toggle" href="/node/add/<?php echo $this->var['type']; ?>" type="submit">Új <?php echo $this->var['type']; ?></a>
    </div>
  </div>
  <div class="span12">
  &nbsp;
  </div>
</div>

<div class="row show-grid">

    <div class="span12">
      <div class="span2">
        <h4><a class="" href="">Cím</a></h4>
      </div>
      <div class="span2">
        <p>
          <strong>létrehozva</strong>
        </p>
      </div>
      <div class="span2">
        <p>
          <strong>utolsó szerkesztés</strong>
        </p>
      </div>
      <div class="span1">
        <p>
          <strong>aktív</strong>
        </p>
      </div>
      <!-- <div class="span1">
        opció
      </div> -->
      <div class="span1">
        opció
      </div>
    </div> <br /><br /><br />

    <div class="span12">&nbsp;</div>

    <?php if(gettype($this->var['data']) != 'NULL'): ?>

    <?php foreach($this->var['data'] as $node): ?>

      <?php if(isset($node['params'])): ?>

      <div class="span12">
        <div class="span2">
          <h4><a class="" href="/node/update/<?php echo $this->var['type']; ?>/<?php echo $node['nid']; ?>"><?php echo $node['params']['title']; ?></a></h4>
        </div>
        <div class="span2">
          <p>
            <?php echo $node['created']; ?>
          </p>
        </div>
        <div class="span2">
          <p>
            <?php echo $node['edited']; ?>
          </p>
        </div>
        <div class="span1">

          <?php if($node['active'] == 1): ?>
            <input model="$node" type="checkbox" rel="<?php echo $node['nid']; ?>" id="active<?php echo $node['nid']; ?>" checked="true" class="active" />
          <?php else: ?>
            <input model="$node" type="checkbox" rel="<?php echo $node['nid']; ?>" id="active<?php echo $node['nid']; ?>" class="active" />
          <?php endif; ?>

      </div>
        <div class="span1">
          <a class="btn btn-danger delete" rel="<?php echo $node['nid']; ?>">Törlés</a>
        </div>
      </div>
      <br /><br /><br />

      <?php endif; ?>

    <?php endforeach; ?>
  <?php else: ?>
    <div class="span12">
      <div class="span6">
        <h3>nincs még feltöltve ilyen tartalom</h3>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php echo $paginator; ?>
