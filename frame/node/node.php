<?php

class Node extends Model {

  public function getNodeById($id) {
    $t = $this->select('select type from node where id = ?',array($id));

    if(isset($t[0])) {
      $r = $this->select(
        "
          select
            n.*,
            nt.*
          from
            node n
          left join
            {$t[0]['type']} nt
          on n.id = nt.nid

          where
            n.id = ?
        ",
        array($id)
      );
      if(isset($r[0])) {
        return $r;
      }
    }
    return null;
  }

  public function getAllByType($type = '',$order = '',$thisWhere = '',$limit = '') {
    if($type != '') {

      $where = " where n.type = '{$type}' ";

      if($thisWhere != '') {
        $where .= $thisWhere;
      }

      $r = $this->select(
        "
          select
            n.*,
            nt.*
          from
            node n
          left join
            {$type} nt
          on n.id = nt.nid

          {$where}

          {$order}

          {$limit};
        ",
        array()
      );
      if(count($r) > 0) {
        return $r;
      }
    }
    return null;
  }

  public function getform($job = 'create',$type = 'node',$id = '') {
    $form = array(
      'form'      => array(
        'action'    => '/node',

        'enctype'   => "multipart/form-data",

        'method'    => 'post',
        'token'     => true,
        '_method'   => $job,
        'id'        => "node_{$job}",
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),
      'elements'  => array(
        array(
          'type'  => 'hidden',
          'value' => $type,
          'id'    => 'type',
          'name'  => 'type'
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
          'id'    => 'meta_description',
          'class' => 'input-xlarge',
          'name'  => 'meta_description'
        ),
        array(
          'type'    => 'checkbox',
          'label'   => 'Aktív',
          'id'      => 'active',
          'class'   => 'input-xlarge',
          'name'    => 'active'
        ),
        array(
          'type'    => 'select',
          'label'   => 'Nyelv',
          'id'      => 'lang',
          'class'   => 'input-xlarge',
          'name'    => 'lang',
          'options' =>  $this->getSelectOptions($type,'lang') //array('hu','en','de')
        )
      )
    );

    if($job == 'update' && $id != '') {
      $form['elements'][] = array(
        'type'  => 'hidden',
        'value' => $id,
        'id'    => 'id',
        'name'  => 'id'
      );
    }

    $nType  = $this->getType($type);
    $cfg    = json_decode($nType['cfg']);

    foreach($cfg as $c) {

      if($c->type == 'select') {
        array_push($form['elements'],array(
          'type'    => $c->type,
          'label'   => $c->name,
          'id'      => $c->name,
          'class'   => 'input-xlarge',
          'name'    => $c->name,
          'options' => $this->getSelectOptions($type)
        ));
      } else {
        array_push($form['elements'],array(
          'type'    => $c->type,
          'label'   => $c->name,
          'id'      => $c->name,
          'class'   => 'input-xlarge',
          'name'    => $c->name
        ));
      }
    }

    $form['elements'][] = array(
      'type'  => 'submit',
      'id'    => 'sbm',
      'class' => 'btn btn-primary',
      'value' => 'Mentés'
    );

    if($job == 'create') {
      $form = $this->changeCreateForm($form,$type);
    }

    return $form;
  }

  public function getType($type) {
    $res = $this->select(
      "select * from node_type where name = ?;",
      array($type)
    );
    if(isset($res[0])) {
      return $res[0];
    }
    return null;
  }

  public function create($post) {
    $type   = $post['type'];
    $nType  = $this->getType($type);
    $cfg    = json_decode($nType['cfg']);

    /*
      first of all we must create a new node
    */
    $nodeValues   = array();
    $nodeValues[] = $type;
    $nodeValues[] = (isset($post['date_from'])        ? $post['date_from']                          : '');
    $nodeValues[] = (isset($post['date_to'])          ? $post['date_to']                            : '');
    $nodeValues[] = (isset($post['meta_title'])       ? $post['meta_title']                         : '');
    $nodeValues[] = (isset($post['meta_keywords'])    ? $post['meta_keywords']                      : '');
    $nodeValues[] = (isset($post['meta_description']) ? $post['meta_description']                   : '');
    $nodeValues[] = (isset($post['lang'])             ? $post['lang']                               : 'hu');
    $nodeValues[] = (isset($post['active'])           ? ($post['active'] == 'on' ? 1 : 0)           : 0);

    $this->query(
      "
        insert
          into
            node
              (created,type,date_from,date_to,meta_title,meta_keywords,meta_description,lang,active)
          values
              (now(),?,?,?,?,?,?,?,?);
      ",
      $nodeValues
    );

    $lastInserId  = $this->db->lastInsertId();
    $values       = array();
    $vals         = array();
    $arr          = array();
    $vals[]       = $lastInserId;
    $values[]     = 'nid';
    $arr[]        = '?';
    foreach($cfg as $c) {
      $values[] = $c->name;
      $vals[]   = (isset($post[$c->name]) ? $post[$c->name] : '');
      $arr[]    = '?';
    }

    $thisVals = implode(',',$values);
    $thisArr  = implode(',',$arr);

    $this->query(
      "
        insert
          into
            {$type}({$thisVals})
          values
            ({$thisArr});
      ",
      $vals
    );

    if(count($_FILES) > 0) {
      $this->addFiles($type,$post,$lastInserId);
    }

    return $lastInserId;
  }

  public function update($type,$index,$node) {
    $formArr = $this->getform('update',$type,$index);
    foreach($formArr['elements']  as $k => $el) {
      if($el['type'] != 'submit') {
        if(isset($node[0][$el['name']])) {

          if($el['name'] == 'active') {
            $formArr['elements'][$k]['checked']     = ($node[0][$el['name']] == 1 ? 'true' : 'false');
          } else if($el['name'] == 'id') {
            $formArr['elements'][$k]['value']       = $index;
          } else if($el['name'] == 'lang') {
            $formArr['elements'][$k]['value']       = $node[0][$el['name']];
          }

          else if($el['name'] == 'gallery') {
            $formArr['elements'][$k]['options']     = $this->getGalleries();
            $formArr['elements'][$k]['value']       = $node[0][$el['name']];
          }

          else {
            $formArr['elements'][$k]['value']       = $node[0][$el['name']];
          }

        }
      }
    }

    /*
      render hook for update form
    */
    $formArr = $this->changeUpdateForm($formArr,$index);

    $formArr['form']['action'] = "/node/{$index}";
    return $formArr;
  }

  public function saveUpdate($post) { //print_r($post); die();
    $type   = $post['type'];
    $nType  = $this->getType($type);
    $cfg    = json_decode($nType['cfg']); //print_r($cfg); die();
    $cfgArr = array();
    foreach($cfg as $c) {
      $cfgArr[] = $c->name;
    }

    $nodeArr      = array();
    $nodeTypeArr  = array();
    foreach($post as $k => $val) {
      if(in_array($k,$cfgArr)) {
        $nodeTypeArr[$k] = $val;
      }
    }

    /*
      update node
    */
    $this->query(
      "
        update
          node
            set
              date_from         = ?,
              date_to           = ?,
              meta_title        = ?,
              meta_keywords     = ?,
              meta_description  = ?,
              lang              = ?,
              active            = ?,
              edited            = now()
          where
            id = ?
      ",
      array(
        $post['date_from'],
        $post['date_to'],
        $post['meta_title'],
        $post['meta_keywords'],
        $post['meta_description'],
        $post['lang'],
        ($post['active'] == 'on' ? 1 : 0),
        $post['id']
      )
    );

    /*
      update node type
    */
    $updStr = '';
    $updArr = array();
    foreach ($nodeTypeArr as $key => $val) {
      $updStr   .= " {$key} = ?, ";
      $updArr[]  = $val;
    }

    $updArr[] = $post['id'];
    $updStr   = substr($updStr,0,strlen($updStr)-2);

    $this->query(
      "
        update
          {$post['type']}
            set
             {$updStr}
          where
            nid = ?
      ",
      $updArr
    ); //print_r($updArr); die();
  }

  public function delete($id) {
    $thisNode = $this->getNodeById($id);

    if($thisNode[0]['type'] == 'gallery') {
      $res = $this->select("
        select right_id from node_node where left_id = ? and left_type = 'gallery';
      ",
      array($id)
      );

      if(isset($res[0]['right_id'])) {
        $this->query("delete from node_node where left_id = ? and (right_type = 'images')",array($res[0]['right_id']));
      }
    }

    if($thisNode[0]['type'] == 'sidebar') {
      $res = $this->select("
        select right_id from node_node where left_id = ? and left_type = 'sidebar';
      ",
      array($id)
      );

      if(isset($res[0]['right_id'])) {
        $this->query("delete from node_node where left_id = ? and (right_type = 'articles')",array($res[0]['right_id']));
      }
    }

    if($thisNode[0]['type'] == 'home') {
      $res = $this->select("
        select right_id from node_node where left_id = ? and left_type = 'home';
      ",
      array($id)
      );

      if(isset($res[0]['right_id'])) {
        $this->query("delete from node_node where left_id = ? and (right_type = 'articles' or right_type = 'images')",array($res[0]['right_id']));
      }
    }

    $this->query("delete from node where id = ?",array($id));
    $this->query("delete from {$thisNode[0]['type']} where nid = ?",array($id));

#    $this->query("delete from node_node where left_id = ?",array($id));
#    $this->query("delete from node_node where right_id = ?",array($id));
  }

  public function setActive($id,$state) {
    $thisState = ($state == 'true' ? 1 : 0);// echo "update node set active = ? where id = ?";
    $this->query("update node set active = ? where id = ?",array($thisState,$id));
  }

  /*
    files hook
  */
  public function addFiles($type = '',$post,$id = -1) {
    global $loader;
    if($type != '' && $id != -1) {
      switch($type) {
        case 'images':
          $stuff    = $loader->get('Stuff');
          $thisName = md5(microtime());

          if($newFile = $stuff->moveUpload('name',$thisName,UPLOAD.$post['gallery'])) {
            $this->query("update images set name = '{$newFile}' where nid = {$id}",array());
          }
        break;
      }
    }
  }

  /*
    select options hook
  */
  public function getSelectOptions($type,$field='') {
    if($field == 'lang') {
      return array('hu','en','de');
    }
    if($type != '') {
      switch($type) {
        case 'images':
          return $this->getGalleries();
        break;
      }
    }
  }

  public function getNodeConnection($direction,$id) {
    $sql = '';
    switch($direction) {
      case 'left':
        $sql = "
          select
            right_id,
            right_type
              from
                node_node
          where
            left_id = ?
        ";
      break;
      case 'right':
        $sql = "
          select
            right_id,
            right_type
              from
                node_node
          where
            right_id = ?
        ";
      break;
    }
    if($sql != '') {
      return $this->select($sql,array($id));
    }
    return null;
  }

  /*
    extra params hook
  */
  public function addParams($type = '',$nodes = array()) {
    if($type != '') {
      switch($type) {
        case 'images':
          if(count($nodes) > 0) {
            foreach($nodes as $index => $r) {
              $thisGallery = $this->getNodeById($r['gallery']);
              $nodes[$index]['params'] = $thisGallery[0];
            }
          }
        break;

        case 'sidebar':
          if(count($nodes) > 0) {
            foreach($nodes as $index => $r) {
              $arr        = explode('|',$r['nodes']);
              if(isset($arr[0])) {
                $main_node                = $this->getNodeById($arr[0]);
                $nodes[$index]['params']  = $main_node[0];
              }
            }
          }
        break;

        case 'gallery':
          if(count($nodes) > 0) {
            foreach($nodes as $index => $r) {
              $arr        = explode('|',$r['nodes']);
              if(isset($arr[0])) {
                $main_node                = $this->getNodeById($arr[0]);
                $nodes[$index]['params']  = $main_node[0];
              }
            }
          }
        break;

        case 'home':
          if(count($nodes) > 0) {
            foreach($nodes as $index => $r) {
              $arr        = explode('|',$r['nodes']);
              if(isset($arr[0])) {
                $main_node                = $this->getNodeById($arr[0]);
                $nodes[$index]['params']  = $main_node[0];
              }
            }
          }
        break;

      }
    }
    return $nodes;
  }

  /*
    render hook for create form
  */
  public function changeCreateForm($form,$type) {
    global $loader;
    $thisView = $loader->get('View');
    $elements = array();
    foreach($form['elements'] as $el) {
      switch($type) {
        case 'menu':
          if($el['type'] == 'hidden') {
            if($el['name'] == 'action') {
              $elements[] = array(
                'type'  => 'special',
                'src'   => 'sample_menu'
              );
              $elements[] = $el;
            } else {
              $elements[] = $el;
            }
          } else {
            $elements[] = $el;
          }
          $form['elements'] = $elements;
        break;
      }
    }
    return $form;
  }

  /*
    render hook for update form
  */
  public function changeUpdateForm($form,$id) {
    global $loader;
    $thisView = $loader->get('View');
    $node     = $this->getNodeById($id);

    $elements = array();
    foreach($form['elements'] as $el) {
      switch($node[0]['type']) {
        case 'menu':
          if($el['type'] == 'hidden') {
            if($el['name'] == 'action') {
              $elements[] = array(
                'type'  => 'special',
                'src'   => 'sample_menu'
              );
              $elements[] = $el;
            } else {
              $elements[] = $el;
            }
          } else {
            $elements[] = $el;
          }
          $form['elements'] = $elements;
        break;
        case 'images':
          if($el['type'] == 'file') {
            $path = "/upload/{$node[0]['gallery']}/{$node[0]['name']}";
            $elements[] = array(
              'type'  => 'special',
              'html'  => '
                <label>kép</label>
                <div class="control-group">
                  <a target="_blank" href="'.$path.'"><img width="150" src="'.$path.'" /></a>
                </div>
              '
            );
            $elements[] = array(
              'type'  => 'hidden',
              'name'  => 'name',
              'value' =>  $node[0]['name']
            );
          } else {
            $elements[] = $el;
          }
          $form['elements'] = $elements;
        break;
      }
    }
    return $form;
  }

  public function getImagesByGallery($gallery_id) {
    $r = $this->select(
      "
        select
          n.*,
          nt.*
        from
          node n
        left join
          images nt
        on n.id = nt.nid

        where
          nt.gallery = ?
        and
          n.active = 1;
      ",
      array($gallery_id)
    );

    return $r;
  }

  public function getGalleries() {
    $result = array();
    $res    = $this->select(
      "select nid,title from galleries",
      array()
    );
    foreach($res as $r) {
      $result[$r['nid']] = $r['title'];
    }
    return $result;
  }

  public function getTypeById($id) {
    $res = $this->select(
      "select * from node_type where id = ?",
      array($id)
    );

    if(count($res) > 0) {
      return $res;
    }
    return null;
  }

  public function getTypes() {
    $res = $this->select(
      "select * from node_type;",
      array()
    );
    $types = array();
    if(count($res) > 0) {
      foreach($res as $r) {
        $types[] = $r['name'];
      }
      return $types;
    }
    return null;
  }

  public function getNodeTypeById($id) {
    $node = $this->select(
      "
        select
          type
            from
              node
        where
          id = ?
      ",
      array($id)
    );
    return $node[0]['type'];
  }

  public function getNodeTypes() {
    $res = $this->select(
      "select * from node_type where name != 'menu';",
      array()
    );
    if(count($res) > 0) {
      return $res;
    }
    return null;
  }

  public function deletetype($id) {
    $thisType = $this->getTypeById($id);
    $tbl      = $thisType[0]['name'];

    $this->query("drop table {$tbl}",array());
    $this->query("delete from node_type where id = ?",array($id));
    $this->query("delete from node where type = '{$tbl}'",array());
  }

  public function saveSidebarItem($left_id,$ids) {
    $sidebarId  = $this->create(array('type'=>'sidebar'));
    $arr        = array($left_id);
    foreach($ids as $id) {
      $arr[] = $id;
    }

    $thisString = implode('|',$arr);
    $this->query("
      update sidebar set nodes = ? where nid = ?
    ",array($thisString,$sidebarId));
  }

  public function updateSidebarItem($left_id,$ids) {
   $res = $this->select("
      select
        nid
          from
            sidebar
      where nodes like '{$left_id}%'
    ",array());

    $sidebarId = $res[0]['nid'];

    $arr = array($left_id);
    foreach($ids as $id) {
      $arr[] = $id;
    }
    $thisString = implode('|',$arr);
    $this->query("
      update sidebar set nodes = ? where nid = ?
    ",array($thisString,$sidebarId));
  }

  public function getMenuByRoute($route) {
    $res = $this->select("
      select
        m.*
          from

            menu m
      join node n
        on m.nid = n.id

      where
        url = ?
      and
        n.active != 10
    ",array($route));
    if(isset($res[0])) {
      return $res[0];
    }

    return null;
  }

  public function saveGalleryItem($left_id,$ids) {
    $sidebarId = $this->create(array('type'=>'gallery'));
    $arr = array($left_id);
    foreach($ids as $id) {
      $arr[] = $id;
    }
    $thisString = implode('|',$arr);
    $this->query("
      update gallery set nodes = ? where nid = ?
    ",array($thisString,$sidebarId));
  }

  public function updateGalleryItem($left_id,$ids) {
    $res = $this->select("
      select
        nid
          from
            gallery
      where nodes like '{$left_id}%'
    ",array());

    $sidebarId = $res[0]['nid'];

    $arr = array($left_id);
    foreach($ids as $id) {
      $arr[] = $id;
    }
    $thisString = implode('|',$arr);
    $this->query("
      update gallery set nodes = ? where nid = ?
    ",array($thisString,$sidebarId));
  }

  public function saveHomeItem($left_id,$ids) {
    $sidebarId  = $this->create(array('type'=>'home'));
    $arr        = array($left_id);
    foreach($ids as $id) {
      $arr[] = $id;
    }

    $thisString = implode('|',$arr);
    $this->query("
      update home set nodes = ? where nid = ?
    ",array($thisString,$sidebarId));
  }

  public function updateHomeItem($left_id,$ids) {
   $res = $this->select("
      select
        nid
          from
            home
      where nodes like '{$left_id}%'
    ",array());

    $sidebarId = $res[0]['nid'];

    $arr = array($left_id);
    foreach($ids as $id) {
      $arr[] = $id;
    }
    $thisString = implode('|',$arr);
    $this->query("
      update home set nodes = ? where nid = ?
    ",array($thisString,$sidebarId));
  }

  public function urlLookup($node) {
    /*
      1., search in the show actions of menu node
    */
    $res = $this->select(
      "
        select
          *
          from
            menu
          where
            content = ?
      ",
      array($node['nid'])
    );

    if(isset($res[0])) { //print_r($res[0]);
      $node['link'] = '/'.$this->link("content/menu/{$res[0]['url']}");
    } else {
    /*
      2., if it fails ( 1 ), generate a content/menu/type/id url
    */
      $node['link'] = '/'.$this->link("content/menu/{$node['type']}/{$node['nid']}");
    }
    return $node;
  }

  public function link($link) {
    global $loader;
    if(!isset($this->linkModel)) {
      $this->linkModel = $loader->get('linx','model');
    }

    if(!isset($this->linx)) {
      $linx = $this->linkModel->get();
      foreach($linx as $l) {
        $this->linx[$l['params']] = $l['thisorder'];
      }
    }

    if(isset($this->linx[$link])) {
      return $this->linx[$link];
    } else {
      return $link;
    }
  }

  // public function script() {
  //   $res = $this->select(
  //     "
  //       select
  //         *
  //       from
  //         images
  //     ",
  //     array()
  //   );
  //   foreach($res as $r) {
  //     $this->query(
  //       "
  //         insert into node(type,created,meta_title,meta_keywords,meta_description,lang, active)
  //         values('images','{$r['created']}','{$r['meta_title']}','{$r['meta_keywords']}','{$r['meta_desc']}','{$r['lang']}','{$r['active']}');
  //       "
  //     );

  //     $lstId = $this->db->lastInsertId();

  //     $this->query(
  //       "
  //         insert into images_temp(nid,title,gallery,name,lead)
  //         values({$lstId},'{$r['title']}','{$r['gallery']}','{$r['name']}','{$r['lead']}');
  //       "
  //     );
  //   }
  // }
}
