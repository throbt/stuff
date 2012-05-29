<?php 

class getMailer {
  static function &get() {
    static $obj;
    if (!is_object($obj)){
      $obj = new Mailer();
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

class Mailer {

  function __construct() {
    require_once('phpmailer/phpmailer.inc.php');
    $this->mailer = new PHPMailer(true);
    $this->setup(); print_r($this);
  }

  public function setup() {
    global $config;  //print_r($config);
    $arr = array();
    foreach($config->cfg as $k => $config) {
      if(preg_match("/mail/",$k)) {
        $arr = explode('mail_',$k);
        $this->mailer->$arr[1] = $config;
      }
    }
    // $this->mailer->SMTPAuth = true;
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->ContentType = 'text/html';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
    // $this->mailer->CharSet = 'utf-8';
  }


}