<?php

class Main_helper extends View {
  
  public function init() {
    //print_r($this->scope->router->loader);

    $this->url = '/' . implode('/',$this->scope->router->orders);
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
      'Content-Language'          => 'hu-hu',
      'Copyright'                 => '',
      'author'                    => 'robThot'
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
    return  array(
      'Home'        => $this->scope->router->link('front'),
      'Rólunk'      => '',
      'Cégcsoport'  => '',
      'Termékek'    => '',
      'Iparágak'    => '',
      'active'      => $this->scope->router->link($this->scope->router->scope)
    );
  }

  public function happeningImages() {
    $arr    = array();
    $images = $this->scope->router->loader->get('Images','model');
    $res    = $images->get('',array("select * from images where gallery = 24;",array()));

    foreach($res as $image) {
      $arr[] = "/upload/{$image['gallery']}/{$image['name']}";
    }

    return $arr;
  }

  public function getSideBarItems() {  //print_r($this->scope->router->orders); die();
    return array(
      'Az Evolineról'         => '/cikkek/28',
      'Cégünk tevékenysége'   => '/cikkek/27',
      'Történetünk'           => '/cikkek/23',
      'Értékeink'             => '/cikkek/25',
      'A linepro cégcsoport'  => '/cikkek/24',
      'active'                => $this->scope->router->link('/cikkek/28') //$this->scope->router->link($this->url)
    );
  }

  public function getCfg() {
    $cfg = json_encode(array(
      'menubar'         => $this->getMenu(),
      'happeningImages' => $this->happeningImages(),
      'sidebar'         => ($this->scope->router->action == 'show' ? $this->getSideBarItems() : ''),
      'thisLocation'    => $this->scope->router->link($this->url)
    ));

    return "<input type='hidden' id='cfg' value='{$cfg}' />";
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
      'index' => 'main.js',
      'show'  => 'main_show.js'
    );

    $arr      = array('jquery.js','jquery.nivo.slider.js','builder.js','slidercfg.js',$main_js[$this->scope->router->action]);
    $scripts  = '';
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
}
