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
    New Node
  </li>
</ul>

<?php echo $this->var['data'] ?>

<div id="extraFieldsWrapper" class="well form-horizontal" style="display:none;">
  
  <h4>Fields</h4>

  <table id="extraFields" class="table table-striped table-bordered table-condensed">

    <tr id="header">
      <td>name</td>
      <td>type</td>
      <td>value</td>
      <td>description</td>
      <td>option</td>
    </tr>

  </table>
</div>

<div id="add_new_field" class="well form-horizontal">
  <button id="new_node_type" class="btn btn-toggle" href="#" type="submit">Add new field</button>
</div>

<div id="add_new_field" class="well form-horizontal">
  <button id="node_type_save" class="btn btn-primary" href="#" type="submit">Save</button>
</div>