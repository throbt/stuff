<?php

class Admin_helper extends View {
  
  public function init() {
    //print_r($this->scope->router);
  }

  public function getTitle($title) {
    return "<title>{$title}</title>";
  }

  public function getHeader() {
    return implode("\n",array(
      $this->getTitle($this->scope->title),
      $this->getStyle(),
      $this->getScript()
    ));
  }

  public function getMenu() {
    $menuModel = $this->scope->router->loader->get('Menu','model');
    $menuItems = $menuModel->get(
      '',
      array(
        '
          select
            *
            from
              langelements
          where
            type = "adminmenu"
          order
            by
              "order";
        ',
        array()
      )
    );
    return $this->renderTemplate($menuItems,$this->getTemplatePath('admin','menu'));
  }

  public function getScript() {
    $arr      = array('jquery.js','jquery-ui-1.8.20.custom.min.js' /*,'main.js','calendar.js'*/ /*,'bootstrap-dropdown.js'*/,'bootstrap-datepicker.js','main.js');
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
    $arr      = array('bootstrap.css','bootstrap-responsive.css','datepicker.css','admin.css','jquery.window.css');
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
