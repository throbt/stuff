<?php
  global $session;
  $message = $session->getSysMessages('term');
?>


<ul class="breadcrumb">
  <li>
    <a href="/admin">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Vocabulary terms
  </li>
</ul>

<div id="message_holder" class="well form-horizontal" style="display:<?php echo ($message ? 'block' : 'none');  ?>;">
    <h3 id="message" style="color:#0088CC;"><?php echo $message; ?></h3>
</div>

<div class="well form-horizontal">
  <a id="sbm" class="btn btn-toggle" type="submit" href="/admin/new_term">Add</a>
</div>

<?php echo $this->var['data'] ?>


<div class="well form-horizontal" id="term-container" style="display:none;">
  <table class="table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>#</th>
        <th>name</th>
        <th>vocabulary</th>
        <th>option</th>
      </tr>
    </thead>
    <tbody id="inner_terms_wrapper">
    </tbody>
  </table>
</div>