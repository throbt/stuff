<?php
  //print_r($this->var['data']);
  global $session;
  $message = $session->getSysMessages('modules');
  $session->setToken();
?>

<?php if($message): ?>
  <div class="well form-horizontal">
    <h3 style="color:#0088CC;"><?php echo $message; ?></h3>
  </div>
<?php endif; ?>


<ul class="breadcrumb">
  <li>
    <a href="/admin">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Modules
  </li>
</ul>

<form id='modules' action="/admin/modulessave" method="post">
  
  <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>" />
  <input type="hidden" name="cfg" value="<?php echo urlencode(json_encode($this->var['data'])); ?>" />

  <?php foreach($this->var['data'] as $key => $module): ?>

    <div class="well form-horizontal">

      <h2><?php echo $module['title']; ?></h2>
      <p><?php echo $module['description']; ?></p>

    
      <table class="table table-striped table-bordered table-condensed">

        <thead>
          <tr>
            <th>method</th>
            <th>active</th>
          </tr>

        </thead>
        <tbody>

          <?php foreach($module['api'] as $k => $method): ?>

            <tr>
              <td><?php echo $k; ?></td>
              <td><input type="checkbox" <?php if($method == 1) echo "checked='true'"; ?> name="<?php echo $key; ?>|<?php echo $k; ?>" /></td>
            </tr>

          <?php endforeach; ?>

        </tbody>
      </table>
    </div>

  <?php endforeach; ?>

  <button id="sbm" class="btn btn-primary" type="submit">Save</button>

</form>