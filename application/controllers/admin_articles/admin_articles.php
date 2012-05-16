<?php

class Admin_articles_controller extends Controller {

  public function init() {
    $this->model        = $this->router->loader->get('Article','model');
    $this->itemPerPage  = 10;
  }

  public function index() {

    $res = $this->model->getAll(

      "select
          *
          from
            article
        order by
          created desc, edited desc",

      "select
        count(*) as counter
          from
            article",

      array(),

      $this->itemPerPage,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    $this->title   = 'Cikkek';

    $paginator = $this->view->renderTemplate(
      array(
        'all'     => $res['all'],
        'current' => $res['current']
      ),
      $this->view->getTemplatePath('paginator','paginator')
    );

    $this->content = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $res['result'],
        'paginator' => $paginator
      ),
      $this->view->getTemplatePath('admin_articles','index')
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
    $this->title    = 'Új cikk';
    $form           = $this->router->loader->get('Form');
    $this->content  = $form->render(array(

      'form'      => array(
        'action'    => '/admin_articles',
        'method'    => 'post',
        'token'     => true,
        '_method'   => 'create',
        'id'        => 'create_article',
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
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => 'Ment'
          )
      )
    ));

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
        'title'   => $this->post['title'],
        'lead'    => $this->post['lead'],
        'body'    => $this->post['body'],
        'edited'  => 'now()'
      ));
      $thisId = $this->model->db->lastInsertId();
      $this->redirect("admin_articles/{$this->post['id']}/edit");
    } else {
      $this->redirect("admin_articles");
    }
  }

  public function create() {
    global $session;
    if($session->checkToken($this->post['token'])) {
      $this->model->create(array(
        'title'   => $this->post['title'],
        'lead'    => $this->post['lead'],
        'body'    => $this->post['body'],
        'create'  => 'now()'
      ));
      $thisId = $this->model->db->lastInsertId();
      $this->redirect("admin_articles/{$thisId}");
    } else {
      $this->redirect("admin_articles");
    }
  }

  public function show() {
    if(isset($this->router->orders[2]) && $this->router->orders[2] == 'edit') {
      $this->edit();
    } else {
      $article        = $this->model->get($this->index);
      $this->title    = $article[0]['title'];
      $this->content  = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $article[0]
        ),
        $this->view->getTemplatePath('admin_articles','show')
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
      $this->redirect("admin_articles");
    } else {
      $this->redirect("admin_articles");
    }
  }

  public function edit() {
    $article = $this->model->get($this->index);
    $this->title    = "szerkesztés - {$article[0]['title']}";

    $form           = $this->router->loader->get('Form');
    $this->content  = $form->render(array(

      'form'      => array(
        'action'    => "/admin_articles/{$article[0]['id']}",
        'method'    => 'post',
        'token'     => true,
        '_method'   => 'update',
        'id'        => 'create_article',
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
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => 'Ment'
          )
      )
    ));
  
    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }
}