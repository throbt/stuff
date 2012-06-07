<?php
  class Admin_slider_setup_controller extends Controller {

    public function init() {
      global $session;
      $this->session = $session;
      if(!$this->session->checkProfile()) {
        //$_SESSION['destination'] = $_SERVER['REQUEST_URI'];
        $this->redirect('login');
        die();
      }
      $this->model = $this->router->loader->get('Slider','model');
    }

    public function index() {
      
      $this->title = 'Evoline - background slider';
      $form           = $this->router->loader->get('Form');

      $this->content  = $form->render(array(

        'form'      => array(
          'action'    => '/admin_slider_setup/1/setup',
          'method'    => 'post',
          '_method'   => 'update',
          'id'        => 'slider',
          'token'     => true,
          'class'     => 'well form-horizontal',

          /* (default|empty) */
          'template'  => 'default'
        ),

        'elements'  => array(

            array(
              'type'    => 'select',
              'label'   => 'effect',
              'id'      => 'slider_effect',
              'class'   => 'input-xlarge',
              'name'    => 'effect',
              'options' =>  $this->model->getEffects(),
              'value'   => $this->model->getCfg()->slider->effect
            ),

            array(
              'type'    => 'select',
              'label'   => 'box cols',
              'id'      => 'box_cols',
              'class'   => 'input-xlarge',
              'name'    => 'box_cols',
              'options' =>  $this->model->getBoxCols(),
              'value'   =>  $this->model->getCfg()->slider->boxCols
            ),

            array(
              'type'    => 'select',
              'label'   => 'box rows',
              'id'      => 'box_rows',
              'class'   => 'input-xlarge',
              'name'    => 'box_rows',
              'options' =>  $this->model->getBoxRows(),
              'value'   =>  $this->model->getCfg()->slider->boxRows
            ),

            array(
              'type'    => 'select',
              'label'   => 'slices',
              'id'      => 'slices',
              'class'   => 'input-xlarge',
              'name'    => 'slices',
              'options' =>  $this->model->getSlices(),
              'value'   =>  $this->model->getCfg()->slider->slices
            ),

            array(
              'type'  => 'text',
              'label' => 'animSpeed,  a value between 1 and 4000 <small>(miliseconds)</small>',
              'id'    => 'email',
              'class' => 'input-xlarge',
              'name'  => 'animSpeed',
              'value' =>  $this->model->getCfg()->slider->animSpeed
            ),

            array(
              'type'  => 'text',
              'label' => 'pauseTime,  a value between 1 and 4000 <small>(miliseconds)</small>',
              'id'    => 'email',
              'class' => 'input-xlarge',
              'name'  => 'pauseTime',
              'value' =>  $this->model->getCfg()->slider->pauseTime
            ),

            array(
              'type'  => 'hidden',
              'id'    => 'layout',
              'name'  => 'layout',
              'value' =>  $this->model->getCfg()->layout->layout
            ),

            array(
              'type'  => 'special',
              'html'  => '
                <script>
                  function insert(obj) {
                    $("#layout").val($(obj).attr("rel"));
                    $("#thisLabel").html(["raster style:  ",$(obj).attr("rel")].join(""));
                  }
                </script>
                <label>choose raster style</label>
                <small id="thisLabel">raster style: '.$this->model->getCfg()->layout->layout.'</small>
                <div class="control-group">
                  <div style="width:175px;height:100px">
                    <div rel="01" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/01.png) repeat"></div>
                    <div rel="02" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/02.png) repeat"></div>
                    <div rel="03" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/03.png) repeat"></div>
                    <div rel="04" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/04.png) repeat"></div>
                    <div rel="05" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/05.png) repeat"></div>
                    <div rel="06" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/06.png) repeat"></div>
                    <div rel="07" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/07.png) repeat"></div>
                    <div rel="08" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/08.png) repeat"></div>
                    <div rel="09" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/09.png) repeat"></div>
                    <div rel="10" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/10.png) repeat"></div>
                    <div rel="11" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/11.png) repeat"></div>
                    <div rel="12" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/12.png) repeat"></div>
                    <div rel="13" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/13.png) repeat"></div>
                    <div rel="14" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/14.png) repeat"></div>
                    <div rel="15" onclick="insert(this)" style="cursor:pointer;width:30px;height:30px;margin-left:5px;margin-top:5px;float:left;background:url(/img/overlay/15.png) repeat"></div>
                  </div>
                </div>
              '
            ),

            
            array(
              'type'  => 'special',
              'html'  => '
                <script>
                  $(document).ready(function() {
                    $("#opacity").val('.$this->model->getCfg()->layout->opacity.');
                  });
                </script>
                <label>choose opacity</label>
                <div class="control-group">
                  <select class="control-group" id="opacity" name="opacity">
                    <option value="0">opacity: 0</option>
                    <option value="0.1">opacity: 0.1</option>
                    <option value="0.2">opacity: 0.2</option>
                    <option value="0.3">opacity: 0.3</option>
                    <option value="0.4">opacity: 0.4</option>
                    <option value="0.5">opacity: 0.5</option>
                    <option value="0.6">opacity: 0.6</option>
                    <option value="0.7">opacity: 0.7</option>
                    <option value="0.8">opacity: 0.8</option>
                    <option value="0.9">opacity: 0.9</option>
                    <option value="1">opacity: 1</option>
                  </select>
                </div>
              '
            ),


            array(
              'type'  => 'submit',
              'id'    => 'sbm',
              'class' => 'btn btn-primary',
              'value' => 'submit'
            )
        )
      ));

      echo $this->view->renderTemplate(
        array(
          'scope' => $this,
          'data'  => $this->content
        ),
        $this->view->getTemplatePath('admin','main')
      );
    }

    public function update() {
      if(isset($this->router->orders[2]) && $this->router->orders[2] == 'setup') {
        $this->setup();
      }
    }

    public function setup() {
      $cfg = array(
        'slider' => array(
          'effect'        => $this->post['slider_effect'],
          'boxRows'       => $this->post['box_rows'],
          'boxCols'       => $this->post['box_cols'],
          'slices'        => $this->post['slices'],
          'animSpeed'     => $this->post['animSpeed'],
          'pauseTime'     => $this->post['pauseTime'],

          'directionNav'  => false,
          'controlNav'    => false,
          'keyboardNav'   => true
        ),
        'layout' => array(
          'layout'  => $this->post['layout'],
          'opacity' => $this->post['opacity'],
        )
      );

      $this->model->writecfg($cfg);

      $this->redirect('admin_slider_setup');

      die();
    }
  }
?>