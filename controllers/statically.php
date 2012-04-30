<?php

class Statically extends Controller {

  public function init() {
    echo $this->router->renderTemplate($this->router->urlParts[0],$this->router->urlParts[0]);
  }
}
