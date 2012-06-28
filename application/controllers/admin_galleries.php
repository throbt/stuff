<?php

class Admin_galleries_controller extends Nodecontroller {

  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Node');
    $this->itemPerPage  = 10;
  }

  public function index() {

    $res          = $this->indexAction('galleries');
    $this->title  = 'Galériák';
    $paginator    = $this->view->renderTemplate(
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
      $this->view->getTemplatePath('admin_galleries','index')
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

    $gallery = $this->showAction('galleries');

    $this->title    = $gallery[0]['title'];
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $gallery[0]
      ),
      $this->view->getTemplatePath('admin_galleries','show')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  // public function update() {
  //   $res = $this->updateAction();
  // }


  // public function index() {

  //   $res = $this->model->getAll(

  //     "select
  //         *
  //         from
  //           galleries
  //       order by
  //         edited desc, created desc",

  //     "select
  //       count(*) as counter
  //         from
  //           galleries",

  //     array(),

  //     $this->itemPerPage,

  //     (isset($this->get['page']) ? $this->get['page'] : 1)
  //   );

  //   $this->title   = 'Galériák';

  //   $paginator = $this->view->renderTemplate(
  //     array(
  //       'all'     => $res['all'],
  //       'current' => $res['current'],
  //       'url'     => implode('/',$this->router->orders)
  //     ),
  //     $this->view->getTemplatePath('paginator','paginator')
  //   );

  //   $this->content = $this->view->renderTemplate(
  //     array(
  //       'scope'     => $this,
  //       'data'      => $res['result'],
  //       'paginator' => $paginator
  //     ),
  //     $this->view->getTemplatePath('admin_galleries','index')
  //   );

  //   echo $this->view->renderTemplate(
  //     array(
  //       'scope'   => $this,
  //       'data'    => $this->content
  //     ),
  //     $this->view->getTemplatePath('admin','main')
  //   );
  // }

  // public function add() {
  //   $this->title    = 'Új galéria';
  //   $form           = $this->router->loader->get('Form');
  //   $thisForm       = $form->render(array(

  //     'form'      => array(
  //       'action'    => '/admin_galleries',
  //       'method'    => 'post',
  //       'token'     => true,
  //       '_method'   => 'create',
  //       'id'        => 'create_gallery',
  //       'class'     => 'well form-horizontal',
  //       'template'  => 'default'
  //     ),

  //     'elements'  => array(

  //         array(
  //           'type'  => 'text',
  //           'label' => 'Cím',
  //           'id'    => 'title',
  //           'class' => 'input-xlarge',
  //           'name'  => 'title'
  //         ),
  //         array(
  //           'type'    => 'select',
  //           'label'   => 'Nyelv',
  //           'id'      => 'lang',
  //           'class'   => 'input-xlarge',
  //           'name'    => 'lang',
  //           'options' =>  array('hu','en','de'),
  //           'value'   => 'hu'
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'Lead',
  //           'id'    => 'lead',
  //           'class' => 'input-xlarge',
  //           'name'  => 'lead'
  //         ),
  //         array(
  //           'type'  => 'textarea',
  //           'label' => 'Tartalom',
  //           'id'    => 'body',
  //           'class' => 'input-xlarge',
  //           'name'  => 'body'
  //         ),

  //         array(
  //           'type'  => 'text',
  //           'label' => 'meta - Cím',
  //           'id'    => 'meta_title',
  //           'class' => 'input-xlarge',
  //           'name'  => 'meta_title'
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'meta - Keywords',
  //           'id'    => 'meta_keywords',
  //           'class' => 'input-xlarge',
  //           'name'  => 'meta_keywords'
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'meta - Leírás',
  //           'id'    => 'meta_desc',
  //           'class' => 'input-xlarge',
  //           'name'  => 'meta_desc'
  //         ),
          
  //         array(
  //           'type'  => 'checkbox',
  //           'label' => 'Aktív',
  //           'id'    => 'active',
  //           'class' => 'input-xlarge',
  //           'name'  => 'active'
  //         ),

  //         array(
  //           'type'  => 'text',
  //           'label' => 'Megjelenés, tól:',
  //           'id'    => 'date_from',
  //           'class' => 'input-xlarge datep',
  //           'name'  => 'date_from'
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'Megjelenés, ig:',
  //           'id'    => 'date_to',
  //           'class' => 'input-xlarge datep',
  //           'name'  => 'date_to'
  //         ),

  //         array(
  //           'type'  => 'submit',
  //           'id'    => 'sbm',
  //           'class' => 'btn btn-primary',
  //           'value' => 'Ment'
  //         )
  //     )
  //   ));
    
  //   $this->content = $this->view->renderTemplate(
  //     array(
  //       'scope' => $this,
  //       'data'  => $thisForm
  //     ),
  //     $this->view->getTemplatePath('admin_galleries','add')
  //   );
    
  //   echo $this->view->renderTemplate(
  //     array(
  //       'scope' => $this,
  //       'data'  => $this->content
  //     ),
  //     $this->view->getTemplatePath('admin','main')
  //   );
  // }

  // public function update() {

  //   global $session;
  //   if($session->checkToken($this->post['token'])) {
  //     $this->model->update(
  //       $this->post['id'],
  //       array(
  //       'title'         => $this->post['title'],
  //       'lang'          => $this->post['lang'],
  //       'lead'          => $this->post['lead'],
  //       'body'          => $this->post['body'],

  //       'meta_title'    => $this->post['meta_title'],
  //       'meta_keywords' => $this->post['meta_keywords'],
  //       'meta_desc'     => $this->post['meta_desc'],

  //       'active'        => (isset($this->post['active']) ? 'true' : 'false'),

  //       'date_from'     => $this->post['date_from'],
  //       'date_to'       => $this->post['date_to'],

  //       'edited'        => 'now()'
  //     ));
  //     $thisId = $this->model->db->lastInsertId();
  //     $this->redirect("admin_galleries/{$this->post['id']}/edit");
  //   } else {
  //     $this->redirect("admin_galleries");
  //   }
  // }

  // public function create() {

  //   global $session;
  //   if($session->checkToken($this->post['token'])) {
  //     $this->model->create(array(
  //       'title'         => $this->post['title'],
  //       'lang'          => $this->post['lang'],
  //       'lead'          => $this->post['lead'],
  //       'body'          => $this->post['body'],

  //       'meta_title'    => $this->post['meta_title'],
  //       'meta_keywords' => $this->post['meta_keywords'],
  //       'meta_desc'     => $this->post['meta_desc'],

  //       'active'        => (isset($this->post['active']) ? 'true' : 'false'),

  //       'date_from'     => $this->post['date_from'],
  //       'date_to'       => $this->post['date_to'],

  //       'created'        => 'now()'
  //     ));
  //     $thisId = $this->model->db->lastInsertId();
  //     $this->redirect("admin_galleries/{$thisId}");
  //   } else {
  //     $this->redirect("admin_galleries");
  //   }
  // }

  // public function show() {
  //   if(isset($this->router->orders[2]) && $this->router->orders[2] == 'edit') {
  //     $this->edit();
  //   }

  //    else {
  //     $article        = $this->model->get($this->index);
  //     $this->title    = $article[0]['title'];
  //     $this->content  = $this->view->renderTemplate(
  //       array(
  //         'scope' => $this,
  //         'data'  => $article[0]
  //       ),
  //       $this->view->getTemplatePath('admin_galleries','show')
  //     );

  //     echo $this->view->renderTemplate(
  //     array(
  //       'scope' => $this,
  //       'data'  => $this->content
  //     ),
  //     $this->view->getTemplatePath('admin','main')
  //   );
  //   }
  // }

  // public function delete() {
  //   global $session;
  //   if($session->checkToken($this->post['token'])) {
  //     $this->model->delete($this->index);
  //     $this->redirect("admin_galleries");
  //   } else {
  //     $this->redirect("admin_galleries");
  //   }
  // }

  // public function edit() {
  //   $article = $this->model->get($this->index);
  //   $this->title    = "szerkesztés - {$article[0]['title']}";

  //   $form           = $this->router->loader->get('Form');
  //   $this->content  = $form->render(array(

  //     'form'      => array(
  //       'action'    => "/admin_galleries/{$article[0]['id']}",
  //       'method'    => 'post',
  //       'token'     => true,
  //       '_method'   => 'update',
  //       'id'        => 'create_gallery',
  //       'class'     => 'well form-horizontal',
  //       'template'  => 'default'
  //     ),

  //     'elements'  => array(

  //         array(
  //           'type'  => 'hidden',
  //           'id'    => 'id',
  //           'class' => 'hidden',
  //           'name'  => 'id',
  //           'value' => $article[0]['id']
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'Cím',
  //           'id'    => 'title',
  //           'class' => 'input-xlarge',
  //           'name'  => 'title',
  //           'value' => $article[0]['title']
  //         ),

  //         array(
  //           'type'    => 'select',
  //           'label'   => 'Nyelv',
  //           'id'      => 'lang',
  //           'class'   => 'input-xlarge',
  //           'name'    => 'lang',
  //           'options' =>  array('hu','en','de'),
  //           'value'   => $article[0]['lang']
  //         ),

  //         array(
  //           'type'  => 'text',
  //           'label' => 'Lead',
  //           'id'    => 'lead',
  //           'class' => 'input-xlarge',
  //           'name'  => 'lead',
  //           'value' => $article[0]['lead']
  //         ),
  //         array(
  //           'type'  => 'textarea',
  //           'label' => 'Tartalom',
  //           'id'    => 'body',
  //           'class' => 'input-xlarge',
  //           'name'  => 'body',
  //           'value' => $article[0]['body']
  //         ),

  //         array(
  //           'type'  => 'text',
  //           'label' => 'meta - Cím',
  //           'id'    => 'meta_title',
  //           'class' => 'input-xlarge',
  //           'name'  => 'meta_title',
  //           'value' => $article[0]['meta_title']
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'meta - Keywords',
  //           'id'    => 'meta_keywords',
  //           'class' => 'input-xlarge',
  //           'name'  => 'meta_keywords',
  //           'value' => $article[0]['meta_keywords']
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'meta - Leírás',
  //           'id'    => 'meta_desc',
  //           'class' => 'input-xlarge',
  //           'name'  => 'meta_desc',
  //           'value' => $article[0]['meta_desc']
  //         ),
          
  //         array(
  //           'type'    => 'checkbox',
  //           'label'   => 'Aktív',
  //           'id'      => 'active',
  //           'class'   => 'input-xlarge',
  //           'name'    => 'active',
  //           'checked' => $article[0]['active']
  //         ),

  //         array(
  //           'type'  => 'text',
  //           'label' => 'Megjelenés, tól:',
  //           'id'    => 'date_from',
  //           'class' => 'input-xlarge datep',
  //           'name'  => 'date_from',
  //           'value' => $article[0]['date_from']
  //         ),
  //         array(
  //           'type'  => 'text',
  //           'label' => 'Megjelenés, ig:',
  //           'id'    => 'date_to',
  //           'class' => 'input-xlarge datep',
  //           'name'  => 'date_to',
  //           'value' => $article[0]['date_to']
  //         ),

  //         array(
  //           'type'  => 'submit',
  //           'id'    => 'sbm',
  //           'class' => 'btn btn-primary',
  //           'value' => 'Ment'
  //         )
  //     )
  //   ));

  //   $thisForm = $this->view->renderTemplate(
  //     array(
  //       'scope' => $this,
  //       'data'  => $this->content
  //     ),
  //     $this->view->getTemplatePath('admin_galleries','edit')
  //   );
  
  //   echo $this->view->renderTemplate(
  //     array(
  //       'scope' => $this,
  //       'data'  => $thisForm
  //     ),
  //     $this->view->getTemplatePath('admin','main')
  //   );
  // }
}
