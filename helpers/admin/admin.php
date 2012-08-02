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
    // $menuModel = $this->scope->router->loader->get('Menu','model');
    // $menuItems = $menuModel->get(
    //   '',
    //   array(
    //     '
    //       select

    //         *
    //         from
    //           langelements

    //       where
    //         type = "adminmenu"

    //       order
    //         by `order`;
    //     ',
    //     array()
    //   )
    // );

		//print_r($this->scope->router);

    $menuItems = array(

      array(
        'hu'  => 'Tartalom',
        'url' => $this->scope->router->link('admin_content'),
        'sub' => array(
          array(
            'hu'  => 'Új tartalom típus',
            'url' => $this->scope->router->link('node/newtype'),
          ),
          array(
            'hu'  => 'Tartalom szerkesztése',
            'url' => $this->scope->router->link('node/types'),
          ),
          array(
            'hu'  => 'Főoldali tartalom szerkesztése',
            'url' => $this->scope->router->link('node/nodetype/home'),
          )
        )
      ),
			array(
				'hu'  => 'Effectek',
				'url' => $this->scope->router->link('admin_slider_setup')
			),
			array(
	      'hu'  => 'SEO',
	      'url' => $this->scope->router->link('admin_speaking_url')
	   	),
			array(
		    'hu'  => 'Nyelvek',
		    'url' => $this->scope->router->link('admin_language')
		  ),
			array(
			  'hu'  => 'Menü',
			  'url' => $this->scope->router->link('node/nodetype/menu')
			),
			array(
			  'hu'  => 'Galériák',
			  'url' => $this->scope->router->link('node/nodetype/gallery')
			),
			array(
			  'hu'  => 'Sidebar',
			  'url' => $this->scope->router->link('node/nodetype/sidebar')
			),
			array(
			  'hu'  => 'Álláshirdetések',
			  'url' => $this->scope->router->link('admin_positions')
			),array(
				'hu'  => 'System',
				'url' => $this->scope->router->link('admin_system')
			)
    );

    return $this->renderTemplate($menuItems,$this->getTemplatePath('admin','menu'));
  }

  public function getScript() {
    $arr      = array('jquery.js','jquery-ui-1.8.20.custom.min.js','bootstrap-datepicker.js','bootstrap-dropdown.js','tiny_mce_cfg.js','admin_main.js');
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
    $arr      = array('bootstrap.css','bootstrap-responsive.css','datepicker.css','admin.css'/*,'jquery.window.css'*/);
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
