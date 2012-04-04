<?php
  //print_r($this->var);
?>

<script type="text/javascript">
  var insertInput = function() {
    var clickedCache = '',
        thisSelect = function(id) {
          return [
            '<select id="editor" rel="',id,'">',
            '<option value="fejlesztő">fejlesztő</option>',
            '<option value="admin">admin</option>',
            '<option value="tulajdonos">tulajdonos</option>',
            '<option value="new user">new user</option>',
            '</select>'
          ].join('');
        };
    $('.editable').click(function() {
      if(clickedCache != '') {
        writeCell();
      }
      var thisContent = $(this).html();
      if(this.id != clickedCache) {
        $(this).html(thisSelect(this.id));
        $('#editor').val(thisContent);
        $('#editor').focus();
        clickedCache = this.id;
      } else {
        writeCell(this);
        clickedCache = '';
      }
    });
    var writeCell = function(obj) {
      $(['#',clickedCache].join('')).html($('#editor').val());
    }
  }
  $(document).ready(function() {
    document.onkeydown = function(e) {
      if(typeof e == 'undefined' && window.event)
        e = window.event;
      if(e.keyCode == 13) {
          if($('#key').val() != '')
            $('#searchForm').submit();
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
      $('#updateDomain').val($(['#domain_',id].join('')).html());
      $('#updateDir').val($(['#dir_',id].join('')).html());
      $('#updateForm').submit();
      return false;
    });
    insertInput();
  });	
</script>

<form action="/users/delete" method="post" id="deleteForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="deleteId" id="deleteId" value="" />
</form>
<form action="/users/update" method="post" id="updateForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="updateId" id="updateId" value="" />
  <input type="hidden" name="updateEmail" id="updateEmail" value="" />
  <input type="hidden" name="updateName" id="updateName" value="" />
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

<form action="/users/search" method="post" id="searchForm">
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
		<!--tfoot>
		  <tr>
			  <td colspan="5" class="pagination">
				  <span class="active curved">1</span><a href="#" class="curved">2</a><a href="#" class="curved">3</a><a href="#" class="curved">4</a> ... <a href="#" class="curved">10 million</a>
			  </td>
		  </tr>
	  </tfoot>
		<tbody-->
		<?php foreach($this->var as $user): ?>
		    <tr>
		      <td><?php echo $user['uid'] ?></td>
		      <td id="email_<?php echo $user['uid'] ?>" rel="" class=""><?php echo $user['email'] ?></td>
		      <td id="name_<?php echo $user['uid'] ?>" rel="" class=""><?php echo $user['name'] ?></td>
		      <td id="role_<?php echo $user['uid'] ?>" rel="" class="editable"><?php echo $user['role'] ?></td>
		      <td>
		        <a href="" rel="<?php echo $user['uid'] ?>" class="edit">elküld</a>
		        <a href="" rel="<?php echo $user['uid'] ?>" class="delete">töröl</a>
		      </td>
		    </tr>
		<?php endforeach; ?>
		</tbody>
</table>
