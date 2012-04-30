<?php

class Routeaccess extends Controller {
  
  public function init() {
    $this->route = $this->router->loader->get('Route','model');
    $this->route->pagePerItem  = 10;
  }
  
  public function index() {
    $key = (isset($_GET['key']) ? $_GET['key'] : '');
    $this->router->session->setToken();
    
    $contentArr                 = $this->route->getAll($key);
    $contentArr['link']         = $this->getBaseUriForPaginator();
    
    $this->router->content = $this->router->renderTemplate($contentArr, 'routeaccess');
  }
  
  public function add() {
    $this->route->add($_POST['newroute'],$_POST['newname']);
    $this->router->nextRoute = 'routeaccess';
    $this->router->goToRoute();
  }
  
  public function update() {
    $this->route->update($_POST['updateId'],$_POST['updateRole'],$_POST['updateName']);
    $this->router->nextRoute = 'routeaccess';
    $this->router->goToRoute();
  }
  
  public function delete() {
    $this->route->delete($_POST['deleteId']);
    $this->router->nextRoute = 'routeaccess';
    $this->router->goToRoute();
  }
}
