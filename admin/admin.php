<?php

class Admin_controller extends Controller {
  
  public function init() {
    global $session; global $stuff;
    $this->stuff    = $stuff;
    $this->session  = $session;
    if(!$this->session->checkProfile()) {
      $this->session->addObject('destination',$_SERVER['REQUEST_URI']);
      $this->redirect('login');
    }

    if(file_exists(CONFIG.'system.cfg')) {
      include CONFIG.'system.cfg';

      if(isset($sys)) {
        $this->sys = json_decode($this->stuff->sunesc($sys));
        $this->sys = $this->sys->system;
      }
    }
  }
  
  public function index() {
    $this->title    = (isset($this->sys->brand) ? $this->sys->brand : '');
    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => ''
      ),
      $this->view->getTemplatePath('admin','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('admin','main')
    );
  }

  public function system() {

      $this->title    = 'Site parameters';
      $form           = $this->router->loader->get('Form');

      $this->content  = $form->render(array(

        'form'      => array(
          'action'    => '/admin/systemsetup/',
          'method'    => 'post',
          '_method'   => '',
          'id'        => 'system',
          'token'     => true,
          'class'     => 'well form-inline',

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
            <a href="/admin">Admin Home</a>
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

    public function systemsetup() {
      $thismodel = $this->router->loader->get('System','model');
      $cfg = array(
        'system' => array()
      );

      foreach($this->post as $k => $p) {
        if($k != 'token' && $k != '_method') {
          $cfg['system'][$k] = $p;
        }
      }

      $thismodel->writecfg($cfg);
      $this->redirect('admin/system');
      die();
    }

    public function modules() {
      $this->title  = 'Modules';
      $thismodel    = $this->router->loader->get('Module');
      $content      = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $thismodel->get()
        ),
        $this->view->getTemplatePath('admin','modules')
      );

      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function modulessave() {
      $cfg      = array();
      $methods  = array();
      $key      = '';

      foreach(json_decode(urldecode($this->post['cfg'])) as $item) {
        $cfg[$item->namespace] = array();

        foreach($item->api as $method => $obj) {
          $key = "{$item->namespace}|{$method}";
          if(isset($this->post[$key])) {
            $methods[$method][]             = $item->namespace; 
            $cfg[$item->namespace][$method] = 1;
          } else {
            $cfg[$item->namespace][$method] = 0;
          }
        }
      }

      file_put_contents(CONFIG.'modules.cfg', "<?php \$modules='".json_encode($cfg)."'; \$methods='".json_encode($methods)."'; ?>");
      $this->session->setSysMessages('modules','The modules have been saved');
      $this->redirect('admin/modules');
      die();
    }

    public function vocabulary() {

      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0) {
        $this->show_vocabulary($this->router->orders[2]);
        die();
      }

      $this->title  = 'Vocabulary';
      $Taxonomy     = $this->router->loader->get('Taxonomy');
      $res          = $Taxonomy->getAll(

        "select
            *
            from
              vocabulary

          order by
            vid",

        "select
          count(*) as counter
            from
              vocabulary",

        array(),

        20,

        (isset($this->get['page']) ? $this->get['page'] : 1)
      );

      $paginator = $this->view->renderTemplate(
        array(
          'all'     => $res['all'],
          'current' => $res['current'],
          'url'     => implode('/',$this->router->orders)
        ),
        $this->view->getTemplatePath('paginator','paginator')
      );

      $content = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $res['result'],
          'paginator' => $paginator
        ),
        $this->view->getTemplatePath('admin','vocabulary')
      );

      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function new_vocabulary() {
      $this->title  = 'New Vocabulary';
      $Taxonomy     = $this->router->loader->get('Taxonomy');
      $form         = $this->router->loader->get('Form');

      $thisForm     = $Taxonomy->vocabulary_form();
      $thisForm['form']['action'] = '/admin/save_vocabulary';

      $content      = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $form->render($thisForm)
        ),
        $this->view->getTemplatePath('admin','new_vocabulary')
      );
      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function save_vocabulary() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'])) {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        $Taxonomy->vocabulary_add($this->post);
        $this->session->setSysMessages('vocabulary','New vocabulary has added.');
      } else {
        $this->session->setSysMessages('vocabulary','Something went wrong!');
      }
      $this->redirect('admin/vocabulary');
    }

    public function update_vocabulary() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'])) {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        if(!isset($this->post['required'])) {
          $this->post['required'] = 'off';
        }
        $Taxonomy->query("
          update
            vocabulary
          set
            name = ?,
            description = ?,
            hierarchy = ?,
            required = ?,
            weight = ?
          where
            vid = ?
        ",array(
          $this->post['name'],
          $this->post['description'],
          $this->post['hierarchy'],
          ($this->post['required'] == 'on' ? 1 : 0),
          ((int)$this->post['weight'] > 0 ? $this->post['weight'] : 0),
          $this->post['vid']
        ));
        $this->session->setSysMessages('vocabulary','The vocabulary has succesfully updated.');
      } else {
        $this->session->setSysMessages('vocabulary','Something went wrong!');
      }
      $this->redirect('admin/vocabulary');
    }

    public function show_vocabulary($id = '') {
      if($id != '') {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        $form         = $this->router->loader->get('Form');
        $thisForm     = $Taxonomy->vocabulary_form();
        $thisForm['elements'][] = array(
          'type'  => 'hidden',
          'name'  => 'vid',
          'value' => $id
        );
        $thisForm['form']['action'] = '/admin/update_vocabulary';
        $voc          = $Taxonomy->select("
          select * from vocabulary where vid = ?
        ",array($id));
        $this->title  = $voc[0]['name'];
        foreach($voc[0] as $k => $v) {
          if($k != 'vid') {
            foreach($thisForm['elements'] as $index => $el) {
              if(isset($el['name']) && $el['name'] == $k) {
                if($k == 'hierarchy') {
                  $thisForm['elements'][$index]['value'] = ($v == 0 ? 1000 : $v);
                } else {
                  $thisForm['elements'][$index]['value'] = $v;
                }
              }
            }
          }
        }
        $content      = $this->view->renderTemplate(
          array(
            'scope'     => $this,
            'data'      => $form->render($thisForm)
          ),
          $this->view->getTemplatePath('admin','show_vocabulary')
        );
        echo $this->view->renderTemplate(
          array(
            'scope' => $this,
            'data'  => $content
          ),
          $this->view->getTemplatePath('admin','main')
        );
      }
    }

    /*
      TODO merge this method to da taxonomy
    */
    public function delete_vocabulary() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'],'ajax')) {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        $Taxonomy->query("
          delete from vocabulary where vid = ?
        ",array($this->post['vid']));
        $Taxonomy->query("
          update vocabulary set hierarchy = 1000 where hierarchy = ?
        ",array($this->post['vid']));

        $Taxonomy->query("
          delete from term_data where vid = ?
        ",array($this->post['vid']));
        $Taxonomy->query("
          delete from term_node where vid = ?
        ",array($this->post['vid']));
        $this->session->setSysMessages('vocabulary','The Item has deleted');
        echo 1;
      } else {
        echo 0;
      }
      die();
    }

    public function term() {

      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0) {
        $this->show_term($this->router->orders[2]);
        die();
      }

      $Taxonomy     = $this->router->loader->get('Taxonomy');
      $form         = $this->router->loader->get('Form');
      $this->title  = "Vocabulary terms";
      $result       = array(1000 => 'Choose');
      $res          = $Taxonomy->select(
        "select vid,name from vocabulary",
        array()
      );

      foreach($res as $r) {
        $result[$r['vid']] = $r['name'];
      }

      $thisForm = array(
        'form'      => array(
          'action'    => '',

          'enctype'   => "multipart/form-data",

          'method'    => 'post',
          'token'     => true,
          '_method'   => '',
          'id'        => "term",
          'class'     => 'well form-inline',
          'template'  => 'default'
        ),
        'elements' => array(
          array(
            'type'    => 'select',
            'label'   => 'Vocabularies',
            'id'      => 'choose_vocabularies',
            'class'   => 'input-xlarge',
            'name'    => 'vocabularies',
            'options' =>  $result
          )
        )
      );

      $content      = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $form->render($thisForm)
        ),
        $this->view->getTemplatePath('admin','term')
      );
      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function load_term() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'],'ajax')) {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        $res = $Taxonomy->select("
            select

              td.*,
              v.name as voc

            from
              term_data td

            left join
              vocabulary v
                on td.vid = v.vid

            where
              td.vid = ?
          ",
          array($this->post['vid'])
        );

        if(count($res) == 0) {
          echo false;
        } else {
          echo json_encode($res);
        }
      } else {
        echo 0;
      }
      die();
    }

    public function show_term($id = '') {
      if($id != '') {
        $Taxonomy               = $this->router->loader->get('Taxonomy');
        $form                   = $this->router->loader->get('Form');
        $thisForm               = $Taxonomy->term_form();
        $thisForm['form']['action'] = '/admin/update_term';
        $thisForm['elements'][] = array(
          'type'  => 'hidden',
          'name'  => 'tid',
          'value' => $id
        );
        $term                   = $Taxonomy->select("
            select
              *
            from
              term_data
            where
              tid = ?
          ",
          array($id)
        );

        $this->title  = $term[0]['name'];
        foreach($term[0] as $k => $v) {
          if($k != 'tid') {
            foreach($thisForm['elements'] as $index => $el) {
              if(isset($el['name']) && $el['name'] == $k) {
                $thisForm['elements'][$index]['value'] = $v;
              }
            }
          }
        }

        $content      = $this->view->renderTemplate(
          array(
            'scope'     => $this,
            'data'      => $form->render($thisForm)
          ),
          $this->view->getTemplatePath('admin','show_term')
        );
        echo $this->view->renderTemplate(
          array(
            'scope' => $this,
            'data'  => $content
          ),
          $this->view->getTemplatePath('admin','main')
        );
        die();
      }
    }

    public function new_term() {
      $this->title  = 'New Vocabulary';
      $Taxonomy     = $this->router->loader->get('Taxonomy');
      $form         = $this->router->loader->get('Form');

      $thisForm     = $Taxonomy->term_form();
      $thisForm['form']['action'] = '/admin/save_term';

      $content      = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $form->render($thisForm)
        ),
        $this->view->getTemplatePath('admin','new_vocabulary')
      );
      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function save_term() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'])) {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        $Taxonomy->query("
          insert into term_data(name,description,weight,vid) values(?,?,?,?)
        ",array(
          $this->post['name'],
          $this->post['description'],
          $this->post['weight'],
          $this->post['vid']
        ));
        $this->session->setSysMessages('vocabulary','New term has added.');
      } else {
        $this->session->setSysMessages('vocabulary','Something went wrong!');
      }
      $this->redirect('admin/term');
    }

    public function update_term() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'])) {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        $Taxonomy->query("
          update
            term_data
          set
            name = ?,
            description = ?,
            weight = ?
          where
            tid = ?
        ",array(
          $this->post['name'],
          $this->post['description'],
          ((int)$this->post['weight'] > 0 ? $this->post['weight'] : 0),
          $this->post['tid']
        ));
        $this->session->setSysMessages('vocabulary','The term has succesfully updated.');
      } else {
        $this->session->setSysMessages('vocabulary','Something went wrong!');
      }
      $this->redirect('admin/term');
    }

    /*
      TODO merge this method to da taxonomy
    */
    public function delete_term() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'],'ajax')) {
        $Taxonomy     = $this->router->loader->get('Taxonomy');
        $Taxonomy->query("
          delete from term_data where tid = ?
        ",array($this->post['tid']));
        $Taxonomy->query("
          delete from term_node where tid = ?
        ",array($this->post['tid']));
        $this->session->setSysMessages('term','The Item has deleted');
        echo 1;
      } else {
        echo 0;
      }
      die();
    }

    public function node() {
      $this->title  = 'Node types';
      $node         = $this->router->loader->get('Node');
      $types        = $node->node_type();

      $content      = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => (isset($types['id']) ? array($types) : $types)
        ),
        $this->view->getTemplatePath('admin','node_index')
      );
      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function new_node_type() {
      $this->title  = 'New Node Type';
      $node         = $this->router->loader->get('Node');
      $form         = $this->router->loader->get('Form');

      $thisForm     = $node->node_type_form();

      $content      = $this->view->renderTemplate(
        array(
          'scope'     => $this,
          'data'      => $form->render($thisForm)
        ),
        $this->view->getTemplatePath('admin','node_new')
      );
      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function node_vocabulary() {
      $Taxonomy = $this->router->loader->get('Taxonomy');
      $result = array();
      $res = $Taxonomy->select("
        select vid, name from vocabulary
      ",array());
      if(count($res) > 0) {
        foreach($res as $r) {
          $result[$r['vid']] = $r['name'];
        }
      }
      echo json_encode($result);
      die();
    }

    public function node_term() {
      $Taxonomy = $this->router->loader->get('Taxonomy');
      $result = array();
      $res = $Taxonomy->select("
        select vid from vocabulary where name = ?
      ",array($this->post['vid']));
      $res = $Taxonomy->select("
        select tid, name from term_data where vid = ?
      ",array($res[0]['vid']));
      if(count($res) > 0) {
        foreach($res as $r) {
          $result[$r['tid']] = $r['name'];
        }
      }
      echo json_encode($result);
      die();
    }

    public function save_new_node_type() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'],'ajax')) {
        $node     = $this->router->loader->get('node');
        $thisCfg  = json_encode($this->post['cfg']);
        $node->new_node_type_table($this->post['name'],$thisCfg);
        $node->query("
          insert into node_type(name,suffix,cfg) values(?,?,?)
        ",array($this->post['name'],$this->post['name'],$thisCfg));
        echo 1;
      } else {
        echo false;
      }
      die();
    }

    public function delete_node_type() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'],'ajax')) {
        $node       = $this->router->loader->get('node');
        $curr_type  = $node->select("
          select
            name
            from
              node_type
          where
            id = ?
        ",array($this->post['id']));

        if(isset($curr_type[0]['name'])) {
          $node->query("
            delete from node_type where id = ?
          ",array($this->post['id']));

          $node->query("
            drop table {$curr_type[0]['name']}
          ",array());
        }
        echo 1;
      } else {
        echo 0;
      }
      die();
    }

    public function node_type() {
      
      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0) {
        $index          = $this->router->orders[2];
        $node           = $this->router->loader->get('node');
        $nodes          = array(); 
        $res            = $node->select("
          select
            *
            from 
              node_type
          where
            id = ?

        ",array($index));

        if(isset($res[0]['name'])) {

          $exceptions = array('user_image','gallery_image');

          $node_type      = $res[0]['name'];
          $this->title    = $node_type;

          $result = $node->node_type_get_all_item($node_type,20,(isset($this->get['page']) ? $this->get['page'] : 1),' order by n.id  ');

          foreach($result['result'] as $thisNode) {
            $nodes[] = $node->node_load($thisNode['id']);
          }

          $paginator = $this->view->renderTemplate(
            array(
              'all'     => $result['all'],
              'current' => $result['current'],
              'url'     => implode('/',$this->router->orders)
            ),
            $this->view->getTemplatePath('paginator','paginator')
          );

          $this->content  = $this->view->renderTemplate(
            array(
              'scope'     => $this,
              'node_type' => $res[0],
              'data'      => $nodes, //$result['result'],
              'paginator' => $paginator
            ),
            $this->view->getTemplatePath('admin', (in_array($res[0]['name'],$exceptions) ? "node_types_{$node_type}" : 'node_types'))
          );

          echo $this->view->renderTemplate(
            array(
              'scope' => $this,
              'data'  => $this->content
            ),
            $this->view->getTemplatePath('admin','main')
          );
        } else {
          $this->redirect('admin/node');
        }
      }
    }

    public function node_add() {
      $node = $this->router->loader->get('node');
      $form = $this->router->loader->get('Form');
      if(isset($this->router->orders[2])) {
        $res = $node->select("
          select
            *
            from 
              node_type
          where
            name = ?
        ",array($this->router->orders[2]));

        if(isset($res[0]['name'])) {
          $thisForm = $node->node_form($res[0]['name']);
          $thisForm['form']['action'] = '/admin/node_save';
          $this->title  = "Add new {$res[0]['name']}";
          $content      = $this->view->renderTemplate(
            array(
              'scope'     => $this,
              'data'      => $form->render($thisForm)
            ),
            $this->view->getTemplatePath('admin','node_add')
          );
          echo $this->view->renderTemplate(
            array(
              'scope' => $this,
              'data'  => $content
            ),
            $this->view->getTemplatePath('admin','main')
          );
          die();
        }
      }
      $this->redirect('admin/node');
    }

    public function node_delete() {
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'],'ajax')) {
        $nodeModel  = $this->router->loader->get('node');
        $nodeModel->node_delete($this->post['id']);
        $this->session->setSysMessages('node_type',"The Item has deleted");
        echo 1;
      } else {
        echo 0;
      }
      die();
    }

    public function node_save() {
      $node   = $this->router->loader->get('node');
      $nodeId = $node->node_save($this->post);
      $this->redirect("admin/node_view/{$nodeId}");
      die();
    }

    public function node_update() {
      $nodeModel  = $this->router->loader->get('node');
      $nodeModel->node_update($this->post);
      $this->redirect("admin/node_view/{$this->post['id']}");
      die();
    }

    public function node_view() {
      if(isset($this->router->orders[2]) && (int)$this->router->orders[2] > 0) {
        $nid                        = $this->router->orders[2];
        $nodeModel                  = $this->router->loader->get('node');
        $form                       = $this->router->loader->get('Form');

        $node                       = $nodeModel->node_view($nid); //print_r($node);
        $thisForm                   = $node['form'];
        $thisForm['form']['action'] = '/admin/node_update';
        $this->title  = "Update {$node['title']}";

        $type         = $nodeModel->node_type($node['type']);

        $content      = $this->view->renderTemplate(
          array(
            'scope'     => $this,
            'data'      => $form->render($thisForm),
            'node'      => $node,
            'type_id'   => $type['id']
          ),
          $this->view->getTemplatePath('admin','node_update')
        );
        echo $this->view->renderTemplate(
          array(
            'scope' => $this,
            'data'  => $content
          ),
          $this->view->getTemplatePath('admin','main')
        );
        die();
      } else {
        $this->redirect('admin/node_type');
      }
    }

    public function node_active() { 
      if(isset($this->post['token']) && $this->session->checkToken($this->post['token'],'ajax')) {
        $nodeModel  = $this->router->loader->get('node');
        $nodeModel->query("
          update
            node
              set
                active = ?
          where id = ?
        ",array($this->post['active'],$this->post['id']));
        echo 1;
        die();
      }
      echo 0;
      die();
    }

    public function newsletter_image_setup() {
      $nodeModel  = $this->router->loader->get('node');
      $nodeModel->query("
        update
          node
            set
              active = 0
        where type = ?
      ",array('newsletter_image'));

      $nodeModel->query("
        update
          node
            set
              active = 1
        where id = ?
      ",array($this->post['id']));
    }

}