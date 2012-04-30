<?php

class Linkto extends Controller {
  
  public function init() {
    $this->domain = $this->router->loader->get('Domain','model');
    $this->user   = $this->router->loader->get('User','model');
  }
  
  public function show($id) {
    if(isset($_GET['uid'])) {
      $domain   = ($_SESSION['sessionUser']->role_id >= 3 ? $this->domain->getDomainForOwner($id) : $this->domain->get($id));
      $profile  = $this->user->getById($_GET['uid']);
      
      if(isset($domain) && isset($profile)) {
        $email  = urlencode($profile->email);
        $psw    = urlencode($profile->psw);
        
        $this->setAccounts($profile,$domain);
        
        $link   = "http://{$domain[0]['domain']}?o=kezelo&user={$email}&passw={$psw}";
        header("location: {$link}");
      } else {
        $this->router->nextRoute = "cegunkrol";
        $this->router->goToRoute();
      }
      die();
    }
  }
  
  public function setAccounts($profile,$domain) {
    $thisDir      = DOMAINS.$domain[0]['dir'].'/';
    $accounts     = $this->getAccounts($profile,$domain,$thisDir); //print_r($profile); print_r($accounts); die();
    if(gettype($accounts) == 'array' && count($accounts) > 0) { 
      if(!$this->inAccounts(array($profile->email,$profile->psw),$accounts)) {
        array_push($accounts,array(
          'nev'     => $profile->email,
          'jelszo'  => $profile->psw
        ));
        file_put_contents($thisDir.ACCOUNT,base64_encode(serialize($accounts)));
      }
    } else { 
      $account      = base64_encode(serialize(array(
        1 => array(
          'nev'     => $profile->email,
          'jelszo'  => $profile->psw
        )
      )));
      file_put_contents($thisDir.ACCOUNT,$account);
    }
  }
  
  public function getAccounts($profile,$domain,$thisDir) {
    return unserialize(base64_decode(file_get_contents($thisDir.ACCOUNT)));
  }
  
  public function inAccounts($arr,$accounts) {
    $thisReturn = false;
    foreach($accounts as $acc) {
      if($arr[0] == $acc['nev'] && $arr[1] == $acc['jelszo']) {
        $thisReturn = true;
        break;
      }
    }
    return $thisReturn;
  }
}
