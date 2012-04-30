<?php
  //print_r(count($this->var));
?>
<script type="text/javascript">
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
      $('#updateForm').submit();
      return false;
    });
    insertInput('select',selectValues);
  });	
</script>

<form action="/users/delete" method="post" id="deleteForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="deleteId" id="deleteId" value="" />
</form>
<form action="/users/update" method="post" id="updateForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="updateId" id="updateId" value="" />
  <input type="hidden" name="updateRole" id="updateRole" value="" />
</form>

<form action="/users/add" method="post">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <div class="grid_4">
	  <p>
		  <label>email</label>
		  <input type="text" name="newemail" id="newemail" />
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

<form action="/users" method="post" id="searchForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <div class="grid_4">
	  <p>
		  <label>kereső<small>elküld: enter</small></label>
		  <input type="text" name="key" id="key" />
	  </p>
  </div>
  
</form>

<table class='users'>
	<thead>
		<tr>
			<th>id</th>
			<th>email</th>
			<th>név</th>
			<th>csoport</th>
			<th colspan="2" width="10%">opciók</th>
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
		
		
		<?php if(isset($this->var['result'])): ?>
		  <?php foreach($this->var['result'] as $user): ?>
		      <tr>
		        <td><?php echo $user['uid'] ?></td>
		        <td id="email_<?php echo $user['uid'] ?>" rel="" class=""><a href="/profile/<?php echo $user['uid'] ?>"><?php echo $user['email'] ?></a></td>
		        <td id="name_<?php echo $user['uid'] ?>" rel="" class=""><?php echo $user['name'] ?></td>
		        <td id="role_<?php echo $user['uid'] ?>" rel="" class="editable"><?php echo $user['role'] ?></td>
		        <td>
		          <a href="" rel="<?php echo $user['uid'] ?>" class="edit">elküld</a>
		          <a href="" rel="<?php echo $user['uid'] ?>" class="delete">töröl</a>
		        </td>
		      </tr>
		  <?php endforeach; ?>
		<?php endif; ?>
		
		</tbody>
</table>
