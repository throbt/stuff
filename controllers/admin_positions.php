<?php

class Admin_positions_controller extends Controller {
  public function init() {
    global $session;
    $this->session = $session;
    if(!$this->session->checkProfile()) {
      $this->redirect('login');
      die();
    }
    $this->model        = $this->router->loader->get('Positions','model');
    $this->itemPerPage  = 10;
  }

  public function index() {

    $res = $this->model->getAll(

      "select

			  p.*,
			  l.id as location,
			  t.id as type

		  from
			  positions p

		  left join
		    position_location l
	        on
	          p.location = l.id

      left join
		    position_type t
	        on
	          p.type = t.id

      order by
        p.edited desc, p.created desc",

      "select
        count(*) as counter
          from
            positions",

      array(),

      $this->itemPerPage,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    $this->title   = 'Positions';

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
      $this->view->getTemplatePath('admin_position','index')
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
    $this->title  = 'Add position';

    $this->content = $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->model->getForm(array('action' => 'admin_positions/create'))
      ),
      $this->view->getTemplatePath('admin_position','add')
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
    $res                = $this->model->get($this->index);
    $position           = $res[0];
    $this->title        = "Edit {$position['title']}";
    $position['action'] = 'admin_positions/update';

    $this->content = $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->model->getForm($position)
      ),
      $this->view->getTemplatePath('admin_position','edit')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function create() {
    global $session;
    if($session->checkToken($this->post['token'])) {
      $this->model->create(array(
        'date_from'     => $this->post['date_from'],
        'date_to'       => $this->post['date_to'],
        'title'         => $this->post['title'],
        'position'      => $this->post['position'],
        'location'      => $this->post['location'],
        'description'   => $this->post['description'],
        'type'          => $this->post['type'],
        'commitment'    => $this->post['commitment'],
        'expectations'  => $this->post['expectations'],
        'active'        => (isset($this->post['active']) ? 1 : 0),
        'created'       => 'now()'
      ));
      $thisId = $this->model->db->lastInsertId();
      $this->redirect("admin_positions/{$thisId}");
    } else {
      $this->redirect("admin_positions");
    }
  }

  public function update() {

    global $session;
    if($session->checkToken($this->post['token'])) {
      $this->model->update(
        $this->post['id'],
        array(
        'date_from'     => $this->post['date_from'],
        'date_to'       => $this->post['date_to'],
        'title'         => $this->post['title'],
        'position'      => $this->post['position'],
        'location'      => $this->post['location'],
        'description'   => $this->post['description'],
        'type'          => $this->post['type'],
        'commitment'    => $this->post['commitment'],
        'expectations'  => $this->post['expectations'],
        'active'        => (isset($this->post['active']) ? 1 : 0),
        'edited'        => 'now()',
        'created'       => $this->post['created']
      ));
      $thisId = $this->model->db->lastInsertId();
      $this->redirect("admin_positions/{$this->post['id']}/edit");
    } else {
      $this->redirect("admin_positions");
    }
  }

  public function location() {

    if(isset($this->router->orders[2]) && $this->router->orders[2] == 'new') {
      $this->model->query(
        "insert into position_location(location) values(?)",
        array($this->post['location'])
      );
      $this->redirect('admin_positions');
      die();
    }

    $this->title    = 'New location';
    $form           = $this->router->loader->get('Form');
    $thisForm       = $form->render(array(

      'form'      => array(
        'action'    => "/admin_positions/location/new",
        'method'    => 'post',
        'token'     => true,
        '_method'   => '',
        'id'        => 'create_position',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'  => array(

          array(
            'type'  => 'text',
            'label' => 'New Location',
            'id'    => 'location',
            'class' => 'input-xlarge',
            'name'  => 'location'
          ),

          array(
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => 'Save'
          )
      )
    ));

    $this->content = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $thisForm
      ),
      $this->view->getTemplatePath('admin_position','location')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function type() {

    if(isset($this->router->orders[2]) && $this->router->orders[2] == 'new') {
      $this->model->query(
        "insert into position_type(type) values(?)",
        array($this->post['type'])
      );
      $this->redirect('admin_positions');
      die();
    }

    $this->title    = 'New type';
    $form           = $this->router->loader->get('Form');
    $thisForm       = $form->render(array(

      'form'      => array(
        'action'    => '/admin_positions/type/new',
        'method'    => 'post',
        'token'     => true,
        '_method'   => '',
        'id'        => 'create_type',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'  => array(

          array(
            'type'  => 'text',
            'label' => 'New Type',
            'id'    => 'type',
            'class' => 'input-xlarge',
            'name'  => 'type'
          ),

          array(
            'type'  => 'submit',
            'id'    => 'sbm',
            'class' => 'btn btn-primary',
            'value' => 'Save'
          )
      )
    ));

    $this->content = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $thisForm
      ),
      $this->view->getTemplatePath('admin_position','type')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function del() {
    $this->model->query(
      "delete from positions where id = ?",
      array($this->post['id'])
    );
    $this->redirect('admin_positions');
    die();
  }
}
