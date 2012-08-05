<?php

class Main_helper extends View {

  public function init() {
    $this->model  = $this->scope->router->loader->get('Node');

    $thisUrl      = $this->model->select(
      "select thisorder from linx where params = ?",
      array(implode('/',$this->scope->router->orders))
    );

    if(isset($thisUrl[0]['thisorder'])) {
      $this->url = $thisUrl[0]['thisorder'];
    } else {
      $this->url = implode('/',$this->scope->router->orders);
    }
  }

  public function getSliderImages() {
    $Images_model = $this->scope->router->loader->get('Images','model');
    $images       = $Images_model->get(
      '',
      array(
        "
        select
          *
            from
              images
        where
          gallery = ?
        ",
        array(17)
      )
    );

    return $this->renderTemplate($images,$this->getTemplatePath('page','slider'));
  }

  public function getSEO() {
    $arr    = array(
      'Content-type'              => 'text/html; charset=utf-8',
      'Content-Language'          => "{$_SESSION['language']}-{$_SESSION['language']}",
      'Copyright'                 => '',
      'author'                    => 'thRobt'
    );
    $metas  = '';
    foreach($arr as $key => $value) {
        $metas .= implode('',array(
          "<meta http-equiv='",
          $key,
          "' content='",
          $value,
          "' />\n"
        ));
    }
    return $metas;
  }

  public function getTitle($title) {
    return "<title>{$title}</title>";
  }

  public function getHeader() {
  	return implode("\n",array(
      $this->getTitle((!isset($this->scope->title) ? '' : $this->scope->title)),
      $this->getSEO(),
      $this->getStyle(),
      $this->getScript()
    ));
  }

  public function getCalendar() {
    return $this->renderTemplate('',$this->getTemplatePath('page','siderbanner'));
  }

  public function getMenu() {
    $result = array();
    $res    = $this->model->getAllByType('menu',' order by nt.menu_order '," and n.lang = '{$_SESSION['language']}' and n.active = 1 ");

    foreach ($res as $r) {
      $result[$r['title']] = $this->scope->router->link("content/menu/{$r['url']}");
    }
    $result['active'] = $this->url;
    return $result;
  }

  public function happeningImages() {

    $gallery = array();
    switch($this->scope->router->action) {
      case 'index':
        /*
          ugly, but dont have time
          it must be 'HOME' (theres no other index action in this page)
          this node is 337
        */
        $thisNode     = $this->model->getNodeById(337);
        $gallery      = $thisNode[0];
      break;

      case 'show':
        $thisNode     = $this->scope->node[0]['nid'];
        $res          = $this->model->select("
          select
            nid
              from
                gallery
          where nodes like ?
        ",array("{$thisNode}%"));

        if(isset($res[0]['nid'])) {
          $thisNode     = $this->model->getNodeById($res[0]['nid']);
          $gallery      = $thisNode[0];
        }
      break;
    }

    $images = array(); $thisNode;
    if(isset($gallery['nodes'])) {
      $res = explode('|',$gallery['nodes']);
      array_shift($res);
    } else {
      /*
        simple fallback -> instead of display error
        default image, or sthing like that
      */
      $res = array(
        216
      );
    }

    if(count($res) > 0) {
      foreach($res as $r) {
        $thisNode = $this->model->getNodeById($r);
        $images[] = $thisNode[0];
      }
    }

    foreach($images as $image) {
      $arr[] = array(
        'src'   => "/upload/{$image['gallery']}/{$image['name']}",
        "text"  => "{$image['title']}|{$image['lead']}"
      );
    }
    return $arr;
  }

  public function getSideBarItems() {
    $nodes  = array();

    if($this->scope->router->orders[0] == 'positions') {
      $thisNode = 189;
    } else {
      $thisNode = $this->scope->node[0]['nid'];
    }

    $res = $this->model->select("
      select
        nid
          from
            sidebar
      where nodes like ?
    ",array("%{$thisNode}%"));

    if(isset($res[0]['nid'])) {
      $thisNode     = $this->model->getNodeById($res[0]['nid']);
      $sidebar      = $thisNode[0];

      $res    = explode('|',$sidebar['nodes']);
      array_shift($res);
      if(count($res) > 0) {
        foreach ($res as $r) {
          $result   = $this->model->getNodeById($r);
          $thisNode = $this->model->urlLookup($result[0]);
          $nodes[$thisNode['title']] = $thisNode['link'];
        }
      }
    }

    return $nodes;

#    $res = $this->model->select(
#      "
#        select
#          left_id
#            from
#              node_node
#        where
#          right_id = ?
#        and
#          left_type = 'sidebar'

#      ",array($this->scope->node[0]['nid'])
#    );

#    $sider_el = (isset($res[0]['left_id']) ? $res[0]['left_id'] : '');

#    if($sider_el != '') {
#      $nodes  = array();

#      $res    = $this->model->select(
#        "
#          select
#            nn.right_id
#              from
#                node_node nn

#          left join
#            node n
#              on nn.right_id = n.id

#          where
#            nn.left_id = ?
#          and
#            nn.right_type != 'sidebar'

#          order by
#            n.date_from desc

#        ",array($this->scope->node[0]['nid'])
#      );

#      foreach ($res as $r) {
#        $result   = $this->model->getNodeById($r['right_id']);
#        $thisNode = $this->model->urlLookup($result[0]);
#        $nodes[$thisNode['title']] = $thisNode['link'];
#      }
#      return $nodes;
#    } else {
#      $res = $this->model->select(
#        "
#          select
#            left_id
#              from
#                node_node
#          where
#            right_id = ?
#          and
#            left_type = 'articles'

#        ",array($this->scope->node[0]['nid'])
#      );
#      $sider_el = (isset($res[0]['left_id']) ? $res[0]['left_id'] : '');

#      if($sider_el != '') {
#        $res    = $this->model->select(
#          "
#            select
#              nn.right_id
#                from
#                  node_node nn

#            left join
#              node n
#                on nn.right_id = n.id

#            where
#              nn.left_id = ?
#            and
#              nn.right_type != 'sidebar'

#            order by
#              n.date_from desc

#          ",array(/*$this->scope->node[0]['nid']*/  $sider_el)
#        );
#        $nodes  = array();
#        foreach ($res as $r) {
#          $result   = $this->model->getNodeById($r['right_id']);
#          $thisNode = $this->model->urlLookup($result[0]);
#          $nodes[$thisNode['title']] = $thisNode['link'];
#        }
#        return $nodes;
#      }
#    }
  }

  public function getPageMenu() {
    $nodes  = array();
    $res    = $this->model->select(

      "
        select
            n.*,
            nt.*
          from
            node n
           join
            evoline_kozep_menu_content nt
          on n.id = nt.nid

        where
          n.lang = '{$_SESSION['language']}'
      ",
      array()
    );

    foreach ($res as $r) {
      $result   = $this->model->getNodeById($r['nid']);
      $thisNode = $this->model->urlLookup($result[0]);
      $nodes[$thisNode['title']] = $thisNode['link'];
    }

    switch($this->scope->router->action) {
      case 'show':

        if($this->scope->router->orders[0] == 'positions') {
          $nodes['pageTitle'] = $this->scope->title;
        } else {
          $thisNode           = $this->model->getNodeById($this->scope->node[0]['nid']);
          $nodes['pageTitle'] = $thisNode[0]['title'];
        }
      break;
      case 'index':
        $nodes['pageTitle'] = $this->scope->menu['title'];
      break;
      case 'search':
        $nodes['pageTitle'] = 'search';
      break;
    }
    return $nodes;
  }

  public function getPageInfo() {
    return array(
      'pageTitle' => (!isset($this->scope->menu['title']) ? $this->scope->node[0]['title'] : $this->scope->menu['title']),
      'language'  =>  $_SESSION['language']
    );
  }

  public function getBreadCrumb($id) {
    if($id == '') {
      $this->bcIds      = array();
      $this->breadcrumb = array();
      if($this->scope->router->action == 'index') {
        $thisMenu = $this->scope->menu;
        $thisMenu['config'] = '';
        $this->breadcrumb[] = $thisMenu;
      } else if($this->scope->router->action == 'show') {
        $this->breadcrumb[] = $this->scope->node[0];
        $this->getBreadRecursive($this->scope->node[0]['nid']);

        foreach($this->breadcrumb as $k => $crumb) {
          $this->breadcrumb[$k]['link'] = $this->scope->router->link("content/menu/{$crumb['type']}/{$crumb['nid']}");
          $this->breadcrumb[$k]['body'] = '';
        }
      }
    } else {
      $this->breadcrumb = $this->codeItForContent($this->model->getNodeById($id));
      $this->getBreadRecursive(189);
    }
  }

  public function getBreadRecursive($right_id) {
    $res          = $this->model->select("
      select
        *
          from
            sidebar
      where nodes like ?
    ",array("%{$right_id}%"));

    $res1          = $this->model->select("
      select
        *
          from
            sidebar
      where nodes like ?
    ",array("{$right_id}%"));

    if(!isset($res1[0]['nid']) || $res[0]['nid'] != $res1[0]['nid']) {
      if(isset($res[0]['nodes'])) {
        $arr      = explode('|',$res[0]['nodes']);
        $thisNode = array_shift($arr);

        if(!in_array($thisNode,$this->bcIds)) {
          $this->bcIds[]      = $thisNode;
          $node               = $this->codeItForContent($this->model->getNodeById($thisNode));
          $this->breadcrumb[] = $node[0];
          $this->getBreadRecursive($thisNode);
        } else {
          return;
        }
      }
    } else {
      return;
    }
  }

  public function getCfg() {

    if($this->scope->router->orders[0] == 'positions') {
      $this->getBreadCrumb(189);
    } else {
      $this->getBreadCrumb('');
    }  //print_r($this->breadcrumb);

    $cfg = json_encode(array(
      'language'        => $_SESSION['language'],
      'menubar'         => $this->getMenu(),
      'sys'             => (isset($this->scope->router->sys) ? $this->scope->router->sys : array()),
      'happeningImages' => $this->happeningImages(),
      'sidebar'         => ($this->scope->router->action == 'show' ? $this->getSideBarItems() : ''),
      'thisLocation'    => $this->scope->router->link($this->url),
      'pageMenu'        => $this->getPageMenu(),
      'pageInfo'        => $this->getPageInfo(),
      'breadcrumb'      => $this->breadcrumb,
      'translate'       => $this->translate(),
      'messages'        => $this->getSysMess()
    ));

    return "<div id='cfg' class='hiddenStuff'>{$cfg}</div>";
  }

  public function getSysMess() {
    $result = array();
    if(isset($_SESSION['messages'])) {
      foreach($_SESSION['messages'] as $k => $message) {
        $result[$k] = $message->message;
      }
      return $result;
    }
  }

  public function translate() {
    $result = array();
    $model  = $this->scope->router->loader->get('Langelements','model');
    $res    = $model->select("select * from langelements where type = ?",array($this->scope->menu['url']));
    if($res) {
      foreach($res as $r) {
        $result[$r['orig']] = $r[$_SESSION['language']];
      }
      return $result;
    } else {
      return array();
    }
  }

  public function about_us() {
    return '
      <div id="sider_about_us">
      </div>
    ';
  }

  public function getSider() {
  	return implode("\n",array(
      '<div id="sider_container">',
      $this->getFacebookCode(),
      $this->getCalendar(),
      '</div>',
      $this->about_us()
    ));
  }

  public function getFooter() {
  	return $this->renderTemplate('',$this->getTemplatePath('page','footer'));
  }

  public function getScript() {

    $main_js = array(
      'index'   => 'main.js',
      'show'    => 'main_show.js',
      'search'  => 'main_search.js'
    );

    $scripts  = '';

    switch($this->scope->menu['url']) {
      case 'newsletter':
        $arr = array('jquery.js','evoline_gallery.js','builder.js','stuff.js','slidercfg.js','main_newsletter.js');
      break;
      case 'contact':
        $arr      = array('jquery.js','evoline_gallery.js','builder.js','stuff.js','slidercfg.js','main_contact.js');
      break;
      case 'positions':
        $arr      = array('jquery.js','evoline_gallery.js','builder.js','stuff.js','slidercfg.js','main_position.js');
      break;
      case 'cv':
        $arr      = array('jquery.js','evoline_gallery.js','builder.js','stuff.js','slidercfg.js','main_cv.js');
      break;
      case 'position':
        $arr      = array('jquery.js','evoline_gallery.js','builder.js','stuff.js','slidercfg.js','main_positions.js');
      break;
      default:
        $arr = array('jquery.js','evoline_gallery.js','builder.js','stuff.js','slidercfg.js',$main_js[$this->scope->router->action]);
      break;
    }


    foreach($arr as $scriptName) {
      $scripts .= implode('',array(
        "<script src='/js/",
        $scriptName,
        "' type='text/javascript'></script>\n"
      ));
    }
    return $scripts;
  }

  public function getStyle() {
    $arr      = array(/*'bootstrap.css','bootstrap-responsive.css',*/'bootstrap.css','nivo-slider.css','bootstrap-responsive.css', /*'bootstrap.css','default.css'*/ 'style.css');
    $styles   = '';
    foreach($arr as $scriptName) {
      $styles .= implode('',array(
        "<link rel='stylesheet' type='text/css' href='/css/",
        $scriptName,
        "' />\n"
      ));
    }
    return $styles;
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
}
