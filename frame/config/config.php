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
      define('REPO',          $this->cfg['repo']);

	    define('APPLICATION',   $this->cfg['application']);

      define('CONFIG',        APPLICATION . 'config'      . DIRECTORY_SEPARATOR);
      define('MODULES',       APPLICATION . 'modules'     . DIRECTORY_SEPARATOR);
	    define('CONTROLLERS',   APPLICATION . 'controllers' . DIRECTORY_SEPARATOR);
			define('MODELS',        APPLICATION . 'models' 			. DIRECTORY_SEPARATOR);
			define('VIEWS',        	APPLICATION . 'views' 			. DIRECTORY_SEPARATOR);
      define('HELPERS',       APPLICATION . 'helpers'     . DIRECTORY_SEPARATOR);
	    define('WWW',           APPLICATION . 'www' 				. DIRECTORY_SEPARATOR);
      define('3rdparty',      APPLICATION . '3rdparty'    . DIRECTORY_SEPARATOR);
	    define('CSS',           WWW 				. 'css' 				. DIRECTORY_SEPARATOR);
	    define('JS',            WWW 				. 'js' 					. DIRECTORY_SEPARATOR);
	    define('IMG',           WWW 				. 'img' 				. DIRECTORY_SEPARATOR);
      define('UPLOAD',        WWW         . 'upload'      . DIRECTORY_SEPARATOR);

      /* web routes */
      define('LIB', '/lib'         . DIRECTORY_SEPARATOR);
      define('BOOTSTRAP',             LIB . 'bootstrap'             . DIRECTORY_SEPARATOR);
      define('BOOTSTRAP_DATEPICKER',  LIB . 'bootstrap-datepicker'  . DIRECTORY_SEPARATOR);
      define('JQUERY_UI_BOOTSTRAP',   LIB . 'jquery-ui-bootstrap'   . DIRECTORY_SEPARATOR);
      define('TINY_MCE',              LIB . 'tiny_mce'              . DIRECTORY_SEPARATOR);
      define('MNVC',                  LIB . 'mnvc'                  . DIRECTORY_SEPARATOR);

      define('EMILE',                 LIB . 'emile'                 . DIRECTORY_SEPARATOR);
      define('INTERFACE',             LIB . 'interface'             . DIRECTORY_SEPARATOR);

      define('IFORM',                 LIB . 'iform'                 . DIRECTORY_SEPARATOR);
		}
  }

  /*
    @method get

    @param $key string
    @return array
  */
  public function get($key) {
    return $this->vars[$key];
  }
}
