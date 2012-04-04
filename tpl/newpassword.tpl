<?php
  //print_r($this->var);
?>
<div class="box">
	<h2>Önnek új jelszót kell létrehoznia!</h2>
	<div class="utils">
	</div>
  <form action="/profile/add" method="post">
    <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
    <input type="hidden" name="id" id="id" value="<?php echo $this->var->id; ?>" />
	  <table>
		  <tbody>
			  <tr>
				  <td><input type="password" name="password" id="password" /></td>
			  </tr>
			  <tr>
				  <td><input type="submit" name="submit" id="submit" value="mentés" /></td>
			  </tr>
		  </tbody>
	  </table>
  </form>
</div>
