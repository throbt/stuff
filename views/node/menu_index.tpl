<?php  //print_r(gettype($this->var['data'])); die();
  $form       = $this->var['scope']->router->loader->get('Form');
  $paginator  = $this->var['paginator'];
?>

<script>
  var sortable_hook = function() {
    var result = [];
    $('#sortable_list > .sortable').each(function(item) {
      result.push($(this).attr('rel'));
    });

    $.get(
      '/admin_ajax/sortableMenu',
      {menus: result},
      function(resp) {
         window.location.reload();
      }
    );
  }
</script>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <!-- <li>
    <a href="/node/nodetype/menu">Menüpontok</a>
    <span class="divider">/</span>
  </li> -->
  <li class="active">
    Menüpontok
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


    <ul id="">
      <li>
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
          <div class="span1">
            <p>
              <strong>nyelv</strong>
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
      </li>
    </ul>



    <?php if(gettype($this->var['data']) != 'NULL'): ?>

<ul id="sortable_list">

      <?php foreach($this->var['data'] as $node): ?>
        <li id="item<?php echo $node['nid']; ?>" rel="<?php echo $node['nid']; ?>" class="sortable">
        <div class="span12 handle">
          <div class="span2">
            <h4><a class="" href="/node/update/<?php echo $this->var['type']; ?>/<?php echo $node['nid']; ?>"><?php echo $node['title']; ?></a></h4>
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
            <p>
              <?php echo $node['lang']; ?>
            </p>
          </div>

          <div class="span1">
            <a class="btn btn-danger delete" rel="<?php echo $node['nid']; ?>">Törlés</a>
          </div>
        </div>
        <br /><br /><br />
      <?php endforeach; ?>
    <?php else: ?>
      <div class="span12">
        <div class="span6">
          <h3>nincs még feltöltve ilyen tartalom</h3>
        </div>
      </div>
    <?php endif; ?>
  </div>
</li>
</ul>
<?php echo $paginator; ?>
