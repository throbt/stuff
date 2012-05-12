<div id="<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>-wrapper" class="form-wrapper">
	<form id="<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>" action="<?php echo isset($this->var['action']) ? $this->var['action'] : ''; ?>" method="<?php echo isset($this->var['method']) ? $this->var['method'] : ''; ?>">
		<?php
			if(isset($this->var['type'])) {
				echo "<input type='hidden' name='_method' value='{$this->var['type']}' />";
			}

			echo $this->var['content'];
		?>
	</form>
</div>