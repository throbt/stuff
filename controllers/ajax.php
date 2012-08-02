<?php

class Ajax_controller extends Controller {

  public function init() {
    $this->sys = $this->router->sys;
  }

  public function getDrinksByCat() {

    $this->model = $this->router->loader->get('Drinks','model');

    $result = array();
    $res    = $this->model->get(
      '',
      array(
        "
        select
          *
            from
              drinks

        where
          categories = ?
        and
            title != 'index_action'
        ",
        array($this->get['cat'])
      )
    );

    foreach ($res as $r) {
      $result[$r['type']][] = $r;
    }

    echo json_encode($result);

    die();
  }

  public function getImagesByGallery() {
    $images = $this->router->loader->get('Images','model');
    echo json_encode($images->get(
      '',
      array(
        "
          select
            m.*,
            g.title as thisGallery
              from
                images m
            left join
                galleries g
            on
              m.gallery = g.id
            where
              g.title != 'index_action'
            and
              m.gallery = ?
          ",
        array($this->get['gallery'])
      )
    ));
    die();
  }

  public function getPositions() {

    $where      = '';
    $variables  = array();
    $loc        = urldecode($this->get['loc']);
    $type       = urldecode($this->get['type']);

    if($this->get['loc'] != '') {
      $where = " where l.location like ? ";
      $variables[] = "%{$loc}%";
    }
    if($this->get['type'] != '') {
      if(preg_match('/where/',$where)) {
        $where .= " and t.type like ? ";
      } else {
        $where = " where t.type like ? ";
      }
      $variables[] = "%{$type}%";
    }

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

      {$where}

      order by
        p.edited desc, p.created desc",

      "
      select

        count(*) as counter

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

      {$where} ",

      $variables,

      $this->sys->positions_items,

      (isset($this->get['page']) ? $this->get['page'] : 1)
    );

    /*
      linx
    */
    if(isset($result['result'])) {
      foreach($result['result'] as $k => $r) {
        $result['result'][$k]['link'] = $this->router->link("positions/{$r['id']}");
      }
    }

    echo json_encode(array(
      'positions'   => (count($result['result']) > 0 ? $this->codeItForPositions($result['result']) : 0),
      'all'         => $result['all'],
      'currentPage' => (isset($this->get['page']) ? $this->get['page'] : 1)
    ));
  }

  public function codeItForPositions($arr) {
    $res    = array();
    $ar     = array();
    foreach($arr as $thisArr) {

      $ar['position']  =  urlencode($thisArr['position']);
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
}
