<?php
class Taxonomy extends Model {

  /*
    @method vocabulary_form

    @return array
  */
  public function vocabulary_form() {
    $form = array(
      'form'      => array(
        'action'    => '',

        'enctype'   => "multipart/form-data",

        'method'    => 'post',
        'token'     => true,
        '_method'   => '',
        'id'        => "vocabulary",
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),
      'elements'  => array(
        array(
          'type'  => 'text',
          'label' => 'name:',
          'id'    => 'name',
          'class' => 'input-xlarge',
          'name'  => 'name'
        ),
        array(
          'type'  => 'textarea',
          'label' => 'description:',
          'id'    => 'description',
          'class' => 'input-xlarge',
          'name'  => 'description'
        ),
        array(
          'type'    => 'select',
          'label'   => 'hierarchy',
          'id'      => 'hierarchy',
          'class'   => 'input-xlarge',
          'name'    => 'hierarchy',
          'options' =>  $this->getHierarchyForVoc()
        ),
        array(
          'type'  => 'checkbox',
          'label' => 'required:',
          'id'    => 'required',
          'class' => 'input-xlarge',
          'name'  => 'required'
        ),
        array(
          'type'  => 'text',
          'label' => 'weight:',
          'id'    => 'weight',
          'class' => 'input-xlarge',
          'name'  => 'weight'
        ),
        array(
          'type'  => 'submit',
          'id'    => 'sbm',
          'class' => 'btn btn-primary',
          'value' => 'Save'
        )
      )
    );
    return $form;
  }

  /*
    @term_form

    @return array
  */
  public function term_form() {
    $form = array(
      'form'      => array(
        'action'    => '',

        'enctype'   => "multipart/form-data",

        'method'    => 'post',
        'token'     => true,
        '_method'   => '',
        'id'        => "term",
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),
      'elements'  => array(
        array(
          'type'  => 'text',
          'label' => 'name:',
          'id'    => 'name',
          'class' => 'input-xlarge',
          'name'  => 'name'
        ),
        array(
          'type'    => 'select',
          'label'   => 'vocabulary',
          'id'      => 'vid',
          'class'   => 'input-xlarge',
          'name'    => 'vid',
          'options' =>  $this->getHierarchyForVoc()
        ),
        array(
          'type'  => 'textarea',
          'label' => 'description:',
          'id'    => 'description',
          'class' => 'input-xlarge',
          'name'  => 'description'
        ),
        array(
          'type'  => 'text',
          'label' => 'weight:',
          'id'    => 'weight',
          'class' => 'input-xlarge',
          'name'  => 'weight'
        ),
        array(
          'type'  => 'submit',
          'id'    => 'sbm',
          'class' => 'btn btn-primary',
          'value' => 'Save'
        )
      )
    );
    return $form;
  }

  /*
    @vocabulary_load

    @param $vid   integer
    @param $name  string - optional
    @return array if fails return boolean(false)
  */
  public function vocabulary_load($vid,$name = '') {
    if($name == '') {
      $sql = "
        select

          *
          from
            vocabulary

        where
          vid = ?
      ";
      $params = array($vid);
    } else {
      $sql = "
        select

          *
          from
            vocabulary

        where
          name = ?
      ";
      $params = array($name);
    }

    $res = $this->select($sql,$params);

    if(gettype($res) == 'array' && count($res) > 0) {
      return (count($res) == 1 ? $res[0] : $res);
    } else {
      return false;
    }
  }

  /*
    @term_load  - loading a single term by term_data id

    @param $tid   integer
    @param $name  string - optional
    @return array
  */
  public function term_load($tid,$name = '') {
    $sql    = '';
    $params = array();
    if($name == '') {
      $sql = "
        select

          *
          from
            term_data

        where
          tid = ?
      ";
      $params = array($tid);
    } else {
      $sql = "
        select

          *
          from
            term_data

        where
          name = ?
      ";
      $params = array($name);
    }
    $res = $this->select($sql,$params);
    if(gettype($res) == 'array' && count($res) > 0) {
      return (count($res) == 1 ? $res[0] : $res);
    } else {
      return false;
    }
  }

  /*
    @terms_load - loading terms by vocabulary id

    @param $vid integer
    @return array
  */
  public function terms_load($vid) {
    $res = $this->select("
      select

        *
        from
          term_data

      where
        vid = ?
    ",array($vid));

    if(gettype($res) == 'array' && count($res) > 0) {
      return (count($res) == 1 ? $res[0] : $res);
    } else {
      return false;
    }
  }

  /*
    @vocabulary_add

    @param $arr array
    @return integer
  */
  public function vocabulary_add($arr) {
    $this->query("
      insert
        into
          vocabulary
        (name,description,hierarchy,required,weight)
          values
        (?,?,?,?,?)
    ",array(
        $arr['name'],
        $arr['description'],
        $arr['hierarchy'],
        ($arr['required'] == 'on' ? 1 : 0),
        ((int)$arr['weight'] > 0 ? $arr['weight'] : 0)
    ));
    return $this->db->lastInsertId();
  }

  /*
    @term_add

    @param $arr array
    @return integer
  */
  public function term_add($arr) {
    $res = $this->select("select count(*) as counter from term_data where name = ?;",array($arr['name']));
    if((int)$res[0]['counter'] == 0) {
      $this->query("
        insert
          into
            term_data
          (name,description,weight,vid)
            values
          (?,?,?,?)
      ",array(
        $arr['name'],
        $arr['description'],
        $arr['weight'],
        $arr['vid']
      ));
      return $this->db->lastInsertId();
    }
  }

  /*
    @add_term_node

    @param $nid integer
    @param $vid integer
    @param $tid integer
    @return boolean
  */
  public function add_term_node($nid = 0,$vid = 0,$tid = 0) {
    if((int)$nid != 0 && (int)$vid != 0 && (int)$tid != 0) {
      $res = $this->select("
        select
          count(*) as counter
            from
              term_node
        where
          nid = ?
        and
          vid = ?
        and
          tid = ?
      ",array((int)$nid,(int)$vid,(int)$tid));
      if($res[0]['counter'] < 1) {
        $this->query("
          insert
            into
              term_node
          (nid,vid,tid)
            values
          (?,?,?)
        ",array((int)$nid,(int)$vid,(int)$tid));
        return true;
      } else {
        return false;
      }
    }
  }

  /*
    @getHierarchyForVoc

    @return array
  */
  public function getHierarchyForVoc() {
    $result = array(1000 => 'Root');
    $res = $this->select(
      "select vid,name from vocabulary",
      array()
    );
    if(isset($res[0])) {
      foreach($res as $r) {
        $result[$r['vid']] = $r['name'];
      }
    }
    return $result;
  }
}
