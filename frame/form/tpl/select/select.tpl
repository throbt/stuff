<div class="control-group <?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>" style="width:100%">
  <label for="<?php echo isset($this->var['name']) ? $this->var['name'] : ''; ?>"><?php echo isset($this->var['label']) ? $this->var['label'] : ''; ?></label>
  <div class="text" style="float:left;">
    <select id="<?php echo isset($this->var['id']) ? $this->var['name'] : ''; ?>" name="<?php echo isset($this->var['name']) ? $this->var['id'] : ''; ?>" class="<?php echo isset($this->var['class']) ? $this->var['class'] : ''; ?>">


      <?php
        // array
        if(isset($this->var['options'][0])): ?>


        <?php foreach($this->var['options'] as $option): ?>

          <?php if(isset($this->var['value']) && $this->var['value'] == $option): ?>
            <option selected="true" value="<?php echo $option; ?>"><?php echo $option; ?></option>
          <?php else: ?>
            <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
          <?php endif; ?>

        <?php endforeach; ?>

      <?php else: ?>

        <?php
          // hash
          foreach($this->var['options'] as $k => $option): ?>

          <?php if(isset($this->var['value']) && $this->var['value'] == $k): ?>
            <option selected="true" value="<?php echo $k; ?>"><?php echo $option; ?></option>
          <?php else: ?>
            <option value="<?php echo $k; ?>"><?php echo $option; ?></option>
          <?php endif; ?>

        <?php endforeach; ?>

    <?php endif; ?>

    </select>

  </div>

  <?php if(isset($this->var['new'])): ?>
    <div class="text" style="float:left;" id="newWrapper">
      <a onclick="this.parentNode.parentNode.innerHTML='<label><?php echo isset($this->var['label']) ? $this->var['label'] : ''; ?></label><input type=\'text\' name=\'<?php echo isset($this->var['name']) ? $this->var['id'] : ''; ?>\' />';" id="sbm" class="btn  btn-primary save" type="button" href="#">Új</a>
    </div>
  <?php endif; ?>

</div>
