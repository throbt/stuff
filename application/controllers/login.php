<?php

class Login_controller extends Controller {
	
  public function init() {
    global $session;
    $this->session = $session;
  }
  
  public function index() {
    
    $this->title    = 'Login';
    $form           = $this->router->loader->get('Form');

    $this->content  = $form->render(array(

      'form'      => array(
        'action'    => '/login/process',
        'method'    => 'post',
        '_method'   => 'login',
        'id'        => 'loginForm',
        'token'     => true,
        'class'     => 'well form-horizontal',

        /* (default|empty) */
        'template'  => 'default'
      ),

      'elements'  => array(

          array(
            'type'  => 'text',
            'label' => 'email',
            'id'    => 'email',
            'class' => 'email',
            'name'  => 'email'
          ),
          array(
            'type'  => 'password',
            'label' => 'password',
            'id'    => 'password',
            'class' => 'password',
            'name'  => 'password'
          ),
          array(
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => 'submit'
          )
      )
    ));

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('login','index')
    );
  }
  
  public function process() {
		global $session;
    $profileModel = $this->router->loader->get('Profile');
    $profile      = $profileModel->getProfile(trim($this->post['email']),md5(trim($this->post['password'])));

    if($profile) {
      $this->session->setProfile($profile);

      if($this->session->isObject('destination')) {
        header('location: ' . $this->session->readObject('destination'));
      } else {
        $this->redirect('admin');
      }
    } else {
      $this->redirect('login');
    }
  }

  public function logout() {
    session_destroy();
    session_unset();
    $this->redirect('home');
  }

}


