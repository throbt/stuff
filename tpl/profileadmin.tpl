<?php
    //print_r($this->var);
    
    //print_r($this);
  ?>
<div class="box" style="clear:both;margin-top:20px;float:left;">

  <script type="text/javascript">
    $(document).ready(function() {
      $('.delete').click(function() {
        $('#deleteId').val($(this).attr('rel'));
        $('#deleteForm').submit();
        return false;
      });
      
      $('.edit').click(function() {
        $('#addId').val($(this).attr('rel'));
        $('#addForm').submit();
        return false;
      });
    });	
  </script>

  <form action="/usersdomains/delete" method="post" id="deleteForm">
    <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
    <input type="hidden" name="deleteId" id="deleteId" value="" />
    <input type="hidden" name="profileId" id="profileId" value="<?php echo $this->urlParts[1]; ?>" />
  </form>
  
  <form action="/usersdomains/add" method="post" id="addForm">
    <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
    <input type="hidden" name="addId" id="addId" value="" />
    <input type="hidden" name="profileId" id="profileId" value="<?php echo $this->urlParts[1]; ?>" />
  </form>
  
  <?php if($_SESSION['sessionUser']->role_id < 3): ?>
  
  <h2>A profilhoz tartozó domain(ek):</h2>

  <?php if(!$this->var): ?>
    
    <table class='profile'>
	    <tr>
	      <td><span>Ehhez a profilhoz még nincs domain rendelve.</span></td>
	    </tr>
  </table>
  
  <?php else: ?>
  
  <table class='profile' style="margin-top:20px;">
  
    <?php if($this->var['domains']): ?>
      <?php foreach($this->var['domains'] as $domain): ?>
      
        <tr>
	        <td id="domain_<?php echo $domain['domain_id'] ?>">
	          <a href="/domainss/<?php echo $domain['domain_id'] ?>">
	            <?php echo $domain['domain']; ?>
	          </a>
          </td>
          <td>
            <a href="" rel="<?php echo $domain['udid'] ?>" class="delete">töröl</a> 
          </td>
	      </tr>
      
      <?php endforeach; ?>
    <?php else: ?>
        <tr>
	        <td>
	          <span>Ehhez a profilhoz nem tartozik domain.</span>
          </td>
	      </tr>
    <?php endif; ?>
    
  </table>
  
  <?php endif; ?>
  
  <h2 style="margin-top:20px;clear:both;">domain hozzáadása:</h2>
  <table class='profile'>
    
    <?php if($this->var['addDomains']): ?>
      <?php foreach($this->var['addDomains'] as $domain): ?>
      
        <tr>
	        <td id="domain_<?php echo $domain['id'] ?>">
	          <a href="/domainss/<?php echo $domain['id'] ?>">
	            <?php echo $domain['domain']; ?>
	          </a>
          </td>
          <td>
            <a href="" rel="<?php echo $domain['id'] ?>" class="edit">hozzáad</a> 
          </td>
	      </tr>
      
      <?php endforeach; ?>
    <?php else: ?>
        <tr>
	        <td>
	          <span>Nincs szabad domain.</span>
          </td>
	      </tr>
    <?php endif; ?>
  
  </table>
  
  <?php endif; ?>
</div>
