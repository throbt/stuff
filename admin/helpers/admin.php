<?php

class Admin_helper extends View {

  public function init() {
  }

  public function getTitle($title) {
    return "<title>{$title}</title>";
  }

  public function getHeader() {
    return implode("\n",array(
      $this->getTitle($this->scope->title),
      $this->getStyle(),
      $this->getScript(),
      $this->getSEO()
    ));
  }

  public function getSEO() {
    $metas  = '';
    $names = array(
      'format-detection'  => 'telephone=no',
      'viewport'          => 'width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1',
      'apple-mobile-web-app-capable' => 'yes',
      'apple-mobile-web-app-status-bar-style' => 'black'
    );
    $httpequivs = array(
      'Content-type'      => 'text/html; charset=utf-8',
      'X-UA-Compatible'   => 'IE=edge,chrome=1',
      'Copyright'         => 'iForm',
      'author'            => 'thRobt'
    );
    
    foreach($httpequivs as $key => $value) {
        $metas .= implode('',array(
          "<meta http-equiv='",
          $key,
          "' content='",
          $value,
          "' />\n"
        ));
    }
    foreach($names as $key => $value) {
        $metas .= implode('',array(
          "<meta name='",
          $key,
          "' content='",
          $value,
          "' />\n"
        ));
    }
    return $metas;
  }

  public function getMenu() {
    $menuItems = array(

      array(
        'hu'  => 'System',
        'url' => $this->scope->router->link('admin'),
        'sub' => array(
          array(
            'hu'  => 'Site params',
            'url' => $this->scope->router->link('admin/system'),
          ),
          array(
            'hu'  => 'Modules',
            'url' => $this->scope->router->link('admin/modules'),
          ),
          array(
            'hu'  => 'Vocabularies',
            'url' => $this->scope->router->link('admin/Vocabulary'),
          ),
          array(
            'hu'  => 'Vocabularies Terms',
            'url' => $this->scope->router->link('admin/term'),
          ),
          array(
            'hu'  => 'Node',
            'url' => $this->scope->router->link('admin/node'),
          )
        )
      )/*,

      array(
        'hu'  => 'Test',
        'url' => $this->scope->router->link('admin/test'),
      )*/
    );
    return $this->renderTemplate($menuItems,$this->getTemplatePath('admin','menu'));
  }

  public function getScript() {
    $arr = array(
      LIB                 . 'jquery-1.8.2.min.js',
      JQUERY_UI_BOOTSTRAP . 'js/jquery-ui-1.8.16.custom.min.js',
      BOOTSTRAP           . 'js/bootstrap.js',
      TINY_MCE            . 'tiny_mce.js',
      TINY_MCE            . 'tiny_mce_cfg.js',
      MNVC                . 'DomBuilder.js',
      MNVC                . 'NodeType.js',
    );
    $scripts  = '';
    foreach($arr as $scriptName) {
      $scripts .= implode('',array(
        "<script src='",
        $scriptName,
        "' type='text/javascript'></script>\n"
      ));
    }
    return $scripts;
  }

  public function getStyle() {
    $arr = array(
      'http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&subset=latin,latin-ext',
      'http://fonts.googleapis.com/css?family=Fenix|Source+Code+Pro|Archivo+Black',
      'http://fonts.googleapis.com/css?family=Archivo+Black',
      BOOTSTRAP . 'css/bootstrap-responsive.css',
      BOOTSTRAP . 'css/bootstrap.css',
      JQUERY_UI_BOOTSTRAP . 'css/custom-theme/jquery-ui-1.8.16.custom.css',
      JQUERY_UI_BOOTSTRAP . 'css/custom-theme/jquery.ui.1.8.16.ie.css',
      '/css/admin.css'
    );
    $styles   = '';
    foreach($arr as $scriptName) {
      $styles .= implode('',array(
        "<link rel='stylesheet' type='text/css' href='",
        $scriptName,
        "' />\n"
      ));
    }
    return $styles;
  }
}
