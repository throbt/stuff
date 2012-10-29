<?php

class Image_module extends Module {

  public function init() {
    global $loader;
    global $stuff;
    $this->loader = $loader;
    $this->stuff  = $stuff;

    include(CONFIG.'system.cfg');
    $this->sys = json_decode($this->stuff->sunesc($sys));
    $this->sys = $this->sys->system;

    require_once('image/image.php');
    $this->image  = new Image($this->sys);
    $this->types = array('article_image');
  }

  public function node_load($node) {
    switch($node['type']) {
      case 'article_image':
        $node['image_link'] = $this->getImageLink($node['name']);
      break;
    }
    return $node;
  }

  public function node_save($id,$post) {

    switch($post['type']) {

      case 'article_image':
        $node       = $this->loader->get('node');
        $node_type  = $node->node_type($post['type']);
        $cfg        = json_decode($node_type['cfg']);
        $imageName  = md5(microtime());
        $subdir     = $this->stuff->hash2Digit($imageName); 
        $pathTo     = UPLOAD.'images/'.$subdir;
        if($newImage = $this->image->moveUpload('name',$imageName,$pathTo)) {

          $this->image->scale($newImage,$imageName,array(1000,1000),'image_');

          $node->query("
            update article_image set name = ? where nid = ?
          ",array($newImage,$id));
        }
      break;

      // case 'user_image':
      //   $node       = $this->loader->get('node');
      //   $node_type  = $node->node_type($post['type']);
      //   $cfg        = json_decode($node_type['cfg']);
      //   $imageName  = md5(microtime());
      //   $subdir     = $this->stuff->hash2Digit($imageName); 
      //   $pathTo     = UPLOAD.'images/'.$subdir;
      //   $webPath    = "/upload/images/{$subdir}/";

      //   /*
      //     in this case, the file has arrived from an ajax upload - put method
      //   */
      //   if(isset($_SERVER['HTTP_X_FILE_NAME'])) {
      //     $arr      = explode('.',$_SERVER['HTTP_X_FILE_NAME']);
      //     $ext      = $arr[count($arr)-1];
      //     $newFile  = "{$pathTo}/{$imageName}.{$ext}";
      //     $this->image->fetchFromStdin($newFile);

      //     $this->image->scale("{$imageName}.{$ext}",$imageName,array($this->sys->user_landscape,$this->sys->user_landscape),'img_');

      //     $node->query("
      //       update user_image set image = ? where nid = ?
      //     ",array("{$imageName}.{$ext}",$id));


      //     $thisReturn = "{$webPath}{$imageName}.{$ext}";
      //   } else {

      //     if($newImage = $this->image->moveUpload('image',$imageName,$pathTo)) {
      //       $this->image->scale($newImage,$imageName,array($this->sys->user_landscape,$this->sys->user_landscape),'img_');

      //       $node->query("
      //         update user_image set image = ? where nid = ?
      //       ",array($newImage,$id));

      //       $thisReturn = "{$webPath}/{$newImage}";
      //     }
      //   }

      //   echo $thisReturn;
      // break;
    }
  }

  public function node_view($node) {

    if(in_array($node['type'],$this->types)) {
      if(isset($node['form']['form'])) {
        $thisForm   = $node['form'];
      } else {
        $nodeModel  = $this->loader->get('node');
        $thisForm   = $nodeModel->node_form($node['type']);
      }

      foreach($thisForm['elements'] as $k => $el) {
        if(isset($el['name'])) {
          if($el['name'] == 'image' || $el['name'] == 'name') {
            switch($node['type']) {
              case 'article_image':
                $node['image_link'] = $this->getImageLink($node['name']);
                $thisForm['elements'][$k] = array(
                  'type'  => 'special',
                  'html'  => '
                    <div class="control-group">
                      <div class="text">
                        <label>image view</label>
                        <ul class="thumbnails">
                          <li class="span2">
                            <a target="_blank" class="thumbnail" href="'.$node['image_link'].$node['name'].'">
                              <img class="image" rel="" src="'.$node['image_link'].'image_'.$node['name'].'" />
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  '
                );
              break;

            }
          }
        }
      }
      $node['form'] = $thisForm;
    }

    return $node;
  }

  public function node_new($node) {
    return $node;
  }

  public function node_form($form) {
    return $form;
  }

  public function node_delete($node) {
    if(in_array($node['type'],$this->types)) {

      if(isset($node['name'])) {
        $arr        = explode('.',$node['name']); 
      }

      if(isset($arr[0]))
        $subDir     = $this->stuff->hash2Digit($arr[0]);

      if(isset($arr[1])) {
        if(file_exists(UPLOAD.'images/' .$subDir.'/'.$node['name']))
          unlink(UPLOAD.'images/' .$subDir.'/'.$node['name']);
        if(file_exists(UPLOAD.'scaled/'.$subDir.'/'.$node['name']))
          unlink(UPLOAD.'scaled/'.$subDir.'/'.$node['name']);
        if(file_exists(UPLOAD.'scaled/'.$subDir.'/'."thumb_{$arr[0]}.{$arr[1]}"))
          unlink(UPLOAD.'scaled/'.$subDir.'/'."thumb_{$arr[0]}.{$arr[1]}");
        if(file_exists(UPLOAD.'scaled/'.$subDir.'/'."img_{$arr[0]}.{$arr[1]}"))
          unlink(UPLOAD.'scaled/'.$subDir.'/'."img_{$arr[0]}.{$arr[1]}");
      }
    }
    return $node;
  }

  public function title() {
    return 'image';
  }

  public function getImageLink($imgName) {
    $stuff  = $this->loader->get('stuff');
    $arr    = explode('.',$imgName);
    $subdir = $stuff->hash2Digit($arr[0]);
    return "/upload/scaled/{$subdir}/";
  }

  public function description() {
    return 'Handling images';
  }

  public function name_space() {
    return 'image';
  }
}