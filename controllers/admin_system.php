<?php
  class Admin_system_controller extends Controller {

    public function init() {
      global $session;
      $this->session = $session;
      if(!$this->session->checkProfile()) {
        //$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
        $this->redirect('login');
        die();
      }

      $this->model = $this->router->loader->get('System','model');
      $this->stuff = $this->router->loader->get('Stuff');

      if(file_exists(CONFIG.'system.cfg')) {
        include CONFIG.'system.cfg';

        if(isset($sys)) {
          $this->sys = json_decode($this->stuff->sunesc($sys));
          $this->sys = $this->sys->system;
        }
      }
    }

    public function index() {

      $this->title = 'Evoline - Site parameters';
      $form           = $this->router->loader->get('Form');

      $this->content  = $form->render(array(

        'form'      => array(
          'action'    => '/admin_system/setup',
          'method'    => 'post',
          '_method'   => '',
          'id'        => 'system',
          'token'     => true,
          'class'     => 'well form-horizontal',

          /* (default|empty) */
          'template'  => 'default'
        ),

        'elements'  => array(

            array(
              'type'  => 'text',
              'label' => 'Site email',
              'id'    => 'site_email',
              'class' => 'input-xlarge',
              'name'  => 'site_email',
              'value' =>  (isset($this->sys->site_email) ? stripslashes($this->sys->site_email) : '')
            ),

            array(
              'type'  => 'text',
              'label' => 'Root email',
              'id'    => 'root_email',
              'class' => 'input-xlarge',
              'name'  => 'root_email',
              'value' =>  (isset($this->sys->root_email) ? stripslashes($this->sys->root_email) : '')
            ),

            array(
              'type'  => 'text',
              'label' => 'Brand',
              'id'    => 'brand',
              'class' => 'input-xlarge',
              'name'  => 'brand',
              'value' =>  (isset($this->sys->brand) ? stripslashes($this->sys->brand) : '')
            ),

            array(
              'type'  => 'text',
              'label' => 'Slogan',
              'id'    => 'slogan',
              'class' => 'input-xlarge',
              'name'  => 'slogan',
              'value' =>  (isset($this->sys->slogan) ? stripslashes($this->sys->slogan) : '')
            ),

            array(
              'type'  => 'text',
              'label' => 'Positions, items / page',
              'id'    => 'positions_items',
              'class' => 'input-xlarge',
              'name'  => 'positions_items',
              'value' =>  (isset($this->sys->positions_items) ? stripslashes($this->sys->positions_items) : '')
            ),

            array(
              'type'  => 'submit',
              'id'    => 'sbm',
              'class' => 'btn btn-primary',
              'value' => 'submit'
            )
        )
      ));

      $breadcrumb = '
        <ul class="breadcrumb">
          <li>
            <a href="/admin_content">Admin Home</a>
            <span class="divider">/</span>
          </li>
          <li class="active">
            Site setup
          </li>
        </ul>
      ';

      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $breadcrumb . $this->content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

#    public function update() {
#      if(isset($this->router->orders[2]) && $this->router->orders[2] == 'setup') {
#        $this->setup();
#      }
#    }

    public function setup() {
      $cfg = array(
        'system' => array()
      );

      foreach($this->post as $k => $p) {
        if($k != 'token' && $k != '_method') {
          $cfg['system'][$k] = $p;
        }
      }

      $this->model->writecfg($cfg);
      $this->redirect('admin_system	');
      die();
    }
  }
?>
