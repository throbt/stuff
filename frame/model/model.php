<?php

class Model {

  function __construct() {
		global $stuff;
		global $config;
		$this->stuff 	= $stuff;

    if(!include_once("db/{$config->cfg['db.adapter']}.php")) {
      throw new Exception("the db adapter is missisng: {$config->cfg['db.adapter']}");
      die();
    }

    $this->db = getPDO::get();
    $this->db->query("set names 'utf8'");
		$this->init();
  }

	public function init() {
  }

  /*
    @method select
    
    $param $query string
    $param $params array
    @return array
  */
	public function select($query,$params = array()) {
    $sth = $this->db->prepare($query);
    if(gettype($params) == 'array') {
      foreach($params as $index => $param) {
        $sth->bindValue(($index+1),$param);
      }
    } else if(gettype($params) == 'object'){
      foreach($params as $index => $param) {
        $sth->bindValue(":{$index}",$param);
      }
    }
    $sth->execute();

    // if(/*isset($this->debug) && $this->debug == true*/ 1 == 1) {
    // 	echo $query . "<br />\n";
    // 	print_r($params);
    // 	print_r($sth->errorinfo()); //die();
    // }

    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  /*
    @method query
    
    $param $query string
    $param $params array
    @return no return
  */
  public function query($query,$params = array()) {
    $sth = $this->db->prepare($query);
    foreach($params as $index => $param) {
      $sth->bindValue(($index+1), $param);
    }
    $sth->execute();

    // if(/*isset($this->debug) && $this->debug == true*/ 1 == 1) {
    // 	echo $query . "<br />\n";
    // 	print_r($params);
    // 	print_r($sth->errorinfo()); //die();
    // }
  }

  /*
    @method getClassName
    
    @param $className string
    @return string
  */
	public function getClassName($className) {
		if(preg_match('/_model/',$className)) {
			preg_match('/[^_]*/',$className,$matches);
			return strtolower($matches[0]);
		} else {
			return strtolower($className);
		}
	}

	/*
		@method get 

		@param $id integer
		@param $query array (string,array)
    @return array or boolean(false)
	*/
	public function get($id='',$query='') {
		if(gettype($query) == 'array' && $id == '') {
			$result = $this->select(
				$query[0],$query[1]
			);
		} else if((int)$id > 0) {
			$result = $this->select("
				select
					*
					from
						{$this->className}
					where
						id = ?;
				",
				array($id)
	    );
		}	/*
				getAll
			*/
			else if($id == '' && $query == '') {
			$result = $this->select("
				select
					*
					from
						{$this->className};
				",
				array()
	    );
		}

		if(isset($result) && $result != null && gettype($result) == 'array') {
			if(count($result) > 0)
				return $result;
		} else {
			return false;
		}
  }

	/*
		@method create

		@param $column array (hash)
		@param $query array (string,array)
    @return array or boolean(false)
	*/
	public function create($columns='',$query='') {
  	if(gettype($query) == 'array' && $columns == '') {
			$this->query(
				$query[0],$query[1]
			);
		} else if(gettype($columns) == 'array') {
			$keys 	= implode(',',array_keys($columns));
			$arr 		= array();
			$values = array();
			foreach($columns as $key => $column) {
				if($column == 'now()' || $column == 'NOW()') {
					$arr[] 		= $column;
				} else {
					$arr[] 		= '?';
					$values[] = "{$column}";
				}
			}
			$vals 	= implode(',',$arr);
			$this->query("
					insert
						into
							{$this->className}
					({$keys})
						values({$vals});
				",
				$values
			);
		}
  }

	/*
    @method update

    @param $id integer
    @param $column array
    @param $query array (string,array)
    @return no return
  */
	public function update($id='',$columns='',$query='') {
  	if(gettype($query) == 'array' && $columns == '' && $id == '') {
			$this->query(
				$query[0],$query[1]
			);
		} else if((int)$id > 0 && gettype($columns) == 'array' && $query == '') {

			$values 		= array();
			$expr 			= '';

			foreach(array_keys($columns) as $key) {
				if($columns[$key] == 'now()' || $columns[$key] == 'NOW()') {
					$expr 			.= " {$key} = {$columns[$key]}, ";
				} else {
					$expr 			.= " {$key} = ?, ";
					$values[] 	 = "{$columns[$key]}";
				}
			}

			$expr = substr($expr,0,strlen($expr)-2);

			$this->query("
					update
						{$this->className}
					set
						{$expr}
					where
						id = {$id};
				",
				$values
			);
		}
  }

	/*
    @method delete

    @param $id integer
    @param $query array (string,array)
    @return no return
  */
	public function delete($id='',$query='') {
  	if(gettype($query) == 'array' && $id == '') {
			$this->query(
				$query[0],$query[1]
			);
		} else if((int)$id > 0) {
			$this->query("
				delete
					from
						{$this->className}
				where
					id = ?;
				",
				array($id)
			);
		}
  }

  /*
    @method getAll

    @param $queryAll string
    @param $queryCount string
    @param $params array
    @param $pagePerItem integer
    @param $page integer
    @return array or boolean(false)
  */
  public function getAll($queryAll,$queryCount,$params=array(),$pager,$page) {
  	$currentPage  = $page;
    $pagePerItem  = $pager;
    $queryArr[0]  = $queryCount;
    $queryArr[1] = $params;

    $paginator = $this->paginator($queryArr,$pagePerItem,$currentPage);

    $res = $this->select(
        "{$queryAll}"
        /*(preg_match('/where/',$queryAll) ? '' : (preg_match('/order/',$queryAll) ? '' : ' where '))*/
        ."{$paginator['limit']};",
        $params
    );

    if(gettype($res) == 'array' && count($res) > 0) {
      return array(
        'result'  => $res,
        'all'     => $paginator['allPages'],
        'current' => $currentPage
      );
    } else {
      return false;
    }
  }

  /*
    @method paginator

    @param $queryArr    array
    @param $pagePerItem integer
    @param $currentPage integer
    @return             array
  */
  public function paginator($queryArr = array(), $pagePerItem,$pager) {
    $res = $this->select(
      $queryArr[0],
      $queryArr[1]
    );
    $all      = (isset($res[0]['counter']) ? $res[0]['counter'] : 0);
    $allPages = ceil((int)$all/(int)$pagePerItem);

    if($pager <= 0 || $pager > $allPages) {
    	$currentPage = 1;
    } else {
    	$currentPage = $pager
    	;
    }

    $from     = $currentPage != 0 ? ($currentPage == 1 ? 0 : ((int)$currentPage - 1)*(int)$pagePerItem) : 0;
    $count    = (int)$pagePerItem;
    $limit    = " limit {$from},{$count} ";
    return array(
      'allPages'  => $allPages,
      'limit'     => $limit
    );
  }
}
