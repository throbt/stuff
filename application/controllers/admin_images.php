<?php

class Admin_images_controller extends Controller {

  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      //$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Images','model');
    $this->galleries    = $this->router->loader->get('Galleries','model');
    $this->itemPerPage  = 10;
  }
  
  public function index() {

    $this->title    = 'Képek';

    $galleries      = $this->galleries->get();

    $this->content  = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'galleries' => array_slice($galleries,1)
      ),
      $this->view->getTemplatePath('admin_images','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }
  
  public function add() {

    $this->title    = 'Kép hozzáadása';
    $thisGalleries  = $this->galleries->get();
    $galleries      = array();
    foreach($thisGalleries as $k => $gallery) {
      $galleries[$gallery['id']] = $gallery['title'];
    }

    $form           = $this->router->loader->get('Form');
    $content  = $form->render(array(

        'form'      => array(
          'action'    => "/admin_images/add",
          'method'    => 'post',
          'enctype'   => 'multipart/form-data',
          'token'     => true,
          '_method'   => 'create',
          'id'        => 'create_image',
          'class'     => 'well form-horizontal',
          'template'  => 'default'
        ),

        'elements'      => array(
            array(
              'type'  => 'text',
              'label' => 'Név',
              'id'    => 'title',
              'class' => 'input-xlarge',
              'name'  => 'title'
            ),

            array(
              'type'  => 'text',
              'label' => 'Leírás',
              'id'    => 'lead',
              'class' => 'input-xlarge',
              'name'  => 'lead'
            ),

            array(
            'type'    => 'select',
            'label'   => 'Galéria',
            /*'new'     => 'true',*/
            'id'      => 'gallery',
            'class'   => 'input-xlarge',
            'name'    => 'gallery',
            'options' =>  $galleries
          ),

            array(
              'type'  => 'file',
              'label' => 'Leírás',
              'id'    => 'image',
              'class' => 'input-xlarge',
              'name'  => 'image'
            ),

            array(
              'type'  => 'submit',
              'id'    => 'sbm',
              'class' => 'btn btn-primary',
              'value' => 'Feltöltés'
            )
        ),

      ));

    $this->content  = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $content
      ),
      $this->view->getTemplatePath('admin_images','add')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function show() {
    if(isset($this->router->orders[2]) && $this->router->orders[2] == 'edit') {
      $this->edit();
    } else {
      $image = $this->model->get(
        '',
        array(
          "
          select
            m.*,
            g.title as thisGallery
              from
                images m
            left join
                galleries g
            on
              m.gallery = g.id
            where
              m.id = ?
          ",
          array($this->index)
        )
      );
      $this->title    = $image[0]['title'];
      $this->content  = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $image[0]
        ),
        $this->view->getTemplatePath('admin_images','show')
      );

      echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
    }
  }

  public function create() {
    $stuff    = $this->router->loader->get('Stuff');
    $thisName = md5(microtime());
    if($newImege = $stuff->moveUpload('image',$thisName,UPLOAD.$this->post['gallery'])) {
      $this->model->create(array(
        'title'         => $this->post['title'],
        'lead'          => $this->post['lead'],
        'gallery'       => $this->post['gallery'],
        'name'          => $newImege,
        'created'       => 'now()'
      ));
      $thisId = $this->model->db->lastInsertId();
      $this->redirect("admin_images/{$thisId}");
      die();
    }
  }
}
