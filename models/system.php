<?php

class System_model extends Model {

  public function init() {
    global $loader;

    $this->stuff    = $loader->get('Stuff');
    $this->cfg_file = CONFIG.'system.cfg';
  }

  public function writecfg($cfg) {
    $thisJson = $this->stuff->sesc(json_encode($cfg));
    file_put_contents($this->cfg_file, "<?php \$sys='".$thisJson."'; ?>");
  }

  public function readcfg() {
    preg_match('/(\=)(.*)(;)/',file_get_contents($this->cfg_file),$matches);
    return $matches[2];
  }

  public function getCfg() {
    return json_decode($this->readcfg());
  }
}
