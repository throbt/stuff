<div class="control-group" style="width:100%;display:block;">
  <label for="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>" class="checkbox"><?php echo isset($this->var['label']) ? $this->var['label'] : ''; ?>

    <input type="checkbox" id="<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>" class="input  <?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>" name="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>" <?php
    
      if(isset($this->var['checked']) && $this->var['checked'] == 'true')
        echo ' checked="true" ';

      if(isset($this->var['value']) && $this->var['value'] == 1)
        echo ' checked="true" ';
    
    ?> />

  </label>
  <div style="clear:both;"></div>
  
 </div>
