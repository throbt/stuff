<?php
  //print_r($this->var['data']);
?>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Tartalom típusok
  </li>
</ul>

<?php foreach($this->var['data'] as $types): ?>
  <div class="row">
    <div class="span12">
      <div class="span6">
        <h6><a href="/node/nodetype/<?php echo $types['name']; ?>"><?php echo $types['name']; ?></a></h6>
      </div>

      <div class="span2">
        <a class="btn btn-primary deleteType" rel="<?php echo $types['id']; ?>">Törlés</a>
      </div>
    </div>
  </div>
  <br />
<?php endforeach; ?>
