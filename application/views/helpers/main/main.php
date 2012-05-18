<?php

class Main_helper extends View {
  
  public function init() {
    //print_r($this->scope->router->loader);
  }

  public function getSiderImages() {
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

  public function getFacebookCode() {
    return '

            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/hu_HU/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, \'script\', \'facebook-jssdk\'));</script>
            <div id="facebook_wrapper">
              <div class="fb-like-box" data-href="http://www.facebook.com/pages/Manna-%C3%89tterem/176210038779" data-width="294" data-height="390" data-colorscheme="dark" data-show-faces="true" data-border-color="#333333" data-stream="false" data-header="false"></div>
            </div>
    ';
  }

  public function getCalendar() {
    return $this->renderTemplate('',$this->getTemplatePath('page','calendar'));
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
            type = "menu"
          order
            by
              "order";
        ',
        array()
      )
    );
    return $this->renderTemplate($menuItems,$this->getTemplatePath('page','menu'));
  }

  public function getSider() {
  	return implode("\n",array(
      $this->getFacebookCode(),
      $this->getCalendar()
    ));
  }

  public function getFooter() {
  	return $this->renderTemplate('',$this->getTemplatePath('page','footer'));
  }

  public function getScript() {
    $arr      = array('jquery.js','main.js'/*,'calendar.js'*/ ,'jquery.nivo.slider.pack.js');
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
    $arr      = array('nivo-slider.css', /*'bootstrap.css',*/ 'style.css','default.css');
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