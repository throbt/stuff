<?php

class getIo {
  static function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new Io();
    }
    return $obj;
  }
}

class Io {

  function __construct() {
  }
  
  /*
    @method rrmdir

    @param $dir string
    @return no return
  */
  public function rrmdir($dir) {
    if(is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
        }
      }
      reset($objects);
      rmdir($dir);
    }
  }

  /*
    @method curl_request

    @param  $url     string
    @param  $params  array
    @return string
  */
  function curl_request($url, $params) {
    $c = curl_init($url);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $params);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($c);
    curl_close($c);
    return $response;
  }

  /*
    @method curlDownload

    @param $Url string
    @return string
  */
	public function curlDownload($Url) {
	  if (!function_exists('curl_init')){
	      die('Sorry cURL is not installed!');
	  }
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $Url);
	  curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
	  curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	  curl_setopt($ch, CURLOPT_HEADER, 0);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	  $output = curl_exec($ch);
	  curl_close($ch);
	  return $output;
	}

  /*
    @method getFileByFtp

    @param $local   string
    @param $remote  string
    @return boolean
  */
	public function getFileByFtp($local, $remote) {
	  $success = false;
	  if($ret = ftp_nb_get($this->ftp,$local,$remote,FTP_BINARY)) {
	    while ($ret == FTP_MOREDATA) {
	      $ret = ftp_nb_continue($this->ftp);
	    }
	    $success = true;
	  } else {
	    $success = false;
	  }
	  return $success;
	}

  /*
    @method ftpConnect

    @param $passive   string
    @param $account   array
    @return no return
  */
	public function ftpConnect($passive = '',$account=array()) {
	  $this->ftp    = ftp_connect($account['server'],21,90);
	  $login_result = ftp_login($this->ftp, $account['user'],$account['password']);

	  if($passive == 'passive')
	    ftp_pasv($this->ftp, true);
	}

  /*
    @method ftpClose

    @return no return
  */
	public function ftpClose() {
	  ftp_close($this->ftp);
	}

  /*
    @method fileGetContentLines
    
    @param $resource resource
    @return no return
  */
  public function fileGetContentLines($resource) {
    $res  = array();
    $fp   = fopen($resource,'rb');
    while(($line = fgets($fp)) !== false) {
      $res[] = $line;
    }
    return $res;
  }
}
