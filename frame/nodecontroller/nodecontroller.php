<?php

class Nodecontroller extends Controller {

  public function indexAction($type) {

    $order = '';
    switch($type) {
      case 'menu':
        $order = ' order by menu_order asc, n.lang ';
      break;
      default:
        $order = ' order by created, edited ';
      break;
    }

    $res = $this->model->getAll(
      "
        select
          n.*,
          nt.*
        from
          node n
        join
          {$type} nt
        on n.id = nt.nid

        where
          n.type = '{$type}'

        {$order}
      ",

      "select
        count(*) as counter
          from
            node
        where
          type = '{$type}'
      ",

      array(),

      $this->itemPerPage,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    $res['result'] = $this->model->addParams($type,$res['result']);
    return $res;
  }

  public function show() {
    return $this->showAction();
  }

  public function showAction() {
    return $this->model->getNodeById($this->index);
  }

  public function add() {
    if(isset($this->router->orders[2]) && $this->router->orders[2] != '') {
      $thisType       = $this->router->orders[2];
      $form           = $this->router->loader->get('Form');
      $this->title    = "add {$thisType}";

      $thisForm = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $form->render($this->model->getform('create',$thisType)),
          'type'  => $thisType
        ),
        $this->view->getTemplatePath('node',(file_exists(VIEWS."node/{$thisType}_add.tpl")?"{$thisType}_add":'node_add'))
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

  public function create() {
    $newId    = $this->model->create($this->post);
    $thisNode = $this->model->getNodeById($newId);
    $this->redirect("node/nodetype/{$thisNode[0]['type']}");
  }

  public function update() {
    /*
      saving the update
    */
    if(isset($this->post['_method']) && $this->post['_method'] == 'update') {
      $this->model->saveUpdate($this->post);
      $this->redirect("node/update/{$this->post['type']}/{$this->post['id']}");
    }
    /*
      getting update form
    */
    if(isset($this->router->orders[3]) && (int)$this->router->orders[3] > 0) {
      $type           = $this->router->orders[2];
      $index          = $this->router->orders[3];
      $form           = $this->router->loader->get('Form');
      $node           = $this->model->getNodeById($index);
      $this->title    = "update {$type}";
      $thisForm       = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $form->render($this->model->update($type,$index,$node)),
          'type'  => $type,
          'node'  => $node
        ),
        $this->view->getTemplatePath('node',(file_exists(VIEWS."node/{$type}_update.tpl")?"{$type}_update":'node_update'))
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

  public function types() {

    $this->title    = 'Tartalmak kezelése';
    $this->content  = $this->view->renderTemplate(
      array(
        'scope'     => $this,
        'data'      => $this->model->getNodeTypes()
      ),
      $this->view->getTemplatePath('node','types')
    );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function nodetype() {
    $thisType = $this->router->orders[2];
    $types    = $this->model->getTypes();

    if(in_Array($thisType,$types)) {

      $this->title    = "lista - {$thisType}";
      $res            = $this->indexAction($thisType);

      $paginator    = $this->view->renderTemplate(
        array(
          'all'     => (isset($res['all']) ? $res['all'] : null),
          'current' => (isset($res['current']) ? $res['current'] : null),
          'url'     => implode('/',$this->router->orders)
        ),
        $this->view->getTemplatePath('paginator','paginator')
      );

      $this->content = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $res['result'],
          'type'      => $thisType,
          'paginator' => $paginator
        ),
        $this->view->getTemplatePath('node',(file_exists(VIEWS."node/{$thisType}_index.tpl")?"{$thisType}_index":'node_index'))
      );

      echo $this->view->renderTemplate(
        array(
          'scope'   => $this,
          'data'    => $this->content
        ),
        $this->view->getTemplatePath('admin','main')
      );

    } else {
      echo "404 - nincs ilyen node tipus <br /> <a href='/node/types'>Vissza</a>";
    }
  }

  public function newtype() {
    $this->title  = "Tartalom típus hozzáadása";
    $form         = $this->router->loader->get('Form');
    $thisForm     = $form->render(array(
      'form'      => array(
        'action'    => '/node/saveNewType',
        'method'    => 'post',
        'token'     => true,
        'id'        => 'newtype',
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),
      'elements'  => array(
        array(
          'type'  => 'text',
          'label' => 'A tartalom típus neve:',
          'id'    => 'name',
          'class' => 'input-xlarge',
          'name'  => 'name'
        ),
        array(
          'type'  => 'submit',
          'id'    => 'sbm',
          'class' => 'btn btn-primary',
          'value' => 'Mentés'
        )
      )
    ));

    $this->content = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $thisForm
        ),
        $this->view->getTemplatePath('node','newtype')
      );

    echo $this->view->renderTemplate(
      array(
        'scope'   => $this,
        'data'    => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function saveNewType() {
    $defaultCfg = '[{"name":"title","type":"text"},{"name":"lead","type":"text"},{"name":"body","type":"textarea"}]';

    $this->model->query(
      "
        CREATE TABLE IF NOT EXISTS `{$this->post['name']}` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `nid` int(10) NOT NULL,
          `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `lead` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `body` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
      ",
      array()
    );

    $this->model->query(
      "insert
        into
          node_type
            (name,suffix,cfg)
          values
            (?,?,?)
      ",
      array(
        $this->post['name'],
        $this->post['name'],
        $defaultCfg
      )
    );

    $this->redirect("node/types");
  }

  public function menu() {
    echo "asdasd";
  }

  public function type() {
    $this->model->getNodeTypes();
  }

}
