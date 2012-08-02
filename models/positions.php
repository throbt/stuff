<?php

class Positions_model extends Model {

	public function init() {
	  global $loader; global $stuff;
		$this->className  = $this->getClassName(get_class());
		$this->stuff      = $stuff;
		$this->loader     = $loader;
  }

  public function get($id='', $where = '', $variables = array()) {
    $where  = '';
    $vars   = array();
    if($id != '') {
      $where = " where p.id = ? ";
      $vars  = array($id);
    }

    $result = $this->select("
		  select

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
      {$where}
		  ",
		  $vars
	  );

    if(isset($result) && $result != null && gettype($result) == 'array') {
			if(count($result) > 0)
				return $result;
		} else {
			return false;
		}

  }

  public function getPosition($id='') {
    if($id != '') {
      $where = " where p.id = ? ";
      $vars  = array($id);

      $result = $this->select("
		    select

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
		    ",
		    $vars
	    );

      if(isset($result) && $result != null && gettype($result) == 'array') {
			  if(count($result) > 0)
				  return $result;
		  } else {
			  return false;
		  }
    }
  }

  public function getForm($vars = array()) {
    $action   = (isset($vars['action']) ? $vars['action'] : '');
    $form     = $this->loader->get('Form');
    $thisForm = array(
      'form'      => array(
        'action'    => "/{$action}",
        'enctype'   => "multipart/form-data",
        'method'    => 'post',
        'token'     => true,
        '_method'   => '',
        'id'        => "positions",
        'class'     => 'well form-horizontal',
        'template'  => 'default'
      ),

      'elements'  => array(

        array(
          'type'  => 'text',
          'label' => 'Megjelenés, tól:',
          'id'    => 'date_from',
          'class' => 'input-xlarge datep',
          'name'  => 'date_from',
          'value' => (isset($vars['date_from']) ? $vars['date_from'] : '')
        ),

        array(
          'type'  => 'text',
          'label' => 'Megjelenés, ig:',
          'id'    => 'date_to',
          'class' => 'input-xlarge datep',
          'name'  => 'date_to',
          'value' => (isset($vars['date_to']) ? $vars['date_to'] : '')
        ),

        array(
          'type'  => 'text',
          'label' => 'title',
          'id'    => 'title',
          'class' => 'input-xlarge',
          'name'  => 'title',
          'value' => (isset($vars['title']) ? $vars['title'] : '')
        ),

        array(
          'type'  => 'text',
          'label' => 'position',
          'id'    => 'position',
          'class' => 'input-xlarge',
          'name'  => 'position',
          'value' => (isset($vars['position']) ? $vars['position'] : '')
        ),

        array(
          'type'    => 'select',
          'label'   => 'location',
          'id'      => 'location',
          'class'   => 'input-xlarge',
          'name'    => 'location',
          'options' =>  $this->getSelectOptions('location'),
          'value' => (isset($vars['location']) ? $vars['location'] : '')
        ),

        array(
          'type'  => 'textarea',
          'label' => 'description',
          'id'    => 'description',
          'class' => 'input-xlarge',
          'name'  => 'description',
          'value' => (isset($vars['description']) ? $vars['description'] : '')
        ),

        array(
          'type'    => 'select',
          'label'   => 'type',
          'id'      => 'type',
          'class'   => 'input-xlarge',
          'name'    => 'type',
          'options' =>  $this->getSelectOptions('type'),
          'value' => (isset($vars['location']) ? $vars['type'] : '')
        ),

        array(
          'type'  => 'textarea',
          'label' => 'commitment',
          'id'    => 'commitment',
          'class' => 'input-xlarge',
          'name'  => 'commitment',
          'value' => (isset($vars['commitment']) ? $vars['commitment'] : '')
        ),

        array(
          'type'  => 'textarea',
          'label' => 'expectations',
          'id'    => 'expectations',
          'class' => 'input-xlarge',
          'name'  => 'expectations',
          'value' => (isset($vars['expectations']) ? $vars['expectations'] : '')
        ),

        array(
          'type'  => 'submit',
          'id'    => 'sbm',
          'class' => 'btn btn-primary',
          'value' => 'Save'
        )

      )
    );

    if(isset($vars['id'])) {
      $thisForm['elements'][] = array(
        'type'  => 'hidden',
        'name'  => 'id',
        'value' => $vars['id']
      );
    }

    return $form->render($thisForm);
  }

  public function getSelectOptions($type = '') {
    //$result = array('0' => 'Choose');
    if($type != '') {
      $res = $this->select("
		    select
			    *
		    from
			    position_{$type}
		    ",
		    array()
	    );
    }
    if(count($res) > 0) {
      foreach($res as $r) {
        $result["{$r['id']}"] = $r[$type];
      }
    }
    return $result;
  }

  public function getLocations() {
    $res = $this->select("select * from position_location order by location asc",array());
    return $res;
  }

  public function getTypes() {
    $res = $this->select("select * from position_type order by type asc",array());
    return $res;
  }

  public function setActive($id = '',$active = '') {
    if($id != '' && $active != '') {
      $this->update(
        $id,
        array(
        'active'        => ($active == 'true' ? 1 : 0)
      ));
    }
  }

	public function codeIt($arr) {
		$res 		= array();
		$ar 		= array();
		foreach($arr as $thisArr) {
			$ar = array();
			foreach($thisArr as $k => $val) {
				$ar[$k] = urlencode($this->stuff->textCutter($val,300));
			}
			$res[] = $ar;
		}
		return $res;
	}

	public function codeItForContent($arr) {
		$res 		= array();
		$ar 		= array();
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
