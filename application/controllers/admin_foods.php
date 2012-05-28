<?php

class Admin_foods_controller extends Controller {

  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      //$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Foods','model');
    $this->itemPerPage  = 10;
  }

  public function index() {

    $res = $this->model->getAll(

      "select
          *
          from
            foods
        order by
          edited desc, created desc",

      "select
        count(*) as counter
          from
            foods",

      array(),

      $this->itemPerPage,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    $this->title   = 'Ételek';

    $paginator = $this->view->renderTemplate(
      array(
        'all'     => $res['all'],
        'current' => $res['current'],
        'url'     => implode('/',$this->router->orders)
      ),
      $this->view->getTemplatePath('paginator','paginator')
    );

    $this->content = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $res['result'],
        'paginator' => $paginator
      ),
      $this->view->getTemplatePath('admin_foods','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function csvProcess() {
    $stuff      = $this->router->loader->get('Stuff');
    $thisName   = $_FILES['csv']["name"];
    $thisDrinx  = array();
    if($newFile = $stuff->moveUpload('csv',$thisName,UPLOAD.'csv')) {
      $foods = array_slice($stuff->csvHandler(UPLOAD.'csv/'.$newFile),1);
      
      foreach($foods as $food) {
        $arr          = explode(';',$food);

        // $thisDrinx[]  = array(
        //   // ﻿name;content;price;type;language;date;title;keywords;description
        //   'title'         => $arr[0],
        //   'body'          => $arr[1],
        //   'price'         => $arr[2],
        //   'type'          => $arr[3],
        //   'lang'          => $arr[4],
        //   'date'          => $arr[5],
        //   'meta_title'    => $arr[6],
        //   'meta_keywords' => $arr[7],
        //   'meta_desc'     => $arr[8]
        // );

        $this->model->create(array(
          'title'         => $arr[0],
          'body'          => $arr[1],
          'price'         => $arr[2],
          'type'          => $arr[3],
          'lang'          => strtolower($arr[4]),
          'meta_title'    => $arr[6],
          'meta_keywords' => $arr[7],
          'meta_desc'     => $arr[8],
          'active'        => 'true',
          'created'       => str_replace('-','.',$arr[5])
        ));
        
      }
      $this->redirect("admin_foods");
      die();
    } else {
      $this->redirect("admin_foods/import");
    }
  }

  public function import() {
    $this->title    = 'Import - ételek';
    $form           = $this->router->loader->get('Form');
    $content  = $form->render(array(

      'form'      => array(
        'action'    => "/admin_foods/csvProcess",
        'method'    => 'post',
        'enctype'   => 'multipart/form-data',
        'token'     => true,
        '_method'   => 'create',
        'id'        => 'import_foods',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'      => array(
          array(
            'type'  => 'file',
            'label' => 'csv',
            'id'    => 'csv',
            'class' => 'input-xlarge',
            'name'  => 'csv'
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
      $this->view->getTemplatePath('admin_foods','import')
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
    $this->title    = 'Új étel';
    $form           = $this->router->loader->get('Form');
    $thisForm       = $form->render(array(

      'form'      => array(
        'action'    => '/admin_foods',
        'method'    => 'post',
        'token'     => true,
        '_method'   => 'create',
        'id'        => 'create_foods',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'  => array(

          array(
            'type'  => 'text',
            'label' => 'Cím',
            'id'    => 'title',
            'class' => 'input-xlarge',
            'name'  => 'title'
          ),

          array(
            'type'  => 'hidden',
            'value' => '',
            'id'    => 'node_image',
            'name'  => 'image'
          ),

          array(
            'type'  => 'special',
            'html'  => '
              <div class="control-group">
                <button id="sbm" class="btn btn-primary imager" type="button">Kép választása a lista nézethez</button>
              </div>
            '
          ),

          array(
            'type'  => 'text',
            'label' => 'Típus',
            'id'    => 'type',
            'class' => 'input-xlarge',
            'name'  => 'type'
          ),
          array(
            'type'  => 'text',
            'label' => 'Ár',
            'id'    => 'price',
            'class' => 'input-xlarge',
            'name'  => 'price'
          ),

          array(
            'type'    => 'select',
            'label'   => 'Nyelv',
            'id'      => 'lang',
            'class'   => 'input-xlarge',
            'name'    => 'lang',
            'options' =>  array('hu','en','de'),
            'value'   => 'hu'
          ),
          array(
            'type'  => 'text',
            'label' => 'Lead',
            'id'    => 'lead',
            'class' => 'input-xlarge',
            'name'  => 'lead'
          ),
          array(
            'type'  => 'textarea',
            'label' => 'Tartalom',
            'id'    => 'body',
            'class' => 'input-xlarge',
            'name'  => 'body'
          ),

          array(
            'type'  => 'text',
            'label' => 'meta - Cím',
            'id'    => 'meta_title',
            'class' => 'input-xlarge',
            'name'  => 'meta_title'
          ),
          array(
            'type'  => 'text',
            'label' => 'meta - Keywords',
            'id'    => 'meta_keywords',
            'class' => 'input-xlarge',
            'name'  => 'meta_keywords'
          ),
          array(
            'type'  => 'text',
            'label' => 'meta - Leírás',
            'id'    => 'meta_desc',
            'class' => 'input-xlarge',
            'name'  => 'meta_desc'
          ),
          
          array(
            'type'  => 'checkbox',
            'label' => 'Aktív',
            'id'    => 'active',
            'class' => 'input-xlarge',
            'name'  => 'active'
          ),

          array(
            'type'  => 'text',
            'label' => 'Megjelenés, tól:',
            'id'    => 'date_from',
            'class' => 'input-xlarge datep',
            'name'  => 'date_from'
          ),
          array(
            'type'  => 'text',
            'label' => 'Megjelenés, ig:',
            'id'    => 'date_to',
            'class' => 'input-xlarge datep',
            'name'  => 'date_to'
          ),

          array(
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => 'Ment'
          )
      )
    ));
    
    $this->content = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $thisForm
      ),
      $this->view->getTemplatePath('admin_foods','add')
    );
    
    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function update() {

    global $session;
    if($session->checkToken($this->post['token'])) {
      $this->model->update(
        $this->post['id'],
        array(
        'title'         => $this->post['title'],

        'type'          => $this->post['type'],
        'price'         => $this->post['price'],

        'lang'          => $this->post['lang'],
        'lead'          => $this->post['lead'],
        'image'         => $this->post['image'],
        'body'          => $this->post['body'],

        'meta_title'    => $this->post['meta_title'],
        'meta_keywords' => $this->post['meta_keywords'],
        'meta_desc'     => $this->post['meta_desc'],

        'active'        => (isset($this->post['active']) ? 'true' : 'false'),

        'date_from'     => $this->post['date_from'],
        'date_to'       => $this->post['date_to'],

        'edited'        => 'now()'
      ));
      $thisId = $this->model->db->lastInsertId();
      $this->redirect("admin_foods/{$this->post['id']}/edit");
    } else {
      $this->redirect("admin_foods");
    }
  }

  public function create() {

    if(isset($this->router->orders[1]) && $this->router->orders[1] == 'csvProcess') {
      $this->csvProcess();
      die();
    }

    global $session;
    if($session->checkToken($this->post['token'])) {
      $this->model->create(array(
        'title'         => $this->post['title'],

        'type'          => $this->post['type'],
        'price'         => $this->post['price'],
        
        'lang'          => $this->post['lang'],
        'lead'          => $this->post['lead'],
        'image'         => $this->post['image'],
        'body'          => $this->post['body'],

        'meta_title'    => $this->post['meta_title'],
        'meta_keywords' => $this->post['meta_keywords'],
        'meta_desc'     => $this->post['meta_desc'],

        'active'        => (isset($this->post['active']) ? 'true' : 'false'),

        'date_from'     => $this->post['date_from'],
        'date_to'       => $this->post['date_to'],

        'created'        => 'now()'
      ));
      $thisId = $this->model->db->lastInsertId();
      $this->redirect("admin_foods/{$thisId}");
    } else {
      $this->redirect("admin_foods");
    }
  }

  public function show() {
    if(isset($this->router->orders[2]) && $this->router->orders[2] == 'edit') {
      $this->edit();
    }

     else {
      $article        = $this->model->get($this->index);
      $this->title    = $article[0]['title'];
      $this->content  = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $article[0]
        ),
        $this->view->getTemplatePath('admin_foods','show')
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

  public function delete() {
    global $session;
    if($session->checkToken($this->post['token'])) {
      $this->model->delete($this->index);
      $this->redirect("admin_foods");
    } else {
      $this->redirect("admin_foods");
    }
  }

  public function edit() {
    $article = $this->model->get($this->index);

    $thisSpecial    = ($article[0]['image'] == 0 ? '<button id="sbm" class="btn btn-primary imager" type="button">Kép választása a lista nézethez</button>'
      : "<label>Lista nézet kép:</label><img class='modalGalleryImg imager' rel='{$article[0]['gallery']}' src='/upload/{$article[0]['gallery']}/{$article[0]['name']}'>"
    );

    $this->title    = "szerkesztés - {$article[0]['title']}";

    $form           = $this->router->loader->get('Form');
    $this->content  = $form->render(array(

      'form'      => array(
        'action'    => "/admin_foods/{$article[0]['id']}",
        'method'    => 'post',
        'token'     => true,
        '_method'   => 'update',
        'id'        => 'create_food',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'  => array(

          array(
            'type'  => 'hidden',
            'id'    => 'id',
            'class' => 'hidden',
            'name'  => 'id',
            'value' => $article[0]['id']
          ),
          array(
            'type'  => 'text',
            'label' => 'Cím',
            'id'    => 'title',
            'class' => 'input-xlarge',
            'name'  => 'title',
            'value' => $article[0]['title']
          ),

          array(
            'type'  => 'hidden',
            'value' => '',
            'id'    => 'node_image',
            'name'  => 'image',
            'value' => $article[0]['image']
          ),

          array(
            'type'  => 'special',
            'html'  => '
              <div class="control-group">
                '.(isset($thisSpecial) ? $thisSpecial : '').'
              </div>
            '
          ),

          array(
            'type'  => 'text',
            'label' => 'Típus',
            'id'    => 'type',
            'class' => 'input-xlarge',
            'name'  => 'type',
            'value' => $article[0]['type']
          ),
          array(
            'type'  => 'text',
            'label' => 'Ár',
            'id'    => 'price',
            'class' => 'input-xlarge',
            'name'  => 'price',
            'value' => $article[0]['price']
          ),

          array(
            'type'    => 'select',
            'label'   => 'Nyelv',
            'id'      => 'lang',
            'class'   => 'input-xlarge',
            'name'    => 'lang',
            'options' =>  array('hu','en','de'),
            'value'   => $article[0]['lang']
          ),

          array(
            'type'  => 'text',
            'label' => 'Lead',
            'id'    => 'lead',
            'class' => 'input-xlarge',
            'name'  => 'lead',
            'value' => $article[0]['lead']
          ),
          array(
            'type'  => 'textarea',
            'label' => 'Tartalom',
            'id'    => 'body',
            'class' => 'input-xlarge',
            'name'  => 'body',
            'value' => $article[0]['body']
          ),

          array(
            'type'  => 'text',
            'label' => 'meta - Cím',
            'id'    => 'meta_title',
            'class' => 'input-xlarge',
            'name'  => 'meta_title',
            'value' => $article[0]['meta_title']
          ),
          array(
            'type'  => 'text',
            'label' => 'meta - Keywords',
            'id'    => 'meta_keywords',
            'class' => 'input-xlarge',
            'name'  => 'meta_keywords',
            'value' => $article[0]['meta_keywords']
          ),
          array(
            'type'  => 'text',
            'label' => 'meta - Leírás',
            'id'    => 'meta_desc',
            'class' => 'input-xlarge',
            'name'  => 'meta_desc',
            'value' => $article[0]['meta_desc']
          ),
          
          array(
            'type'    => 'checkbox',
            'label'   => 'Aktív',
            'id'      => 'active',
            'class'   => 'input-xlarge',
            'name'    => 'active',
            'checked' => $article[0]['active']
          ),

          array(
            'type'  => 'text',
            'label' => 'Megjelenés, tól:',
            'id'    => 'date_from',
            'class' => 'input-xlarge datep',
            'name'  => 'date_from',
            'value' => $article[0]['date_from']
          ),
          array(
            'type'  => 'text',
            'label' => 'Megjelenés, ig:',
            'id'    => 'date_to',
            'class' => 'input-xlarge datep',
            'name'  => 'date_to',
            'value' => $article[0]['date_to']
          ),

          array(
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => 'Ment'
          )
      )
    ));

    $thisForm = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin_foods','edit')
    );
  
    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $thisForm
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }
}
