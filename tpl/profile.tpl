<?php
  //print_r($this->var); print_r($_SESSION['sessionUser']);
?>
<div class="box">
	<h2>Felhasználói profil</h2>
	
	<div class="utils">
	</div>
	
	<table class='profile'>
	  <tr>
	    <td>Név:</td><td><?php echo $this->var->name; ?></td>
	  </tr>
	  <tr>
	    <td>Email:</td><td><?php echo $this->var->email; ?></td>
	  </tr>
	  <tr>
	    <td>Csoport:</td><td><?php echo $this->var->role; ?></td>
	  </tr>
	</table>
	
	
	<?php if($this->var->id == $_SESSION['sessionUser']->id): ?>
    <form action="/profile/newpass" method="post">
      <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
      <input type="hidden" name="id" id="id" value="<?php echo $this->var->id; ?>" />
	    <table class='profile_pass'>
		    <tbody>
			    <tr>
				    <td><label>új password</label><input type="password" name="password" id="password" /></td>
			    </tr>
			    <tr>
				    <td><input type="submit" name="submit" id="submit" value="csere" /></td>
			    </tr>
		    </tbody>
	    </table>
    </form>
  <?php endif; ?>
</div>
