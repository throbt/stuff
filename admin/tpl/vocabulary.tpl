<?php
  //print_r($this->var['data']);
  global $session;
  $message = $session->getSysMessages('vocabulary');
  $session->setToken();
?>


<ul class="breadcrumb">
  <li>
    <a href="/admin">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Vocabularies
  </li>
</ul>

<div id="message_holder" class="well form-horizontal" style="display:<?php echo ($message ? 'block' : 'none');  ?>;">
    <h3 id="message" style="color:#0088CC;"><?php echo $message; ?></h3>
</div>

<div class="well form-horizontal">
  <a id="sbm" class="btn btn-toggle" type="submit" href="/admin/new_vocabulary">Add</a>
</div>

<input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token'] ?>"  />

<!-- <div class="well form-horizontal"> -->
  <table class="table table-striped table-bordered table-condensed">

    <thead>
      <tr>
        <th>#</th>
        <th>name</th>
        <th>option</th>
      </tr>
    </thead>

    <tbody>

      <?php foreach($this->var['data'] as $voc): ?>

        <tr>
          <td><?php echo $voc['vid']; ?></td>
          <td><a href="/admin/vocabulary/<?php echo $voc['vid']; ?>"><?php echo $voc['name']; ?></a></td>
          <td>
            <button id="sbm" class="btn btn-danger delete" rel="vocabulary|<?php echo $voc['vid']; ?>" type="submit">
              Delete
            </button>
          </td>
        </tr>

      <?php endforeach; ?>

    </tbody>
  </table>
<!-- </div> -->

<?php echo $this->var['paginator'] ?>