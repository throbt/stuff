<?php

class Domainss extends Controller {
  
  public function init() {
    $this->router->checkProfile();
    $this->domain = $this->router->loader->get('Domain','model');
    $this->domain->pagePerItem  = 25;
  }
  
  public function show($id) {
    $this->router->session->setToken();
    $this->router->title        = 'domain';
    $this->router->content      = $this->router->renderTemplate(array(
      'domain'  => $this->domain->get($id),
      'state'   => $this->domain->dirState($id)
    ), 'domain');
    $this->router->render();
  }
  
  public function index() { //print_r($this->domain->getAll());
    $this->router->session->setToken();
    
    if($_SESSION['sessionUser']->role_id < 3) {
      $contentArr                 = $this->domain->getAll();
      $contentArr['link']         = $this->getBaseUriForPaginator();
      $this->router->content      = $this->router->renderTemplate($contentArr, 'domains');
    } else {
      $contentArr['result']       = $this->domain->getByOwner();
      $contentArr['link']         = $this->getBaseUriForPaginator();
      $this->router->content      = $this->router->renderTemplate($contentArr, 'domainsforowner');
    }
  }
  
  public function search() { 
    $this->router->session->setToken();
    $contentArr                 = $this->domain->getSearchResult($_GET['key']);
    $contentArr['link']         = $this->getBaseUriForPaginator();
    $this->router->content      = $this->router->renderTemplate($contentArr, 'domains');
    $this->router->render();
  }
  
  public function add() { 
  
    if($this->router->session->checkToken($_POST['token'])) {
      $dir      = trim($_POST['newdomain']);
      $thisDir  = DOMAINS.$dir.'/';
      
      if(is_dir($thisDir)) {
        //$this->io->rrmdir($thisDir);
      } else {
        mkdir(DOMAINS."{$dir}",0777);
        shell_exec("cp ".SAMPLE.SAMPLEFILE." ".DOMAINS."{$dir}/".SAMPLEFILE."; cd ".DOMAINS."{$dir}/; gunzip ".SAMPLEFILE."; tar -xf sample.tar; rm sample.tar; touch builded;");
        shell_exec("chown root:www-data ".DOMAINS."{$dir}/ -R");
        shell_exec("chmod 7777 ".DOMAINS."{$dir}/ -R");
      }
      $this->domain->add($dir,$dir);
    }
    
    $message  = "Kedves Rendszergazda, <br /><br />\r\n\r\n";
    $message .= "Ezúton értesítelek, hogy {$_SESSION['sessionUser']->email} új domaint töltött fel. <br />\r\n\r\n";
    $message .= " a domain neve: {$_POST['newdomain']} <br />\r\n";
    $message .= " a domainhoz tartozó document_root: {$thisDir} <br /><br />\r\n\r\n";
    $message .= "A tartalomkezelő használat megelőzően, a domain beállítását a fenti instrukciók alapján el kell végezni! <br />\r\n";
    $message .= "Ez egy automata értesitőlevél, kerlek, ne válaszolj rá! <br /><br />\r\n\r\n";
    $message .= "Üdv. <br />\r\n";
    $message .= "Tent.hu <br />\r\n";
    
    $to       = "csaba.vincze@szabadalmi.hu, cseszko.ferenc@halation.hu, robthot@gmail.com";
    $subject  = "Értesítés új domain felvételéről: {$_POST['newdomain']}";
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "To: cseszko.ferenc@halation.hu" . "\r\n";
    $headers .= 'From: tent.hu Team <tent.hu>' . "\r\n";
    
    mail($to, $subject, $message, $headers);
    
    $this->router->nextRoute = 'domainss';
    $this->router->goToRoute();
  }
  
  public function delete() {
    if($this->router->session->checkToken($_POST['token'])) {
      $thisDomain = $this->domain->get($_POST['deleteId']);
      $thisDir    = $thisDomain[0]['dir'];
      
      $this->io   = $this->router->loader->get('Io','class');
      
      if(is_dir(DOMAINS."{$thisDir}")) {
        $this->io->rrmdir(DOMAINS."{$thisDir}");
        rmdir(DOMAINS."{$thisDir}");
      }
      $this->domain->delete($_POST['deleteId']);
    }
    $this->router->nextRoute = 'domainss';
    $this->router->goToRoute();
  }
  
  public function update() {
    if($this->router->session->checkToken($_POST['token'])) {
      $this->domain->update($_POST['updateDomain'],$_POST['updateDir'],$_POST['updateId']);
    }
    $this->router->nextRoute = 'domainss';
    $this->router->goToRoute();
  }
  
  public function getDirs() {
    $joinedDirs = $this->domain->getDirs();
    $systemDirs = array(
      'commands',
      'css',
      'errPages',
      'img',
      'js',
      'myadmin',
      'upload'
    );
    $dirs   = scandir(DOMAINS);
    $res    = array();
    foreach($dirs as $dir) {
      if(is_dir($dir) && !in_array($dir,$systemDirs)) {
        if($dir != '.' && $dir != '..')
          $res[] = $dir;
      }
    }
    if(!$joinedDirs) {
      $joinedDirs = array();
    }
    return array_diff($res,$joinedDirs);
  }
}
