<?php
  //print_r($this->var['data']);
  global $session;
  $message = $session->getSysMessages('node_type');
  $session->setToken();
?>

<ul class="breadcrumb">
  <li>
    <a href="/admin">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Node types
  </li>
</ul>

<div id="message_holder" class="well form-horizontal" style="display:<?php echo ($message ? 'block' : 'none');  ?>;">
    <h3 id="message" style="color:#0088CC;"><?php echo $message; ?></h3>
</div>

<div class="well form-horizontal">
  <a id="sbm" class="btn btn-toggle" type="submit" href="/admin/new_node_type">Add</a>
</div>

<!-- <div class="well form-horizontal"> -->

  <input type="hidden" id="token" value="<?php echo $_SESSION['token']; ?>" />

  <table class="table table-striped table-bordered table-condensed">

    <thead>
      <tr>
        <th>#</th>
        <th>name</th>
      </tr>
    </thead>

    <tbody>

      <?php foreach($this->var['data'] as $type): ?>

        <tr>
          <td><?php echo $type['id']; ?></td>
          <td><a href="/admin/node_type/<?php echo $type['id']; ?>"><?php echo $type['name']; ?></a></td>
          <td>
            <button id="sbm" class="btn btn-danger delete" rel="node_type|<?php echo $type['id']; ?>" type="submit">
              Delete
            </button>
          </td>
        </tr>

      <?php endforeach; ?>

    </tbody>
  </table>
<!-- </div> -->
