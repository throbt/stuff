<?php

class Application_Model_Lang extends Zend_Db_Table_Abstract {

    public function getData($params) {
      
      $items        = array();
      $res          = $this->_db->query("select id from lang_groups where flag = ?", array((isset($params["lang"]) ? $params["lang"] : 'en')))->fetchAll();
      $langid       = $res[0]['id'];
      $defLangid    = 1;
      $cat          = (isset($params["cat"])  ? $params["cat"]    : '1');
      $page         = (isset($params["page"]) ? $params["page"]   : '1');
      $itemCount    = (isset($params["limit"])? $params["limit"]  : '5');
      
      $vars = $this->_db->query("
        select
          lv.id     as id,
          lv.var    as variable,
          lc.var    as category
        from
          lang_variables lv
        left join
          lang_cat lc
            on lv.cat_id = lc.id
        where cat_id = ?;
        ",
        array($cat)
      )->fetchAll();
      
      foreach($vars as $i => $v) {
        $r = $this->_db->query("
          select
            value
          from
            lang_values
          where
            group_id = ?
          and
            var_id = ?;
          ",
          array($defLangid,$v['id'])
        )->fetchAll();   
        $vars[$i]['word'] = (isset($r[0]) ? $r[0]['value'] : "");
      }
      
      /*$result = $this->_db->query("
        select
          l_var.id     as id,
          l_var.var    as variable,
          l_cat.var    as category,
          l_val.value  as word
        from
          lang_variables l_var
          
        join
          lang_values l_val
        on
          l_var.id = l_val.var_id
          
        join
          lang_cat l_cat
        on
          l_cat.id = l_var.cat_id
          
        where
          l_var.cat_id = ?
        and
          l_val.group_id = ?
        order by
          l_var.id
            asc
        ",
        array($cat,$defLangid)
      )->fetchAll();*/
      
      $paginator = Zend_Paginator::factory($vars);
      $paginator->setItemCountPerPage($itemCount);
      $paginator->setCurrentPageNumber($page);
     
      foreach ($paginator as $item) {
        
        $res = $this->_db->query("
          select value from lang_values where var_id = {$item['id']} and group_id = {$langid};
        ")->fetchAll();
        

        
        $item["foreign_word"] = (isset($res[0]) ? $res[0]['value'] : "");
        $items[]              = $item;
        
      }
      
      return array(
        'success' => true,
        'results' => $paginator->getTotalItemCount(),
        'rows'    => $items
      );
      
    }
    
    public function getGroups() {
      $res = array();  
      $result = $this->_db->query("
        select * from lang_groups; 
      ")->fetchAll();
      foreach($result as $r) {
        $res[] = array(
          'lang'    => $r['val'],
          'langval' => "{$r['flag']}"
        );
      }
      
      return array(
        'success' => true,
        'rows'    => $res
      );
    }
    
    public function getCats() {
      $res = array();  
      $result = $this->_db->query("
        select * from lang_cat; 
      ")->fetchAll();
      foreach($result as $r) {
        $res[] = array(
          'cat'    => $r['var'],
          'catval' => "{$r['id']}"
        );
      }
      
      return array(
        'success' => true,
        'rows'    => $res
      );
    }
    
    public function updateRow($params) {
      $result   = $this->_db->query("
        select id from lang_groups where flag = '{$params['lang']}'; 
      ")->fetchAll();
      $lang_id  = $result[0]['id'];
      $result   = $this->_db->query("
        select count(id) as c from lang_values where var_id = {$params['id']} and group_id = {$lang_id}; 
      ")->fetchAll();
      
      if($result[0]['c'] > 0)
        $sql = "update lang_values set value = '{$params['val']}' where var_id = {$params['id']} and group_id = {$lang_id}";
      else
        $sql = "insert into lang_values(var_id,group_id,value) values({$params['id']},{$lang_id},'{$params['val']}');";
      
      $res      = $this->_db->query($sql);
      return ($res != null ? 'success' : -1);
    }
    
    public function deleteCategory($id) {
      $this->_db->query("
        delete from lang_cat where id = ?;
      ",
      array($id)
      );
    }
    
    public function addCategory($cat) {
      $this->_db->query("
        insert into lang_cat(var) values(?);
      ",
      array($cat)
      );
    }
    
    public function addLanguage($lang) {
      $flag = substr($lang, 0, 2);
      $this->_db->query("
        insert into lang_groups(val,flag) values(?,?);
      ",
      array($lang,$flag)
      );
    }
    
    public function deleteLanguage($id) {
      $this->_db->query("
        delete from lang_groups where id = ?;
      ",
      array($id)
      );
    }
    
    public function getVariables($cat) {
      $res = array();  
      $result = $this->_db->query("
        select * from lang_variables where cat_id = {$cat};
      ")->fetchAll();
      foreach($result as $r) {
        $res[] = array(
          'var'    => $r['var'],
          'varval' => "{$r['id']}"
        );
      }
      
      return array(
        'success' => true,
        'rows'    => $res
      );
    }
    
    public function addVariable($params) {
      $res = $this->_db->query("
        insert into lang_variables(cat_id,var) values(?,?);
      ",
      array($params['cat'],$params['var'])
      );
      if($res != null) {
        $lastInsertId = $this->_db->lastInsertId();
        $res = $this->_db->query("
            insert into lang_values(var_id,group_id,value) values(?,1,?);
          ",
          array($lastInsertId,$params['expr'])
        );
      }
      return ($res != null ? 'success' : -1);
    }
    
    public function delVariable($id) {
      $this->_db->query("
        delete from lang_variables where id = ?;
      ",
      array($id)
      );
      $this->_db->query("
        delete from lang_values where var_id = ?;
      ",
      array($id)
      );
    }
    
    public function getLanguageItems($lang_cat,$lang) {
      $res    = array();  
      $result = $this->_db->query("
        select
        
          lval.value as value,
          lvar.var as variable
          
        from
          lang_values lval
        left join
          lang_variables lvar on lval.var_id = lvar.id
        left join
          lang_groups lgroup on lgroup.id = lval.group_id
        left join
          lang_cat lcat on lcat.id = lvar.cat_id
          
        where
          lcat.id = ?
        and
          lgroup.flag = ?;
        ",
        array($lang_cat,$lang)
      )->fetchAll();
      
      foreach($result as $r) {
        $res[$r['variable']] = $r['value'];
      }
      return $res;
    }
}

