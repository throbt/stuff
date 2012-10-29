<?php

class Image {

  function __construct($sys) {
    global $stuff;
    $this->stuff  = $stuff;
    $this->sys    = $sys;
    require_once('crop.php');
    require_once('scale.php');
  }

  /*
    TODO - needs refact. the application depend params must get out of here
    @method scale

    @param $newFile   string - pathToTheFile.file
    @param $name      string - the hash without extension to generate the subdir
    @param $dim       array  - dimensions
    @param $prefix    string
    @return no return
  */
  public function scale($newFile,$name,$dim = array(),$prefix = '') {
    $subDir     = $this->stuff->hash2Digit($name);
    $pathTo     = UPLOAD.'images/'.$subDir.'/'.$newFile;
    $newPathTo  = UPLOAD.'scaled/'.$subDir.'/'.$newFile;
    $thumbPath2 = UPLOAD.'scaled/'.$subDir.'/'.$prefix.$newFile;
    $dimensions = getimagesize($pathTo);

    if(!is_dir(UPLOAD.'scaled/'.$subDir))
      mkdir(UPLOAD.'scaled/'.$subDir);

    copy($pathTo,$newPathTo);

    $image = new SimpleImage();
    $image->load($newPathTo);

    /* landscape */
    if($dimensions[0] >= $dimensions[1]) {
      $width  = $dim[0];
      $image->resizeToWidth($width);
    }
    /* portrait */
    else {
      $height = $dim[1];
      $image->resizeToHeight($height);
    }

    $image->save($thumbPath2);
  }

  /*
    TODO - needs refact the application depend params must get out of here
    @method crop

    @param $newFile string - pathToTheFile.file
    @param $name string - the hash without extension to generate the subdir
    @return no return
  */
  public function crop($newFile,$name) {

    $subDir     = $this->stuff->hash2Digit($name);
    $pathTo     = UPLOAD.'images/'.$subDir.'/'.$newFile;
    $newPathTo  = UPLOAD.'scaled/'.$subDir.'/'.$newFile;
    $width      = 0;
    $height     = 0;
    $rate       = 0;
    $dimensions = getimagesize($pathTo);

    if(!is_dir(UPLOAD.'scaled/'.$subDir))
      mkdir(UPLOAD.'scaled/'.$subDir);

    copy($pathTo,$newPathTo);

    /* landscape */
    if($dimensions[0] >= $dimensions[1]) {
      $width  = $this->sys->landscape;
      $rate   = $dimensions[0]/$width;
      $height = $dimensions[1]/$rate;
    }
    /* portrait */
    else {
      $height = $this->sys->portrait;
      $rate   = $dimensions[1]/$height;
      $width  = $dimensions[0]/$rate;
    }

    crop_image($newPathTo, $width, $height);
  }

  /*
    @method fetchFromStdin

    @param $file string
    @return no return
  */
  public function fetchFromStdin($file) {
    $putdata  = fopen("php://input", "r");
    $fp       = fopen($file, "w");

    /* Read the data 1 KB at a time
       and write to the file */
    while ($data = fread($putdata, 1024))
      fwrite($fp, $data);

    /* Close the streams */
    fclose($fp);
    fclose($putdata);
  }

  /*
    @method moveUpload

    @param $key string - the key of $_FILES array
    @param $name string
    @param $to string
    @return string if success return false if not
  */
  public function moveUpload($key='',$name='',$to='') {
    if($key != '' && $name != '' && $to != '') {
      if($_FILES[$key]["error"] == 0) {
        if(!is_dir($to)) {
          mkdir($to);
        }
        $ext      = $this->getExtension($_FILES[$key]["name"]);
        $newFile  = "{$name}.{$ext}";
        $newPath  = "{$to}/{$newFile}";
        
        if(move_uploaded_file($_FILES[$key]["tmp_name"],$newPath)) {
          return $newFile;
        }
      }
    }
    return false;
  }

  /*
    @method getExtension

    @param $fileName string
    @return string
  */
  public function getExtension($fileName) {
    $thisArr = explode('.',$fileName);
    return $thisArr[count($thisArr)-1];
  }
}
