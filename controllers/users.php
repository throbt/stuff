<?php

class Users extends Controller {
  
  public function init() {
    $this->user         = $this->router->loader->get('User','model');
    $this->emailMatcher = "/^[A-Za-z0-9_%+-]+[A-Za-z0-9._%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/";
    //$this->user->pagePerItem    = 10;
  }
  
  public function index() {
    $key = (isset($_GET['key']) ? $_GET['key'] : '');
    $this->router->session->setToken();
    
    $contentArr         = $this->user->getAll($key);
    $contentArr['link'] = $this->getBaseUriForPaginator();
    
    $this->router->content = $this->router->renderTemplate($contentArr, 'users');
  }
  
  public function add() {
    if(preg_match($this->emailMatcher,$_POST['newemail'])) {
      $this->password   = md5(time());
      $thisHash         = md5($this->password);
      $id               = $this->user->add($_POST['newemail'],$this->password,$_POST['newname']);
      
      $this->usersroles = $this->router->loader->get('Usersroles','model');
      $this->usersroles->add(1000,$id);
      
      if(is_numeric($id) && $id > 0)
        $this->sendMail($_POST['newemail'],$_POST['newname'],$id);
    }
    
    $this->router->nextRoute = 'users';
    $this->router->goToRoute();
  }
  
  public function delete() {
    $this->user->delete($_POST['deleteId']); 
    $this->router->nextRoute = 'users';
    $this->router->goToRoute();
  }
  
  public function update() {
    $this->user->update($_POST['updateId'],$_POST['updateRole']);
    $this->router->nextRoute = 'users';
    $this->router->goToRoute();
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
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "To: {$email}" . "\r\n";
    $headers .= 'From: tent.hu Team <tent.hu>' . "\r\n";
    
    mail($to, $subject, $message, $headers);
  }
}
