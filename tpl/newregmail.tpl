<html>
  <head>
    <title>Tárgy: Új regisztráció a <?php echo HOST; ?> oldalon</title>
  </head>
  <body>
    <p> Kedves <?php echo $this->var['name'] ?></p>
    <a href="http://<?php echo HOST; ?>/login">http://<?php echo HOST; ?>/login</a>
    <p> password: <?php echo $this->var['hash'] ?></p>
  </body>
</html>
