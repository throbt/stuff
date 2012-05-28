<?php

class Newsletter_controller extends Controller {
  
  public function init() {
    $this->model = $this->router->loader->get('Newsletter','model');
  }
  
  public function index() {

    $this->title    = 'Feliratkozás a hírleveleinkre';
    $form           = $this->router->loader->get('Form');
    $thisForm       = $form->render(array(

      'form'      => array(
        'action'    => "/newsletter/create",
        'method'    => 'post',
        'token'     => true,
        '_method'   => 'create',
        'id'        => 'create_newsletter',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'      => array(

          array(
            'type'  => 'text',
            'label' => 'Adja meg a nevét',
            'id'    => 'name',
            'class' => '',
            'name'  => 'name'
          ),

          array(
            'type'  => 'text',
            'label' => 'Adja meg az email címét',
            'id'    => 'newsletter',
            'class' => '',
            'name'  => 'newsletter'
          ),

          array(
            'type'  => 'submit',
            'id'    => 'newsletter_sbm',
            'class' => 'btn btn-primary',
            'value' => 'Elküld'
          )
      ),

    )); 

    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $thisForm
      ),
      $this->view->getTemplatePath('newsletter','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }

  public function create() {

    global $session;
    if($session->checkToken($this->post['token'])) {
      $this->model->create(array(

        'name'          => $this->post['name'],
        'email'         => $this->post['newsletter'],
        'active'        => 'true',
        'hash'          => md5(time()),
        'adate'         => 'now()'

      ));
      $this->redirect("newsletter");
    } else {
      $this->redirect("newsletter");
    }
  }
}