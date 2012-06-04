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
    require_once('phpmailer/class.phpmailer.php');
    $this->mailer = new PHPMailer(true);
    //$this->setup(); //print_r($this);
  }
  
  public function getHeader($to,$name) {
  
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'To: '.$name.' <'.$to.'>' . "\r\n";
    $headers .= 'From: Mannalounge <info@mannalounge.com>' . "\r\n";
    
    return $headers;
  }
  
  public function simpleSend($to,$name,$subject,$body) {
    mail($to, $subject, $body, $this->getHeader($to,$name));
  }

  public function send($email,$name,$subject,$body) {
    $this->mailer->Subject  = $subject;
    $this->mailer->Body     = $body;
    $this->mailerFromName   = $name;
    $this->mailer->AddAddress($email,$name);
    $this->mailer->AddReplyTo("info@mannalounge.com", "Information"); //print_r($this);
    $this->mailer->Send();
  }

  public function setup() {
    global $config;
    $arr = array();
    foreach($config->cfg as $k => $config) {
      if(preg_match("/mail/",$k)) {
        $arr = explode('mail_',$k);
        $this->mailer->$arr[1] = $config;
      }
    }
#    $this->mailer->IsSMTP();
#    $this->mailer->SMTPAuth = true;
    $this->mailer->IsHTML(true);
  }


}
