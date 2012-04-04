<html>
  <head>
    <title>Tárgy: Új regisztráció a <?php echo HOST; ?> oldalon</title>
  </head>
  <body>
    <p> Kedves <?php echo $this->var['name'] ?></p>
    <a href="http://<?php echo HOST; ?>/profile/<?php echo $this->var['id'] ?>">http://<?php echo HOST; ?>/profile/<?php echo $this->var['id'] ?></a>
    <p> password: <?php echo $this->var['hash'] ?></p>
  </body>
</html>
