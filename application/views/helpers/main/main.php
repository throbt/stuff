<?php

class Main_helper extends View {
  
  public function init() {

  }

  public function getSEO() {
    $arr    = array(
      'MSSmartTagsPreventParsing' => 'true',
      'ROBOTS'                    => 'ALL',
      'Copyright'                 => ''
    );
    $metas  = '';
    foreach($arr as $key => $value) {
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

  public function getTitle($title) {
    return "<title>{$title}</title>";
  }

  public function getHeader() {
  	return implode("\n",array(
      $this->getTitle($this->scope->title),
      $this->getSEO(),
      $this->getStyle(),
      $this->getScript()
    ));
  }

  public function getSider() {
  	
  }

  public function getFooter() {
  	
  }

  public function getScript() {
    $arr      = array('jquery.js','main.js');
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
    $arr      = array('style.css');
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