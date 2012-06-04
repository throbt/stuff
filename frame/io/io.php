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

/*
  |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\   |\_____|\
  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\  |       0\
  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /  | A____  /
  |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/   |/|/ |/\/
*/

class Io {

  function __construct() {
  }
  
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

	public function getFileByFtp($local, $remote) {
	  $success = false;
	  if($ret = ftp_nb_get($this->ftp,$local,$remote,FTP_BINARY)) {
	    while ($ret == FTP_MOREDATA) {
	      $ret = ftp_nb_continue($this->ftp);
	    }
	    $success = 1;
	  } else {
	    $success = false;
	  }
	  return $success;
	}

	public function ftpConnect($passive = '',$account=array()) {
	  $this->ftp    = ftp_connect($account['server'],21,90);
	  $login_result = ftp_login($this->ftp, $account['user'],$account['password']);

	  if($passive == 'passive')
	    ftp_pasv($this->ftp, true);
	}

	public function ftpClose() {
	  ftp_close($this->ftp);
	}
	
}
