<?php
  //print_r($this->var['data']);
  //print_r($this->var['node_type']);

  global $session;
  $message = $session->getSysMessages('node_type');
  $session->setToken();
?>

<input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token'] ?>"  />

<ul class="breadcrumb">
  <li>
    <a href="/admin">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li>
    <a href="/admin/node">Node types</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    <?php echo $this->var['node_type']['name']; ?>
  </li>
</ul>

<div id="message_holder" class="well form-horizontal" style="display:<?php echo ($message ? 'block' : 'none');  ?>;">
    <h3 id="message" style="color:#0088CC;"><?php echo $message; ?></h3>
</div>

<div class="well form-horizontal">
  <a id="sbm" class="btn btn-toggle" href="/admin/node_add/<?php echo $this->var['node_type']['name']; ?>" type="submit">Add <?php echo $this->var['node_type']['name']; ?></a>
</div>

<!-- <div class="well form-horizontal"> -->
<table class="table table-striped table-bordered table-condensed">

    <thead>
      <tr>
        <th>#</th>
        <th>monument</th>
        <th>fb user</th>
        <th>delete</th>
      </tr>
    </thead>

    <tbody>

      <?php foreach($this->var['data'] as $node): ?>  <?php //print_r($node); ?>

        <tr>
          <td><?php echo $node['nid']; ?></td>
          <td><a href="/admin/node_view/<?php echo $node['nid']; ?>"><?php echo $node['title']; ?></a></td>

          <td>
            <a target="_blank" href="<?php echo $node['user']['link']; ?>">

              <?php if(isset($node['user']['picture']) && $node['user']['picture'] != ''): ?>
                <img src="<?php echo $node['user']['picture']; ?>" />
              <?php endif; ?>

                <span style="margin-left:10px">
                    <?php echo $node['user']['name']; ?>
                </span>
            </a>
          </td>
          
          <!-- <td>
            <?php if($node['active'] == 1): ?>
              <input type="checkbox" rel="<?php echo $node['nid']; ?>" id="active<?php echo $node['nid']; ?>" checked="true" class="active" />
            <?php else: ?>
              <input type="checkbox" rel="<?php echo $node['nid']; ?>" id="active<?php echo $node['nid']; ?>" class="active" />
            <?php endif; ?>
          </td> -->

          <td>
            <button id="sbm" class="btn btn-danger delete" rel="node|<?php echo $node['nid']; ?>" type="submit">
              Delete
            </button>
          </td>

        </tr>

      <?php endforeach; ?>

    </tbody>
  </table>
<!-- </div> -->

<?php echo $this->var['paginator']; ?>