<div class="clearfix <?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>">
	<label for="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>"><?php echo isset($this->var['label']) ? $this->var['label'] : ''; ?></label>
	<div class="textarea">
	  <textarea id="<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>" class="input  <?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>" name="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>">
	  <?php echo isset($this->var['value']) ? $this->var['value'] : ''; ?>
	</textarea>
  </div>
</div>
