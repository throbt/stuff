<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

  <?php echo $this->var['header']; ?>

  <body>
    
    <h1 id="head">Honlapkezelő
      <?php if(isset($_SESSION['sessionUser'])): ?>
        <div id="profile">
            
          <a id="logoutLink" href="/login/logout">kijelentkezés</a>
              
          <span id="profileName"><?php echo $_SESSION['sessionUser']->role; ?></span>
            
          <span id="profileName">&nbsp; - &nbsp;</span>
            
          <span id="profileName">
            <a id="" href="/profile/<?php echo $_SESSION['sessionUser']->id; ?>"><?php echo $_SESSION['sessionUser']->name; ?></a>
              
          </span>
          

        </div>
      <?php endif; ?>
    </h1>
    
		
		<?php echo $this->var['menu']; ?>
		
		<div id="content" class="container_16 clearfix">
		
		  <?php echo $this->var['content']; ?>
		
		</div>
		
		  <?php echo $this->var['footer']; ?>
    
  </body>

</html>
