<?php

class Taxonomy_module extends Module {

  public function init() {
    global $loader;
    $this->loader = $loader;
  }

  public function node_load($node) {
    $taxonomy   = $this->loader->get('Taxonomy');
    $nodeModel  = $this->loader->get('node');
    $node_type  = $nodeModel->node_type($node['type']);
    $cfg        = json_decode($node_type['cfg']);

    $node['taxonomy'] = array();

    foreach($cfg as $item) {
      if($item->type == 'select') {
        //echo $node[$item->name] . "<br />";
        switch($item->group) {
          case 'vocabulary':
            $res = $taxonomy->select("
              select

                td.*

                  from
                    vocabulary v
                  left join
                    term_data td
                      on v.vid = td.vid
              where
                v.name = ?
            ",array($item->vocabulary));

            $options = array();
            foreach($res as $term) {
              $options[$term['tid']] = $term['name'];
            }
            $node['taxonomy'][$item->name]['vocabulary']['options'] = $options;
          break;
          case 'term':

            $term   = $taxonomy->term_load('',$item->term);
            $terms  = $nodeModel->nodes_load_by_term($term['tid']);

            if($terms) {
              $options = array();
              foreach($terms as $nod) {
                $options[$nod['id']] = $nod['title'];
              }
              $node['taxonomy'][$item->name]['term']['options'] = $options;
            }
          break;
        }
      }
    }
    return $node;
  }

  public function node_save($id,$post) {
    $model      = $this->loader->get('node');
    $taxonomy   = $this->loader->get('taxonomy');
    $node_type  = $model->node_type($post['type']);
    $cfg        = json_decode($node_type['cfg']);
    foreach($cfg as $c) {

      if(isset($c->type)) {
        if($c->type == 'select') {
          switch($c->group) {
            case 'vocabulary':
              $voc = $taxonomy->vocabulary_load('',$c->vocabulary);
              $vid = $voc['vid'];
              $tid = $post[$c->name];
              $taxonomy->add_term_node((int)$id,(int)$vid,(int)$tid);
            break;
            case 'term':
              $voc  = $taxonomy->vocabulary_load('',$c->vocabulary);
              $term = $taxonomy->term_load('',$c->term); //print_r($post);
              $vid  = $voc['vid'];
              $tid  = $term['tid'];
            break;
          }
        }
      }
    }
  }

  public function node_view($node) {

    if(isset($node['form']['form'])) {
      $thisForm   = $node['form'];
    } else {
      $nodeModel  = $this->loader->get('node');
      $thisForm   = $nodeModel->node_form($node['type']);
    }

    foreach($thisForm['elements'] as $k => $el) {
      if(isset($el['name'])) {
        if(isset($node[$el['name']])) {
          if($el['type'] == 'select') {
            if(isset($el['group'])) {
              switch($el['group']) {
                case 'term':
                  if(isset($node['taxonomy'][$el['name']]['term']['options']))
                    $thisForm['elements'][$k]['options'] = $node['taxonomy'][$el['name']]['term']['options'];
                break;
                case 'vocabulary':
                  if(isset($node['taxonomy'][$el['name']]['vocabulary']['options']))
                    $thisForm['elements'][$k]['options'] = $node['taxonomy'][$el['name']]['vocabulary']['options'];
                break;
              }
            }
          }
          $thisForm['elements'][$k]['value'] =  $node[$el['name']];
        }
      }
    }
    array_unshift($thisForm['elements'],array(
      'type'  => 'hidden',
      'name'  => 'id',
      'value' => $node['nid']
    ));
    $node['form'] = $thisForm;
    return $node;
  }

  public function node_delete($node) {
    $model = $this->loader->get('node');
    $model->query("
      delete from term_node where nid = ?
    ",array($node['id']));
    return $node;
  }

  public function node_new($node) {

  }

  public function node_form($form) {
    $Taxonomy = $this->loader->get('Taxonomy');
    foreach($form['elements'] as $k => $el) {
      if($el['type'] == 'select') {
        switch($el['group']) {
          case 'vocabulary':
            $res = $Taxonomy->select("
              select

                td.*

                  from
                    vocabulary v
                  left join
                    term_data td
                      on v.vid = td.vid
              where
                v.name = ?
            ",array($el['vocabulary']));

            $options = array();
            foreach($res as $term) {
              $options[$term['tid']] = $term['name'];
            }
            $form['elements'][$k]['options'] = $options;
          break;
          case 'term':
            $res = $Taxonomy->select("
              select

                tn.nid,
                td.vid,
                td.name,
                td.tid

                  from
                    term_data td
                  left join
                    term_node tn
                      on td.tid = tn.tid
              where
                td.name = ?
            ",array($el['term']));

            $options = array();
            foreach($res as $term) {
              $options[$term['tid']] = $term['name'];
            }
            $form['elements'][$k]['options'] = $options;
          break;
        }
      }
    }
    return $form;
  }

  public function title() {
    return 'taxonomy';
  }

  public function description() {
    return 'taxonomy description';
  }

  public function name_space() {
    return 'taxonomy';
  }
}