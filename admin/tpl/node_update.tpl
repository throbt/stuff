<?php
  //print_r($this->var['node']);
  //print_r($this->var);

  global $session;
  $message = $session->getSysMessages('node_update');
  $session->setToken();
?>

<ul class="breadcrumb">
  <li>
    <a href="/admin">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li>
    <a href="/admin/node">Node types</a>
    <span class="divider">/</span>
  </li>
  <li>
    <a href="/admin/node_type/<?php echo $this->var['type_id']; ?>"><?php echo $this->var['node']['type']; ?>s</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    <?php echo $this->var['scope']->title; ?>
  </li>
</ul>

<div id="message_holder" class="well form-horizontal" style="display:<?php echo ($message ? 'block' : 'none');  ?>;">
    <h3 id="message" style="color:#0088CC;"><?php echo $message; ?></h3>
</div>

<?php
  echo $this->var['data'];
?>