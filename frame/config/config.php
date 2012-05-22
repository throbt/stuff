<?php 

class getConfig {
  static function &get($ini='') {
    static $obj;
    if (!is_object($obj)){
      $obj = new Config($ini);
    }
    return $obj;
  }
}

class Config {

  function __construct($iniPath) {
	
		$this->vars['env'] = $_SERVER['env'];
	
		if(file_exists($iniPath)) {
			$ini 				= parse_ini_file($iniPath, true);
			$this->cfg 	= $ini[$this->vars['env']];
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
	
	    define('APPLICATION',   $this->cfg['application']);
      
	    define('CONTROLLERS',   APPLICATION . 'controllers' . DIRECTORY_SEPARATOR);
			define('MODELS',        APPLICATION . 'models' 			. DIRECTORY_SEPARATOR);
			define('VIEWS',        	APPLICATION . 'views' 			. DIRECTORY_SEPARATOR);
      define('HELPERS',       VIEWS       . 'helpers'     . DIRECTORY_SEPARATOR);
	    define('WWW',           APPLICATION . 'www' 				. DIRECTORY_SEPARATOR);
	    define('CSS',           WWW 				. 'css' 				. DIRECTORY_SEPARATOR);
	    define('JS',            WWW 				. 'js' 					. DIRECTORY_SEPARATOR);
	    define('IMG',           WWW 				. 'img' 				. DIRECTORY_SEPARATOR);

      define('UPLOAD',        WWW         . 'upload'      . DIRECTORY_SEPARATOR);
		}
  }
  
  public function get($key) {
    return $this->vars[$key];
  }
}
