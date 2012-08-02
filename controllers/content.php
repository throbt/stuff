<?php

class Content_controller extends Controller {

  public function init() {
    $this->model            = $this->router->loader->get('Node');
    $this->model->className = 'Node';
    $this->stuff            = $this->router->loader->get('Stuff');
    $this->sys              = $this->router->sys;

    $this->routes           = array(
      'newsletter_add',
      'email_add',
      'cv_add',
      'search'
    );
  }

  public function home() {
    $contentArr = array();

    $news       = $this->getReferenciak(); //print_r($news); die();

    foreach($news as $a) {
      $contentArr['news'][] = $this->model->urlLookup($a);
    }

#    foreach($news as $k => $v) {
#      if(preg_match('/flekk/',$k)) {
#        $news[$k] = urlencode($v);
#      }
#    }

    $kiemelt = $this->getKiemelt();

    foreach($kiemelt as $a) {
      $contentArr['kiemelt'][] = $this->model->urlLookup($a);
    }

    $contentArr['news']     = $this->codeIt($contentArr['news']);
    $contentArr['kiemelt']  = $this->codeIt($contentArr['kiemelt']);

    $this->content = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $contentArr
      ),
      $this->view->getTemplatePath('content','index')
    );
    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }

  public function getReferenciak() {
    $result = array();
    $node   = array();

    $res          = $this->model->select("
      select
        nid
          from
            home
      where nodes like ?
    ",array("290%"));

    $res = $this->model->select(
      "select nodes from home where nid = ?",
      array($res[0]['nid'])
    );

    if(isset($res[0]['nodes'])) {
      $arr = explode('|',$res[0]['nodes']);
      array_shift($arr);
      foreach($arr as $r) {
        $node     = $this->model->getNodeById($r);
        $result[] = $node[0];
      }
    }

    return (count($result) > 0 ? $result : false);
  }

  public function getKiemelt() {
    $result = array();
    $node   = array();

    $res          = $this->model->select("
      select
        nid
          from
            home
      where nodes like ?
    ",array("291%"));

    $res = $this->model->select(
      "select nodes from home where nid = ?",
      array($res[0]['nid'])
    );

    if(isset($res[0]['nodes'])) {
      $arr = explode('|',$res[0]['nodes']);
      array_shift($arr);
      foreach($arr as $r) {
        $node     = $this->model->getNodeById($r);
        $result[] = $node[0];
      }
    }

    return (count($result) > 0 ? $result : false);
  }

  public function menu() {

    if(in_array($this->router->orders[2],$this->routes,TRUE)) {
      $thisMethod = $this->router->orders[2];
      $this->$thisMethod();
      die();
    }

    $menu = $this->model->getMenuByRoute(urldecode($this->router->orders[2]));

    if($menu != null) {
      $this->cfg          = new stdClass;
      $this->cfg->action  = $menu['action'];
      $this->cfg->content = $menu['content'];
      $this->title        = $menu['title'];
      $this->menu         = $menu;

      $this->router->action = $this->cfg->action;

      switch($this->router->action) {
        case 'index':

          if($this->menu['url'] == 'home') {
            $this->home();
            die();
          }

          $contentArr = array();
          $arr        = $this->model->getAllByType($this->cfg->content,''," and n.lang = '{$_SESSION['language']}' and n.active = 1 ");

          foreach($arr as $a) {
            $contentArr[] = $this->model->urlLookup($a);
          }

          $this->content = $this->view->renderTemplate(
            array(
              'scope' => $this,
              'data'  => $this->codeIt($contentArr)
            ),
            $this->view->getTemplatePath('content','index')
          );
          echo $this->view->renderTemplate(
            array(
              'scope' => $this,
              'data'  => $this->content
            ),
            $this->view->getTemplatePath('page','page')
          );
        break;
        case 'show':
          if((int)$this->cfg->content > 0) {

            if(!isset($this->menu)) {
              $this->menu = array('url' => '');
            }

            $this->node   = $this->model->getNodeById($this->cfg->content);

            $this->title  = $this->node[0]['title'];

            $this->content = $this->view->renderTemplate(
              array(
                'scope' => $this,
                'data'  => $this->codeItForContent($this->node)
              ),
              $this->view->getTemplatePath('content','show')
            );

            echo $this->view->renderTemplate(
              array(
                'scope' => $this,
                'data'  => $this->content
              ),
              $this->view->getTemplatePath('page','page')
            );
          } else {
            //404
          }
        break;
      }

    /*
      it must be  a simple show without menu bind
    */
    } else {
      $this->router->action = 'show';
      $type                 = $this->router->orders[2];
      $id                   = $this->router->orders[3];

      $this->menu   = array('url' => '');
      if($id == '193') {
        $this->menu   = array('url' => 'cv');
      }
      if($id == '399') {
        $this->getAllasHirdetesek(399);
        die();
      }

      $this->node   = $this->model->getNodeById($id);

      if($this->node != null) {
        $this->title = $this->node[0]['title'];

        $this->content = $this->view->renderTemplate(
          array(
            'scope' => $this,
            'data'  => $this->codeItForContent($this->node)
          ),
          $this->view->getTemplatePath('content','show')
        );

        echo $this->view->renderTemplate(
          array(
            'scope' => $this,
            'data'  => $this->content
          ),
          $this->view->getTemplatePath('page','page')
        );
      /*
        404
      */
      } else {
        echo '404';
      }
    }
  }

  public function getAllasHirdetesek($id) {
    $position       = $this->router->loader->get('Positions','model');
    $result         = $position->getAll(

      "select

			  p.*,
			  l.location as location,
			  t.type as type

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

      $this->sys->positions_items,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    $this->node     = $this->model->getNodeById($id);
    $this->menu     = array('url' => 'position');
    $this->title    = $this->node[0]['title'];

    /*
      linx
    */
    foreach($result['result'] as $k => $r) {
      $result['result'][$k]['link'] = $this->router->link("positions/{$r['id']}");
    }

    $this->content  = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => array(
          'node'        => $this->codeItForContent($this->node),
          'positions'   => $this->codeItForPositions($result['result']),
          'locations'   => $position->getLocations(),
          'types'       => $position->getTypes(),
          'all'         => $result['all'],
          'currentPage' => 1
        )
      ),
      $this->view->getTemplatePath('content','show')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );
  }

  public function codeItForPositions($arr) {
    $res    = array();
    $ar     = array();
    foreach($arr as $thisArr) {

      $ar['position']   =  urlencode($thisArr['position']);
      $ar['type']       = urlencode($thisArr['type']);
      $ar['location']   = urlencode($thisArr['location']);
      $ar['link']       = urlencode($thisArr['link']);
      $ar['id']         = $thisArr['id'];

      $res[] = $ar;
    }
    return $res;
  }

  public function codeItForContent($arr) {
    $res    = array();
    $ar     = array();
    foreach($arr as $thisArr) {
      $ar = array();
      foreach($thisArr as $k => $val) {
        $ar[$k] = urlencode($val);
      }
      $res[] = $ar;
    }
    return $res;
  }

  public function codeIt($arr) {
    $res    = array();
    $ar     = array();
    foreach($arr as $thisArr) {
      $ar = array();
      foreach($thisArr as $k => $val) {
        $ar[$k] = urlencode($this->stuff->textCutter($val,360));
      }
      $res[] = $ar;
    }
    return $res;
  }

  public function index() {

    $this->title = 'Evoline - home';

    $contentArr = array();
    $arr        = $this->model->get();

    $this->content = $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => 'asda' //$this->model->codeIt($contentArr)
      ),
      $this->view->getTemplatePath('front','index')
    );

    echo $this->view->renderTemplate(
      array(
        'scope' => $this,
        'data'  => $this->content
      ),
      $this->view->getTemplatePath('page','page')
    );

  }

  public function newsletter_add() {
    if(isset($this->post['name']) && $this->post['name'] != '' && isset($this->post['mail']) && $this->post['mail'] != '') {
      $this->model->query(
        "
          insert
            into
              contacts
                (name,mail)
              values
                (?,?)
        ",
        array($this->post['name'],$this->post['mail'])
      );
    }
    $this->redirect('content/menu/newsletter');
  }

  public function email_add() {
#    if(isset($this->post['name']) && $this->post['name'] != '' && isset($this->post['mail']) && $this->post['mail'] != '') {
#      $this->model->query(
#        "
#          insert
#            into
#              contacts
#                (name,mail)
#              values
#                (?,?)
#        ",
#        array($this->post['name'],$this->post['mail'])
#      );
#    }
    $this->redirect('email');
  }

  public function cv_add() {
#    if(isset($this->post['name']) && $this->post['name'] != '' && isset($this->post['mail']) && $this->post['mail'] != '') {
#      $this->model->query(
#        "
#          insert
#            into
#              contacts
#                (name,mail)
#              values
#                (?,?)
#        ",
#        array($this->post['name'],$this->post['mail'])
#      );
#    }
    $this->redirect('cv');
  }

  public function search() {
    if(isset($this->get['key'])) {

      $this->router->action = 'search';

      $this->menu           = array();
      $this->title          = 'Keresés';
      $this->menu['url']    = 'search';
      $this->router->action = 'search';
      $k                    = $this->get['key'];
      $contentArr           = array();
      $arr                  = $this->model->select(
        "
          select
            n.*,
            nt.*
          from
            node n
          left join
            articles nt
          on n.id = nt.nid

          where
            nt.title like ?
          or
            nt.lead like ?
          or
            nt.body like ?
          ",
          array(
            "%{$k}%",
            "%{$k}%",
            "%{$k}%"
          )
      ); //print_r($arr);

      foreach($arr as $a) {
        $contentArr[] = $this->model->urlLookup($a);
      }

      $arr                  = $this->model->select(
        "
          select
            n.*,
            nt.*
          from
            node n
          left join
            kiemelt nt
          on n.id = nt.nid

          where
            nt.title like ?
          or
            nt.lead like ?
          or
            nt.body like ?
          ",
          array(
            "%{$k}%",
            "%{$k}%",
            "%{$k}%"
          )
      );

      foreach($arr as $a) {
        $contentArr[] = $this->model->urlLookup($a);
      }

      $arr                  = $this->model->select(
        "
          select
            n.*,
            nt.*
          from
            node n
          left join
            evoline_kozep_menu_content nt
          on n.id = nt.nid

          where
            nt.title like ?
          or
            nt.lead like ?
          or
            nt.body like ?
          ",
          array(
            "%{$k}%",
            "%{$k}%",
            "%{$k}%"
          )
      );

      foreach($arr as $a) {
        $contentArr[] = $this->model->urlLookup($a);
      }

      $this->content = $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $this->codeIt($contentArr)
        ),
        $this->view->getTemplatePath('content','index')
      );

      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $this->content
        ),
        $this->view->getTemplatePath('page','page')
      );
    }

  }
}
