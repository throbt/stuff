<div id="formEl-wrapper-<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>" class="formEl-wrapper">
	<label for="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>"><?php echo isset($this->var['label']) ? $this->var['label'] : ''; ?></label>
	<input type="text" id="<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>" class="textElement  <?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>" name="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>" />
</div>
