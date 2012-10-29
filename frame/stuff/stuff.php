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

  /*
    @method debug
    @param $stuff string
    @return no return
  */
  public function debug($stuff) {
		echo "<pre>";
			print_r($stuff);
		echo "</pre>";
	}

  /*
    @method getBaseUriForPaginator
    @return no return
  */
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

  /*
    @method str_getcsv > 5.3
    @param $csvFile string - path to the file.
    @return array
  */
  public function csvHandler($csvFile) {
    return str_getcsv(file_get_contents($csvFile),"\n");
  }

  /*
    @method moveUpload

    @param $key string - the key of $_FILES array
    @param $name string
    @param $to string 
    @return string if success return false if not
  */
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

  /*
    @method getExtension

    @param $fileName string
    @return string
  */
  public function getExtension($fileName) {
    $thisArr = explode('.',$fileName);
    return $thisArr[count($thisArr)-1];
  }

  /*
    @method getDateformatToFe

    @param $thisDate string
    @return array
  */
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

  /*
    @method textCutter

    @param $text string
    @param $length integer
    @return string
  */
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

  /*
    @method sesc - simple escape

    @param $str string
    @return string
  */
  public function sesc($str) {
    return str_replace("'","\'",$str);
  }

  /*
    @method sesc - simple unescape

    @param $str string
    @return string
  */
  public function sunesc($str) {
    return str_replace("\'","'",$str);
  }

  /*
    @method hash2Digit - convert a hash to 1 digit number

    @param $hash string
    @return integer
  */
  public function hash2Digit($hash) {
    return $this->num2OneDigit($this->str2OneDigit($hash));
  }

  /*
    TODO - needs refact, the recursive release is wrong, we need the simpliest way - Done


    @method num2OneDigit - convert a number to 1 digit number
    recursive but only 2 level deep

    @param $num string
    @return integer
  */
  public function num2OneDigit($num) {
    $thisNum = (int)$num;
    return ($thisNum%floor(($thisNum/10)));
    /*$sum  = 0;
    foreach(str_split($num) as $index => $digit) {
      $sum += $digit;
    }
    if($sum > 9)
      $sum = $this->num2OneDigit($sum);
    return $sum;*/
  }

  /*
    @method str2OneDigit - convert a string to number

    @param $str string
    @return integer
  */
  public function str2OneDigit($str) {
    $sum      = 0;
    foreach(str_split($str) as $index => $letter) {
      $sum += hexdec(bin2hex($letter));
    }
    return $sum;
  }
}
