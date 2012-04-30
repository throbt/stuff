<?php 

class getConfig {
  public function &get($ini) {
    static $obj;
    if (!is_object($obj)){
      $obj = new Config($ini);
    }
    return $obj;
  }
}

class Config {

  function __construct($iniPath) {
	
		$this->env = $_SERVER['env'];
	
		if(file_exists($iniPath)) {
			$ini 				= parse_ini_file($iniPath, true);
			$this->cfg 	= $ini[$this->env];
		} else {
			echo "wrong application.ini path or the file(application.ini) does not exist";
			die();
		}
		
		if(isset($this->cfg)) {
			$this->vars['db'] = array(
	      "host"  => $this->cfg['db.host'],
	      "db"    => $this->cfg['db.dbname'],
	      "user"  => $this->cfg['db.username'],
	      "psw"   => $this->cfg['db.password']
	    );
		
			define('HOST',          $this->cfg['host']);
	    define('ROOT',          $this->cfg['doc_root']);
	
	    define('APPLICATION',   ROOT 				. 'application' . DIRECTORY_SEPARATOR);
	    define('CONTROLLERS',   APPLICATION . 'controllers' . DIRECTORY_SEPARATOR);
			define('MODELS',        APPLICATION . 'models' 			. DIRECTORY_SEPARATOR);
			define('VIEWS',        	APPLICATION . 'views' 			. DIRECTORY_SEPARATOR);
	    define('WWW',           ROOT 				. 'www' 				. DIRECTORY_SEPARATOR);
	    define('CSS',           WWW 				. 'css' 				. DIRECTORY_SEPARATOR);
	    define('JS',            WWW 				. 'js' 					. DIRECTORY_SEPARATOR);
	    define('IMG',           WWW 				. 'img' 				. DIRECTORY_SEPARATOR);
		}
  }
  
  public function get($key) {
    return $this->vars[$key];
  }
}
