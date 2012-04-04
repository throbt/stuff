<?php

class Users extends Controller {
  
  public function init() {
    $this->user         = $this->router->loader->get('User','model');
    $this->emailMatcher = "/^[A-Za-z0-9_%+-]+[A-Za-z0-9._%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/";
  }
  
  public function index() {
    $this->router->session->setToken();
    $this->router->content = $this->router->renderTemplate($this->user->getAll(), 'users');
  }
  
  public function add() {
    if(preg_match($this->emailMatcher,$_POST['newemail'])) {
      $this->password   = md5(time());
      $thisHash         = md5($this->password);
      $id               = $this->user->add($_POST['newemail'],$thisHash,$_POST['newname']);
      
      $this->usersroles = $this->router->loader->get('Usersroles','model');
      $this->usersroles->add(1000,$id);
      
      if(is_numeric($id) && $id > 0)
        $this->sendMail($_POST['newemail'],$_POST['newname'],$id);
    }
    
    $this->router->nextRoute = 'users';
    $this->router->goTo();
  }
  
  public function delete() {
    
  }
  
  public function update() {
    
  }
  
  public function sendMail($email,$name,$id) {
    $message  = $this->router->renderTemplate(array(
                  'email' => $email,
                  'name'  => $name,
                  'id'    => $id,
                  'hash'  => $this->password
                ), 'newregmail');
                
    $to       = "{$email}";
    $subject  = "Tárgy: Új regisztráció a " . HOST;
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "To: {$email}" . "\r\n";
    $headers .= 'From: f40@halation.hu Team <f40@halation.hu>' . "\r\n";
    
    mail($to, $subject, $message, $headers);
  }
}
