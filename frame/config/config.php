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

  public $vars = array();
  
  function __construct($iniPath) {
	
		$this->env = $_SERVER['env'];
	
		try { 
			$ini = parse_ini_file($iniPath, true);
		} catch (Exception $e) { 
			echo "wrong filepath"; 
		}

		print_r($ini);
		
    $this->scope = $scope;
    $this->vars['db'] = array(
      "host"  => "localhost",
      "db"    => "tent",
      "user"  => "root",
      "psw"   => ""
    );
    
    define('ROOT',          trim(shell_exec("cd ..; echo `pwd`;")));
    define('CLASSES',       ROOT . '/classes/');
    define('SAMPLE',        ROOT . '/sample/');
    define('SAMPLEFILE',    'sample.tar'); //'sample.tar.gz'
    define('DOMAINS',       ROOT . '/www/domains/');
    define('THIRDPARTY',    ROOT . '/3rdparty/');
    define('ADODB',         THIRDPARTY . '/adodb5/');
    define('CONTROLLERS',   ROOT . '/controllers/');
    define('MODELS',        ROOT . '/models/');
    define('TPL',           ROOT . '/tpl/');
    define('WWW',           ROOT . '/www/');
    define('CSS',           WWW . '/css/');
    define('JS',            WWW . '/js/');
    define('IMG',           WWW . '/img/');
    
    define('ACCOUNT',       'conf/felhasznalok.php');
    
    define('HOST',          $_SERVER['HTTP_HOST']);
  }
  
  public function get($key) {
    return $this->vars[$key];
  }
}
