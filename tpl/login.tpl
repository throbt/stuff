<div class="box">
	<h2>Bejelentkezés</h2>
	<div class="utils">
	</div>
  <form action="/login/process" method="post">
    <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>" />
	  <table>
		  <tbody>
			  <tr>
				  <td><input type="text" name="user" id="user" /></td>
			  </tr>
			  <tr>
				  <td><input type="password" name="password" id="password" /></td>
			  </tr>
			  <tr>
				  <td><input type="submit" name="submit" id="submit" value="bejelentkezés" /></td>
			  </tr>
		  </tbody>
	  </table>
  </form>
</div>
