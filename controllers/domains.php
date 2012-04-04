<?php

class Domains extends Controller {
  
  public function init() {
    $this->domain = $this->router->loader->get('Domain','model');
  }
  
  public function index() {
    $this->router->session->setToken();
    $this->domain->pagePerItem  = 10;
    $contentArr                 = $this->domain->getAll();
    $contentArr['link']         = $this->getBaseUriForPaginator();
    $this->router->content      = $this->router->renderTemplate($contentArr, 'domains');
  }
  
  public function search() { 
    $this->router->session->setToken();
    $contentArr             = $this->domain->getSearchResult($_GET['key']);
    $contentArr['link']     = $this->getBaseUriForPaginator();
    $this->router->content  = $this->router->renderTemplate($contentArr, 'domains');
    $this->router->render();
  }
  
  public function add() {
    if($this->router->session->checkToken($_POST['token'])) {
      $this->domain->add($_POST['newdomain'],$_POST['dir']);
    }
    $this->router->nextRoute = 'domains';
    $this->router->goTo();
  }
  
  public function delete() {
    if($this->router->session->checkToken($_POST['token'])) {
      $this->domain->delete($_POST['deleteId']);
    }
    $this->router->nextRoute = 'domains';
    $this->router->goTo();
  }
  
  public function update() {
    if($this->router->session->checkToken($_POST['token'])) {
      $this->domain->update($_POST['updateDomain'],$_POST['updateDir'],$_POST['updateId']);
    }
    $this->router->nextRoute = 'domains';
    $this->router->goTo();
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
    $dirs   = scandir(WWW);
    $res    = array();
    foreach($dirs as $dir) {
      if(is_dir($dir) && !in_array($dir,$systemDirs)) {
        if($dir != '.' && $dir != '..')
          $res[] = $dir;
      }
    }
    return array_diff($res,$joinedDirs);
  }
}
