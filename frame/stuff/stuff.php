<?php

class getStuff {
  static function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new Stuff();
    }
    return $obj;
  }
}

class Stuff {

  function __construct() {
  }
  
  public function debug($stuff) {
		echo "<pre>";
			print_r($stuff);
		echo "</pre>";
	}
	
	public function getBaseUriForPaginator() {
    $url = $_SERVER['REQUEST_URI'];
    if(preg_match('/(.*)(page)/',$url,$matches)) {
      $url = $matches[1];
      if(preg_match("/(.*)(\&)/",$url,$matches)) {
        $url = $matches[0];
      } else if(preg_match("/(.*)(\?)/",$url,$matches)) {
        $url = $matches[0];
      } 
    } else if(preg_match("/(.*)(\?)/",$url,$matches)) {
      $url .= '&';
    } else {
      $url .= '?'; 
    }
    return $url;
  }

  public function csvHandler($csvFile) {
    return str_getcsv(file_get_contents($csvFile),"\n");
  }

  public function moveUpload($key='',$name='',$to='') {
    if($key != '' && $name != '' && $to != '') {
      if($_FILES[$key]["error"] == 0) {
        if(!is_dir($to)) {
          mkdir($to);
        }
        $ext      = $this->getExtension($_FILES[$key]["name"]);
        $newFile  = "{$name}.{$ext}";
        if(move_uploaded_file($_FILES[$key]["tmp_name"],"{$to}/{$newFile}")) {
          return $newFile;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function getExtension($fileName) {
    $thisArr = explode('.',$fileName);
    return $thisArr[count($thisArr)-1];
  }

  public function getDateformatToFe($thisDate) {
    $thisMonths = array(
      '01' => 'JAN',
      '02' => 'FEB',
      '03' => 'MÁR',
      '04' => 'ÁPR',
      '05' => 'MÁJ',
      '06' => 'JÚN',
      '07' => 'JÚL',
      '08' => 'AUG',
      '09' => 'SZE',
      '10' => 'OKT',
      '11' => 'NOV',
      '12' => 'DEC'
    );
    $arr = explode('-',$thisDate);
    
    return array($arr[0],$thisMonths[$arr[1]],$arr[2]);
  }

  public function textCutter($text, $length) {
    $out = '';
    foreach(explode(' ',$text) as $part) {
      if(strlen($out . " {$part}") < $length) { 
        $out .= " {$part}";
      } else {
        return $out;
      }
    }
    return $out;
  }
}
