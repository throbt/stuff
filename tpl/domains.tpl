<?php
  $directories = $this->thisController->getDirs();
?>

<script type="text/javascript">

  var insertInput = function() {
    var clickedCache = '';
    $('.editable').click(function() {
      if(clickedCache != '') {
        $(['#',clickedCache].join('')).html($('#editor').val());
      }
      var thisContent = $(this).html();
      if(this.id != clickedCache) {
        $(this).html(['<input type="text" rel="',this.id,'" id="editor" />'].join(''));
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
      if(typeof e == 'undefined' && window.event)
        e = window.event; 
      if(e.keyCode == 13) {
        if($('#key').val() != '') {
          $('#searchForm').attr('action',[$('#searchForm').attr('action'),'?key=',escape($('#key').val())].join(''));
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
    insertInput();
  });	
</script>

<form action="/domains/delete" method="post" id="deleteForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="deleteId" id="deleteId" value="" />
</form>
<form action="/domains/update" method="post" id="updateForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <input type="hidden" name="updateId" id="updateId" value="" />
  <input type="hidden" name="updateDomain" id="updateDomain" value="" />
  <input type="hidden" name="updateDir" id="updateDir" value="" />
</form>

<form action="/domains/add" method="post">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <div class="grid_4">
	  <p>
		  <label>domain név</label>
		  <input type="text" name="newdomain" id="newdomain" />
	  </p>
  </div>
  <div class="grid_5">
					  <p>
						  <label>könyvtár</label>
						  <select name="dir" id="dir">
						    <?php foreach($directories as $dir): ?>
						      <option value="<?php echo $dir; ?>"><?php echo $dir; ?></option>
						    <?php endforeach; ?>
						  </select>
					  </p>
				  </div>
  <div class="grid_2">
	  <p style="width:200px;">
		  <label>&nbsp;</label>
		  <input type="submit" id="addSubmit" value="hozzáad" />
	  </p>
  </div>
  
</form>

<form action="/domains/search" method="post" id="searchForm">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <div class="grid_4">
	  <p>
		  <label>kereső<small>elküld: enter</small></label>
		  <input type="text" name="key" id="key" />
	  </p>
  </div>
  
</form>

<table class='domains'>
	<thead>
		<tr>
			<th>id</th>
			<th>domain név</th>
			<th>könyvtár</th>
			<th colspan="2" width="10%">opciók</th>
		</tr>
		</thead>
		<tfoot>
		  <tr>
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
		  </tr>
	  </tfoot>
		<tbody>
		<?php foreach($this->var['result'] as $domain): ?>
		    <tr>
		      <td><?php echo $domain['id'] ?></td>
		      <td id="domain_<?php echo $domain['id'] ?>" rel="" class=""><?php echo $domain['domain'] ?></td>
		      <td id="dir_<?php echo $domain['id'] ?>" rel="" class=""><?php echo $domain['dir'] ?></td>
		      <td>
		        <!--a href="" rel="<?php echo $domain['id'] ?>" class="edit">elküld</a-->
		        <a href="" rel="<?php echo $domain['id'] ?>" class="delete">töröl</a>
		      </td>
		    </tr>
		<?php endforeach; ?>
		</tbody>
</table>
