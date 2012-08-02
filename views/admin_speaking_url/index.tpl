<?php
  /*
    SEO
  */

  $paginator = $this->var['paginator'];
?>

<ul class="breadcrumb">
  <li>
    <a href="/admin_content">Admin Home</a>
    <span class="divider">/</span>
  </li>
  <li class="active">
    Url maszkolás
  </li>
</ul>

<script src="/js/SEO.js" type="text/javascript"></script>

<div class="well form-horizontal">

  <label>Új:</label>

  <table class="table">
    <table class="table">
    <thead>
      <tr>
        <th>
            <label>order:</label>
            <input  id="ordernew" class="input input-xlarge" type="text" name="order" value="" />
        </th>
        <th>
            <label>params:</label>
            <input  id="paramsnew" class="input input-xlarge" type="text" name="params" value="" />
        </th>
        <th><button id="sbm" class="btn btn-primary savenew" type="submit" rel="">Ment</button></th>
      </tr>
    </thead>
  </table>

</div>


<div class="well form-horizontal">

  <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>order</th>
        <th>link</th>
        <th>params</th>
        <th>link</th>
        <th>ment</th>
        <th>töröl</th>
      </tr>
    </thead>

    <tbody>

      <?php foreach($this->var['data'] as $data): ?>

      <tr>
        <td><?php echo $data['id']; ?></td>

        <td id="order<?php echo $data['id']; ?>" class="editable"><?php echo $data['thisorder']; ?></td>

        <td>
          <a target="_blank" href="/<?php echo $data['thisorder']; ?>" id="sbm" class="btn btn-success" type="submit" rel="1">link</a>
        </td>

        <td id="params<?php echo $data['id']; ?>" class="editable"><?php echo $data['params']; ?></td>

        <td>
          <a target="_blank" href="/<?php echo $data['params']; ?>" id="sbm" class="btn btn-success" type="submit" rel="1">link</a>
        </td>

        <td>
          <button id="sbm" class="btn btn-primary save" type="submit" rel="<?php echo $data['id']; ?>">Ment</button>
        </td>

        <td>
          <button id="sbm" class="btn btn-danger del" type="submit" rel="<?php echo $data['id']; ?>">Töröl</button>
        </td>

      </tr>

    <?php endforeach; ?>

    </tbody>

  </table>

</div>

<?php echo $paginator; ?>
