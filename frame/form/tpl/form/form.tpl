<div id="<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>-wrapper" class="form-wrapper">
	<form class="<?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>" id="<?php echo isset($this->var['id']) ? $this->var['id'] : ''; ?>" action="<?php echo isset($this->var['action']) ? $this->var['action'] : ''; ?>" method="<?php echo isset($this->var['method']) ? $this->var['method'] : ''; ?>">
	
		<fieldset>

      <?php
        if(isset($this->var['token']) && $this->var['token'] == true) {
          global $session;
          $session->setToken();
          echo '<input type="hidden" name="token" value="'.$_SESSION["token"].'" />';
        }
      ?>

		  <input type="hidden" name="_method" value="<?php echo isset($this->var['_method']) ? $this->var['_method'] : ''; ?>" />
			<?php echo $this->var['content']; ?>
		</fieldset>
		
	</form>
</div>
