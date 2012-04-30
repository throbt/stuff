<?php
  //print_r($_SESSION['sessionUser']);
?>

<script type="text/javascript">
  var roleId = <?php echo $_SESSION['sessionUser']->role_id; ?>;
  $(document).ready(function() {
    var selectValues = {
      'fejlesztő'   : 1,
      'admin'       : 2,
      'tulajdonos'  : 3,
      'new user'    : 1000
    };
    document.onkeydown = function(e) {
      if(typeof e == 'undefined' && window.event)
        e = window.event;
      if(e.keyCode == 13) {
        if($('#key').val() != '') {
          $('#searchForm').attr('action',[$('#searchForm').attr('action'),'?key=',thisUrlEncode(Utf8.encode($('#key').val()))].join(''));
          $('#searchForm').submit();
        }
        return false;
      }
    }
    $('.delete').click(function() {
      $('#deleteId').val($(this).attr('rel'));
      $('#deleteForm').submit();
      return false;
    });
    $('.edit').click(function() {
      if($('#editor').get(0) != null) {
        var thatId = $('#editor').attr('rel');
        $(['#',thatId].join('')).html($('#editor').val());
      }
      var id = $(this).attr('rel');
      $('#updateId').val(id);
      $('#updateRole').val(selectValues[$(['#role_',id].join('')).html()]);
      $('#updateName').val($(['#name_',id].join('')).html());
      $('#updateForm').submit();
      return false;
    });
    if(roleId == 1) {
      insertInput('select',selectValues);
      insertInput('text',selectValues,'.editable_name');
    }
  });	
</script>

<form action="/routeaccess/delete" method="post" id="deleteForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="deleteId" id="deleteId" value="" />
</form>
<form action="/routeaccess/update" method="post" id="updateForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="updateId" id="updateId" value="" />
  <input type="hidden" name="updateRoute" id="updateRoute" value="" />
  <input type="hidden" name="updateName" id="updateName" value="" />
  <input type="hidden" name="updateRole" id="updateRole" value="" />
</form>

<?php if($_SESSION['sessionUser']->role_id == 1): ?>
  <form action="/routeaccess/add" method="post">
    <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
    <div class="grid_4">
	    <p>
		    <label>route</label>
		    <input type="text" name="newroute" id="newroute" />
	    </p>
    </div>
    
    <div class="grid_5">
	    <p>
		    <label>név</label>
		    <input type="text" name="newname" id="newname" />
	    </p>
    </div>
    
    <div class="grid_2">
	    <p style="width:200px;">
		    <label>&nbsp;</label>
		    <input type="submit" id="addSubmit" value="hozzáad" />
	    </p>
    </div>
  </form>
<?php endif; ?>

<form action="/routeaccess" method="post" id="searchForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <div class="grid_4">
	  <p>
		  <label>kereső<small>elküld: enter</small></label>
		  <input type="text" name="key" id="key" />
	  </p>
  </div>
  
</form>

<table class='routeaccess'>
	<thead>
		<tr>
			<th>id</th>
			<th>route</th>
			<th>név</th>
			<th>csoport</th>
			<?php if($_SESSION['sessionUser']->role_id == 1): ?>
			  <th colspan="2" width="10%">opciók</th>
			<?php endif; ?>
		</tr>
		</thead>
		  <tfoot>
		    <tr>
		      <?php if(isset($this->var['all'])): ?>
		        <?php if($this->var['all'] > 1): ?>
			        <td colspan="5" class="pagination">
			          <?php for($i = 1;$i <= $this->var['all']; $i++): ?>
			              <?php if($i == $this->var['current']): ?>
			                <span class="active curved"><?php echo $i; ?></span>
			              <?php else: ?>
			                <a href="<?php echo $this->var['link']; ?>page=<?php echo $i; ?>" class="curved"><?php echo $i; ?></a>
			              <?php endif; ?>
			          <?php endfor; ?>
			        </td>
			      <?php endif; ?>
		      <?php endif; ?>
		    </tr>
	    </tfoot>
		<tbody>
		
		
		<?php if($this->var): ?>
		  <?php foreach($this->var['result'] as $route): ?>
		      <tr>
		        <td><?php echo $route['id'] ?></td>
		        <td id="route_<?php echo $route['id'] ?>" rel="" class=""><?php echo $route['route'] ?></td>
		        <td id="name_<?php echo $route['id'] ?>" rel="" class="editable_name"><?php echo $route['name'] ?></td>
		        <td id="role_<?php echo $route['id'] ?>" rel="" class="editable"><?php echo $route['role'] ?></td>
	          <?php if($_SESSION['sessionUser']->role_id == 1): ?>
		          <td>
	              <a href="" rel="<?php echo $route['id'] ?>" class="edit">elküld</a>
	              <a href="" rel="<?php echo $route['id'] ?>" class="delete">töröl</a>
		          </td>
		        <?php endif; ?>
		      </tr>
		  <?php endforeach; ?>
		<?php endif; ?>
		</tbody>
</table>
