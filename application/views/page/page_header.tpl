<?php
  global $loader;
  $main = $loader->get('Main','helper',$this->var['scope']);
?>
<?php echo $main->getMenu(); ?>