<?php

class Slider_model extends Model {
  
  public function init() {
    //$this->className = strtolower($this->getClassName(get_class()));
    $this->cfg_file = JS.'slidercfg.js';
  }

  public function getEffects() {
    return array(
      'sliceDownRight','sliceDownLeft','sliceUpRight','sliceUpLeft','sliceUpDown','sliceUpDownLeft','fold','fade',
      'boxRandom','boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse'
    );
  }

  public function getBoxCols() {
    return array(
      1,2,3,4,5,6,7,8,9,10,11,12
    );
  }

  public function getBoxRows() {
    return array(
      1,2,3,4,5
    );
  }

  public function getSlices() {
    return array(
      1,2,3,4,5,6,7,8,9,10,11,12
    );
  }

  public function writecfg($cfg) {
    $thisJson = json_encode($cfg);
    file_put_contents($this->cfg_file, "var sliderCfg = {$thisJson};\n");
  }

  public function readcfg() {
    preg_match('/(\=)(.*)(;)/',file_get_contents($this->cfg_file),$matches);
    return $matches[2];
  }

  public function getCfg() {
    return json_decode($this->readcfg());
  }
}