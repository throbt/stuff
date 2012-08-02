<?php

class Rcis_controller extends Controller {

  public function init() {
    $this->path = '/home/vvv/sites/rcis/';
    $this->log  = "{$this->path}log.txt";
    $this->io   = $this->router->loader->get('Io');
  }

  public function index() {
    foreach ($this->io->fileGetContentLines($this->log) as $line) {
      echo "<p><pre>{$line}</pre></p>";
    }
  }
}
