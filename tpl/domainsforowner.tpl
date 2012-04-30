<?php
  $directories = $this->thisController->getDirs();
?>

<script type="text/javascript">
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

<table class='domains'>
	<thead>
		<tr>
			<th>id</th>
			<th>domain név</th>
			<!--th>könyvtár</th>
			<th colspan="2" width="10%">opciók</th-->
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
		  <?php foreach($this->var['result'] as $domain): ?>
		      <tr>
		        <td><?php echo $domain['id'] ?></td>
		        <td id="domain_<?php echo $domain['id'] ?>" rel="" class="">
		          <a href="/linkto/<?php echo $domain['domain_id'] ?>?uid=<?php echo $_SESSION['sessionUser']->id; ?>">
	              <?php echo $domain['domain']; ?>
	            </a>
	          </td>
		        <!--td id="dir_<?php echo $domain['id'] ?>" rel="" class=""><?php echo $domain['dir'] ?></td-->
		        <td>
		          <!--a href="" rel="<?php echo $domain['id'] ?>" class="edit">elküld</a-->
		          <!--a href="" rel="<?php echo $domain['id'] ?>" class="delete">töröl</a-->
		        </td>
		      </tr>
		  <?php endforeach; ?>
		<?php endif; ?>
		</tbody>
</table>
