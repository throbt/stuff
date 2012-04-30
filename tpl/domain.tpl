<?php
    //print_r($this->var['state']);
    
    //print_r($this);
?>

<script type="text/javascript">
  $(document).ready(function() {
    $('.delete').click(function() {
      $.post(
        '/ajax',
        { method  : 'delete',
          token   : $('#token').val(),
          id      : $(this).attr('rel') },
        function(resp) {window.location.reload();}
      );
      return false;
    });
    $('.edit').click(function() {
      $.post(
        '/ajax',
        { method  :'build',
          token   : $('#token').val(),
          id      : $(this).attr('rel') },
        function(resp) {window.location.reload();}
      );
      return false;
    });
  });	
</script>

<div class="box" style="clear:both;margin-top:20px;float:left;">
  <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
  <h2>A domain tulajdonságai:</h2>
  
  <table class='profile' style="margin-top:20px;">
  
    <thead>
      <tr>
        <th>
          domain
        </th>
          
        <th>
          könyvtár
        </th>
      </tr>
    </thead>
    
    <tbody>
    <?php if($this->var['domain']): ?>
      <?php foreach($this->var['domain'] as $domain): ?>
      
        <tr>
          <td id="domain_<?php echo $domain['domain_id'] ?>">
            <?php echo $domain['domain']; ?>
          </td>
          <td>
            <?php echo $domain['dir']; ?>
          </td>
        </tr>
      
      <?php endforeach; ?>
      
      <tr>
        <th>státusz</th>
        <th>
          opció
        </th>
      </tr>
      
      <?php if($this->var['state']): ?>
        
        <tr>
          <td>létrehozva</td>
          <td>
            <a href="" rel="<?php echo $this->var['domain'][0]['id'] ?>" class="delete">töröl</a>
          </td>
        </tr>
        
      <?php else: ?>
        
        <tr>
          <td>üres</td>
          <td>
            <a href="" rel="<?php echo $this->var['domain'][0]['id'] ?>" class="edit">létrehoz</a>
          </td>
        </tr>
        
      <?php endif; ?>
      
    <?php endif; ?>
    </tbody>
    
  </table>
</div>
