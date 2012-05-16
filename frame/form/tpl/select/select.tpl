<div class="control-group <?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>">
  <label for="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>"><?php echo isset($this->var['label']) ? $this->var['label'] : ''; ?></label>
  <div class="text">
    <select id="<?php echo isset($this->var['id']) ? $this->var['name'] : ''; ?>" name="<?php echo isset($this->var['name']) ? $this->var['id'] : ''; ?>" class="<?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>">
      
      <?php foreach($this->var['options'] as $option): ?>
      
        <?php if($this->var['value'] == $option): ?>
          <option selected="true" value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php else: ?>
          <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
        <?php endif; ?>
      
      <?php endforeach; ?>
      
    </select>
  </div>
</div>
