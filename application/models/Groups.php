<?php

class Application_Model_Groups extends Zend_Db_Table_Abstract {
  
  /**
   * Virtual table
   * Tables: members, multi, multigroup, groups, user
   * elements grouped by the multi table(if it has no join, called name is 'egyeb csoportok')
   */
  
  protected $_name = 'groups';

  public function getGroup($id){
    $id   = (int)$id;
    $row  = $this->fetchRow('id = ' . $id);
    if (!$row) {
        throw new Exception("Could not find row $id");
    }
    return $row->toArray();
  }
    
  public function getAll($sessionUser){
    
    $resultSet  = array();
    $multiids   = array();
    $multis     = array() ;
    $uid        = $sessionUser->profile["id"];
   
    $gRes = $this->_db->query("
      select id,if(length(name)>0,name,title) realname from multi where index_grouping='yes' order by realname;
    ")->fetchAll();
   
    foreach($gRes as $r) {
      $multiids[] = $r['id'];
      $multis[$r['id']] = $r['realname'];
    }
   
    $thisIds = implode(",",$multiids);
   
    $result = $this->_db->query("
      select
        if(length(g.name)>0,g.name,g.title) realname,
        m.membership as membership,
        m.group_id,
        g.title,
        mg.multiid,
        'single' as grouptype
      from
        members m,
        groups g
      left join
          multigroup mg on g.id=mg.groupid
        and
          mg.multiid in ({$thisIds})
          
      where
        g.id=m.group_id
      and
        m.user_id = ?
      
      union all
      
      select
        if(length(g.name)>0,g.name,g.title) realname,
        m.membership as membership,
        m.group_id,
        g.title,
        'multis' as multiid,
        'multi' as grouptype
      from
        multi_members m,multi g
      where
        g.id=m.group_id
      and
        m.user_id = ?
      and
        m.membership='affiliate'
      order by realname
    ",
      array($uid,$uid)
    )->fetchAll();
    
    for($i = 0;$i < count($result); $i++) {
      $resultSet[$i] = $result[$i];
      if($result[$i]['multiid'] != null)
        $resultSet[$i]['group'] = $multis[$result[$i]['multiid']];
      else
        $resultSet[$i]['group'] = 'Egyéb csoport';
    }
   
    return $resultSet;
  }
  
}